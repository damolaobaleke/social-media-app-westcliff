<?php // Example 09: members.php
require_once 'header.php';

if (!$loggedin) die("</div></body></html>");

// Check if a specific user is being viewed
$recipient = $user;  // Default to logged-in user if no other user is viewed
if (isset($_GET['view'])) {
  $recipient = sanitizeString($_GET['view']);
}

echo "<h3>Send a Voice Note</h3>";

  // The voice recording interface
  echo <<<_END
  <div>
    <button id="recordBtn">Record</button>
    <button id="stopBtn" disabled>Stop</button>
    <audio id="audioPreview" controls style="display: none;"></audio>
    <form id="voiceNoteForm" method="POST" enctype="multipart/form-data" style="display: none;">
      <input type="hidden" name="recipient" value="$user">  <!-- Assuming you're sending to yourself; adjust as necessary -->
      <input type="file" name="voiceNote" id="voiceNoteInput" accept="audio/*">
      <button type="submit">Send</button>
    </form>
  </div>

  <script>
    const recordBtn = document.getElementById('recordBtn');
    const stopBtn = document.getElementById('stopBtn');
    const audioPreview = document.getElementById('audioPreview');
    const voiceNoteForm = document.getElementById('voiceNoteForm');
    const voiceNoteInput = document.getElementById('voiceNoteInput');

    let mediaRecorder, audioChunks;

    recordBtn.addEventListener('click', async () => {
      const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
      mediaRecorder = new MediaRecorder(stream);
      audioChunks = [];

      mediaRecorder.addEventListener('dataavailable', event => {
        audioChunks.push(event.data);
      });

      mediaRecorder.addEventListener('stop', () => {
        const audioBlob = new Blob(audioChunks, { type: 'audio/webm' });
        const audioURL = URL.createObjectURL(audioBlob);

        audioPreview.src = audioURL;
        audioPreview.style.display = 'block';

        // Create a file for form submission
        const file = new File([audioBlob], 'voice_note.webm', { type: 'audio/webm' });
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        voiceNoteInput.files = dataTransfer.files;

        voiceNoteForm.style.display = 'block';
      });

      mediaRecorder.start();
      recordBtn.disabled = true;
      stopBtn.disabled = false;
    });

    stopBtn.addEventListener('click', () => {
      mediaRecorder.stop();
      recordBtn.disabled = false;
      stopBtn.disabled = true;
    });
  </script>
_END;


if (isset($_GET['view'])) {
    $view = sanitizeString($_GET['view']);

    if ($view == $user) $name = "Your";
    else                $name = "$view's";
    $message_name = "$view";

    echo "<h3>$name Profile</h3>";
    showProfile($view);
    echo "<a data-role='button' data-transition='slide'
          href='messages.php?view=$view&r=$randstr'>View messages with $message_name</a>";
    die("</div></body></html>");
}

if (isset($_GET['add'])) {
    $add = sanitizeString($_GET['add']);

    $result = queryMysql("SELECT * FROM friends
      WHERE user='$add' AND friend='$user'");
    if (!$result->rowCount)
        queryMysql("INSERT INTO friends VALUES ('$add', '$user')");
} elseif (isset($_GET['remove'])) {
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM friends
      WHERE user='$remove' AND friend='$user'");
}

// New function to check if a user is online
function isUserOnline($username) {
    $result = queryMysql("SELECT online FROM members WHERE user='$username'");
    if ($row = $result->fetch()) {
        return $row['online'] == 1;
    }
    return false;
}

//Handle voice notes upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['voiceNote'])) {
  $recipient = sanitizeString($_POST['recipient']);
  $sender = $_SESSION['user'];

  $uploadsDir = 'uploads/voice_notes/';
  if (!file_exists($uploadsDir)) {
      mkdir($uploadsDir, 0777, true);
  }

  $filePath = $uploadsDir . uniqid() . '_' . $_FILES['voiceNote']['name'];
  move_uploaded_file($_FILES['voiceNote']['tmp_name'], $filePath);

  queryMySQL("INSERT INTO voice_notes (sender, recipient, file_path) VALUES ('$sender', '$recipient', '$filePath')");
  echo "<div>Voice note sent successfully!</div>";
}


$result = queryMysql("SELECT user FROM members ORDER BY user");
$num = $result->rowCount();

while ($row = $result->fetch()) {
    if ($row['user'] == $user) continue;

    $onlineStatus = isUserOnline($row['user']) ? "<span style='color: green;'>Online</span>" : "<span style='color: red;'>Offline</span>";

    echo "<li><a data-transition='slide' href='members.php?view=" .
        $row['user'] . "&$randstr'>" . $row['user'] . "</a> - $onlineStatus";
    $follow = "follow";

    $result1 = queryMysql("SELECT * FROM friends WHERE
      user='" . $row['user'] . "' AND friend='$user'");
    $t1 = $result1->rowCount();

    $result1 = queryMysql("SELECT * FROM friends WHERE
      user='$user' AND friend='" . $row['user'] . "'");
    $t2 = $result1->rowCount();

    if (($t1 + $t2) > 1) echo " &harr; is a mutual friend";
    elseif ($t1)         echo " &larr; you are following";
    elseif ($t2) {
        echo " &rarr; is following you";
        $follow = "recip";
    }

    if (!$t1) echo " [<a data-transition='slide'
      href='members.php?add=" . $row['user'] . "&r=$randstr'>$follow</a>]";
    else      echo " [<a data-transition='slide'
      href='members.php?remove=" . $row['user'] . "&r=$randstr'>drop</a>]";
}
?>
    </ul></div>
  </body>
</html>
