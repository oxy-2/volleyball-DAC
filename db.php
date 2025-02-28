<?php

$servername = "localhost";
$username = "projetoDAC";
$password = "torneio123";
$dbname = "torneio_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

?>