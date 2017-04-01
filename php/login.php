<?php
  include('php/getuser.php');
  if (isset($_POST['login_attempt'])) {
    $user = getUser($_POST['login_attempt']['user'], $_POST['login_attempt']['password']);
    if ($user) {
      $_SESSION['user'] = $user;
    }
    else{
      $_SESSION['login_attempt'] = false;
    }
  }

  if(isset($_SESSION['login_attempt']))
    if($_SESSION['login_attempt'] === "false"){
      echo "<script>window.alert('Login attempt failed, bad username/password');</script>";
      session_unset();
  }
?>