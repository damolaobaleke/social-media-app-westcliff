<?php // Example 04: index.php
  session_start();
  require_once 'header.php';

  echo "<div class='center'>Welcome to WorkSocial,";

  if ($loggedin) echo " $user, you are logged in";
  else           echo ' please sign up or log in';

echo <<<_END
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        .footer {
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            padding: 10px 20px;
            text-align: center;
        }
    </style>
    <div class="content">

    </div>
    <div class="footer">
        <div class="container">
            <div class="row py-5">
                <div class="col-md-4">
                    <a data-inline="true" class="help-btn px-2 py-1" style="background:white; border:1px solid black; border-radius:10px"
                        data-transition="slide" href="help.php">Help</a>
                </div>
                <div class="col-md-4">
                    <a target="_blank" href="https://www.linkedin.com/mynetwork/grow/">LinkedIn Referrals</a>
                </div>
                <div class="col-md-4">
                    <ul>
                        <li><a target="_blank" href="https://forms.gle/xy7fGxqs2LR9CeR78">Feedback Form</a></li>
                        <li><a target="_blank" href="mailto:R.Dulani.438@westcliff.edu">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
_END;
?>

