<?php
    session_start();
?>

<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toetsen</title>
    <link rel="stylesheet" href="../app/css/toetsen.style.css">
    <link rel="stylesheet" href="../app/css/main.style.css">
</head>
<body>
    <header>
        <a href="../dashboard.php">
            <img src="../app/img/logo.png" alt="logo">
        </a>
    </header>
    <main>
        <section class="menu">
            <div class="menu-top">
                <i class="fa-solid fa-user"></i>
                <h1><?php echo $_SESSION['naam']; ?></h1>
                <nav>
                <?php
                    if(isset($_SESSION['student_id'])) {
                        ?>
                        <a href="toetsen.php">Toetsen</a>
                        <a href="resultaten.php">Resultaat overzicht</a>
                        <?php
                    }
                ?>
                </nav>
            </div>
            <div class="menu-bottom">
                <a href="../app/php/loguit.verwerk.php">Loguit</a>
            </div>
        </section>
        <section class="content">
            <div class="toetsen">

            </div>
        </section>
    </main>
    <footer>
        <p>© 2022 Kaylan de Groot & Delano van Aken</p>
    </footer>
</body>
<script src="https://kit.fontawesome.com/ab1ca9801d.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../app/js/toetsen.js" defer></script>
</html>