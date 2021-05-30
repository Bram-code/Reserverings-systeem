<?php

/** @var $db */
require_once "DB.php";
$query = "SELECT * FROM soorten";
$result = mysqli_query($db, $query);


while ($row = mysqli_fetch_assoc($result)) {
    $soorten[] = $row;
}


if (isset($_POST['submit'])) {
    /** @var $db */
    require_once "DB.php";

    $soort = mysqli_escape_string($db, $_POST['soort']);

    $errors = [];
    if ($soort == "") {
        $errors['soort'] = 'Soort cannot be empty';
    }

    if (empty($errors)) {
        $query = "INSERT INTO soorten (soort)
                  VALUES ('$soort')";
        $result = mysqli_query($db, $query) or die('Error: ' . $query);

        if ($result) {
            header('Location: overzicht.php');
            exit;
        } else {
            $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

        //Close connection
        mysqli_close($db);
    }
}

if (isset($_POST['submit2'])) {
    /** @var $db */
    require_once "DB.php";
    foreach ($soorten as $c){
        $soort = mysqli_escape_string($db, $_POST[$c['id']]);
        $id =  $c['id'];

        $query = "UPDATE soorten
                    SET id = '$id', soort = '$soort'
                    WHERE id = '$id'";
        $result = mysqli_query($db, $query);
    }
    if ($result) {
        header('Location: overzicht.php');
        exit;
    } else {
        $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
    }

    //Close connection
    mysqli_close($db);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nieuwe soort toevoegen</title>
</head>
<body>
<h1>Nieuwe soort toevoegen</h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="soort">Soort</label>
        <input id="soort" type="text" name="soort" value="<?= isset($naam) ? htmlentities($naam) : '' ?>"/>
        <span class="errors"><?= isset($errors['soort']) ? $errors['soort'] : '' ?></span>
    </div>
    <div class="data-submit">
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<h2>Volgorde wijzigen</h2>
<form action="" method="post" enctype="multipart/form-data">
    <p>Een id loopt van onder naar boven. <br>Maak je dus geen zorgen als er cijfer niet tussen staat. <br>Dit is een gevolg van eerder verwijderde soorten.</p>
    <?php foreach ($soorten as $b) { ?>
    <div class="data-field">
        <label for="<?= $b['id'] ?>">id-<?= $b['id'] ?> =></label>
        <select id="<?= $b['id'] ?>" name="<?= $b['id'] ?>"">

        <?php foreach ($soorten as $a) { ?>
            <option value="<?= $a['soort'] ?>"

            <?php if ($b['id'] == $a['id']) { ?>
                selected
            <?php } ?>

            ><?= $a['soort'] ?></option>
        <?php } ?>

        </select>
        <a href="delete2.php?id=<?= $b['id'] ?>">delete</a>
    </div>
    <?php } ?>
    <div class="data-submit">
        <input type="submit" name="submit2" value="Save"/>
    </div>
</form>
</body>
</html>
