<?php
  session_start();

    if (isset($_POST['nick']))
    {
      //udana walidarequire_once "connect.php";cja
      $wszystko_OK = true;    #jezeli chociaz jedna rzecz bedzie zle to nie wykona

      //sprawdz Nickname
      $nick = $_POST['nick'];

      //sprawdzenie długości nick'u
      if (strlen($nick)<3 || (strlen($nick)>20))
      {
        $wszystko_OK = false;
        $_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków";

      }

      if (ctype_alnum($nick)==false)
      {
        $wszystko_OK = false;
        $_SESSION['e_nick']="Nick może składać się tylko z liter i z cyfr!";
      }

        //sprawdz poprawność hasła
        $haslo = $_POST['haslo'];

        if (strlen($haslo)<5 || (strlen($haslo)>20))
        {
          $wszystko_OK = false;
          $_SESSION['e_haslo']="Hasło musi posiadać od 6 do 20 znaków!";

        }

        $haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);

     

        //Zapamietaj wprowadzone dane
        $_SESSION['fr_nick'] = $nick;
          $_SESSION['fr_email'] = $email;
            if(isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;

        require_once "config/config.php";
        mysqli_report(MYSQLI_REPORT_STRICT);

        try
        {
            $polaczenie = new mysqli($db_host, $db_user, $db_password, $db_name);

            if($polaczenie->connect_errno!=0) #sprawdzenie czy połączenie się udało. Jeżeli nie podaje komunikat o błędzie.
            {
              throw new Exception(mysqli_connect_errno());
            }

            else
            {
              //czy nick juz istnieje?
              $rezultat = $polaczenie->query("SELECT id FROM user WHERE username='$nick'");

              if(!$rezultat) throw new Exception($polaczenie->error);

              $ile_takich_nickow = $rezultat->num_rows;

              if($ile_takich_nickow>0)
              {
                $wszystko_OK = false;
                $_SESSION['e_nick']="Istnieje juz użytkownik o takim nicku!";
              }

              if($wszystko_OK==true)
              {
                //wszystko zaliczone
                if($polaczenie->query("INSERT INTO user VALUES ('', '$nick', '$haslo_hash', '', '', 'transparent' ,'LightGrey', '')"))
                {
                  $_SESSION['udanarejestracja']=true;
                  header('Location: /ticket/login.php');
                }
                else
                {
                  throw new Exception($polaczenie->error);
                }

              }

              $polaczenie->close();

            }
        }
          catch(Exception $e)
          {
            echo '<span style="color:red">Błąd serwera! Przepraszamy!</span>';
            echo '<br />Informacja developerska:'.$e;
          }
    }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Rejestracja - Elo</title>
  <link rel="stylesheet" href="css/style.css" />  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <style>
    .error{
      color: red;
      margin-top: 10px;
      margin-bottom: 10px;
    }
  </style>
  <script type="text/javascript" src="ajax/show_ticket.js"></script>
</head>
<body class="text-center" style="overflow: hidden;">
  



  <form method="post" class="form-signin">
    <a href="/ticket/"><img class="mb-2" src="img/logo.png" width="160px" /></a>
    <h1 class="login_h1 mb-3 font-weight-normal">Zarejestruj się</h1>
    <input type="text" class="w-100 input-username" placeholder="Nazwa użytkownika" autocomplete="off" value="<?php
    if(isset($_SESSION['fr_nick']))
    {
      echo $_SESSION['fr_nick'];          //dzieki temu przy wpisaniu np błędnego hasła informacje nie znikaja tylko pozostają na miejscu.
      unset($_SESSION['fr_nick']);
    }
    ?>" name="nick" />

    <?php
      if(isset($_SESSION['e_nick']))
      {
        echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
        unset($_SESSION['e_nick']);
      }
      ?>

    <input type="password" name="haslo" placeholder="Hasło" class="input-password w-100" autocomplete="off" />

    <?php
      if(isset($_SESSION['e_haslo']))
      {
        echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
        unset($_SESSION['e_haslo']);
      }
      ?>

    <button class="sign-bttn btn btn-lg btn-primary btn-block mb-2" type="submit">Zarejestruj</button>
    <span>Majsz już konto? <a href="/ticket/login.php" style="color: grey;">Zaloguj się!</a></span>
  </form>
	
	</div>
</div>
</body>

</html>
