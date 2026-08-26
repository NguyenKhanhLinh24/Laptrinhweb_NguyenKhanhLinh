<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "quan_ly_thu_vien";

$conn = new mysqli(
    $host,
    $user,
    $password,
    $database
);

if ($conn->connect_error) {
    die("Kết nối CSDL thất bại: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>