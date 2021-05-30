<?php
/** @var $db */
require_once "DB.php";

if (isset($_POST['submit'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $password2 = password_hash($_POST['password2'], PASSWORD_DEFAULT);
    $naam = $_POST['name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    if ($_POST['password'] == $_POST['password2']){
        $query = "INSERT INTO gebruikers (mail, password, name, last_name)
                  VALUES ('$email', '$password', '$naam', '$last_name')";
        $result = mysqli_query($db, $query) or die('Error: ' . $query);

        if ($result) {
            header('Location: overzicht.php');
            exit;
        } else {
            $error['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }
    }else{
        $errors['herhalen'] = 'Wachtwoord herhalen ging fout';
    }
    //Save the record to the database

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Aanmelden</title>
</head>
<body>
<h1>Nieuwe Admin toevoegen</h1>

<?php if (isset($error)) { ?>
    <p><?= $error['db']; ?></p>
<?php } ?>

<form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
    <div>
        <label for="name">Naam:</label>
        <input id="name" type="text" name="name"/>
    </div>
    <div>
        <label for="last_name">Achternaam:</label>
        <input id="last_name" type="text" name="last_name"/>
    </div>
    <div>
        <label for="email">E-mail:</label>
        <input id="email" type="email" name="email"/>
    </div>
    <div>
        <label for="password">Wachtwoord:</label>
        <input id="password" type="password" name="password"/>
    </div>
    <div>
        <label for="password2">Wachtwoord herhalen:</label>
        <input id="password2" type="password" name="password2"/>
        <span class="errors"><?= isset($errors['herhalen']) ? $errors['herhalen'] : '' ?></span>
    </div>
    <div>
        <input type="submit" name="submit" value="Aanmelden"/>
    </div>
</form>
</body>
</html>
