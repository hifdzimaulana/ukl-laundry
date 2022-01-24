<?php
session_start();
if ($_SESSION['login_status'] == false) {
    header('location: home.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
</head>

<body>
    <?php include "../components/navbar.php" ?>

    <h3>List transaksi</h3>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Berat(Kg)</th>
                <th>Tanggal</th>
                <th>Status paket</th>
                <th>Status bayar</th>
                <th>Total bayar</th>
                <th>Operator</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../koneksi.php";

            $qry_trx = mysqli_query($conn, "SELECT m.nama, p.jenis, d_trx.qty, trx.tanggal_transaksi, trx.status, trx.status_bayar, trx.id, p.harga, u.username as operator FROM transaksi trx INNER JOIN detail_transaksi d_trx ON d_trx.id_transaksi = trx.id INNER JOIN user u ON trx.id_user = u.id INNER JOIN member m ON trx.id_member = m.id INNER JOIN paket p ON d_trx.id_paket = p.id;");

            $no = 0;
            while ($trx_data = mysqli_fetch_array($qry_trx)) {
                $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $trx_data['nama'] ?></td>
                    <td><?= $trx_data['jenis'] ?></td>
                    <td><?= $trx_data['qty'] ?></td>
                    <td><?= $trx_data['tanggal_transaksi'] ?></td>
                    <td class="text-uppercase"><?= $trx_data['status'] ?></td>
                    <td class="text-uppercase"><?= $trx_data['status_bayar'] ?></td>
                    <td><?= $trx_data['harga'] ?></td>
                    <td><?= $trx_data['operator'] ?></td>
                    <td><a href="edit_transaksi.php?trx_id=<?= $trx_data['id'] ?>" class="btn btn-warning">Update</a></td>
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