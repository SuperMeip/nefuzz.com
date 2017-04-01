<?php 
session_start();
error_reporting( E_ALL );
//include('php/login.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="css/style.php?p=styles.scss" />
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <?php require_once('components/header.php'); ?>
</head>
<body>
  <header>
    <div class="hidden_bumper"></div>
    <div class="site_banner">
      <img class="logo" src='img/nefuzzicon.png'/>
      <img class="name" src='img/fuzztext.png'/>
    </div>
    <div class="nav_bar" id="main-nav-bar">
      <a href="#"><i class="fa fa-home" aria-hidden="true"></i><span class="desktop margin_left_small">Home</span></a>
      <a href="#"><i class="fa fa-list" aria-hidden="true"></i><span class="desktop margin_left_small">Meets</span></a>
      <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i><span class="desktop margin_left_small">Calendar</span></a>
      <a href="#"><i class="fa fa-search" aria-hidden="true"></i><span class="desktop margin_left_small">Search</span></a>
      <?=(isset($_SESSION['user']) ? icon_and_logout($_SESSION['user']) : login_modal());?>
    </div>
  </header>
  <main>