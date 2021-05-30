<?php

# configuratie bestand van mijn persoonlijke database
# waarin adres bestanden e.d. geplaatst kan worden.

// $user = je gebruikersnaam voor mysql
// $password = het wachtwoord
// $host = het adres van je mysql server, normaliter is dit localhost
// $dbname = de naam van je mysql database

$user= "root";
$password="";
$host="localhost";
$dbname="cle2 db";

$db = mysqli_connect($host, $user, $password, $dbname) or die ("Kan geen verbinding maken met de database ");


