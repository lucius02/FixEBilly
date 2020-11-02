<?php

# configuratie bestand van mijn persoonlijke database
# waarin adres bestanden e.d. geplaatst kan worden.

// $user = je gebruikersnaam voor pg
// $password = het wachtwoord
// $host = het adres van je pg server, normaliter is dit localhost
// $dbname = de naam van je pg database

$user= "postgres";
$password="WelKom7993";
$port="5432";
$host="localhost";
$dbname="EBilly";

$db = pg_connect ("host=localhost dbname=EBilly user=postgres password=WelKom7993") or die ("Kan geen verbinding maken met de database ");
?>