<?php
session_start();
if ($_SESSION['login_status'] == false or $_SESSION['role'] != 'admin') {
    header('location: ../admin/home.php');
}

require_once "../koneksi.php";

if ($_POST) {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    $query = sprintf("INSERT INTO outlet (nama, alamat, telepon) VALUES ('%s', '%s', %s)", $nama, $alamat, $telepon);

    if (mysqli_query($conn, $query)) {
        header('location: list_outlet.php');
    } else {
        echo "<script>alert('Gagal menambahkan outlet!'); location.href = 'new_outlet.php';</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laundry | New outlet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
</head>

<body>
    <?php include "../components/navbar.php" ?>
    <div style="max-width: 780px; background-color: #EEEEEE; padding: 30px; margin: auto;">
        <form action="new_outlet.php" method="post">
            <h1>Create outlet</h1>
            <div class="row" style="margin-top: 15px;">
                <div class="col">
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama">
                </div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col">
                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control" placeholder="Alamat"></textarea>
                </div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col">
                    <input type="number" name="telepon" id="telepon" class="form-control" placeholder="Telepon">
                </div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <button type="submit" class="btn btn-success">Register</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="../components/navbar.js"></script>
</body>

</html>