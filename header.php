<?php // Example 02: header.php
  session_start();

echo <<<_INIT
<!DOCTYPE html> 
<html>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'> 
    <link rel='stylesheet' href='jquery.mobile-1.4.5.min.css'>
    <link rel='stylesheet' href='styles.css' type='text/css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src='javascript.js'></script>
    <script src='jquery-2.2.4.min.js'></script>
    <script src='jquery.mobile-1.4.5.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

_INIT;

  require_once 'functions.php';

  $userstr = 'Welcome Guest';
  $randstr = substr(md5(rand()), 0, 7);

  if (isset($_SESSION['user']))
  {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = "Logged in as: $user";
  }
  else $loggedin = FALSE;

echo <<<_MAIN
  <style>
    
  </style>
    <title>Work Social: $userstr</title>
  </head>
  <body>
    <div data-role='page'>
      <div data-role='header'>
        <div id="" style="color:rgb(57, 57, 173); font-family:'Courier New'; font-size:100px;" class='center'>
         WorkSocial
        </div>
        <div class='username'>$userstr</div>
      </div>
      <div data-role='content'>

_MAIN;

  if ($loggedin)
  {
echo <<<_LOGGEDIN
        <div class='center'>
          <a data-role='button' data-inline='true' data-icon='home'
            data-transition="slide" href='members.php?view=$user&r=$randstr'>Home</a>
          <a data-role='button' data-inline='true' data-icon='user'
            data-transition="slide" href='members.php?r=$randstr'>Members</a>
          <a data-role='button' data-inline='true' data-icon='heart'
            data-transition="slide" href='friends.php?r=$randstr'>Friends</a><br>
          <a data-role='button' data-inline='true' data-icon='mail'
            data-transition="slide" href='messages.php?r=$randstr'>Messages</a>
          <a data-role='button' data-inline='true' data-icon='edit'
            data-transition="slide" href='profile.php?r=$randstr'>Edit Profile</a>
          <a data-role='button' data-inline='true' data-icon='action'
            data-transition="slide" href='logout.php?r=$randstr'>Log out</a>
        </div>
        
_LOGGEDIN;
  }
  else
  {
echo <<<_GUEST
        <div class='center'>
          <a data-role='button' data-inline='true' data-icon='home'
            data-transition='slide' href='index.php?r=$randstr''>Home</a>
          <a data-role='button' data-inline='true' data-icon='plus'
            data-transition="slide" href='signup.php?r=$randstr''>Sign Up</a>
          <a data-role='button' data-inline='true' data-icon='check'
            data-transition="slide" href='login.php?r=$randstr''>Log In</a>
        </div>
        <p class='info'>(You must be logged in to use this app)</p>
        
_GUEST;
  }
?>
