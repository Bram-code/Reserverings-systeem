<?php
//Require DB settings with connection variable
/** @var $db */
require_once "DB.php";

//Get the result set from the database with a SQL query
$query = "SELECT * FROM reserveringen";
$result = mysqli_query($db, $query);

//Loop through the result to create a custom array

while ($row = mysqli_fetch_assoc($result)) {
    $reserveringen[]  = $row;

}

//Close connection
mysqli_close($db);
