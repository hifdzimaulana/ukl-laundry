<?php
session_start();
if ($_SESSION['login_status'] == false or $_SESSION['role'] != 'admin') {
    header('location: ../admin/home.php');
} else {
    require_once "../koneksi.php";
    $res = mysqli_query($conn, "SELECT * FROM outlet");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | List outlet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
</head>

<body>

    <?php include "../components/navbar.php" ?>

    <h3>List outlet</h3>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php

            $no = 0;
            while ($outlet_data = mysqli_fetch_array($res)) {
                $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $outlet_data['nama'] ?></td>
                    <td><?= $outlet_data['alamat'] ?></td>
                    <td><?= $outlet_data['telepon'] ?></td>
                    <td><a href="edit_outlet.php?id=<?= $outlet_data['id'] ?>" class="btn btn-success">Ubah</a> | <a href="delete_outlet.php?id=<?= $outlet_data['id'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger">Hapus</a></td>

                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>