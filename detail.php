<?php
/** @var $db */
require_once "DB.php";

$maat2 = [];

if (isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "SELECT * FROM kleding where id = '$id'";
    $result = mysqli_query($db, $query);
}
$kleding = mysqli_fetch_assoc($result);
$naam2 = $kleding['naam'];
$merk = $kleding['merk'];
$soort = $kleding['soort'];
$afbeelding = $kleding['afbeelding'];
$idkleding = $kleding['id'];
$prijs = $kleding['prijs'];
$aantalXXS = $kleding['aantalXXS'];
$aantalXS = $kleding['aantalXS'];
$aantalS = $kleding['aantalS'];
$aantalM = $kleding['aantalM'];
$aantalL = $kleding['aantalL'];
$aantalXL = $kleding['aantalXL'];
$aantalXXL = $kleding['aantalXXL'];

if($aantalXXS !== "0") {
    $maat2[] =$aantalXXS . ', XXS' ;
}

if($aantalXS !== "0") {
    $maat2[] =$aantalXS . ', XS';
}

if($aantalS !== "0") {
    $maat2[] =$aantalS . ', S';
}

if($aantalM !== "0") {
    $maat2[] =$aantalM . ', M';
}

if($aantalL !== "0") {
    $maat2[] =$aantalL . ', L';
}

if($aantalXL !== "0") {
    $maat2[] =$aantalXL . ', XL';
}

if($aantalXXL !== "0") {
    $maat2[] =$aantalXXL .  ', XXL';
}

$day = date('d');
$day = $day + 1;
$date = $day  . '-'.  date('m-Y') ;


$naam = '';
$email = '';
$nummer = '';
$time = '';
$maat4 = '';
$artiekel = '';

if (isset($_POST['submit'])) {
    $naam = mysqli_escape_string($db, $_POST['naam']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $nummer = mysqli_escape_string($db, $_POST['nummer']);
    $time = mysqli_escape_string($db, $_POST['time']);
    $maat4 = mysqli_escape_string($db, $_POST['maat']);
    $artiekel = mysqli_escape_string($db, $naam2);

    $errors = [];
    if ($naam == "") {
        $errors['naam'] = 'Naam mag niet leeg zijn';
    }
    if ($email == "") {
        $errors['email'] = 'Email mag niet leeg zijn';
    }
    if ($nummer == "") {
        $errors['nummer'] = 'Nummer mag niet leeg zijn';
    }
    if ($time == "") {
        $errors['time'] = 'Tijd mag niet leeg zijn';

    }
    if ($maat4 == "") {
        $errors['maat'] = 'Maat mag niet leeg zijn';
    }
}
if (isset($_POST['submit2'])) {

    $naam = mysqli_escape_string($db, $_POST['naam']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $nummer = mysqli_escape_string($db, $_POST['nummer']);
    $time = mysqli_escape_string($db, $_POST['time']);
    $maat4 = mysqli_escape_string($db, $_POST['maat']);
    $artiekel = mysqli_escape_string($db, $naam2);


    $errors = [];
    if ($naam == "") {
        $errors['naam'] = 'Naam mag niet leeg zijn';
    }
    if ($email == "") {
        $errors['email'] = 'Email mag niet leeg zijn';
    }
    if ($nummer == "") {
        $errors['nummer'] = 'Nummer mag niet leeg zijn';
    }
    if ($time == "") {
        $errors['time'] = 'Tijd mag niet leeg zijn';
    }
    if ($maat4 == "") {
        $errors['maat'] = 'Maat mag niet leeg zijn';
    }

    if(empty($errors)) {

        $query = "INSERT INTO reserveringen (naam, email, nummer, tijd, datum, maat, Artiekel)
                  VALUES ('$naam', '$email', '$nummer', '$time', '$date' , '$maat4', '$artiekel')";
        $result = mysqli_query($db, $query) or die('Error: ' . $query);

        if ($result) {
            if($maat4 == 'XXS'){
                $aantal = $aantalXXS - 1;
                $query = "UPDATE kleding
                    SET aantalXXS = '$aantal'
                    WHERE id = '$idkleding'";
                $result = mysqli_query($db, $query);
            }
            if($maat4 == 'XS'){
                $aantal = $aantalXS - 1;
                $query = "UPDATE kleding
                    SET aantalXS = '$aantal'
                    WHERE id = '$idkleding'";
                $result = mysqli_query($db, $query);
            }
            if($maat4 == 'S'){
                $aantal = $aantalS - 1;
                $query = "UPDATE kleding
                    SET aantalS = '$aantal'
                    WHERE id = '$idkleding'";
                $result = mysqli_query($db, $query);
            }
            if($maat4 == 'M'){
                $aantal = $aantalM - 1;
                $query = "UPDATE kleding
                    SET aantalM = '$aantal'
                    WHERE id = '$idkleding'";
                $result = mysqli_query($db, $query);
            }
            if($maat4 == 'L'){
                $aantal = $aantalL - 1;
                $query = "UPDATE kleding
                    SET aantalL = '$aantal'
                    WHERE id = '$idkleding'";
                $result = mysqli_query($db, $query);
            }
            if($maat4 == 'XL'){
                $aantal = $aantalXL - 1;
                $query = "UPDATE kleding
                    SET aantalXL = '$aantal'
                    WHERE id = '$idkleding'";
                $result = mysqli_query($db, $query);
            }
            if($maat4 == 'XXL'){
                $aantal = $aantalXXL - 1;
                $query = "UPDATE kleding
                    SET aantalXXL = '$aantal'
                    WHERE id = '$idkleding'";
                $result = mysqli_query($db, $query);
            }

            $query = "SELECT * FROM reserveringen WHERE naam = '$naam' AND email = '$email' AND nummer = '$nummer' AND tijd = '$time' AND maat = '$maat4' AND Artiekel = '$artiekel'";
            $result = mysqli_query($db, $query);
            $reserveringen = mysqli_fetch_assoc($result);

            $id = $reserveringen ['id'];
            header('Location:result.php?id=' . $id . '');
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
    <title>Kleding reserveren</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style4.css"/>
</head>
<body id="alternative">
<div id="container">
    <h1><?=$naam2?></h1>
    <section>
    <div id = "product">
        <img src="images/<?=$afbeelding?>">
        <p>Merk: <?=$merk?></p>
        <p>Soort: <?=$soort?></p>
        <p>Prijs: €<?=$prijs?></p>

        Maten die nog aanwezig zijn:<br>
        <section id="maten">
            <?php foreach ($maat2 as $num) { ?>
                <?=$num?> <br>
            <?php } ?>
        </section>
    </div>

    <div id = "reservering">
        <h2>reserveren</h2>

        <form action="" method="post" enctype="multipart/form-data">

        <div>
            <label for="naam">Naam:</label>
            <input type="text" id="naam" name="naam">
            <span class="errors"><?= isset($errors['naam']) ? $errors['naam'] : '' ?></span>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
        </div>

        <div>
            <label for="nummer">Nummer:</label>
            <input type="text" id="nummer" name="nummer">
            <span class="errors"><?= isset($errors['nummer']) ? $errors['nummer'] : '' ?></span>
        </div>

        <div>
            <label for="time">Ophalen:</label>
            <?= $date ?> om:
            <input type="time" id="time" name="time" min="13:00" max="17:00" value="13:00">
            <span class="errors"><?= isset($errors['time']) ? $errors['time'] : '' ?></span>
        </div>

        <div>
            <label for="maat">Maat:</label>
            <select name="maat" id="maat">

                <?php if($aantalXXS !== "0") { ?>
                    <option value="XXS">XXS</option>
                <?php } ?>

                <?php if($aantalXS !== "0") { ?>
                <option value="XS">XS</option>
                <?php } ?>

                <?php if($aantalS !== "0") { ?>
                    <option value="S">S</option>
                <?php } ?>

                <?php if($aantalM !== "0") { ?>
                    <option value="M">M</option>
                <?php } ?>

                <?php if($aantalL !== "0") { ?>
                    <option value="L">L</option>
                <?php } ?>

                <?php if($aantalXL !== "0") { ?>
                    <option value="XL">XL</option>
                <?php } ?>

                <?php if($aantalXXL !== "0") { ?>
                    <option value="XXL">XXL</option>
                <?php } ?>

            </select>
            <span class="errors"><?= isset($errors['maat']) ? $errors['maat'] : '' ?></span>
        </div>

        <div class="data-submit">
            <input type="submit" name="submit" value="Reserveren"/>
        </div>
        </form>

        <?php if(isset($_POST['submit'])){
            if(empty($errors)){ ?>
        <div id = check>
            <h2>Controleer je reservering:</h2>
            <form action="" method="post" enctype="multipart/form-data">

                <div>
                    <label for="naam">Naam:</label>
                    <input type="text" id="naam" name="naam" value="<?= htmlentities($naam) ?>">
                    <span class="errors"><?= isset($errors['naam']) ? $errors['naam'] : '' ?></span>
                </div>

                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= htmlentities($email) ?>">
                    <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                </div>

                <div>
                    <label for="nummer">Nummer:</label>
                    <input type="text" id="nummer" name="nummer" value="<?= htmlentities($nummer) ?>">
                    <span class="errors"><?= isset($errors['nummer']) ? $errors['nummer'] : '' ?></span>
                </div>

                <div>
                    <label for="time">Ophalen:</label>
                    <?= $date ?> om:
                    <input type="time" id="time" name="time" min="13:00" value="<?=htmlentities($time)?>">
                    <span class="errors"><?= isset($errors['time']) ? $errors['time'] : '' ?></span>
                </div>

                <div>
                    <label for="maat">Maat:</label>
                    <select name="maat" id="maat">

                        <?php if($aantalXXS !== "0") { ?>
                            <option value="XXS"
                                <?php if ($maat4 == 'XXS') { ?>
                                    selected
                                <?php } ?>
                            >XXS</option>
                        <?php } ?>

                        <?php if($aantalXS !== "0") { ?>
                            <option value="XS"
                                <?php if ($maat4 == 'XS') { ?>
                                    selected
                                <?php } ?>
                            >XS</option>
                        <?php } ?>

                        <?php if($aantalS !== "0") { ?>
                            <option value="S"
                                <?php if ($maat4 == 'S') { ?>
                                    selected
                                <?php } ?>
                            >S</option>
                        <?php } ?>

                        <?php if($aantalM !== "0") { ?>
                            <option value="M"
                                <?php if ($maat4 == 'M') { ?>
                                    selected
                                <?php } ?>
                            >M</option>
                        <?php } ?>

                        <?php if($aantalL !== "0") { ?>
                            <option value="L"
                                <?php if ($maat4 == 'L') { ?>
                                    selected
                                <?php } ?>
                            >L</option>
                        <?php } ?>

                        <?php if($aantalXL !== "0") { ?>
                            <option value="XL"
                                <?php if ($maat4 == 'XL') { ?>
                                    selected
                                <?php } ?>
                            >XL</option>
                        <?php } ?>

                        <?php if($aantalXXL !== "0") { ?>
                            <option value="XXL"
                                <?php if ($maat4 == 'XXL') { ?>
                                    selected
                                <?php } ?>
                            >XXL</option>
                        <?php } ?>

                    </select>
                    <span class="errors"><?= isset($errors['maat']) ? $errors['maat'] : '' ?></span>
                </div>

                <div class="data-submit">
                    <input type="submit" name="submit2" value="Reserveren"/>
                </div>
            </form>

        <?php }} ?>
    </div>
    </section>
</div>
</body>
</html>