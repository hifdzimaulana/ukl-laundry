<?php
session_start();
if ($_SESSION['role'] == 'owner' or $_SESSION['login_status'] == false) {
    header('location: home.php');
}

require_once '../koneksi.php';

if ($_POST) {
    $member_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM member"));

    $nama = $_POST['nama'] ? $_POST['nama'] : $member_data['nama'];
    $alamat = $_POST['alamat'] ? $_POST['alamat'] : $member_data['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'] ? $_POST['jenis_kelamin'] : $member_data['jenis_kelamin'];
    $telepon = $_POST['telepon'] ? $_POST['telepon'] : $member_data['telepon'];

    $query = sprintf("UPDATE member SET nama='%s', alamat='%s', jenis_kelamin='%s', telepon='%s' WHERE id=%s", $nama, $alamat, $jenis_kelamin, $telepon, $_GET['id']);
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if ($result) {
        header('location: list_member.php');
    } else {
        echo sprintf("<script>alert('Error: %s'); location.href='edit_member.php?id=%s';</script>", mysqli_error($conn), $id);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Edit member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
</head>

<body>
    <?php include '../components/navbar.php' ?>

    <?php
    $query = sprintf("SELECT * FROM member WHERE id=%s", $_GET['id']);
    $result = mysqli_query($conn, $query);
    $member_data = mysqli_fetch_array($result);
    ?>

    <div style="max-width: 780px; background-color: #EEEEEE; padding: 30px; margin: auto;">
        <h3>Edit user</h3>
        <form action="edit_member.php?id=<?= $member_data['id'] ?>" method="post">

            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= $member_data['nama'] ?>" class="form-control">

            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"><?= $member_data['alamat'] ?></textarea>

            <?php
            $arr_jk = array('l' => 'Pria', 'p' => 'Wanita');
            ?>

            <label for="jenis_kelamin">Jenis kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                <option value=""></option>
                <?php foreach ($arr_jk as $key_jk => $val_jk) :
                    if ($key_jk == $member_data['jenis_kelamin']) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                ?>

                    <option value="<?= $key_jk ?>" <?= $selected ?>><?= $val_jk ?></option>

                <?php endforeach ?>
            </select>

            <label for="telepon">Telepon</label>
            <input name="telepon" id="telepon" type="number" class="form-control" value="<?= $member_data['telepon'] ?>">

            <center><button type="submit" class="btn btn-success mt-4">Submit</button></center>

        </form>
    </div>

    <script src="../components/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>