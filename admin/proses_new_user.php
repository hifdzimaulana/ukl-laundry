<?php
if (isset($_POST)) {
    $fullname = $_POST['first_name'] . " " . $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = null;

    if ($_POST['role'] == 'owner') $role = 'owner';
    else $role = 'kasir';

    if (empty($fullname) or empty($username) or empty($password) or empty($role)) {
        echo "<script>alert('Form wajib terisi penuh!'); location.href = 'new_user.php';</script>";
    }

    include '../koneksi.php';
    $username_query = mysqli_query($conn, "select * from user where username='" . $username . "'");

    if (mysqli_num_rows($username_query) == 0) {
        $add_user_query = mysqli_query($conn, sprintf("INSERT INTO user (nama, username, password, role) VALUES ('%s', '%s', '%s', '%s')", $fullname, $username, md5($password), $role));
        header('location: users_list.php');
    } else {
        echo "<script>alert('Username sudah digunakan!'); location.href = 'new_user.php';</script>";
    }
}
