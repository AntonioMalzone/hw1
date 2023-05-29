<?php
include 'auth.php';
if (!checkAuth()) {
    header("Location: login.php");
    exit;
}
?>

<html>

<head>
    <link rel="stylesheet" href="cerca.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Most Popular</title>
    <script src="top10.js" defer></script>
</head>

<body>
    <header>
        <div class="overlay">
            <nav>
                <div id="logo">
                    MovieDiary
                </div>
                <div class="links">
                    <a href="home.php"> Home</a>
                    <a href="logout.php">Logout</a>
                </div>

            </nav>
    </header>
    <section id="grid">
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