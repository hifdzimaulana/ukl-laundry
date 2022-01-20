<?php
session_start();
if ($_SESSION['login_status'] == true and $_SESSION['role'] == 'admin') {

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

    include "../koneksi.php";

    $username_qry = mysqli_query($conn, sprintf("SELECT * FROM user WHERE username='%s'", $username));
    if (mysqli_num_rows($username_qry) != 0) {
        echo sprintf("<script>alert('Username sudah digunakan!'); location.href='edit_user.php?id=%s';", $id);
    }

    $query = null;

    if (empty($nama) or empty($username) or empty($password) or empty($role)) {
        $query = sprintf("UPDATE user SET nama='%s', username='%s' WHERE id=%s", $nama, $username, $id);
    } else {
        $query = sprintf("UPDATE user SET nama='%s', username='%s', password='%s', role='%s' WHERE id=%s", $nama, $username, $password, $role, $id);
    }

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if ($result) {
        header('location: list_user.php');
    } else {
        echo sprintf("<script>alert('Error: %s'); location.href='edit_user.php?id=%s';</script>", mysqli_error($conn), $id);
    }
} else {
    header('location: home.php;');
}
