<?php
session_start();
if ($_SESSION['login_status'] == false) {
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
</head>

<body>
    <?php include "../components/navbar.php" ?>

    <h3>Users list</h3>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>nama</th>
                <th>username</th>
                <th>role</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../koneksi.php";

            $qry_siswa = mysqli_query($conn, "select * from user");

            $no = 0;
            while ($data_siswa = mysqli_fetch_array($qry_siswa)) {
                $no++; ?>
                <tr>
                    <td><?= $data_siswa['id'] ?></td>
                    <td><?= $data_siswa['nama'] ?></td>
                    <td><?= $data_siswa['username'] ?></td>
                    <td><?= $data_siswa['role'] ?></td>
                    <td><a href="ubah_siswa.php?id_siswa=<?= $data_siswa['id'] ?>" class="btn btn-success">Ubah</a> | <a href="hapus.php?id_siswa=<?= $data_siswa['id'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger">Hapus</a></td>

                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script defer src="../components/navbar.js"></script>
</body>

</html>