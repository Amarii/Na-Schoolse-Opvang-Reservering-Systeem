<?php
include 'libraries/include.php';
include "connect.php";

$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $database->query($sql);
$array = $result->fetch_assoc();
$type = $array['user_type'];
$name = $array['name'];
$phone = $array['phone'];
$child = $array['child'];
$class = $array['class'];
$teacher = $array['teacher'];
$details = $array['details'];
if (!isset($_SESSION['username'])) {
    header("location: index.php");
}
$sql1 = "SELECT * FROM begeleiders";
$result1 = $database->query($sql1);
$array1 = $result1->fetch_assoc();
$sql2 = "SELECT * FROM users";
$result2 = $database->query($sql2);

$_SESSION['name'] = $array1['name'];

if(isset($_POST['submitSupervisor'])){
    $name = $_POST["name"];

    $phone = $_POST["phone"];
    $sqlSupervisorSelect = "SELECT * FROM `begeleiders`";
    $resultSupervisor = $database->query($sqlSupervisorSelect);
    $nameSupervisor = $resultSupervisor->fetch_assoc();
$name2 = $nameSupervisor['name'];
    $sqlUpdateSupervisor = "UPDATE `begeleiders` SET `name`= '$name',`phone`= '$phone' WHERE `name`= '$name2'";
    $resultSupervisor = $database->query($sqlUpdateSupervisor);
$_POST['submitSupervisor'] = "";

}
if(isset($_POST['addSupervisor'])){
    $addname = $_POST["name"];

    $addphone = $_POST["phone"];
    $sqlSupervisorSelect = "SELECT * FROM `begeleiders`";
    $resultAddSupervisor = $database->query($sqlSupervisorSelect);
    $addNameSupervisor = $resultAddSupervisor->fetch_assoc();
$addName2 = $addNameSupervisor['name'];
    $sqlAddSupervisor = "INSERT INTO `begeleiders`(`name`, `phone`) VALUES ('$addname','$addphone')";
    $database->query($sqlAddSupervisor);



}

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sqlSelect = "SELECT * FROM `begeleiders` WHERE `id` = '$id'";
    $result = $database->query($sqlSelect);
    $fetch = $result->fetch_assoc();
    $_POST = "";

}

?>


    <html>
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    </head>

    <body>
    <!--Import jQuery before materialize.js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

    <script src="libraries/scripts.js"></script>
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <?php include"navbar.php";


    if ($array['user_type'] == "Admin") { ?>

        <div class="row">

            <div class="col s3 m2">
                <div class="row">
                    <a class="waves-effect green btn" onclick="openCalendar()">Kalender</a>
                </div>

                <div class="row">
                    <a class="waves-effect green btn" onclick="openSupervisor()">Begeleiders</a>
                </div>

                <div class="row"><a class="waves-effect yellow btn" href="logout.php">Uitloggen</a>
                </div>
            </div>
            <div class="col s9">
                <div class="col s10" style="display: none" id="supervisor">
                    <table class="striped">
                        <thead>
                        <th><h4>Begeleiders</h4></th>
                        </thead>
                        <tbody>
                        <th>Naam</th>
                        <th>Telefoon</th>
                        <th><button class="btn-flat" type="button"  style="color:green" onclick="createSupervisor()">Toevoegen
                        </button></th>
                        <?php foreach ($result1 as $i => $row) { ?>
                            <tr>
                                <button class="hide" type="button" id="<?=$row['id']?>"></button>
                                <td><?= $row['name']; ?></td>
                                <td><?= $row['phone']; ?></td>
                                <td><button class="btn-flat" type="button" style="text-transform: lowercase; color:green" onclick="editSupervisor()">Aanpassen
                                    </button></td>

                            </tr>


                        <?php } ?>
                        </tbody>
                    </table>

                </div>
                <div class="row" style="display: none" id="editSupervisor">
                    <form class="col l2s offset-s0 offset-m4" action="" method="post">
                        <div class="row">
                            <div class="valign-wrapper center-align">
                            <div class="input-field col s8">
                                <i class="material-icons prefix">account_circle</i>
                                <input name="name" id="name" type="text" value="<?=$array1['name']?>" class="validate">
                                <label for="name">Naam Begeleider</label>
                            </div>
                            <div class="input-field col s8">
                                <i class="material-icons prefix">phone</i>
                                <input name="phone" id="phone" type="text" value="<?=$array1['phone']?>" class="validate" data-length="10">
                                <label for="phone">Telefoon Nummer</label>
                            </div>
                            </div>
                        </div>


                        <div class="row col s12">
<div class="valign-wrapper center-align">
    <div id="row">Beschikbaarheid: </div>

<?php
if($array1['monday'] == "1") {
    $monday = "grey";
}
else{
    $monday = "green";
}
if($array1['tuesday'] == "1") {
    $tuesday = "grey";
}
else{
    $tuesday = "green";
}
if($array1['wednesday'] == "1") {
    $wednesday = "grey";
}
else{
    $wednesday = "green";
}
if($array1['thursday'] == "1") {
    $thursday = "grey";
}
else{
    $thursday = "green";
}
if($array1['friday'] == "1") {
    $friday = "grey";
}
else{
    $friday = "green";
}

?>
                                    <button class="btn col s2 <?=$monday?>" type="button" value="<?=$array1['monday']?>" onclick="editSupervisorMonday()" id="supervisorMonday">Maandag</button>
                                    <button class="btn col s2 <?=$tuesday?>" type="button" value="<?=$array1['tuesday']?>" onclick="editSupervisorTuesday()" id="supervisorTuesday">Dinsdag</button>
                                    <button class="btn col s2 <?=$wednesday?>" type="button" value="<?=$array1['wednesday']?>" onclick="editSupervisorWednesday()" id="supervisorWednesday">Woensdag</button>
                                    <button class="btn col s2 <?=$thursday?>" type="button" value="<?=$array1['thursday']?>" onclick="editSupervisorThursday()" id="supervisorThursday">Donderdag</button>
                                    <button class="btn col s2 <?=$friday?>" type="button" value="<?=$array1['friday']?>" onclick="editSupervisorFriday()" id="supervisorFriday">Vrijdag</button>
</div>

                            </div>


                            <button class="btn waves-effect waves-light green" type="submit" name="submitSupervisor">Verzend Gegevens
                            <i class="material-icons right">send</i>
                        </button>
                    </form

                </div>
            </div>
                <div class="row" style="display: none" id="createSupervisor">
                    <form class="col l2s offset-s0 offset-m4" action="" method="post">
                        <div class="row">
                            <div class="valign-wrapper center-align">
                                <div class="input-field col s8">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input name="name" id="name" type="text" value="" class="validate">
                                    <label for="name">Naam Begeleider</label>
                                </div>
                                <div class="input-field col s8">
                                    <i class="material-icons prefix">phone</i>
                                    <input name="phone" id="phone" type="text" value="" class="validate" data-length="10">
                                    <label for="phone">Telefoon Nummer</label>
                                </div>
                            </div>
                        </div>
                        <button class="btn waves-effect waves-light green" type="submit" name="addSupervisor">Verzend Gegevens
                            <i class="material-icons right">send</i>
                        </button>
                    </form>
                </div>
                <form class="col s12" style="display: none" id="calendar" method="">


                    <div class="col s2">
                        <button class="btn btn1 waves-effect waves-light col s2" type="button" value="monday" id="monday">Ma
                        </button>
                    </div>
                    <div class="col s2">
                        <button class="btn btn1 waves-effect waves-light col s2" type="button" value="tuesday" id="tuesday">Di
                        </button>
                    </div>
                    <div class="col s2">
                        <button class="btn btn1 waves-effect waves-light col s2" type="button" value="wednesday" id="wednesday">Wo
                        </button>
                    </div>
                    <div class="col s2">
                        <button class="btn btn1 waves-effect waves-light col s2" type="button" value="thursday" id="thursday">Do
                        </button>
                    </div>
                    <div class="col s2">
                        <button class="btn btn1 waves-effect waves-light col s2" type="button" value="friday" id="friday">Vrij
                        </button>
                    </div>





                </form>
            </div>
        </div>

        <div class="center-align" id="name-data" style="display: none"></div>
        <script src="libraries/scripts.js"></script>


    <?php } ?>
    <?php if ($array['user_type'] == "User") { ?>
        <div class="row">

            <div class="col s5 m2">
                <div class="row">
                    <button class="waves-effect green btn" type="button" onclick="schedule()">Schema</button>
                </div>
                <div class="row">
                    <a class="waves-effect green btn" href="edit_info.php">Verander Informatie</a>
            </div>
                <div class="row">
                    <a class="waves-effect yellow btn" href="logout.php">Uitloggen</a>
                   </div>
                <div id="row"><?php if(isset($_POST['days'])){echo "<h3>Uw dagen zijn aangemeld</h3>";}?></div>
            </div>

            <div class="col s7 m9">
                <div class="row">
                    <section>
                    <div class="col s12" id="info" style="display: block">
                        <p><b> Naam Ouders:</b><br> <?= $name ?></p>
                        <p><b> Telefoon Nummer:</b><br> <?= $phone ?></p>
                        <p><b> Naam Kind:</b><br> <?= $child ?></p>
                        <p><b> Klas:</b><br> <?= $class ?></p>
                        <p><b> Leerkracht:</b><br> <?= $teacher ?></p>
                        <div class="cut"><b>Bijzonderheden:</b><br>
                            <?= $details ?></div><br>
                     <?php
                        if (isset($_POST['days'])){

                            $eraseMonday ="UPDATE `users` SET `monday` = 'no' WHERE `username` = '$username'";
                            $eraseTuesday ="UPDATE `users` SET `tuesday` = 'no' WHERE `username` = '$username'";
                            $eraseWednesday ="UPDATE `users` SET `wednesday` = 'no' WHERE `username` = '$username'";
                            $eraseThursday ="UPDATE `users` SET `thursday` = 'no' WHERE `username` = '$username'";
                            $eraseFriday ="UPDATE `users` SET `friday` = 'no' WHERE `username` = '$username'";
                            $database->query($eraseMonday);
                            $database->query($eraseTuesday);
                            $database->query($eraseWednesday);
                            $database->query($eraseThursday);
                            $database->query($eraseFriday);
                            foreach ($_POST['days'] as $key => $value) {
                                $sql3 = "UPDATE `users` SET `$value` = 'yes' WHERE `username` = '$username'";
                                $test = $database->query($sql3);


                            }

                        };?>

                    </section>
                    </div>

                    <div class="row" style="display: none" id="schedule">



                                    <section>
                                    <h3>Schema</h3><br>
                            Selecteer welke dagen u uw kind naar de opvang wil brengen




                                        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
                                        <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
                                        <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">
                                        </script>

                                        <script>
                                            $(document).ready(function() {
                                                $('select').material_select();
                                            });
                                        </script>

                                        <div class = "row">
                                            <form class="col s12" id="selectDays" action="" method="post">
                                            <select name="days[]" multiple="multiple">
                                                <option disabled selected>Selecteer de dagen</option>
                                                <option value = "monday">Maandag</option>
                                                <option value = "tuesday">Dinsdag</option>
                                                <option value = "wednesday">Woensdag</option>
                                                <option value = "thursday">Donderdag</option>
                                                <option value = "friday">Vrijdag</option>

                                            </select>
                                                <button class="btn waves-effect waves-light green" type="submit">Verzend
                                                    <i class="material-icons right">send</i>
                                            </form>
                                        </div>
                                    </section>
</div>

                    <?php } ?>

    <?php if ($array['user_type'] == "User") { ?>


    <?php } ?>


    </body>
    </html>

<?php
include "scripts.php";


