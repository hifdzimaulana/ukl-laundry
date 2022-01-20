<?php
session_start();
if ($_SESSION['role'] == 'owner' or $_SESSION['login_status'] == false) {
    header('location: home.php');
}
include "../koneksi.php";
$member_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM member"));

$id = $_POST['id'];
$nama = $_POST['nama'] ? $_POST['nama'] : $member_data['nama'];
$alamat = $_POST['alamat'] ? $_POST['alamat'] : $member_data['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'] ? $_POST['jenis_kelamin'] : $member_data['jenis_kelamin'];
$telepon = $_POST['telepon'] ? $_POST['telepon'] : $member_data['telepon'];

$query = sprintf("UPDATE member SET nama='%s', alamat='%s', jenis_kelamin='%s', telepon='%s' WHERE id=%s", $nama, $alamat, $jenis_kelamin, $telepon, $id);
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

if ($result) {
    header('location: list_member.php');
} else {
    echo sprintf("<script>alert('Error: %s'); location.href='edit_member.php?id=%s';</script>", mysqli_error($conn), $id);
}
