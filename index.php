<?php
    session_start();


    if (isset($_SESSION['user_id'])) {
        header("Location: dashboard.php");
        exit;
    }
?>

<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="app/css/inlog.style.css">
</head>
<body>
    <header>
        <a href="">
            <img src="app/img/logo.png" alt="logo">
        </a>
    </header>
    <main>
        <div class="login-box">
            <h2>Login</h2>
            <form action="app/php/inlog.verwerk.php" method="post">
                <label for="email">Email</label> <br>
                <input type="email" name="email" id="email">

                <label for="wachtwoord">Wachtwoord</label> <br>
                <input type="password" name="wachtwoord" id="wachtwoord">
                
                    <?php
                        if(isset($_GET['msg'])) {
                            ?>
                            <div class="msg">
                            <?php
                            if($_GET['msg'] == 'empty') {
                                echo '<p>Niet alle velden zijn ingevuld!</p>';
                            }
                            else if ($_GET['msg'] == 'invalid') {
                                echo '<p>Email of wachtwoord is incorrect!</p>';
                            }
                            ?>
                            </div>
                            <?php
                        }
                    ?>
                <div class="bottom">
                    <input type="submit" name="submit" value="login">
                </div>
            </form>
        </div>
    </main>
    <footer>
        <p>© 2022 Kaylan de Groot & Delano van Aken</p>
    </footer>
</body>
</html>