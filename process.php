<?php

$name = $_POST['name'];


require "connect.php";

$sql = "SELECT * FROM `users` WHERE `$name` = 'yes'";

$result = $database->query($sql);
$array = $result->fetch_assoc();


?>
<div id="container" style="padding-left: 10vw; padding-right: 10vw">
<div id="row">
    <div class="col s12">
        <h4>Dag Schema</h4>
<table class="bordered highlight " style="width: 100%">
            <thead>

<tr>
            <th>Naam kind</th>
            <th>Telefoon</th>
            <th>Klas</th>
            <th>Leerkracht</th>
            <th>Details</th>
</tr>
            </thead>
    <tbody>
            <?php foreach ($result as $i => $row   ) { ?>
    <tr>
        <td><?= $row['child']; ?></td>
        <td><?= $row['phone']; ?></td>
        <td><?= $row['class']; ?></td>
        <td><?= $row['teacher']; ?></td>
        <td><?= $row['details']; ?></td>
    </tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>