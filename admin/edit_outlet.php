<?php
session_start();
if ($_SESSION['login_status'] == false or $_SESSION['role'] != 'admin') {
    header('location: home.php');
}

if ($_POST) {
    require_once "../koneksi.php";
    $outlet_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM outlet"));

    $id = $_POST['id'];
    $nama = $_POST['nama'] ? $_POST['nama'] : $outlet_data['nama'];
    $alamat = $_POST['alamat'] ? $_POST['alamat'] : $outlet_data['alamat'];
    $telepon = $_POST['telepon'] ? $_POST['telepon'] : $outlet_data['telepon'];

    $query = sprintf("UPDATE outlet SET nama='%s', alamat='%s', telepon='%s' WHERE id=%s", $nama, $alamat, $telepon, $id);
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if ($result) {
        header('location: list_outlet.php');
    } else {
        echo sprintf("<script>alert('Error: %s'); location.href='list_outlet.php';</script>", mysqli_error($conn), $id);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Edit outlet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
</head>

<body>
    <?php include '../components/navbar.php' ?>

    <?php
    require_once '../koneksi.php';
    $result = mysqli_query($conn, sprintf("SELECT * FROM outlet WHERE id=%s", $_GET['id']));
    $member_data = mysqli_fetch_array($result);
    ?>

    <div style="max-width: 780px; background-color: #EEEEEE; padding: 30px; margin: auto;">
        <h3>Edit user</h3>
        <form action="edit_outlet.php" method="post">
            <input type="hidden" name="id" id="id" value="<?= $member_data['id'] ?>">

            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= $member_data['nama'] ?>" class="form-control">

            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"><?= $member_data['alamat'] ?></textarea>

            <label for="telepon">Telepon</label>
            <input type="number" name="telepon" id="telepon" class="form-control" value="<?= $member_data['telepon'] ?>">

            <center><button type="submit" class="btn btn-success mt-4">Submit</button></center>

        </form>
    </div>

    <script src="../components/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>