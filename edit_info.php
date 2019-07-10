<?php
include 'libraries/include.php';
include_once 'connect.php';
$username = $_SESSION['username'];
// Define variables and initialize with empty values and recover username from session
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $database->query($sql);
$results = $result->fetch_assoc();
$name = $results['name'];
$child = $results['child'];
$phoneNumber = $results['phone'];
$class = $results['class'];
$teacher = $results['teacher'];
$details = $results['details'];
// Processing form data when form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $child = $_POST['child'];
    $phoneNumber = $_POST['phone'];
    $class = $_POST['class'];
    $teacher = $_POST['teacher'];
    $details = $_POST['details'];



    $sql = "UPDATE `users` SET `name`='$name',`phone`= '$phoneNumber',`child`='$child',`class`='$class',`teacher`='$teacher',`details`='$details' WHERE username = '$username'";


    $row =  $database->query($sql);
    if ( isset( $_POST['submit'] ) ) {header("location: main.php"); }



}


?>

<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <!--   <script src="libraries/pickadate.js-3.5.6/lib/ui-pickadate.js"></script>-->
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<div class="row">
    <div class="col s12"><img class="z-depth-3 responsive-img" src="img/blieken01.jpg"</div>
</div>
<div class="form">
    <h2 style="text-align: center">Details</h2>
    <div class="row">
        <form class="col l2s offset-s0 offset-m4" action="" method="post">
            <div class="row">

                <div class="input-field col s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input name="name" id="name" type="text" value="<?=$name?>" class="validate">
                    <label for="name">Naam Ouders</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">phone</i>
                    <input name="phone" id="phone" type="text" value="<?=$phoneNumber?>" class="validate" data-length="10">
                    <label for="phone">Telefoon Nummer</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">child_care</i>
                    <input name="child" id="child" type="text" value="<?=$child?>" class="validate">
                    <label for="child">Naam Kind</label>
                </div>

            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">business</i>
                    <input name="class" id="class" type="text" value="<?=$class?>" class="validate">
                    <label for="class">Klas</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">face</i>
                    <input name="teacher" id="teacher" type="text" value="<?=$teacher?>" class="validate">
                    <label for="teacher">Leerkracht</label>
                </div>

            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">note</i>
                    <textarea name="details" id="details" class="materialize-textarea"
                              value="<?=$details?>"></textarea>
                    <label for="details">Bijzonderheden:</label>
                </div>
            </div>

            <button class="btn waves-effect waves-light green" type="submit" name="submit">Verzend Gegevens
                <i class="material-icons right">send</i>
            </button>
        </form>
    </div>


</body>
</html>

<?php
if ( !isset( $_SESSION['username'] ) ) {header("location: index.php"); }
?>