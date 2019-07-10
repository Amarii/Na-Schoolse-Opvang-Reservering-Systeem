<?php

$database = new mysqli("localhost", "0933602", "eveephoo", "0933602");

if($database->connect_error) {
    die("connecction error:" . $database->connect_error);

}
