<?php 
include_once('config/config.php');

if (!isset($_SESSION['zalogowany'])) 
  {
   ?>
   <script>
    window.location.href = "/ticket/login.php";
  </script>
   <?php
  }
    // PERMISIONS

    $user = $_SESSION['user'];
    $permision = "SELECT permision FROM user WHERE username = '$user'";
    $permision_res = mysqli_query($polaczenie, $permision);
    $perm = mysqli_fetch_assoc($permision_res);
    $_SESSION['permision'] = $perm['permision'];

    // DARK MODE

    $dark_mode = "SELECT case_color, night_mode FROM user WHERE username = '$user'";
    $dark_mode_res = mysqli_query($polaczenie, $dark_mode);
    $dark = mysqli_fetch_assoc($dark_mode_res);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Ticket system - Elo</title>
	<link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/night-mode.css" />
  <?php 

    if ($dark['night_mode'] == 1){
      echo '<link rel="stylesheet" href="css/night.css" />';
    }

  ?>
  <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <script type="text/javascript" src="ajax/show_ticket.js"></script>
  <script type="text/javascript" src="class/description_class.js"></script>
</head>
<body class="text-center">
      <div class="header clearfix">
        <div class="header_box">
        <a href="/ticket/">
          <?php 

            if ($dark['night_mode'] == 0){
              echo '<img class="mb-2" src="img/logo.png" />';
            }elseif ($dark['night_mode'] == 1){
              echo '<img class="mb-2" src="img/logo_dark.png" />';
            }

          ?>     
        </a>
        <nav>
          <ul class="nav nav-pills float-right">
            <li class="nav-item">
              <a class="nav-link" href="/ticket/">Lista ticketów</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/ticket/add-ticket.php">Dodaj ticket</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/ticket/teams.php">Zespoły</a>
              <ul>
                <li><a href="add-team.php">Dodaj zespół</a></li>
                <li><a href="users_teams.php">Użytkownicy</a></li>
              </ul>
            </li>
            <?php if (isset($_SESSION['zalogowany'])){  ?>
            <li class="nav-item">
              <a class="nav-link" href="settings.php">Ustawienia</a>
              <ul>
                <li class="changelog"><a href="changelog.php">Changelog</a></li>
              </ul>
            </li>  
            <li class="nav-item">
              <a class="nav-link" href="/ticket/logout.php">Wyloguj</a>
            </li>
          <?php } ?>
          </ul>
        </nav>
        </div>
      </div>
      <div class="container">