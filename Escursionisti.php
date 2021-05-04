<?php
    include("navbar.php");
    include("config.php");
    $con = new mysqli($db_host, $db_user, $db_user_psw, $db_name);
    if(mysqli_connect_errno()){

    }
    echo "<head> 
             <link href =\"style2.css\" rel = \"stylesheet\">
          </head>";
    // eliminazione record selezionati
    if(isset($_POST["del"])){
        if(isset($_POST['vet-del']) && !empty($_POST['vet-del'])){
            $vet = $_POST['vet-del'];
            for($i = 0; $i < count($vet); $i++){
                $q = "DELETE FROM Escursionisti WHERE Username =\"$vet[$i]\" ";
                $ris = $con -> query($q) or die("errore query");

            }
        }
    }

    // modifica record selezionato, il record selezionato può essere modificato solo se la registrazione di questo è stata completata
    if(isset($_POST["mod"])){
        if(isset($_POST['modifica']) && !empty($_POST['modifica'])){ // controllo se non è vuoto il vettore contenete l'username dell'utente da modificare
            $utenti = $_POST["modifica"];
            for($i = 0; $i < count($utenti); $i++){
                $utente = $utenti[$i];
                $q = "SELECT * FROM Escursionisti WHERE Username = '$utente'"; // selezione dati utente da modificare
                $ris = $con -> query($q) or die(mysqli_error($con));
                // stampa tabella contente dati relativi all'utente da modificare
                echo " 
                <div class = \"tab-div\">
                    <form method = 'POST' action = ".$_SERVER["PHP_SELF"].">
                        <table class=\"tab-ut\">
                            <tr class = \"th-row\">
                                <th> Nome Utente </th> <th> Nome </th> <th> Cognome </th> <th> Email </th> 
                            </tr>";
                foreach($ris as $r){
                $_SESSION["mod-id"] = $r["Username"]; // metto l'username dell'utente da modificare in una variabile di sessione
                echo "
                            <tr>
                                <td> <input value = ".$r["Username"]." name = 'username'> </input></td>
                                <td> <input value = ".$r["Nome"]." name = 'nome'> </input></td>
                                <td> <input value = ".$r["Cognome"]." name = 'cognome'> </input></td>
                                <td><input value = ".$r["Email"]." name = 'email'> </input></td>
                            </tr>
                        </table>    
                        <button class = 'mod-btn' name = 'mod-btn'> conferma </button>
                    </form>
                </div>";
                }
                // modifica dati
              
            }
        }
    }
    else if(isset($_POST["mod-btn"])){
        $user = $_SESSION["mod-id"];
        $username = $_POST["username"];
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $email = $_POST["email"];
        $q = "UPDATE Escursionisti SET Username = '$username', Nome = '$nome', Cognome = '$cognome', Email = '$email' WHERE Username = '$user'";
        $ris = $con -> query($q) or die(mysqli_error($con));
    }

    
    echo "
        <div class = \"tab-div\">
            <form method = 'POST' action = ".$_SERVER["PHP_SELF"].">
                <table class=\"tab-ut\">
                <tr class = \"th-row\">
                <th> Nome Utente </th> <th> Nome </th> <th> Cognome </th> <th> Email </th> <th> Comp </th> <th> Elimina </th> <th> Modifica </th>
                </tr>";
    $q = "SELECT * FROM Escursionisti";
    $ris = $con -> query($q) or die(mysqli_error($con));
    foreach($ris as $r){
        echo "
            <tr class = \"data-row\">
                <td> ".$r["Username"]." </td>
                <td> ".$r["Nome"]." </td>
                <td> ".$r["Cognome"]." </td>
                <td> ".$r["Email"]." </td>
                <td> ".$r["Comp"]." </td>
                <td> <input type = \"checkbox\" name = 'vet-del[]' value = ".$r["Username"]."> </input> </td>
                <td> <input type = \"radio\" name = 'modifica[]' value = ".$r["Username"]."> </input> </td>
            </tr>
        ";
    }
    echo "</table>
        <div onclick = \"showOp()\" class =\"opt-btn\"><p> opzioni </p></div>
        <div class=\"opt-div\" id = \"opt-div\">
            <button type = 'submit' name = 'del'> elimina </button>
            <button type = 'submit' name = 'mod'> modifica </button>
        </div>
    </div>
    <script src = \"tab-script.js\"> </script>
    ";
?>