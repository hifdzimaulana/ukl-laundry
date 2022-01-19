<?php
session_start();
if ($_SESSION['role'] == 'kasir' or $_SESSION['login_status'] == false) {
    header('location: ../admin/home.php');
} else {

    $id_user = $_SESSION['id'];
    $id_member = $_POST['member'];
    $jenis = $_POST['jenis'];
    $berat = $_POST['berat'];
    $tanggal = $_POST['tanggal'];
    $batas_waktu = $_POST['batas-waktu'];
    $tanggal_bayar = $_POST['tanggal-bayar'];
    $bayar = $_POST['bayar'];
    $status_bayar = $tanggal_bayar ? 'menunggak' : 'lunas';

    include '../koneksi.php';

    $trx_query = sprintf("INSERT INTO transaksi (id_user, id_member, tanggal_transaksi, batas_waktu, tanggal_bayar, status, status_bayar) VALUES (%s, %s, '%s', '%s', '%s', 'baru', '%s')", $id_user, $id_member, $tanggal, $batas_waktu, $tanggal_bayar, $status_bayar);

    if (mysqli_query($conn, $trx_query)) {
    }
}
