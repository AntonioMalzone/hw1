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
    <title>Cerca</title>
    <script src="cerca.js" defer></script>
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

            <form id="search">
                <input type="text" name="search" id="searchbar" placeholder="CERCA">
            </form>

            <div class='suggestion'>Cerchi ispirazione? Ecco a te i <a href="top10.php">10 film più popolari del
                    momento!</a></div>
        </div>

    </header>



    <section id="grid">
    </section>
    <footer>
        <div class="footer__column">
            <p class="footer__column__logo">
            <h1>MovieDiary</h1>
            </p>
            <p>Antonio Malzone</p>
            <p>100014823</p>
        </div>
        <div class="footer__column links">
            <a href=""><img src="./img/logo-linkedin.png"></a>
            <a href=""><img src="./img/logo-instagram.png"></a>
            <a href=""><img src="./img/logo-facebook.png"></a>
        </div>
    </footer>

</body>

</html>