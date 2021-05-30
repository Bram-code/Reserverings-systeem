<?php
session_start();
/** @var $db */
require_once "DB.php";

//May I even visit this page?
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;

}

$email = $_SESSION['login'];

$query = "SELECT * FROM soorten";
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $soorten[] = $row;

}

if (isset($_POST['submit'])) {
    $naam = mysqli_escape_string($db, $_POST['naam']);
    $merk = mysqli_escape_string($db, $_POST['merk']);
    $soort = mysqli_escape_string($db, $_POST['soort']);
    $id = mysqli_escape_string($db, $_POST['id']);
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
        $errors['naam'] = "Vul aub de naam in";
    }
    if ($merk == "") {
        $errors['merk'] = "Vul aub het merk in";
    }
    if ($soort == "") {
        $errors['soort'] = "Vul aub de soort in";
    }

    if ($prijs == "") {
        $errors['prijs'] = "Vul aub de prijs in";
    }

    if (empty($errors)) {
        //UPDATE in DB
        $query = "UPDATE kleding
                    SET naam = '$naam', merk = '$merk', soort = '$soort', prijs = '$prijs', aantalXXS = '$aantalXXS', aantalXS = '$aantalXS', aantalS = '$aantalS', aantalM = '$aantalM' , aantalL = '$aantalL', aantalXL = '$aantalXL', aantalXXL = '$aantalXXL'
                    WHERE id = '$id'";
        $result = mysqli_query($db, $query);

        if ($result) {
            $success = "Hij is geupdate in de DB";
            header('Location: overzicht.php');
            exit;
        } else {
            $errors['db'] = mysqli_error($db);
        }
    }
} elseif (isset($_GET['id'])) {
    $id = mysqli_escape_string($db, $_GET['id']);
    $query = "SELECT * FROM kleding WHERE id = '$id'";
    $result = mysqli_query($db, $query);
    if ($result){
        $kleding = mysqli_fetch_assoc($result);
        $naam = $kleding['naam'];
        $merk = $kleding['merk'];
        $soort = $kleding['soort'];
        $id = $kleding['id'];
        $prijs = $kleding['prijs'];
        $aantalXXS = $kleding['aantalXXS'];
        $aantalXS = $kleding['aantalXS'];
        $aantalS = $kleding['aantalS'];
        $aantalM = $kleding['aantalM'];
        $aantalL = $kleding['aantalL'];
        $aantalXL = $kleding['aantalXL'];
        $aantalXXL = $kleding['aantalXXL'];
    }else{
        $errors['db'] = 'Fail';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voeg kleding toe</title>
</head>
<body>
<h1>Voeg kleding toe</h1>
<?php
if (isset($errors['db'])) {
    echo $errors['db'];
} elseif (isset($success)) {
    echo $success;
}
?>
<form action="" method="post">
    <div>
        <label for="naam">Naam</label>
        <input type="text" name="naam" id="naam" value="<?= htmlentities($naam); ?>"/>
        <?php
        if (isset($errors['naam'])) {
            echo $errors['naam'];
        }
        ?>
    </div>
    <div>
        <label for="merk">Merk</label>
        <input type="text" name="merk" id="merk" value="<?= htmlentities($merk); ?>"/>
        <?php
        if (isset($errors['merk'])) {
            echo $errors['merk'];
        }
        ?>
    </div>
    <div>
        <label for="soort">Soort</label>
        <select id="soort" name="soort">

            <?php foreach ($soorten as $a) { ?>
                <option value="<?= $a['soort'] ?>"

                <?php if ($soort == $a['soort']) { ?>
                    selected
                <?php } ?>

                ><?= $a['soort'] ?></option>
            <?php } ?>

        </select>
        <a href="create%20soort.php">nieuwe soort toevoegen</a>
        <?php
        if (isset($errors['soort'])) {
            echo $errors['soort'];
        }
        ?>
    </div>
    <div>
        <label for="prijs">Prijs</label>
        <input type="text" name="prijs" id="prijs" value="<?= htmlentities($prijs); ?>"/>
        <?php
        if (isset($errors['prijs'])) {
            echo $errors['prijs'];
        }
        ?>
    </div>

    <div class="data-field">
        <label for="aantalXXS">AantalXXS</label>
        <input id="aantalXXS" type="number" name="aantalXXS" value="<?=htmlentities($aantalXXS)?>"/>
    </div>
    <div class="data-field">
        <label for="aantalXS">AantalXS</label>
        <input id="aantalXS" type="number" name="aantalXS" value="<?=htmlentities($aantalXS)?>"/>
    </div>
    <div class="data-field">
        <label for="aantalS">AantalS</label>
        <input id="aantalS" type="number" name="aantalS" value="<?=htmlentities($aantalS)?>"/>
    </div>
    <div class="data-field">
        <label for="aantalM">AantalM</label>
        <input id="aantalM" type="number" name="aantalM" value="<?=htmlentities($aantalM)?>"/>
    </div>
    <div class="data-field">
        <label for="aantalL">AantalL</label>
        <input id="aantalL" type="number" name="aantalL" value="<?=htmlentities($aantalL)?>"/>
    </div>
    <div class="data-field">
        <label for="aantalXL">AantalXL</label>
        <input id="aantalXL" type="number" name="aantalXL" value="<?=htmlentities($aantalXL)?>"/>
    </div>
    <div class="data-field">
        <label for="aantalXXL">AantalXXL</label>
        <input id="aantalXXL" type="number" name="aantalXXL" value="<?=htmlentities($aantalXXL)?>"/>
    </div>

    <div>
        <input type="hidden" name="id" value="<?= htmlentities($id); ?>"/>
        <input type="submit" name="submit" value="Verstuur"/>
    </div>
</form>
</body>
</html>
