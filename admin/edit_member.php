<?php
session_start();
if ($_SESSION['role'] == 'owner' or $_SESSION['login_status'] == false) {
    header('location: home.php');
}

include '../koneksi.php';
$query = sprintf("SELECT * FROM member WHERE id=%s", $_GET['id']);
$result = mysqli_query($conn, $query);
$member_data = mysqli_fetch_array($result);
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

    <div style="max-width: 780px; background-color: #EEEEEE; padding: 30px; margin: auto;">
        <h3>Edit user</h3>
        <form action="proses_edit_member.php" method="post">
            <input type="hidden" name="id" id="id" value="<?= $member_data['id'] ?>">

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
            <input type="number" class="form-control" value="<?= $member_data['telepon'] ?>">

            <center><button type="submit" class="btn btn-success mt-4">Submit</button></center>

        </form>
    </div>

    <script src="../components/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>