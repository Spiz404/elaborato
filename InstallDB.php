<?php
    include("Confing.php");
    include("createDB.php");
    $con = new mysqli($db_host, $db_user, $db_user_psw, $db_name);
    
    $q = "
    CREATE TABLE  IF NOT EXISTS `Amministratori` (
        `Username` varchar(60) NOT NULL,
        `Nome` varchar(60) NOT NULL,
        `Cognome` varchar(60) NOT NULL,
        `Email` varchar(60) NOT NULL,
        `Psw` varchar(64) NOT NULL,
        PRIMARY KEY(`Username`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if($con -> query($q)) echo "<br>query creazione tabella <b>Amministratori</b> eseguita correttamente"; 
else echo "<br>errore query creazione tabella <b> Amministratori </b>: ".mysqli_error($con); 

$q = "
CREATE TABLE IF NOT EXISTS `Escursioni` (
    `idEscursione` int(11) NOT NULL AUTO_INCREMENT,
    `OraIn` time NOT NULL,
    `OraF` time NOT NULL,
    `Prezzo` float NOT NULL,
    `Tipo` int(11) NOT NULL,
    `MaxP` int(11) NOT NULL,
    `MinP` int(11) NOT NULL,
    `DataE` date NOT NULL,
    `LvDif` int(11) NOT NULL,
    PRIMARY KEY(`idEscursione`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if($con -> query($q)) echo "<br>query creazione tabella <b>Escursioni</b> eseguita correttamente"; 
else echo "<br>errore query creazione tabella <b> Escursioni </b>: ".mysqli_error($con); 

$q = "
    CREATE TABLE IF NOT EXISTS `Escursionisti` (
    `Username` varchar(60) NOT NULL,
    `Nome` varchar(60) NOT NULL,
    `Cognome` varchar(60) NOT NULL,
    `Email` varchar(60) NOT NULL,
    `Comp` tinyint(1) NOT NULL,
    `Psw` varchar(64) NOT NULL,
    PRIMARY KEY(`Username`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if($con -> query($q)) echo "<br>query creazione tabella <b>Escursionisti</b> eseguita correttamente"; 
else echo "<br>errore query creazione tabella <b> Escursionisti </b>: ".mysqli_error($con); 

$q = "
    CREATE TABLE IF NOT EXISTS `Guide` (
    `Username` varchar(60) NOT NULL,
    `Nome` varchar(60) NOT NULL,
    `Cognome` varchar(60) NOT NULL,
    `Email` varchar(60) NOT NULL,
    `Comp` tinyint(1) NOT NULL,
    `Psw` varchar(64) NOT NULL,
    PRIMARY KEY(`Username`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if($con -> query($q)) echo "<br>query creazione tabella <b>Guide</b> eseguita correttamente"; 
else echo "<br>errore query creazione tabella <b> Guide </b>: ".mysqli_error($con); 

$q = "
    CREATE TABLE IF NOT EXISTS `GuideEsc` (
    `idGuida` varchar(60) NOT NULL,
    `idEscursione` int(11) NOT NULL,
    PRIMARY KEY(`idGuida`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if($con -> query($q)) echo "<br>query creazione tabella <b>GuideEsc</b> eseguita correttamente"; 
else echo "<br>errore query creazione tabella <b> GuideEsc </b>: ".mysqli_error($con); 

$q = "
    CREATE TABLE IF NOT EXISTS `Istruttori` (
    `Username` varchar(60) NOT NULL,
    `Nome` varchar(60) NOT NULL,
    `Cognome` varchar(60) NOT NULL,
    `Email` varchar(60) NOT NULL,
    `Comp` tinyint(1) NOT NULL,
    `Psw` varchar(64) NOT NULL,
    PRIMARY KEY(`Username`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if($con -> query($q)) echo "<br>query creazione tabella <b>Istruttori</b> eseguita correttamente"; 
else echo "<br>errore query creazione tabella <b> Istruttori </b>: ".mysqli_error($con);  

$q = "
    CREATE TABLE IF NOT EXISTS `Lezioni` (
    `idLez` int(11) NOT NULL AUTO_INCREMENT,
    `OraI` time NOT NULL,
    `OraF` time NOT NULL,
    `Istruttore` varchar(60) NOT NULL,
    `DataL` date NOT NULL,
    `MaxP` int(11) NOT NULL,
    `MinP` int(11) NOT NULL,
    PRIMARY KEY(`idLez`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if($con -> query($q)) echo "<br>query creazione tabella <b>Lezioni</b> eseguita correttamente"; 
else echo "<br>errore query creazione tabella <b> Lezioni </b>: ".mysqli_error($con);  

$q = "
    CREATE TABLE IF NOT EXISTS `Optional` (
    `idOptional` int(11) NOT NULL AUTO_INCREMENT,
    `idTipo` int(11) NOT NULL,
    `idEscursione` int(11) NOT NULL,
    `Prezzo` float NOT NULL,
    `Descrizione` varchar(200) DEFAULT NULL,
    PRIMARY KEY(`idOptional`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if($con -> query($q)) echo "<br>query creazione tabella <b>Optional</b> eseguita correttamente"; 
else echo "<br>errore query creazione tabella <b> Optional </b>: ".mysqli_error($con);  

$q = "
    CREATE TABLE IF NOT EXISTS `PartecipazioniEsc` (
    `idEsc` varchar(60) NOT NULL,
    `idEscursione` int(11) NOT NULL,
    PRIMARY KEY(`idEsc`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if($con -> query($q)) echo "<br>query creazione tabella <b>PartecipazioniEsc</b> eseguita correttamente"; 
else echo "<br>errore query creazione tabella <b> PartecipazioniEsc </b>: ".mysqli_error($con);  

$q = "
    CREATE TABLE IF NOT EXISTS `TipoEscursione` (
    `idTipoEsc` int(11) NOT NULL AUTO_INCREMENT,
    `Nome` varchar(60) NOT NULL,
    PRIMARY KEY(`idTipoEsc`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if($con -> query($q)) echo "<br>query creazione tabella <b>TipoEscursione</b> eseguita correttamente"; 
else echo "<br>errore query creazione tabella <b> TipoEscursione </b>: ".mysqli_error($con);  

$q = "
    CREATE TABLE IF NOT EXISTS `TipoOptional` (
    `idTipo` int(11) NOT NULL AUTO_INCREMENT,
    `Nome` varchar(60) NOT NULL,
    PRIMARY KEY(`idTipo`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

if($con -> query($q)) echo "<br>query creazione tabella <b>TipoOptional</b> eseguita correttamente"; 
else echo "<br>errore query creazione tabella <b> TipoOptional </b>: ".mysqli_error($con);  


$q = "
    CREATE TABLE IF NOT EXISTS `UtenteLezione` (
    `idLez` int(11) NOT NULL,
    `Username` varchar(60) NOT NULL,
    PRIMARY KEY(`idLez`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if($con -> query($q)) echo "<br>query creazione tabella <b>UtenteLezione</b> eseguita correttamente"; 
else echo "<br>errore query creazione tabella <b> UtenteLezione </b>: ".mysqli_error($con);  

$q = "
    CREATE TABLE IF NOT EXISTS `ValutazioniGuide` (
    `idVal` int(11) NOT NULL AUTO_INCREMENT,
    `idInv` varchar(60) NOT NULL,
    `idGuida` varchar(60) NOT NULL,
    `Valutazione` int(11) NOT NULL,
    `Descr` varchar(200) NOT NULL,
    PRIMARY KEY(`idVal`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if($con -> query($q)) echo "<br>query creazione tabella <b>ValutazioniGuide</b> eseguita correttamente"; 
else echo "<br>errore query creazione tabella <b> ValutazioniGuide </b>: ".mysqli_error($con);  

$q = "
    CREATE TABLE IF NOT EXISTS `ValutazioniIstruttori` (
    `idVal` int(11) NOT NULL AUTO_INCREMENT,
    `idInv` varchar(60) NOT NULL,
    `idIstr` varchar(60) NOT NULL,
    `Valutazione` int(11) NOT NULL,
    `Descr` varchar(200) NOT NULL,
    PRIMARY KEY(`idVal`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if($con -> query($q)) echo "<br>query creazione tabella <b>ValutazioniIstruttori</b> eseguita correttamente"; 
else echo "<br>errore query creazione tabella <b> ValutazioniIstruttori </b>: ".mysqli_error($con);    

$q = "
ALTER TABLE `Escursioni`
  ADD CONSTRAINT `escursioni_ibfk_1` FOREIGN KEY (`Tipo`) REFERENCES `tipoescursione` (`idTipoEsc`) ON DELETE CASCADE ON UPDATE CASCADE;";

  if($con -> query($q)) echo "<br>query fk <b>Escursioni</b> eseguita correttamente"; 
  else echo "<br>errore query fk <b> Escursioni </b>: ".mysqli_error($con);  

$q = "ALTER TABLE `GuideEsc`
  ADD CONSTRAINT `guideesc_ibfk_1` FOREIGN KEY (`idGuida`) REFERENCES `guide` (`Username`),
  ADD CONSTRAINT `guideesc_ibfk_2` FOREIGN KEY (`idEscursione`) REFERENCES `escursioni` (`idEscursione`) ON DELETE CASCADE ON UPDATE CASCADE;";

  if($con -> query($q)) echo "<br>query fk <b>GuideEsc</b> eseguita correttamente"; 
  else echo "<br>errore query fk <b> GuideEsc </b>: ".mysqli_error($con);  

$q = "ALTER TABLE `Optional`
  ADD CONSTRAINT `optional_ibfk_1` FOREIGN KEY (`idTipo`) REFERENCES `tipooptional` (`idTipo`),
  ADD CONSTRAINT `optional_ibfk_2` FOREIGN KEY (`idEscursione`) REFERENCES `escursioni` (`idEscursione`) ON DELETE CASCADE ON UPDATE CASCADE;";

  if($con -> query($q)) echo "<br>query fk <b>Optional</b> eseguita correttamente"; 
  else echo "<br>errore query fk <b> Optional </b>: ".mysqli_error($con);  

$q = "ALTER TABLE `PartecipazioniEsc`
  ADD CONSTRAINT `partecipazioniesc_ibfk_1` FOREIGN KEY (`idEsc`) REFERENCES `Escursionisti` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partecipazioniesc_ibfk_2` FOREIGN KEY (`idEscursione`) REFERENCES `Escursioni` (`idEscursione`) ON DELETE CASCADE ON UPDATE CASCADE;";

  if($con -> query($q)) echo "<br>query fk <b>PartecipazioniEsc</b> eseguita correttamente"; 
  else echo "<br>errore query fk <b> PartecipazioniEsc </b>: ".mysqli_error($con);  

$q = "ALTER TABLE `ValutazioniGuide`
  ADD CONSTRAINT `valutazioniguide_ibfk_1` FOREIGN KEY (`idGuida`) REFERENCES `Guide` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;";

  if($con -> query($q)) echo "<br>query creazione tabella <b>ValutazioniGuide</b> eseguita correttamente"; 
  else echo "<br>errore query creazione tabella <b> ValutazioniGuide </b>: ".mysqli_error($con);  

$q = "ALTER TABLE `ValutazioniIstruttori`
  ADD CONSTRAINT `valutazioniistruttori_ibfk_1` FOREIGN KEY (`idIstr`) REFERENCES `Istruttori` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;";

  if($con -> query($q)) echo "<br>query fk <b>ValutazioniIstruttori</b> eseguita correttamente"; 
  else echo "<br>errore query creazione tabella <b> ValutazioniIstruttori </b>: ".mysqli_error($con);  
?>