<?php
    include("config.php");
    include("navbar.php");
    $con = new mysqli($db_host, $db_user, $db_user_psw, $db_name);
    if(mysqli_connect_errno()){
        $v = false;
    }
    else $v = true;
    // elaborazione 
    if($v){

        // aggiunta escursione
        /*
        if(isset($_POST["add-esc"])){
            /* stampo tabella con input per inserimento escursione 
               NB gli optional vengono inseriti successivamente
        
            echo "
            <form method = 'POST' action = ".$_SERVER["PHP_SELF"].">
                <table class = \"ut-tab\">
                    <tr class = \"th-row\"> 
                        <th> Tipo </th> <th> Prezzo </th> <th> minimo persone </th> <th> massimo persone </th> <th> Guide </th>  <th> data </th> <th> ora inizio </th> <th> ora Fine </th> <th> livello difficoltà </th>
                    </tr>
                    <tr>
                        <td> 
                            <select name = 'tipo'> ";
                        $qTipo = "SELECT * FROM TipoEscursione";
                        $risTipo = $con -> query($qTipo) or die(mysqli_error($con));
                        foreach($risTipo as $rTipo){
                            echo "<option value = \"".$rTipo["idTipoEsc"]."\">".$rTipo["Nome"]."</option>";
                        }
            
            echo "
                        </select>
                        </td>

                        <td>
                            <input name = 'prezzo' type = 'number'> </input>
                        </td>

                        <td>
                            <input type = 'number' name = 'MinP'> </input>
                        </td>

                        <td>
                            <input type = 'number' name = 'MaxP'> </input>
                        </td>
                        <td>
                            <select multiple name = 'guide[]'>";
                            $qGuide = "SELECT * FROM Guide";
                            $risGuide = $con -> query($qGuide) or die(mysqli_error($con));
                            foreach($risGuide as $rGuide){
                                echo "<option value\"".$rGuide["Username"]."\">".$rGuide["Username"]."</option>";
                            }
                            echo "
                            </select>
                        </td>
                        
                        <td>
                            <input type = 'date' name = 'dataE'> </input>
                        </td>

                        <td>
                            <input type = 'time' name = 'OraP'> </input>
                        </td>

                        <td>
                            <input type = 'time' name = 'OraA'> </input>
                        </td>

                        <td>
                            <select name = 'diff'>
                                <option value = '1'> 1 </option>
                                <option value = '3'> 2 </option>
                                <option value = '2'> 3 </option>
                            </select>
                        </td>
                    </tr>
                </table>
                <button type = 'submit' name = 'add-btn' class = 'mod-btn'> aggiungi </button>
            </form>
            ";
        }
        */
        // postback form aggiunta escursione
        if(isset($_POST["add-btn"])){
            $tipo = $_POST["tipo"];
            $prezzo = $_POST["prezzo"];
            $minP = $_POST["MinP"];
            $maxP = $_POST["MaxP"];
            $guide = $_POST["guide"];
            $data = $_POST["dataE"];
            $oraP = $_POST["OraP"];
            $oraA = $_POST["OraA"];
            $diff = $_POST["diff"];
            $prezzo = $_POST["prezzo"];
            // query aggiunta escursione
            $qAdd = "INSERT INTO Escursioni VALUES(0, '$oraP', '$oraA', $prezzo, $tipo, $maxP, $minP, '$data', $diff)";
            $risAdd = $con -> query($qAdd) or die(mysqli_error($con));
            
            $qL = "SELECT LAST_INSERT_ID() as l FROM Escursioni";
            $risL = $con -> query($qL) or die(mysqli_error($con));
            // seleziono l'id dell'ultima escursione inserita
            foreach($risL as $rL) $lastId = $rL["l"];
            // per ogni guida aggiungo un record
            foreach($guide as $g){
                $qA = "INSERT INTO GuideEsc VALUES('$g', $lastId)";
                $risA = $con -> query($qA) or die(mysqli_error($con));
            }

        }

        // rimozione escursioni selezionate
        if(isset($_POST["del-esc"])){

        }

        // modifica dati escursione
        if(isset($_POST["mod-esc"])){

        }

        // opzioni escursione
        if(isset($POST["opt-esc"])){
            $id = $_POST["mod"];
            echo "
            <div class =\"optional-container\" style = 'border: 3px solid red;'>
                <form action ".$_SERVER["PHP_SELF"]." method = 'POST'>
                <table class =\"tab-optional\">
                    <tr>
                        <th> idOptional </th> <th> Tipo </th> <th> Prezzo </th> <th> Descrizione </th> <th> elimina </th> <th> modifica </th>
                    </tr>
                ";
            // query di selezione optional
            $q4 = "SELECT * 
                FROM Optional O INNER JOIN TipoOptional T on O.idTipo = T.idTipo
                WHERE O.idEscursione = ".$id;
            $ris4 = $con -> query($q4) or die(mysqli_error($con));
            
                foreach($ris4 as $r4){
                    echo "<tr>";
                        echo "<td> ".$r4["idOptional"]."</td>";
                        echo "<td> ".$r4["Nome"]."</td>";
                        echo "<td> ".$r4["Prezzo"]."</td>";
                        echo "<td> ".$r4["Descrizione"]."</td>";
                        echo "<td> <input type = 'checkbox' name = 'vetOp[]'> </input> </td>";
                        echo "<td> <input type = 'radio' name = 'mod'> </input> </td>";
                    echo "</tr>";
                }
            echo "
                    </table>
                    <button type = 'submit' name = 'addOpt'> aggiungi </button>
                    <button type = 'modOpt' name = 'modOpt'> modifica </button>
                    <button type = 'submit' name = 'delOpt'> elimina </button>
                </form>
            </div>
                ";
            
        }
    }
    if($v):
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href = "style2.css" rel ="stylesheet">
    <title> Escursioni </title>
</head>
<body>
    <form action = "<?php $_SERVER["PHP_SELF"] ?>" method = "POST"> 
        <table class ="tab-ut">
            <tr class = "th-row">
                <th> idEscursione </th> <th> Tipo </th> <th> Prezzo </th> <th> Numero Partecipanti </th> <th> Ora inizio </th> <th> Ora Fine </th> <th> Data </th> <th> Guide </th> <th> Livello difficoltà </th> <th> Optional </th> <th> Elimina </th> <th> Modifica </th> <th> Optional </th>
            </tr>
            <?php
                $q = " SELECT * FROM Escursioni";
            
                $ris =  $con -> query($q) or die("errore query selezione escursione e dettagli: ".mysqli_error($con));
                foreach($ris as $r){
                    // calcolo prezzo e calcolo numero partecipanti e creazione stringa contenente guide escursione
                    $prezzo = $r["Prezzo"];
                    $q1 = "SELECT SUM(Prezzo) as Somma FROM Optional WHERE idEscursione = ".$r["idEscursione"];
                    $ris1 = $con -> query($q1) or die(mysqli_error($con));
                    $q2 = "SELECT COUNT(*) as Numero FROM PartecipazioniEsc WHERE idEscursione = ".$r["idEscursione"];
                    $ris2 = $con -> query($q2) or die(mysqli_error($con));
                    $q3 = "SELECT * FROM GuideEsc WHERE idEscursione = ".$r["idEscursione"];
                    $ris3 = $con -> query($q3) or die(mysqli_error($con));
                    $guide = "";
                    foreach($ris3 as $r3){
                        $guide .= $r3["idGuida"];
                        $guide .= " ";
                    }

                    foreach($ris2 as $r2){
                        $partecipanti = $r2["Numero"];
                    }

                    foreach($ris1 as $r1){
                        $prezzo += $r1["Somma"];
                    }
                    $idTipoE =  $r["Tipo"];
                    $qT = "SELECT Nome FROM TipoEscursione WHERE idTipoEsc = $idTipoE";
                    $risT = $con -> query($qT) or die(mysqli_error($con));

                    foreach($risT as $rT) $tipo = $rT["Nome"];
                    echo "<tr class = 'data-row'><td>".$r["idEscursione"]."</td>";
                    echo "<td> $tipo </td>";
                    echo "<td> $prezzo €</td>";
                    echo "<td> $partecipanti </td>";
                    echo "<td>". $r["OraIn"]."</td>";
                    echo "<td>". $r["OraF"]."</td>";
                    echo "<td>". $r["DataE"]."</td>";
                    echo "<td> $guide </td>";
                    echo "<td>". $r["LvDif"]."</td>";
                    echo "<td><a onclick = \"ShowOp()\"> visualizza </a> </td>";
                    echo "<td><input type = 'checkbox' name = 'delE[]' value = ".$r["idEscursione"]."> </input></td>";
                    echo "<td><input type = 'radio' name = 'modE' value = ".$r["idEscursione"]."> </input></td>";
                    echo "<td><input type = 'radio' name = 'opt' value = ".$r["idEscursione"]."> </input></td>";
                    echo"</tr>";
                   
                    }
                    if(isset($_POST["add-esc"])){
                        echo "
                        <form method = 'POST' action = ".$_SERVER["PHP_SELF"].">
                           
                               
                                <tr class = 'data-row'>
                                    <td> 
                                        <select name = 'tipo'> ";
                                    $qTipo = "SELECT * FROM TipoEscursione";
                                    $risTipo = $con -> query($qTipo) or die(mysqli_error($con));
                                    foreach($risTipo as $rTipo){
                                        echo "<option value = \"".$rTipo["idTipoEsc"]."\">".$rTipo["Nome"]."</option>";
                                    }
                        
                        echo "
                                    </select>
                                    </td>
            
                                    <td>
                                        <input name = 'prezzo' type = 'number'> </input>
                                    </td>
            
                                    <td>
                                        <input type = 'number' name = 'MinP'> </input>
                                    </td>
            
                                    <td>
                                        <input type = 'number' name = 'MaxP'> </input>
                                    </td>
                                    <td>
                                        <select multiple name = 'guide[]'>";
                                        $qGuide = "SELECT * FROM Guide";
                                        $risGuide = $con -> query($qGuide) or die(mysqli_error($con));
                                        foreach($risGuide as $rGuide){
                                            echo "<option value\"".$rGuide["Username"]."\">".$rGuide["Username"]."</option>";
                                        }
                                        echo "
                                        </select>
                                    </td>
                                    
                                    <td>
                                        <input type = 'date' name = 'dataE'> </input>
                                    </td>
            
                                    <td>
                                        <input type = 'time' name = 'OraP'> </input>
                                    </td>
            
                                    <td>
                                        <input type = 'time' name = 'OraA'> </input>
                                    </td>
            
                                    <td>
                                        <select name = 'diff'>
                                            <option value = '1'> 1 </option>
                                            <option value = '3'> 2 </option>
                                            <option value = '2'> 3 </option>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr style = 'background-color: white;'>
                                        <td colspan = 13>   <button type = 'submit' name = 'add-btn' class = 'mod-btn'> aggiungi </button> </td>
                                </tr>
                           
                        </form>
                        ";
                 
                }
               
            ?>
        </table>
        <div class ="btn-container">
        <button type = "submit" name = "add-esc" class = 'mod-btn'> Aggiungi </button>
        <button type = "submit" name = "del-esc" class = 'mod-btn'> Elimina </button>
        <button type = "submit" name = "mod-esc" class = 'mod-btn'> Modifica </button>
        <button type = "submit" name = "opt-esc" class ='mod-btn'> Optional </button>
        </div>
    </form>
    
</body>
</html>

<?php
    else:
?>
<p> errore di connessione al database </p>

<?php
endif;

?>
