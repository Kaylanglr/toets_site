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
    <title>toets naam</title>
    <link rel="stylesheet" href="../app/css/toets.maak.css">
</head>
<body>
    <header>
        <a href="../dashboard.php">
            <img src="../app/img/logo.png" alt="logo">
        </a>
    </header>
    <main>
        <div class="confirm">
            <h2>Start de toets</h2>
            <p>Sluit u de pagina af, dan wordt uw progressie niet opgeslagen</p>
            <button><a href="toetsen.php">Ga terug</a></button>
            <button type="button" onclick="startToets()">Start</button>
        </div>
        <div class="toets-form hidden">
            <form id="toets">
                <input type="hidden" name="toets_id" value="<?php echo $toets; ?>">
                <div class="vragen">
                    
                </div>
                <div class="buttons">
                    <button type="button" onclick="prev()">Vorige</button>
                    <button type="button" class="next" onclick="next()">Volgende</button>
                </div>
            </form>
        </div>
        <div class="finish hidden">
            <h2>Wil je de toets afronden?</h2>
            <button onclick="finish()">Ja</button>
            <button onclick="goBack()">Nee</button>
        </div>
        <div class="result hidden">

        </div>
    </main>
    <footer>
        <p>© 2022 Kaylan de Groot & Delano van Aken</p>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../app/js/toets.js" defer></script>
</html>