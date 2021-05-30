<?php

session_start();
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
    <title>Kleding overzicht</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style2.css"/>
</head>
<header>
    <p><a href="logout.php">Uitloggen</a> </p>
</header>
<body id="alternative">
<div id="container">
    <h1>Kleding</h1>
    <h2>admin: <?=$email?></h2>

    <div class="intro-links">
        <a href="create.php">Nieuw item toevoegen</a>
        <a href="aanmelden.php">Nieuwe admin toevoegen</a>
        <a href="reserveringoverzicht.php">Gemaakte reserveringen bekijken</a>
    </div>

    <section>
    <div class="albums">
        <?php foreach ($kleding as $klading) { ?>
            <div class="album">
                <div class="cover">
                        <img src= "images/<?=$klading['afbeelding']; ?>" alt="<?= $klading['naam']; ?>"/>
                </div>
                <div class="links">
                    <h2><?= $klading['naam']; ?></h2>
                    <a class="edit" href="edit.php?id=<?= $klading['id']; ?>">Edit</a>
                    <a class="delete" href="delete.php?id=<?= $klading['id'];?>">Delete</a>
                </div>
            </div>
        <?php } ?>
    </div>
    </section>
</div>
</body>
</html>