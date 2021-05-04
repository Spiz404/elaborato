<?php
    include("config.php");
    include("navbar.php");
    function genPsw(){
        $l = 8;
        $f = 0;
        $psw = "";
        for($i = 0; $i < $l; $i++){
            $f = rand(0,1);
            if(!$f){ // caso lettera
                $t = 0; // flag per determinare se il carattere deve essere minuscolo o maiuscolo
                $t = rand(0,1);
                $c = rand(65,87); // estraggo un un carattere maiuscolo
                if(!$t){ // lettera minuscola, quindi aggiungo al valore estratto 32
                    $c = chr($c + 32);
                    $psw .= $c;
                }
                else{ // lettera maiuscola
                    $c = chr($c);
                    $psw .= $c;
                }
            }
            else{ // caso numero
                $n = rand(0,9);
                $psw .= $n;
            }
        }

        return $psw;
    }

    $con = new mysqli($db_host, $db_user, $db_user_psw, $db_name);
    if(mysqli_connect_errno()){
        echo "errore di connessione, errore: ".mysqli_connect_error();
    }
    else{
        if(isset($_POST["add-btn"])){
            $valid = true;
            // reperisco i dati inseriti 
            $username = $_POST["username"];
            $nome = $_POST["nome"];
            $cognome = $_POST["cognome"];
            $email = $_POST["email"];
            $password = genPsw();
            // controllo se l'username inserito non è già presente
            $c = 0;
            $q = "SELECT * FROM Amministratori WHERE Username = '$username'";
            $ris = $con -> query($q) or die(mysqli_error($con));
            $c += mysqli_num_rows($ris);
            $q = "SELECT * FROM Amministratori WHERE Username = '$username'";
            $ris = $con -> query($q) or die(mysqli_error($con));
            $c += mysqli_num_rows($ris);
            $q = "SELECT * FROM Amministratori WHERE Username = '$username'";
            $ris = $con -> query($q) or die(mysqli_error($con));
            $c += mysqli_num_rows($ris);
            $q = "SELECT * FROM Amministratori WHERE Username = '$username'";
            $ris = $con -> query($q) or die(mysqli_error($con));
            $c += mysqli_num_rows($ris);
            if($c){
                $user_error = "Username già in utilizzo";
                $valid = false;
            } 
            
            // controllo se la email inserita non è già presente

            $c = 0;
            $q = "SELECT * FROM Amministratori WHERE Email = '$email'";
            $ris = $con -> query($q) or die(mysqli_error($con));
            $c += mysqli_num_rows($ris);
            $q = "SELECT * FROM Amministratori WHERE Email = '$email'";
            $ris = $con -> query($q) or die(mysqli_error($con));
            $c += mysqli_num_rows($ris);
            $q = "SELECT * FROM Amministratori WHERE Email = '$email'";
            $ris = $con -> query($q) or die(mysqli_error($con));
            $c += mysqli_num_rows($ris);
            $q = "SELECT * FROM Amministratori WHERE Email = '$email'";
            $ris = $con -> query($q) or die(mysqli_error($con));
            $c += mysqli_num_rows($ris);
            if($c){
                $email_error = "Email già in utilizzo";
                $valid = false;
            } 

            if($valid){
                $q = "INSERT INTO Amministratori(Username, Nome, Cognome, Email, Psw) VALUES('$username', '$nome', '$cognome', '$email', '$password')";
                $ris = $con -> query($q) or die(mysqli_error($con));
                echo "<p>Le credenziali d'accesso sono state inviate all'email inserita in fase di registrazione, la password, una volta effettuato il primo accesso, sarà modificabile.</p>";
                
                $to = $email; // Send email to our user
                $subject = 'Registrazione'; // Give the email a subject 
                $message = "
                
                $username, i tuoi dati d'accesso sono i seguenti: 
               
                username: $username
                password: $password
                
                ";
                                    
                $headers = 'From:lorespiz03@gmail.com' . "\r\n"; 
                mail($to, $subject, $message, $headers); 
                //header("location: index.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
        <link rel = "stylesheet" href = "style2.css"> 
</head>
<body>
    <div class = "tab-div">
        <form method = 'POST' action = "<?php $_SERVER["PHP_SELF"] ?>">
            <table class = "tab-ut">
                <tr class = "th-row">
                    <th> Nome Utente </th> <th> Nome </th> <th> Cognome </th> <th> Email </th>
                </tr>
                <tr class = "data-row">
                    <td> <input name = "username" id = "add-username"> </input> <br>
                    <?php if(isset($user_error)) echo "<span style = 'color: red;'> $user_error </span>"; ?>
                    </td>
                    <td> <input name = "nome" id = "add-nome"> </input> </td>
                    <td> <input name = "cognome" id = "add-nome"> </input> </td>
                    <td> <input name = "email"  id = "add-cognome"> </input><br>
                    <?php if(isset($email_error)) echo "<span style = 'color: red;'> $email_error </span>"; ?>
                    </td>
                </tr>
            </table>
            <button type = "submit" class = "mod-btn" name = "add-btn"> aggiungi </button>
        </form>
    </div>
</body>
</html>