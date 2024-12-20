<!DOCTYPE html> <!-- Example 03: setup.php -->
<html>
  <head>
    <title>Setting up database</title>
  </head>
  <body>
    <h3>Setting up...</h3>

<?php
  require_once  'functions.php';

  createTable('members',
              'user VARCHAR(16),
              pass VARCHAR(16),
              online  TINYINT(1) DEFAULT 0,
              INDEX(user(6))');

  createTable('messages', 
              'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              auth VARCHAR(16),
              recip VARCHAR(16),
              pm CHAR(1),
              time INT UNSIGNED,
              message VARCHAR(4096),
              INDEX(auth(6)),
              INDEX(recip(6))');

  createTable('friends',
              'user VARCHAR(16),
              friend VARCHAR(16),
              INDEX(user(6)),
              INDEX(friend(6))');

  createTable('profiles',
              'user VARCHAR(16),
              text VARCHAR(4096),
              INDEX(user(6))');

  createTable('voice_notes',
    'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY',
    'sender VARCHAR(16)',
    'recipient VARCHAR(16)',
    'file_path VARCHAR(255)',
    'timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
    'INDEX(sender(6))',
    'INDEX(recipient(6))'
  );
              
?>

    <br>...done.
  </body>
</html>
