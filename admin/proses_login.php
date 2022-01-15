<?php
if (isset($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) or empty($password)) {
        echo "<script>alert('Username/password tidak boleh kosong!'); location.href='login.php';</script>";
    }

    include "../koneksi.php";
    $result = mysqli_query($conn, "select id, nama, role from user where username='" . $username . "' and password='" . md5($password) . "'");
    $login_data = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if (mysqli_num_rows($result) == 0) {
        echo "<script>alert('Username/password salah!'); location.href='login.php';</script>";
    }

    session_start();

    $_SESSION['id'] = $login_data['id'];
    $_SESSION['nama'] = $login_data['nama'];
    $_SESSION['role'] = $login_data['role'];
    $_SESSION['username'] = $username;
    $_SESSION['login_status'] = true;

    header("location: home.php");
}
