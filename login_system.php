<?php

  session_start(); #włączanie sesji dla całego dokumentu zawsze musi być na samym początku. Niejawne przesyłanie danych (uzytkownik nie widzi danych).
                    #Robi się to po to aby zmienne dostępne był dla każdego pliku php.

  if((!isset($_POST['login'])) || (!isset($_POST['haslo']))) #jeśli login ani hasło nie zostały wpisane przenieś na strone logowania.
  {
    header('Location: /ticket/login.php');
    exit();
  }

  require_once "config/config.php"; #dołącza plik. Once powoduje to że następuje sprawdzenie czy nie zostało to już wcześniej użyte.

    $polaczenie = @new mysqli($db_host, $db_user, $db_password, $db_name); #podłączenie do bazy danych i pobranie nazwy uzytkownika, hasła i nazwy bazy.

    if($polaczenie->connect_errno!=0) #sprawdzenie czy połączenie się udało. Jeżeli nie podaje komunikat o błędzie.
    {
      echo "ERROR:".$polaczenie->connect_errno;
    }
    else
    {
      $login = $_POST['login'];

      $haslo = $_POST['haslo'];

      $login = htmlentities($login, ENT_QUOTES, "UTF-8");         #zabezpieczenie strony przed włamaniem się na konto poprzez podmienienie znaczników html.


      if ($rezultat = @$polaczenie->query(sprintf("SELECT * FROM user WHERE username='%s'",  #określa jakie zapytanie ma zośtać wysłane do bazy.
      mysqli_real_escape_string($polaczenie,$login))))         #$polaczenie->query - połączenie metodą query czyli kwerenda (wysłanie zapytania).
                                                              #gotowa funkcja która nie pozwala na zalogowanie się bez odpowiednich danych.
      {
        $ilu_userow = $rezultat->num_rows; #jeżeli zwróci wiecej niż zero rekordów (1 - taki uzytkownik istnieje) to może zalogować. Jeśli nie zwraca błąd.
        if ($ilu_userow>0)
        {
            $wiersz = $rezultat->fetch_assoc(); #tablicja asocjacyjna. Zbiera zmienne o takich samych nazwach jak nazwy kolumn w tabeli.

            if(password_verify($haslo, $wiersz['password']))
            {

            $_SESSION['zalogowany'] = true;   #zmienna (flaga) mówi nam o tym że jesteśmy zalogowani i nie musimy za każdym razem sie logować.

            $_SESSION['id'] = $wiersz['id'];
            $_SESSION['user'] = $wiersz['username'];

            unset($_SESSION['blad']);  #jeśli uda się zalogować usówa z sesju zmienną błąd, która nie jest już potrzebna.

            $rezultat->close(); #czyści wyjęte rezultaty z tablicy kiedy przestaną być potrzebne.

            header('Location: /ticket/'); #przenośi do strony cos.php.
            }

            else
            {
              $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy Login lub Hasło!</span>';
              header('Location: /ticket/login.php');
            }

        }

        else
        {
          $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy Login lub Hasło!</span>';
          header('Location: /ticket/login.php');
        }
      }
      $polaczenie->close();  #zamyka połączenie z bazą.
    }








 ?>
