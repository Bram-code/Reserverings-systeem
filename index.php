<?php
session_start();
//Require music data to use variable in this file
/** @var $kleding */
require_once "DBarray.php";

//May I even visit this page?
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;

}

$email = $_SESSION['login'];

?>
<!doctype html>
<html lang="en">
<head>
    <title>kleding</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h1>Asortiment</h1>
<table>
    <thead>
    <tr>
        <th></th>
        <th>naam</th>
        <th>Merk</th>
        <th>Soort</th>
        <th>Maat</th>
        <th>Prijs</th>
        <th>Maat</th>
        <th>Afbeelding</th>
        <th colspan="2"></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="9">&copy; My Collection</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($kleding as $klading) { ?>
        <tr>
            <td><?= $klading['id']; ?></td>
            <td><?= $klading['naam']; ?></td>
            <td><?= $klading['merk']; ?></td>
            <td><?= $klading['soort']; ?></td>
            <td><?= $klading['maat']; ?></td>
            <td><?= $klading['prijs']; ?></td>
            <td><?= $klading['aantal']; ?></td>
            <td><?= $klading['afbeelding']; ?></td>
            <td><a href="delete.php?id=<?= $klading['id']; ?>">Delete</a></td>
            <td><a href="edit.php?id=<?= $klading['id']; ?>">Edit</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html