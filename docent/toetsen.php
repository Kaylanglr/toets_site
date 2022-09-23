<?php
    require '../app/php/config.php';
    session_start();
    if(isset($_SESSION['docent_id'])){
        $docent = $_SESSION['docent_id'];
        $query = "SELECT * FROM toetsen WHERE docent_id = {$docent}";
        $result = $conn->query($query);
    }
    else {
        header('Location: ../dashboard.php');
        exit;
    }
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
                    if(isset($_SESSION['docent_id'])) {
                        ?>
                        <a href="toets.create.php">Maak toets</a>
                        <a href="toetsen.php">Gemaakte toetsen</a>
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
                <?php 
                    if($result->num_rows > 0) {
                        echo "<table>";
                        echo "<thead>";
                            echo "<th>Naam</th>";
                            echo "<th>Onderwerp</th>";
                            echo "<th></th>";
                            echo "<th></th>";
                            echo "<th></th>";
                        echo "</thead>";
                        while($toets = $result->fetch_array()) {
                            echo "<tr>";
                                echo "<td>{$toets[1]}</td>";
                                echo "<td>{$toets[2]}</td>";
                                echo "<td><a href='vraag.create.php?toets={$toets[0]}'>Voeg vraag toe</a></td>";
                                echo "<td><a href='resultaten.php?toets={$toets[0]}'>Resultaten</a></td>";
                                echo "<td><a href='../app/php/delete.php?toets={$toets[0]}'><i class='fa-solid fa-trash-can'></i></a></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }else {
                        echo "<h2>Er zijn nog geen toetsen gemaakt door u</h2>";

                    }
                   ?>
            </div>
        </section>
    </main>
    <footer>
        <p>© 2022 Kaylan de Groot & Delano van Aken</p>
    </footer>
</body>
<script src="https://kit.fontawesome.com/ab1ca9801d.js" crossorigin="anonymous"></script>
</html>