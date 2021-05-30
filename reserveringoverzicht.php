<?php
session_start();

//May I even visit this page?
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;

}

/** @var $db */
require_once "DB.php";

$query = "SELECT * FROM reserveringen";
$result = mysqli_query($db, $query);

//Loop through the result to create a custom array

while ($row = mysqli_fetch_assoc($result)) {
    $reserveringen[]  = $row;
}

foreach ($reserveringen as $key => $part) {
    $sort[$key] = strtotime($part['datum']);
}
foreach ($reserveringen as $key => $part) {
    $sort2[$key] = strtotime($part['tijd']);
}
array_multisort($sort, $sort2 , SORT_ASC, $reserveringen);

$day = date('d');
$day = $day;
$date = $day  . '-'.  date('m-Y') ;

foreach ($reserveringen as $a) {
    if($a['datum'] < $date){
        $id = $a['id'];
        $query = "DELETE FROM reserveringen WHERE id =". $id;
        $result = mysqli_query($db, $query);
    }
}

mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Reserveringen overzicht</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style5.css"/>
</head>
<body id="alternative">
<div id="container">
    <h1>Reserveringen</h1>
    <p><a href="overzicht.php">Terug naar overzicht</a> </p>

    <section>
        <div class="reserveringen">
            <?php foreach ($reserveringen as $a) { ?>
                <div class="reservering" id="reservering">
                    <div class="Mensen">
                        <p>Datum van ophalen: <?= $a['datum'] ?></p>
                        <p>Tijd van ophalen: <?= $a['tijd']?></p>
                        <p>Naam: <?= $a['naam']; ?></p>
                        <p>Artiekel: <?= $a['Artiekel']; ?> </p>
                        <p>Maat: <?= $a['maat'] ?></p>
                        <p>Email: <?= $a['email']; ?> </p>
                        <p>Telefoonnummer: <?= $a['nummer'] ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</div>
</body>
</html>

