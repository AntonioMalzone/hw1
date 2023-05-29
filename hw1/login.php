<?php
include 'auth.php';
if (checkAuth()) {
    header('Location: home.php');
    exit;
}

if (!empty($_POST["username"]) && !empty($_POST["password"])) {
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die("Impossibile connettersi al database!");
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $query = "SELECT * FROM users WHERE username ='" . $username . "' AND password='" . $password . "'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_num_rows($res) > 0) {
        $entry = mysqli_fetch_assoc($res);
        $_SESSION["username"] = $username;
        $_SESSION["id"] = $entry["id"];
        header("Location: home.php");
        mysqli_free_result($res);
        mysqli_close($conn);
        exit;
    } else {
        $error = "Username e/o password sono errati";
    }
} else if (isset($_POST["username"]) || isset($_POST["password"])) {
    $error = "Inserisci username e password";
}
?>

<html>

<head>
    <link rel="stylesheet" href="login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesso</title>
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
                <div class="submit"><input type="submit" value="Accedi"></div>
                <div class="link">
                    <a href="signup.php">Ancora non sei registrato?</a>
                </div>
                <?php
                if (isset($error)) {
                    echo "<p class='error'>$error</p>";
                }
                ?>
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