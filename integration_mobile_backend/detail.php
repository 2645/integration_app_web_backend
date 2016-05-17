<?php
include_once 'API.php';
session_start();
if (!isset($_SESSION["userid"])) {
    header('Location: ' . 'index.php');
}
if (!isset($_POST["patientid"])) {
    header('Location: ' . 'overzicht.php');
}
$patient = API::getPatientById($_POST["patientid"])['value'];
?>

<doctype html>
    <html lang="nl">

        <head>
            <meta charset= "utf-8">
            <meta autor="Sam Castaigne">
            <link rel="stylesheet" href="detail.css">
            <link rel="stylesheet" href="animate.css"> 
            <script src="js/jquery-2.1.3.min.js"></script>  
            <script type="text/javascript" src="js/debugger.js"></script>
            <script type="text/javascript" src="js/canvas_helper.js"></script>
            <script type="text/javascript" src="js/fps.js"></script>
            <script type="text/javascript" src="js/Statusbar.js"></script>
            <script type="text/javascript" src="js/informatieManager.js"></script>
            <script type="text/javascript" src="js/Grafiek.js"></script>

            <title>Mioso - detail
            </title>
        </head>

        <body>

            <aside class="navigationbar animated fadeInLeft">
                <logo>
                    <img class="logo" src="img/Logo.svg" height="60px" width="60px">
                    <h1 class="Mioso">Mioso</h1>
                </logo>
                <a class="back-button" href="overzicht.php">Back</a>
                <h1 class="lijst-titel">PATIËNTEN</h1>
                <ul class="patienten-list">
                    <?php
                    foreach (API::getPatienten($_SESSION["userid"])['values'] as $current) {
                        ?>
                        <li class="list-item"><a class="list-item-link" href="">
                                <img class="patient-icon" src="<?php echo $current->getFoto() ?>"><p class="list-item-naam"><?php echo $current->getVoornaam()." ".$current->getNaam()?></p></a></li>
                        <?php
                    }
                    ?>                
                </ul>
            </aside>	

            <section class="main-content grid">
                <div class="wrapper">
                    <section class="kalender card animated fadeInUp2">
                        <header class="kalender-header">
                            <img class="icon" id="kalendericon-left" src="/img/left-arrow.svg" width="70px" height="70px">
                            <h2 class="kalender-month">January 2016</h2>
                            <img class="icon" id="kalendericon-right" src="img/right-arrow.svg" width="70px" height="70px">
                        </header>
                        <table class="kalender">
                            <tr class="kalender-indeling">
                                <th>Maandag</th>
                                <th>Dinsdag</th> 
                                <th>Woensdag</th>
                                <th>Donderdag</th>
                                <th>Vrijdag</th>
                                <th>Zaterdag</th>
                                <th>Zondag</th>
                            </tr>
                            <tr>
                                <td class="vorige-maand">28</td>
                                <td class="vorige-maand">29</td> 
                                <td class="vorige-maand">30</td>
                                <td class="vorige-maand">31</td>
                                <td>14</td>
                                <td>2</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>5</td> 
                                <td>6</td>
                                <td>7</td>
                                <td>8</td>
                                <td>9</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>12</td> 
                                <td>13</td>
                                <td>14</td>
                                <td>15</td>
                                <td>16</td>
                                <td>17</td>
                            </tr>
                            <tr>
                                <td>18</td>
                                <td>19</td> 
                                <td>20</td>
                                <td>21</td>
                                <td>22</td>
                                <td>23</td>
                                <td>24</td>
                            </tr>
                            <tr>
                                <td>25</td>
                                <td>26</td> 
                                <td>27</td>
                                <td>28</td>
                                <td>29</td>
                                <td>30</td>
                                <td>31</td>
                            </tr>
                        </table> 
                    </section>

                    <section class="persoon-info card animated fadeInUp3">

                        <div class="icon-container">
                            <div class="icon-wrapper">
                                <canvas class="persoon-icon" id="canvas1" width="110" height="110"></canvas>
                            </div>
                            <h3 class="persoon-naam"><?php echo $patient->getVoornaam(). " " . $patient->getNaam() ?></h3>
                            <div class="persoon-info">
                                <div class="boven">
                                    <p class="persoon-kg info"><?php echo API::getLaatsteGewicht($patient->getId())->getWaarde() ?><mark>kg</mark></p>
                                    <p class="persoon-leeftijd info"><?php echo $patient->getLeeftijd()?><mark>Jaar</mark></p>
                                </div>
                                <p class="persoon-bmi info"><?php 
                                $bmi = API::getLaatsteGewicht($patient->getId())->getWaarde() / ($patient->getLengte() * $patient->getLengte()) *10000;
                                echo round($bmi,1);
                                ?><mark>BMI</mark></p>
                            </div>
                        </div>  

                    </section>

                    <section class="chart card animated fadeInUp4">
                        <canvas id="myChart" width="1050" height="200"></canvas>
                    </section>

                </div>	
            </section>	

        </body>

    </html>

</doctype>
