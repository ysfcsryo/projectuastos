<?php
$servername = "localhost";
$database = "projekuas";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("CONNECTION FAILED!: " . mysqli_connect_error());
}
