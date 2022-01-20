<?php
session_start();
if ($_SESSION['role'] == 'owner' or $_SESSION['login_status'] == false) {
    header('location: ../admin/home.php');
} else {

    if (isset($_POST)) {
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $jk = $_POST['jenis-kelamin'];
        $telepon = $_POST['telepon'];

        include '../koneksi.php';

        $query = sprintf("INSERT INTO member (nama, alamat, jenis_kelamin, telepon) VALUES ('%s', '%s', '%s', '%s')", $nama, $alamat, $jk, $telepon);

        if (mysqli_query($conn, $query)) {
            header('location: list_member.php');
        } else {
            echo sprintf("<script>alert('%s'); location.href='new_member.php';</script>", mysqli_error($conn));
        }
    }
}
