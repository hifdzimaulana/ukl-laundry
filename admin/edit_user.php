<?php
session_start();
if ($_SESSION['login_status'] == false) {
    header('location: login.php');
}

include "../koneksi.php";
$qry_get_user = mysqli_query($conn, "select * from user where id = " . $_GET['id']);
$user_data = mysqli_fetch_array($qry_get_user);
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

    <div style="max-width: 780px; background-color: #EEEEEE; padding: 30px; margin: auto;">
        <h3>Edit user</h3>
        <form action="proses_edit_user.php" method="post">
            <input type="hidden" name="id" id="id" value="<?= $user_data['id'] ?>">

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