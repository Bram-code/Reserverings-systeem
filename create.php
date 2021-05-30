<?php

session_start();
//May I even visit this page?
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;

}

$email = $_SESSION['login'];

/** @var $db */
require_once "DB.php";

$query = "SELECT * FROM soorten";
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $soorten[] = $row;

}

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    /** @var $db */
    require_once "DB.php";
    require_once "image-helpers.php";


    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $naam = mysqli_escape_string($db, $_POST['naam']);
    $merk = mysqli_escape_string($db, $_POST['merk']);
    $soort = mysqli_escape_string($db, $_POST['soort']);
    $prijs = mysqli_escape_string($db, $_POST['prijs']);
    $aantalXXS = mysqli_escape_string($db, $_POST['aantalXXS']);
    $aantalXS = mysqli_escape_string($db, $_POST['aantalXS']);
    $aantalS = mysqli_escape_string($db, $_POST['aantalS']);
    $aantalM = mysqli_escape_string($db, $_POST['aantalM']);
    $aantalL = mysqli_escape_string($db, $_POST['aantalL']);
    $aantalXL = mysqli_escape_string($db, $_POST['aantalXL']);
    $aantalXXL = mysqli_escape_string($db, $_POST['aantalXXL']);



    $errors = [];
    if ($naam == "") {
        $errors['naam'] = 'Naam cannot be empty';
    }
    if ($merk == "") {
        $errors['merk'] = 'Merk cannot be empty';
    }
    if ($soort == "") {
        $errors['soort'] = 'Soort cannot be empty';
    }

    if($prijs == ""){
        $errors['prijs'] = 'Prijs cannot be empty';
    }

    if ($_FILES['image']['error'] == 4) {
        $errors['image'] = 'Image cannot be empty';
    }

    if (empty($errors)) {
        //Store image & retrieve name for database saving
        $image = addImageFile($_FILES['image']);

        //Save the record to the database
        $query = "INSERT INTO kleding (naam, merk, soort, afbeelding, prijs, aantalXXS, aantalXS, aantalS, aantalM, aantalL, aantalXL, aantalXXL)
                  VALUES ('$naam', '$merk', '$soort', '$image', '$prijs', '$aantalXXS', '$aantalXS', '$aantalS', '$aantalM', '$aantalL', '$aantalXL', '$aantalXXL')";
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
?>
<!doctype html>
<html lang="en">
<head>
    <title>Nieuwe kleding toevoegen</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<h1>Nieuwe kleding</h1>
<?php if (isset($errors['db'])) { ?>
    <div><span class="errors"><?= $errors['db']; ?></span></div>
<?php } ?>

<!-- enctype="multipart/form-data" no characters will be converted -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="naam">Naam</label>
        <input id="naam" type="text" name="naam" value="<?= isset($naam) ? htmlentities($naam) : '' ?>"/>
        <span class="errors"><?= isset($errors['naam']) ? $errors['naam'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="merk">Merk</label>
        <input id="merk" type="text" name="merk" value="<?= isset($merk) ? htmlentities($merk) : '' ?>"/>
        <span class="errors"><?= isset($errors['merk']) ? $errors['merk'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="soort">Soort</label>
        <select id="soort" name="soort"">

        <?php foreach ($soorten as $a) { ?>
            <option value="<?= $a['soort'] ?>"><?= $a['soort'] ?></option>
        <?php } ?>

        </select>
        <a href="create%20soort.php">nieuwe soort toevoegen</a>
        <span class="errors"><?= isset($errors['soort']) ? $errors['soort'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="prijs">Prijs</label>
        <input id="prijs" type="text" name="prijs" value="<?= isset($prijs) ? htmlentities($prijs) : '' ?>"/>
        <span class="errors"><?= isset($errors['prijs']) ? $errors['prijs'] : '' ?></span>
    </div>

    <div class="data-field">
        <label for="aantalXXS">AantalXXS</label>
        <input id="aantalXXS" type="number" name="aantalXXS" value="<?= isset($aantalXXS) ? htmlentities($aantalXXS) : '' ?>"/>
    </div>
    <div class="data-field">
    <label for="aantalXS">AantalXS</label>
    <input id="aantalXS" type="number" name="aantalXS" value="<?= isset($aantalXS) ? htmlentities($aantalXS) : '' ?>"/>
    </div>
    <div class="data-field">
        <label for="aantalS">AantalS</label>
        <input id="aantalS" type="number" name="aantalS" value="<?= isset($aantalS) ? htmlentities($aantalS) : '' ?>"/>
    </div>
    </div>
    <div class="data-field">
        <label for="aantalM">AantalM</label>
        <input id="aantalM" type="number" name="aantalM" value="<?= isset($aantalM) ? htmlentities($aantalM) : '' ?>"/>
    </div>
    </div>
    <div class="data-field">
        <label for="aantalL">AantalL</label>
        <input id="aantalL" type="number" name="aantalL" value="<?= isset($aantalL) ? htmlentities($aantalL) : '' ?>"/>
    </div>
    </div>
    <div class="data-field">
        <label for="aantalXL">AantalXL</label>
        <input id="aantalXL" type="number" name="aantalXL" value="<?= isset($aantalXL) ? htmlentities($aantalXL) : '' ?>"/>
    </div>
    </div>
    <div class="data-field">
        <label for="aantalXXL">AantalXXL</label>
        <input id="aantalXXL" type="number" name="aantalXXL" value="<?= isset($aantalXXL) ? htmlentities($aantalXXL) : '' ?>"/>
    </div>

    <div class="data-field">
        <label for="image">Image</label>
        <input type="file" name="image" id="image"/>
        <span class="errors"><?= isset($errors['image']) ? $errors['image'] : '' ?></span>
    </div>
    <div class="data-submit">
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<div>
    <a href="overzicht.php">Go back to the list</a>
</div>
</body>
</html>