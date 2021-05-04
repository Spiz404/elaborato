<?php
    include("config.php");
    include("navbar.php");
    $con = new mysqli($db_host, $db_user, $db_user_psw, $db_name);
    if(mysqli_connect_errno()){
        $v = false;
    }
    else $v = true;
    $utente = $_SESSION["id"];
    if($v):
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel = "stylesheet" href = "style2.css">
    </head>

    <label> le mie escursioni </label>
    <div style = "width: 80%;"> 
        <?php
            $q = "SELECT * FROM GuideEsc WHERE idGuida = '$utente'";
            $ris = $con -> query($q) or die("errore query selezione escursioni guida: ".mysqli_error($con));
            echo "<table class = \"tab-ut\">
                <tr>
                    <th> idEscursione </th> <th> Ora inizio </th> <th> Ora fine </th> <th> Data </th> <th> Prezzo </th> <th> Tipo </th> <th> Livello difficoltà </th> <th> partecipanti </th> <th> optional </th> 
                </tr>";
            foreach($ris as $r){
                
                $idEscursione = $r["idEscursione"];
                $q = "
                SELECT * 
                FROM ((Escursioni E INNER JOIN optional O ON O.idEscursione = E.idEscurione)
                    INNER JOIN TipoOptional T ON  T.idTipo = O.idTipo)
                        INNER JOIN TipoEscursione TE ON TE.idTipoEsc = E.tipo
                WHERE E.idEscursione = $idEscursione";
                $ris1 =  $con -> query($q) or die("errore query selezione escursione e dettagli: ".mysqli_error($con));
                $prezzo = 0;
                $partecipanti = 0;
                echo "
                    <tr class = \"data-row\">
                        <td>  ".$r["idEscursione"]." </td>
                        <td> ".$r["OraIn"]."  </td>
                        <td> ".$r["OraF"]."  </td>
                        <td> ".$r["DataE"]."  </td>
                        <td> ".$prezzo."  </td>
                        <td>  ".$r["nome"]." </td>
                        <td> ".$r["LvDif"]."  </td>
                        <td>  ".$partecipanti." </td>
                        <td> <a onclick =\"visOpt()\"> visualizza </a> </td>
                    </tr>
                ";
            }
            echo "</table>";
        ?>
    </div>
</html>
<?php
    else:
?>
<p> errore di connessione con il database </p>
<?php
    endif;
?>