<?php
# voorbeeld database installatie script

// lees de waarden in van het configuratie bestand

require_once("config.php");

// Maak de hoofd database
$resultaat = "CREATE TABLE afbeelding (nummer INT(10) NOT NULL
                    AUTO_INCREMENT, omschrijving VARCHAR(30) NOT NULL,
                   afbeelding VARCHAR(50) NOT NULL, PRIMARY KEY (nummer))";
              
   if (pg_query($resultaat)){
       echo "Hoofddatabase is gemaakt!";
        } else {
           echo "Het is helaas niet gelukt een tabel te maken";
       }    

?>