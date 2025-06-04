<?php

$servername = "projekte.tgm.ac.at";
$username = "";
$password = "";


try {
    $pdo = new PDO("mysql:host=$servername;dbname=db3dHIT_s6", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
