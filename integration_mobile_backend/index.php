<?php
include_once 'API.php';
$loginData = "";
session_start();
if(isset($_SESSION["userid"])){
    header('Location: '.'overzicht.php');
}
if (isset($_POST["submitted"])) {
    if (isset($_POST["gebruikersnaam"]) && isset($_POST["wachtwoord"])) {
        $gebruikersnaam = $_POST["gebruikersnaam"];
        $wachtwoord = $_POST["wachtwoord"];
        $loginData = API::login($gebruikersnaam, $wachtwoord);
    } else {
        $loginData = (array(
            "error" => "please enter username and password",
            "userid" => ""
        ));
    }
    echo strlen($loginData["error"]);
    if (strcmp($loginData["error"], "") === 0) {
        session_start();
        $_SESSION["userid"] = $loginData["userid"];
        header('Location: ' . 'overzicht.php');
    }
}
?>

<doctype html>
    <html lang="nl">

        <head>
            <meta charset= "utf-8">
            <meta autor="Sam Castaigne">
            <link rel="stylesheet" href="login.css">
            <link rel="stylesheet" href="animate.css">

            <title>Mioso - Log-in</title>
        </head>

        <body>

            <header class="animated fadeInDown">
                <img class="logo" src="img/Logo.svg" height="120px" width="120px">
                <h1 class="Mioso">Mioso</h1>
            </header>

            <form class="logInForm animated fadeInUp" action="index.php" method="POST">
                <h2 class="form-titel">LOGIN</h2>
                <div class="animated">
                    <input type="text" name="gebruikersnaam"  placeholder="gebruikersnaam">
                    <br>
                    <input type="text" name="wachtwoord"  placeholder="wachtwoord">
                    <br>
                    <input type="hidden" name="submitted" value="1">
                    <button class="animated" type="button" id="button-account-maken">ACCOUNT MAKEN</button>
                    <button class="animated" type="submit" id="button-continue">CONTINUE</button>
                </div>
            </form>

            <a class="paswoord-link animated fadeInUp3" href="#">Paswoord vergeten?</a>

        </body>

    </html>

</doctype>
