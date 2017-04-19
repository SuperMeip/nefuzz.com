<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/user.php");
session_start();
//$_SESSION['user'] = null;
error_reporting( E_ALL );
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>New England Fuzz</title>
  <meta name="description" content="A website for hosting and discovering furry meets in New England">
  <meta name="keywords" content="new england, new, england, massachussetts,
    boston, harftord, conneticut, vermont, new hampshire, rhode island,
    providence, maine, furry, fur, furmeet, furbowl, mascot, anthropomorphic,
    meet, meets, meetup, convention">
  <meta name="author" content="Meep">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="css/style.php?p=styles.scss" />
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/cleave.min.js"></script>
  <script type="text/javascript" src="js/cleave-phone.us.js"></script>
  <?php require_once($_SERVER['DOCUMENT_ROOT']."/components/header.php"); ?>
</head>
<body>
  <header>
    <div class="hidden_bumper"></div>
    <div class="site_banner">
      <img class="logo" src='img/nefuzzicon.png'/>
      <img class="name" src='img/fuzztext.png'/>
    </div>
    <div class="nav_bar" id="main-nav-bar">
      <a class="item" href="/"><i class="fa fa-home" aria-hidden="true"></i><span class="desktop margin_left_small">Home</span></a>
      <a class="item" href="#"><i class="fa fa-list" aria-hidden="true"></i><span class="desktop margin_left_small">Meets</span></a>
      <a class="item" href="#"><i class="fa fa-calendar" aria-hidden="true"></i><span class="desktop margin_left_small">Calendar</span></a>
      <a class="item" href="#"><i class="fa fa-search" aria-hidden="true"></i><span class="desktop margin_left_small">Search</span></a>
      <?=(isset($_SESSION['user']) ? icon_and_logout($_SESSION['user']) : login_modal());?>
    </div>
  </header>
  <main>