<?php
    include("config.php");
    $con = new mysqli($db_host, $db_user, $db_user_psw);
    $q = "CREATE DATABASE IF NOT EXISTS $db_name";
    if($con -> query($q)) echo "<br>query creazione database <b>$db_name</b> eseguita correttamente"; // query creazione database
    else echo "<br>errore query creazione database: ".mysqli_error($con); 

   
?>