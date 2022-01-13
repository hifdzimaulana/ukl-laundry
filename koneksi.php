<?php
$username = "root";
$password = "";
$host = "localhost";
$database = "laundry";

$conn = mysqli_connect($host, $username, $password, $database);
if (mysqli_errno($conn)) {
    echo (mysqli_error($conn));
}
