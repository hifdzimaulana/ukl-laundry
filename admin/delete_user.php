<?php
session_start();
if ($_SESSION['login_status'] == true and $_SESSION['role'] != 'admin') {

    include '../koneksi.php';
    $query = sprintf("DELETE FROM user WHERE id=%s", $_GET['id']);
    $result = mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        header('location: list_user.php');
    }
} else {
    header('location: home.php');
}
