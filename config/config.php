<?php
session_start();
    define('DB_NAME','31602436_ticket');
    define('DB_USER','31602436_ticket');
    define('DB_PASSWORD','Sqbany122!!');
    define('DB_HOST','sql.serwer1943143.home.pl');

    $db_name=DB_NAME; 
    $db_host=DB_HOST; 
    $db_user=DB_USER;
    $db_password=DB_PASSWORD;

    $polaczenie = @new mysqli('sql.serwer1943143.home.pl', '31602436_ticket', 'Sqbany122!!', '31602436_ticket');
    mysqli_query($polaczenie, "SET CHARSET utf8"); 
    mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

    if (mysqli_connect_errno() != 0){
    	echo '<p>Wystąpił błąd połączenia: ' . mysqli_connect_error() . '</p>';
    }
    
?>