<?php 
    session_start();
    require '../app/php/config.php';

    if(isset($_GET['toets'])) {
        $toets = $_GET['toets'];
        $query = "SELECT * FROM toetsen WHERE toets_id = {$toets}";
        $toetsBestaat = $conn->query($query);
        if ($toetsBestaat->num_rows > 0) {

        }else {
            header("Location: ../dashboard.php");
            exit;
        }
    }else {
        header("Location: ../dashboard.php");
        exit;
    }

?>


<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voeg een vraag toe</title>
    <link rel="stylesheet" href="../app/css/create.style.css">
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
        <section class="content create">
            <div class="msg">
                
            </div>


            <div class="create-vraag">
                <h2>Maak een toets vraag</h2>
                <div class="type">
                    <button id="show1">Meerkeuzevraag</button>
                    <button id="show2">Open vraag</button>
                </div>
            
                <form id="open" class="open vraag-form">
                    <input type="hidden" name="type" value="open">
                    <input type="hidden" name="toets" value="<?php echo $toets; ?>">
                    <label for="vraag">Vraag</label> <br>
                    <input type="text" name="vraag" id="vraag" required>
            
                    <label for="antwoord">Antwoord</label> <br>
                    <input type="text" name="antwoord" id="antwoord" required>
                    <div class="bottom">
                        <input type="submit" name="submit" id="submit" value="Maak vraag">
                    </div>
                </form>
                
                <form id="meerkeuze" class="meerkeuze vraag-form">
                    <input type="hidden" name="type" value="meerkeuze">
                    <input type="hidden" name="toets" value="<?php echo $toets; ?>">
                    <label for="vraag">Vraag</label> <br>
                    <input type="text" name="vraag" id="vraag" required>
                    <hr>
                    <label for="onderwerp">Keuzes</label> <br>
                    <table>
                        <tr>
                            <td>Optie A</td>
                            <td><input type="text" name="optieA" required></td>
                        </tr>
                        <tr>
                            <td>Optie B</td>
                            <td><input type="text" name="optieB" required></td>
                        </tr>
                        <tr>
                            <td>Optie C</td>
                            <td><input type="text" name="optieC" required></td>
                        </tr>
                        <tr>
                            <td>Optie D</td>
                            <td><input type="text" name="optieD" required></td>
                        </tr>
                    </table>
                    <hr>
                    <label for="naam">Antwoord</label> <br>
                    <select name="antwoord" id="antwoord" required>
                        <option value="" disabled selected>-- Kies een antwoord --</option>
                        <option value="A">Antwoord A</option>
                        <option value="B">Antwoord B</option>
                        <option value="C">Antwoord C</option>
                        <option value="D">Antwoord D</option>
                    </select>
                    <div class="bottom">
                        <input type="submit" name="submit" id="submit" value="Maak vraag">
                    </div>
                </form>

            </div>
        </section>
    </main>
    <footer>
        <p>© 2022 Kaylan de Groot & Delano van Aken</p>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://kit.fontawesome.com/ab1ca9801d.js" crossorigin="anonymous"></script>
<script src="../app/js/create.js" defer></script>
</html>