<?php
$servername = "localhost";
$database = "projekuastos";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("CONNECTION FAILED!: " . mysqli_connect_error());
}
