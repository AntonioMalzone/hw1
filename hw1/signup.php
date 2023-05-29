<?php
include 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }
if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password_confirm"])) {
    $error = array();
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die("Impossibile connettersi al database");   
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $query = "SELECT username FROM users WHERE username = '$username'";
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) > 0) {
        $error[] = "Username già utilizzato";
    }
    if (strlen($_POST["password"]) < 8) {
        $error[] = "La password deve essere lunga almeno 8 caratteri.";
    }
    if (!preg_match('/[A-Z]/', $_POST["password"])) {
        $error[] = "La password deve contenere almeno una lettera maiuscola.";
    }
    if (!preg_match('/[a-z]/', $_POST["password"])) {
        $error[] = "La password deve contenere almeno una lettera minuscola.";
    }
    if (!preg_match('/[0-9]/', $_POST["password"])) {
        $error[] = "La password deve contenere almeno un numero.";
    }
    if (!preg_match('/[!@#$%^&*()\-=_+[\]{};:<>\/|?.,]/', $_POST["password"])) {
        $error[] = "La password deve contenere almeno un carattere speciale.";
    }
    if (strcmp($_POST["password"], $_POST["password_confirm"]) != 0) {
        $error[] = "Le password non coincidono";
    }
    if (count($error) == 0) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $query = "INSERT INTO users(username, password) VALUES('$username', '$password')";
        if (mysqli_query($conn, $query)) {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["id"] = mysqli_insert_id($conn);
            mysqli_close($conn);
            header("Location: home.php");
            exit;
        } else {
            $error[] = "Errore di connessione al Database";
        }
    }
    mysqli_close($conn);
} else if (isset($_POST["username"])||isset($_POST["password"])||isset($_POST["password_confirm"])) {
    $error = array("Riempi tutti i campi");
}
?>
<html>

<head>
    <link rel="stylesheet" href="signup.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <script src="signup.js" defer></script>
</head>
<body>
    <header>
        <div class="overlay">
            <nav>
                <a href="index.php">
                    <div id="logo">
                        MovieDiary
                    </div>
                </a>
            </nav>
            <form method="post">
                <div class="username"><input type="text" name="username" placeholder="username"></div>
                <div class="password"><input type="password" name="password" placeholder="password"></div>
                <div class="password_confirm"><input type="password" name="password_confirm"
                        placeholder="conferma password"></div>
                <div class="submit"><input type="submit" value="Registrati"></div>
                <div class="link">
                    <a href="login.php">Già registrato?</a>
                </div>
                <?php if (isset($error)) {
                    foreach ($error as $err) {
                        echo "<div class='error'><span>" . $err . "</span></div>";
                    }
                } ?>
            </form>
        </div>
    </header>
    <footer>
        <div class="footer__column">
            <p class="footer__column__logo">
            <h1>MovieDiary</h1>
            </p>
            <p>Antonio Malzone</p>
            <p>1000014823</p>
        </div>
        <div class="footer__column links">
            <a href=""><img src="./img/logo-linkedin.png"></a>
            <a href=""><img src="./img/logo-instagram.png"></a>
            <a href=""><img src="./img/logo-facebook.png"></a>
        </div>
    </footer>
</body>

</html>