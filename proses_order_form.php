<?php
if ($_POST) {
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];

    if (empty($jenis) or empty($harga)) {
        echo "<script>alert('jenis atau harga tidak boleh kosong');location.href='order_form.php';</script>";
    }

    include "koneksi.php";
    $query = mysqli_query($conn, "insert into paket (jenis, harga) values ('" . $jenis . "', " . $harga . ")");
    echo ("sukses mengorder!");
}
