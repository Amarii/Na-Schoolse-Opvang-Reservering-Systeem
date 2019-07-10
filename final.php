<?php
include 'libraries/include.php';
include "connect.php";
$username = $_SESSION['formData']['username'];
$parent = $_SESSION['formData']['first_name'] . " " . $_SESSION['formData']['last_name'];
$child = $_SESSION['formData']['child'];
$class = $_SESSION['formData']['class'];
$phone = $_SESSION['formData']['phone'];
$teacher = $_SESSION['formData']['teacher'];


$sql1 = "SELECT * FROM `opvang`";
$result = $database->query($sql1);
$row = $result->fetch_assoc();

$sql = "INSERT INTO `opvang`(`ouder`, `kind`, `klas`, `leerkracht`, `phone`, `datum`) VALUES ('$parent','$child','$class','$teacher','$$phone')";


    if(isset($_SESSION['formData'])){
        $database->query($sql);
       session_destroy();

    }
    else {
        header("Location: index.php");

    }




echo $phone;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>
Uw Gegevens zijn Verstuurd: <br><br>
<table>
    <tr>
        Naam Ouder: <?=$parent . "<br>"?></tr>
    Naam Kind: <?=$child . "<br>"?>
    Klas: <?=$class . "<br>"?>
    Leerkracht: <?=$teacher . "<br>" ?>
    Telefoon nummmer: <?=$phone . "<br>"?>

</table>
</body>
</html>
