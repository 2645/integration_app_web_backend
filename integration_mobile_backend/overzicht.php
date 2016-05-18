<?php
include_once 'API.php';
session_start();
if (!isset($_SESSION["userid"])) {
    header('Location: ' . 'index.php');
}
?>

<doctype html>
    <html lang="nl">

        <head>
            <meta charset= "utf-8">
            <meta autor="Sam Castaigne">
            <link rel="stylesheet" href="overzicht.css">
            <link rel="stylesheet" href="animate.css">

            <title>Mioso - overzicht</title>

            <script src="js/jquery-2.1.3.min.js"></script>    
            <script type="text/javascript" src="js/debugger.js"></script>
            <script type="text/javascript" src="js/canvas_helper.js"></script>
            <script type="text/javascript" src="js/fps.js"></script>
            <script>
                $(document).ready(function () {
                    $(".patient").click(function () {
                        var url = 'detail.php';
                        var form = $('<form action="' + url + '" method="post">' +
                                '<input type="text" name="patientid" value="' + $(this).attr('id') + '" />' +
                                '</form>');
                        $('body').append(form);
                        form.submit();
                    });
                });
            </script>
        </head>

        <body>

            <header class=" animated fadeInDown">
                <img class="logo" src="img/Logo.svg" height="60px" width="60px">
                <h1 class="Mioso">Mioso</h1>
                <a class="sign-out" href="logout.php">SIGN OUT</a>
                <div class="profiel-icon"></div>
            </header>

            <section class="content-list animated fadeIn">
                <h2 class=" animated fadeInDown">OVERZICHT</h2>

                <table class="lijst">
                    <tr class="header-row animated fadeInUp">
                        <th class="column-foto"></th>
                        <th class="column-naam">NAAM</th> 
                        <th class="column-weekoverzicht">WEEKOVERZICHT</th>
                        <th class="column-gewicht"><img class="gewicht-icon" src="img/scale-icon.svg" height="21px" width="21px"><p class="gewicht-titel">GEWICHT</p></th>
                    <th class="column-gem-hartritme">GEM. HARTRITME</th>
                    <th class="column-hartritme">HARTRITME</th>
                    </tr>
                    <?php
                    $userid = $_SESSION["userid"];
                    $patienten = API::getPatienten($userid);

                    foreach ($patienten['values'] as $patient) {
                        ?>
                        <tr id="<?php echo $patient->getId() ?>" class="patient animated fadeInUp2">
                            <td class="column-foto">
                                <svg width="110" height="110">
                                    <defs>
                                        <clipPath id="circleView">
                                            <circle cx="55" cy="55" r="45" fill="#FFFFFF" />            
                                        </clipPath>
                                    </defs>                                    
                                    <image  height="110" width="110" xlink:href="<?php echo $patient->getFoto() ?>" clip-path="url(#circleView)" preserveAspectRatio="xMidYMid slice"/>
                                    <circle cx="55" cy="55" r="48" stroke="#C7DFF2" stroke-width="5" stroke-linejoin="round" fill="none" />  
                                    <circle cx="55" cy="55" r="48" stroke="#7BCAE9" stroke-width="5" stroke-linejoin="round" fill="none" stroke-dasharray="<?php echo rand(0,301)?>,360"/>
                                </svg>
                            </td>
                            <td class="column-naam"><?php echo $patient->getVoornaam() . " " . $patient->getNaam() ?></td>
                            <td class="week-overzicht">
                            <?php
                            foreach (API::getGewogenDagenPerWeek($patient->getId()) as $key => $item) {
                                ?>
                                <img class="week-icon" src="
                                <?php
                                if ($item) {
                                    if ($key < 5) {
                                        echo "img/checked.svg";
                                    } else {
                                        echo "img/checkedWeekend.svg";
                                    }
                                } else {
                                    if ($key < 5) {
                                        echo "img/unchecked.svg";
                                    } else {
                                        echo "img/uncheckedWeekend.svg";
                                    }
                                }
                                ?>
                                     ">
                                     <?php
                                 }
                                 ?>
                            </td>
                            <td class="column-gewicht"><?php echo API::getLaatsteGewicht($patient->getId())->getWaarde() ?><mark>Kg</mark></td>
                            <td class="column-gem-hartritme"><?php echo API::getGemiddeldeHartslag($patient->getId()) ?><mark>Bpm</mark></td>
                            <td class="column-hartritme"><canvas class="hartmeter" id="hartmeter<?php echo $patient->getId() ?>" width="300" height="120"></canvas></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <!--
                <tr id="patient1" class="patient animated fadeInUp2">
                    <td class="column-foto"><canvas class="statusbar" id="canvas1" width="110" height="110"></canvas></td>
                    <td class="column-naam">Walter White</td> 
                    <td class="column-weekoverzicht">
                        <img class="week-icon" src="img/checked.svg">
                        <img class="week-icon" src="img/checked.svg">
                        <img class="week-icon" src="img/unchecked.svg">
                        <img class="week-icon" src="img/checked.svg">
                        <img class="week-icon" src="img/unchecked.svg">
                        <img class="week-icon" src="img/checkedWeekend.svg">
                        <img class="week-icon" src="img/uncheckedWeekend.svg">
                    </td>
                    <td class="column-gewicht">54<mark>Kg</mark></td>
                    <td class="column-gem-hartritme">65<mark>BPM</mark></td>
                    <td class="column-hartritme"><canvas class="hartmeter" id="hartmeter1" width="300" height="120"></canvas></td>
                </tr>
                <tr id="patient2" class="patient animated fadeInUp3">
                    <td class="column-foto"><canvas class="statusbar" id="canvas2" width="110" height="110"></canvas></td>
                    <td class="column-naam">Walter White</td> 
                    <td class="column-weekoverzicht">
                        <img class="week-icon" src="img/checked.svg">
                        <img class="week-icon" src="img/checked.svg">
                        <img class="week-icon" src="img/unchecked.svg">
                        <img class="week-icon" src="img/checked.svg">
                        <img class="week-icon" src="img/unchecked.svg">
                        <img class="week-icon" src="img/checkedWeekend.svg">
                        <img class="week-icon" src="img/uncheckedWeekend.svg">
                    </td>
                    <td class="column-gewicht">54<mark>Kg</mark></td>
                    <td class="column-gem-hartritme">65<mark>BPM</mark></td>
                    <td class="column-hartritme"><canvas class="hartmeter" id="hartmeter2" width="300" height="120"></canvas></td>
                </tr>
                <tr id="patient3" class="patient animated fadeInUp4">
                    <td class="column-foto"><canvas class="statusbar" id="canvas3" width="110" height="110"></canvas></td>
                    <td class="column-naam">Walter White</td> 
                    <td class="column-weekoverzicht">
                        <img class="week-icon" src="img/checked.svg">
                        <img class="week-icon" src="img/checked.svg">
                        <img class="week-icon" src="img/unchecked.svg">
                        <img class="week-icon" src="img/checked.svg">
                        <img class="week-icon" src="img/unchecked.svg">
                        <img class="week-icon" src="img/checkedWeekend.svg">
                        <img class="week-icon" src="img/uncheckedWeekend.svg">
                    </td>
                    <td class="column-gewicht">54<mark>Kg</mark></td>
                    <td class="column-gem-hartritme">65<mark>BPM</mark></td>
                    <td class="column-hartritme"><canvas class="hartmeter" id="hartmeter3" width="300" height="120"></canvas></td>
                </tr>
                    -->
                </table>

            </section>


        </body>

    </html>

</doctype>
