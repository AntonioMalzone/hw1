<?php
include 'auth.php';
if (!checkAuth()) {
    header("Location: login.php");
    exit;
}
?>

<html>

<head>
    <link rel="stylesheet" href="home.css">
    <meta charset="UTF-8">
    <script src='home.js' defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <header>
        <div class="overlay">
            <h1 class="t">Benvenuto <br>
                <?php echo $_SESSION['username']; ?>!
            </h1>
            <nav>
                <div id="logo">
                    MovieDiary
                </div>
                <div class="links">
                    <a href="cerca.php"> Cerca un film</a>
                    <a href="logout.php">Logout</a>
                </div>
            </nav>
        </div>
    </header>
    <div id="msg">La tua lista</div>
    <section id="results">
    </section>
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