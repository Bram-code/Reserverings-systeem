<?php

/** @var $db */
require_once "DB.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM reserveringen WHERE id = '$id'";
    $result = mysqli_query($db, $query);
    $reservering = mysqli_fetch_assoc($result);

    $naam = $reservering['naam'];
    $email = $reservering['email'];
    $nummer = $reservering['nummer'];
    $time = $reservering['tijd'];
    $maat = $reservering['maat'];
    $artiekel = $reservering['Artiekel'];
    $date = $reservering['datum'];

    $to_email = $email;
    $subject = "Bevesteging van reservering";

    $body =
        "Beste $naam, 
        
Bedankt voor uw reservering!
U heeft het volgende artiekel gereserveerd: 

Kledingstuk: $artiekel, 
Maat: $maat,
Aantal: 1.

U kan uw reservering komen ophalen in de winkel op: 
$date om $time. 
";

    $headers = "Van: bedrijf";

    if (mail($to_email, $subject, $body, $headers)) {
        $mailStatus = "Er is een bevestegingsmail verstuurd naar: $to_email";
    } else {
        $mailStatus = "Het verzenden van de mail is helaas mislukt.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Geslaagd!</title>
    <link rel="stylesheet" type="text/css" href="style6.css"/>
</head>
<body>
    <h1>Uw reservering is geslaagd!</h1>

    <section>
        <h2>U heeft gereserveerd:</h2>
        <p>Artikel: <?= $artiekel ?></p>
        <p>Maat: <?= $maat ?></p>
        <p>Aantal: 1</p>
    </section>
    <section>
        <h2>Op te halen op:</h2>
        <p><?= $date ?> om <?= $time ?></p>
    </section>
    <section>
        <h2>Contact gegevens:</h2>
        <p>Naam: <?= $naam ?></p>
        <p>E-mail: <?= $email ?></p>
        <p><?= $mailStatus ?></p>
        <p>Telefoonnummer: <?= $nummer ?></p>
    </section>

</body>
</html>
