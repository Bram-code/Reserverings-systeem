<?php
/** @var $db */
require_once "DB.php";

$query = "SELECT * FROM soorten";
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $soorten[] = $row;
}

$query2 = "SELECT * FROM kleding";
$result2 = mysqli_query($db, $query2);

while ($row = mysqli_fetch_assoc($result2)) {
    $kleding[] = $row;
}

mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <title>Kleding reserveren</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style3.css"/>
</head>
<body>

<div class="header" id="myHeader">
    <header> <!-- Header voor de titel en een dropdown menu -->
        <h1>Kleding reserveren</h1>
        <nav id="dropdown" class="dropdown">
            <button class="drop">Menu</button><!-- de dropdown knop -->
            <div id="myDropdown" class="binnen"> <!-- de inhoud van de dropdown -->
                <?php foreach ($soorten as $a) { ?>
                    <p id="<?= $a['soort'] ?>" class="check"><?= $a['soort'] ?></p>
                <?php } ?>
            </div>
        </nav>
    </header>
    <div class="lijn"></div> <!-- een lijn om de verschillende soorten mee te scheiden -->
</div>

<?php foreach ($soorten as $a) { ?>
<h2 id="h2<?= $a['soort'] ?>" class = "soort"><?= $a['soort'] ?></h2>
    <section id="container">
                <?php foreach ($kleding as $klading) { ?>
                    <?php if ($klading['soort'] == $a['soort']) { ?>
                    <div id = "kleding">
                        <div>
                            <img src= "images/<?=$klading['afbeelding']; ?>" alt="<?= $klading['naam']; ?>"/>
                        </div>
                        <div>
                            <h2><?= $klading['naam']; ?></h2>
                            <h2>Prijs: €<?=$klading['prijs'];?> </h2>
                            <a class="reserveren" href="detail.php?id=<?= $klading['id']; ?>">reserveren</a>
                        </div>
                    </div>
                    <?php } ?>
                <?php } ?>
    </section>
    <div class="lijn"></div>
<?php } ?>

<script type="text/javascript" src="reserverenJS.js"></script>
</body>
</html>





