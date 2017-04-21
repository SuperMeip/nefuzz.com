<?php
//used to log out the current session

function logout() {
  $_SESSION['user'] = null;
  session_destroy();
}

if (isset($_GET['ajax'])) {
  session_start();
  logout();
}
?>