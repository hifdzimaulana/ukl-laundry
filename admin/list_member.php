<?php
session_start();
if ($_SESSION['role'] == 'owner' or $_SESSION['login_status'] == false) {
    header('location: ../admin/home.php');
} else {
    include '../koneksi.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | List member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
</head>

<body>
    <?php include "../components/navbar.php" ?>

    <h3>List member</h3>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis kelamin</th>
                <th>Telepon</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../koneksi.php";

            $qry_users = mysqli_query($conn, "select * from member");

            $no = 0;
            while ($user_data = mysqli_fetch_array($qry_users)) {
                $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $user_data['nama'] ?></td>
                    <td><?= $user_data['alamat'] ?></td>
                    <td><?= $user_data['jenis_kelamin'] ?></td>
                    <td><?= $user_data['telepon'] ?></td>
                    <td><a href="edit_member.php?id=<?= $user_data['id'] ?>" class="btn btn-success">Ubah</a> | <a href="delete_member.php?id=<?= $user_data['id'] ?>" onclick="return confirm('Apakah anda yakin menghapus member ini?')" class="btn btn-danger">Hapus</a></td>

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