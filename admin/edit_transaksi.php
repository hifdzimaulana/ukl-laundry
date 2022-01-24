<?php
session_start();
if ($_SESSION['login_status'] == false) {
    header('location: home.php');
}

require_once "../koneksi.php";

if ($_POST) {
    $qry = sprintf("UPDATE transaksi SET status='%s', status_bayar='%s' WHERE id=%s", $_POST['status'], $_POST['status_bayar'], $_GET['trx_id']);

    if (mysqli_query($conn, $qry)) {
        header('location: list_transaksi.php');
    } else {
        echo sprintf("<script>alert('Error: %s'); location.href='edit_transaksi.php?trx_id=%s';</script>", mysqli_error($conn), $_GET['trx_id']);
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


    <?php
    require "../components/navbar.php";

    $query = sprintf("SELECT m.nama, p.jenis, d_trx.qty, trx.tanggal_transaksi, trx.status, trx.status_bayar, trx.id, p.harga, u.username as operator FROM transaksi trx INNER JOIN detail_transaksi d_trx ON d_trx.id_transaksi = trx.id INNER JOIN user u ON trx.id_user = u.id INNER JOIN member m ON trx.id_member = m.id INNER JOIN paket p ON d_trx.id_paket = p.id WHERE trx.id=%s", $_GET['trx_id']);

    $result = mysqli_fetch_array(mysqli_query($conn, $query));
    ?>

    <div style="max-width: 780px; background-color: #EEEEEE; padding: 30px; margin: auto;">
        <h3>Update status transaksi</h3>
        <form action="edit_transaksi.php?trx_id=<?= $_GET['trx_id'] ?>" method="post">

            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= $result['nama'] ?>" class="form-control" disabled>

            <label for="jenis">Jenis</label>
            <input type="text" name="jenis" id="jenis" value="<?= $result['jenis'] ?>" class="form-control" disabled>

            <label for="qty">Qty</label>
            <input type="text" name="qty" id="qty" value="<?= $result['qty'] ?>" class="form-control" disabled>

            <label for="tanggal_transaksi">Tanggal transaksi</label>
            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" value="<?= $result['tanggal_transaksi'] ?>" class="form-control" disabled>

            <!--  -->

            <?php
            $arr_status = array('baru' => 'Baru', 'diproses' => 'Diproses', 'selesai' => 'Selesai', 'diambil' => 'Diambil');
            ?>
            <label for="status">Status paket</label>
            <select name="status" id="status" class="form-control">
                <?php foreach ($arr_status as $key_status => $val_status) :
                    if ($key_status == $result['status']) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                ?>

                    <option value="<?= $key_status ?>" <?= $selected ?>><?= $val_status ?></option>

                <?php endforeach ?>
            </select>

            <?php
            $arr_bayar = array('lunas' => 'Lunas', 'menunggak' => 'Menunggak');
            ?>
            <label for="status_bayar">Status pembayaran</label>
            <select name="status_bayar" id="status_bayar" class="form-control">
                <?php foreach ($arr_bayar as $key_bayar => $val_bayar) :
                    if ($key_bayar == $result['status_bayar']) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                ?>

                    <option value="<?= $key_bayar ?>" <?= $selected ?>><?= $val_bayar ?></option>

                <?php endforeach ?>
            </select>

            <!-- -->

            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga" value="<?= $result['harga'] ?>" class="form-control" disabled>

            <label for="operator">Operator</label>
            <input type="text" name="operator" id="operator" value="<?= $result['operator'] ?>" class="form-control" disabled>

            <center><button type="submit" class="btn btn-success mt-4">Update</button></center>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>