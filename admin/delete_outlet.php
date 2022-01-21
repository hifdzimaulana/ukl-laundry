<?php
session_start();
if ($_SESSION['login_status'] == false or $_SESSION['role'] != 'admin') {
    header('location: home.php');
} else {

    require_once '../koneksi.php';
    $query = sprintf("DELETE FROM outlet WHERE id=%s", $_GET['id']);
    $result = mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        header('location: list_outlet.php');
    }
}
