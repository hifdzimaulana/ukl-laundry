<?php
session_start();
if ($_SESSION['login_status'] == false or $_SESSION['role'] != 'admin') {
    header('location: login.php');
}

require_once "../koneksi.php";

if ($_POST) {
    $id = $_GET['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];

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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
</head>

<body>

    <?php require_once('../components/navbar.php') ?>

    <?php
    $qry_get_user = mysqli_query($conn, "select * from user where id = " . $_GET['id']);
    $user_data = mysqli_fetch_array($qry_get_user);
    ?>

    <div style="max-width: 780px; background-color: #EEEEEE; padding: 30px; margin: auto;">
        <h3>Edit user</h3>
        <form action="edit_user.php?id=<?= $_GET['id'] ?>" method="post">

            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= $user_data['nama'] ?>" class="form-control">

            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?= $user_data['username'] ?>" class="form-control">

            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">

            <?php
            $arr_role = array('owner' => 'Owner', 'kasir' => 'Kasir', 'admin' => 'Admin');
            ?>

            <label for="role">Role</label>
            <select name="role" id="role" class="form-control">
                <option value=""></option>
                <?php foreach ($arr_role as $key_role => $val_role) :
                    if ($key_role == $user_data['role']) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                ?>

                    <option value="<?= $key_role ?>" <?= $selected ?>><?= $val_role ?></option>

                <?php endforeach ?>
            </select>

            <button type="submit" class="btn btn-success mt-4">Submit</button>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>