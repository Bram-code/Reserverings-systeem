<?php

session_start();

/** @var $db */
require_once "DB.php";
$login = false;

if (isset($_POST['submit'])) {
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = $_POST['password'];

    //Get record from DB based on first name
    $query = "SELECT * FROM gebruikers WHERE mail='$email'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $login = true;
        } else {
            $error = "Onjuiste inloggegevens";
        }
    } else {
        $error = "Onjuiste inloggegevens";
    }
    if (!isset($error)) {
        $_SESSION['login'] = $email;
    }
}


if (isset($_SESSION['login'])) {
    header("Location: overzicht.php ");
    exit;
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h1>Login</h1>

<?php if (isset($error)) { ?>
    <p><?= $error; ?></p>
<?php } ?>

<form method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
    <div>
        <label for="email">E-mail:</label>
        <input id="email" type="email" name="email"/>
    </div>
    <div>
        <label for="password">Wachtwoord:</label>
        <input id="password" type="password" name="password"/>
    </div>
    <div>
        <input type="submit" name="submit" value="Login"/>
    </div>
</form>
</body>
</html>