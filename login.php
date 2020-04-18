<!DOCTYPE html>
<html>
<head>
	<title>Logowanie - Elo</title>
	<link rel="stylesheet" href="css/style.css" />	
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <script type="text/javascript" src="ajax/show_ticket.js"></script>
</head>
<body class="text-center" style="overflow: hidden;">

 <form class="form-signin" action="login_system.php" method="post" style="">
 	<a href="/ticket/"><img class="mb-2" src="img/logo.png" width="160px" /></a>
      <h1 class="login_h1 mb-3 font-weight-normal">Zaloguj się!</h1> 
      <label for="inputUsername" class="sr-only">Nazwa użytkownika</label>
      <input type="text" id="inputEmail" class="input-username w-100" name="login" placeholder="Nazwa użytkownika" required autofocus>
      <label for="inputPassword" class="sr-only">Hasło</label>
      <input type="password" id="inputPassword" class="input-password w-100" name="haslo" placeholder="Hasło" required>
      <!--<div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div> -->
      <button class="sign-bttn btn btn-lg btn-primary btn-block mb-2" type="submit">Zaloguj</button>
      <span>Nie masz konta? <a href="/ticket/rejestracja.php" style="color: grey;">Zarejestruj się!</a></span>
  </form>

<?php //include_once('footer.php') ?>   