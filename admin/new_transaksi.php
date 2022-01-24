<?php
session_start();
if ($_SESSION['login_status'] == false) {
  header('location: ../admin/home.php');
} else {
  require_once '../koneksi.php';
  require_once './_utils.php';

  if ($_POST) {
    if (is_array_value_empty($_POST)) {
      echo "<script>alert('Form wajib terisi penuh!'); location.href='new_transaksi.php';</script>";
    } else {
      $id_user = $_SESSION['id'];
      $id_member = $_POST['member'];
      $jenis = $_POST['jenis'];
      $berat = $_POST['berat'];
      $tanggal = $_POST['tanggal'];
      $batas_waktu = $_POST['batas-waktu'];
      $tanggal_bayar = $_POST['tanggal-bayar'];
      $bayar_post = $_POST['bayar'];
      $status_bayar = $tanggal_bayar ? 'lunas' : 'menunggak';

      require_once '../koneksi.php';

      $trx_qry = mysqli_query($conn, sprintf("INSERT INTO transaksi (id_user, id_member, tanggal_transaksi, batas_waktu, tanggal_bayar, status, status_bayar) VALUES (%s, %s, '%s', '%s', '%s', 'baru', '%s')", $id_user, $id_member, $tanggal, $batas_waktu, $tanggal_bayar, $status_bayar));


      $last_id_trx = mysqli_insert_id($conn);
      if (!mysqli_error($conn)) {
        for ($i = 0; $i < count($jenis); $i++) {
          $bayar = calculate_bayar($jenis[$i], $berat[$i]);

          $paket_query = sprintf("INSERT INTO paket (jenis, harga) VALUES ('%s', %s)", $jenis[$i], $bayar);

          if (mysqli_query($conn, $paket_query)) {
            $last_id_paket = mysqli_insert_id($conn);

            $trx_detail_query = sprintf("INSERT INTO detail_transaksi (id_transaksi, id_paket, qty) VALUES (%s, %s, %s)", $last_id_trx, $last_id_paket, $berat[$i]);

            echo $trx_detail_query . "<br>";

            if (mysqli_query($conn, $trx_detail_query)) {
              header('location: list_transaksi.php');
            }
          }
        }
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laundry | Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
</head>

<body>
  <?php include "../components/navbar.php" ?>

  <div style="max-width: 560px; margin: 3rem auto; background-color: #eeeeee; padding: 20px;">
    <div>
      <h3>Tambah Transaksi</h1>
        <form action="new_transaksi.php" method="GET">
          <div class="row">
            <label for="paket-count-input" class="col-form-label col-sm-3">Jumlah pesanan</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" id="paket-count-input" name="paket_count" value="<?= isset($_GET['paket_count']) ? $_GET['paket_count'] : 1 ?>">
            </div>
            <button type="submit" class="btn btn-primary col-sm-1">&#x21bb;</button>
          </div>
        </form>
    </div>
    <h3>Transaksi baru</h3>
    <form action="new_transaksi.php" method="post">

      <label for="member" class="form-label">Member</label>
      <select name="member" id="member" class="form-control">
        <option value=""></option>
        <?php
        $query = mysqli_query($conn, "SELECT * FROM member");
        while ($row = mysqli_fetch_array($query)) {
        ?>
          <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
        <?php
        }
        ?>
      </select>

      <label for="tanggal" class="form-label">Tanggal</label>
      <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>">

      <label for="batas-waktu" class="form-label">Batas waktu</label>
      <input type="date" name="batas-waktu" id="batas-waktu" class="form-control">

      <label for="tanggal-bayar" class="form-label">Tanggal pembayaran</label>
      <input type="date" name="tanggal-bayar" id="tanggal-bayar" class="form-control">


      <br>
      <?php for ($i = 0; $i < (isset($_GET['paket_count']) ? $_GET['paket_count'] : 1); $i++) : ?>
        <div class="row mb-3">
          <div class="col-sm-5">
            <select name="jenis[]" class="form-control jenis">
              <option value="">Jenis</option>
              <option value="kiloan">Kiloan (Rp2.300/Kg)</option>
              <option value="selimut">Selimut (Rp3.100/Kg)</option>
              <option value="karpet">Karpet (Rp3.700/Kg)</option>
            </select>
          </div>
          <div class="col-sm-5">
            <input type="number" class="form-control berat" name="berat[]" min="0.5" step="0.5" max="100" placeholder="Qty">
          </div>
        </div>
      <?php endfor; ?>

      <div class="div-total-bayar mt-4">
        <h3>Total bayar</h3>
        <div class="form-group row">
          <label for="bayar" class="col-sm-1 col-form-label" style="font-size: 1.5rem;">Rp</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" name="bayar" id="bayar" value="" style="font-size: 1.5rem;">
          </div>
        </div>
      </div>

      <div id="iyh-bang"></div>

      <center><button type="submit" class="btn btn-success">Submit</button></center>
    </form>

  </div>

  <script>
    // Calculating the bill
    var bayar = document.getElementById("bayar");
    var jenis = document.getElementsByClassName("jenis");
    var berat = document.getElementsByClassName("berat");

    for (const item of jenis) {
      item.addEventListener('input', event => {
        calculate()
      })
    }

    for (const item of berat) {
      item.addEventListener('input', event => {
        calculate()
      })
    }

    function calculate() {
      let total = 0;

      for (let i = 0; i < jenis.length; i++) {
        switch (jenis[i].value) {
          case "kiloan":
            total += 2300 * berat[i].value;
            break;
          case "selimut":
            total += 3100 * berat[i].value;
            break;
          case "karpet":
            total += 3700 * berat[i].value;
            break;
          default:
            total += 0;
            break;
        }
      }

      bayar.value = total;
    }
  </script>
  <script src="../components/navbar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>