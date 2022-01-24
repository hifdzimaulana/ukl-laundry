<?php
session_start();
if ($_SESSION['role'] == 'owner' or $_SESSION['login_status'] == false) {
    header('location: ../admin/home.php');
}
require_once '../koneksi.php';

if ($_POST) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jenis-kelamin'];
    $telepon = $_POST['telepon'];

    $query = sprintf("INSERT INTO member (nama, alamat, jenis_kelamin, telepon) VALUES ('%s', '%s', '%s', '%s')", $nama, $alamat, $jk, $telepon);

    if (mysqli_query($conn, $query)) {
        header('location: list_member.php');
    } else {
        echo sprintf("<script>alert('%s'); location.href='new_member.php';</script>", mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laundry | New member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
</head>

<body>
    <?php include "../components/navbar.php" ?>
    <div style="max-width: 780px; background-color: #EEEEEE; padding: 30px; margin: auto;">
        <form action="new_member.php" method="post">
            <h1>Create member</h1>
            <div class="row" style="margin-top: 15px;">
                <div class="col">
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama lengkap">
                </div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col">
                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control" placeholder="Alamat"></textarea>
                </div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis-kelamin" id="jenis-kelamin" value="l">
                        <label class="form-check-label" for="inlineRadio1">Pria</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis-kelamin" id="jenis-kelamin" value="p">
                        <label class="form-check-label" for="inlineRadio2">Wanita</label>
                    </div>
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