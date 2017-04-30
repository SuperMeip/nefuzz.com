<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/cleave.min.js"></script>
  <script type="text/javascript" src="js/cleave-phone.us.js"></script>
  <script src="https://unpkg.com/babel-polyfill@6.2.0/dist/polyfill.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rome/2.1.22/rome.standalone.js"></script>
  <script src="js/material-datetime-picker.js" charset="utf-8"></script>
  <!--<link rel="stylesheet" href="css/material-datetime-picker.css" />-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <?=((require_once($_SERVER['DOCUMENT_ROOT']."/components/common.php"))?"":"");?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="icon" sizes="192x192" href="img/iconsquare.png">
	<link rel="apple-touch-icon" href="img/iconsquare.png">
  <link rel="stylesheet" href="css/style.php?p=styles.scss" />
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <meta name="theme-color" content="green"/>
	<meta name="mobile-web-app-capable" content="yes">
  <meta charset="UTF-8">
  <meta name="keywords" content="new england, new, england, massachussetts,
          boston, harftord, conneticut, vermont, new hampshire, rhode island,
          providence, maine, furry, fur, furmeet, furbowl, mascot, anthropomorphic,
          meet, meets, meetup, convention <?=$this->extra_keywords();?>">
  <meta name="author" content="<?=$this->author;?>">
	<?=$this->meta_tags();?>
  <title><?=$this->title;?></title>
  <meta name="description" content="<?=$this->description;?>">
  <?=$this->links();?>
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
      <a class="item" href="/map.php"><i class="fa fa-map" aria-hidden="true"></i><span class="desktop margin_left_small">Map</span></a>
      <a class="item" href="#"><i class="fa fa-search" aria-hidden="true"></i><span class="desktop margin_left_small">Search</span></a>
      <?=$this->login_or_logout($_SESSION['user'] ?? null);?>
    </div>
  </header>
  <main>