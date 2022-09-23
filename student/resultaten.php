<?php
    require '../app/php/config.php';
    session_start();
    if(isset($_SESSION['student_id'])){
        $student = $_SESSION['student_id'];
        $query = "SELECT toets_resultaten.resultaat, toets_resultaten.datum, toetsen.toets_naam FROM toets_resultaten INNER JOIN toetsen on toets_resultaten.toets_id=toetsen.toets_id WHERE toets_resultaten.student_id={$student}";
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
                <?php 
                    if($result->num_rows > 0) {
                        echo "<table>";
                        echo "<thead>";
                            echo "<th>Toets</th>";
                            echo "<th>Datum</th>";
                            echo "<th>Cijfer</th>";
                        echo "</thead>";
                        while($resultaat = $result->fetch_array()) {
                            echo "<tr>";
                                echo "<td>{$resultaat[2]}</td>";
                                echo "<td>{$resultaat[1]}</td>";
                                echo "<td>{$resultaat[0]}</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }else {
                        echo "<h2>Je hebt nog geen resultaten</h2>";

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