<?php
session_start();
if ($_SESSION['role'] == 'owner' or $_SESSION['login_status'] == false) {
    header('location: home.php');
} else {

    include '../koneksi.php';
    $query = sprintf("DELETE FROM member WHERE id=%s", $_GET['id']);
    $result = mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) > 0) {
        header('location: list_member.php');
    }
}
