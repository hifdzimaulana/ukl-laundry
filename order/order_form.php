<?php
session_start();
if ($_SESSION['role'] == 'kasir' or $_SESSION['login_status'] == false) {
  header('location: ../admin/home.php');
} else {
  include '../koneksi.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laundry | Order Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
</head>

<body>

  <div style="max-width: 560px; margin: 5rem auto;">
    <h3>Order form</h3>
    <form action="proses_order_form.php" method="post">

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

      <label for="jenis" class="form-label">Jenis</label>
      <select name="jenis" id="jenis" class="form-control">
        <option value=""></option>
        <option value="kiloan">Kiloan (Rp2.300/Kg)</option>
        <option value="selimut">Selimut (Rp3.100/Kg)</option>
        <option value="karpet">Karpet (Rp3.700/Kg)</option>
      </select>

      <label for="berat" class="form-label">Berat (kg)</label>
      <input type="number" name="berat" id="berat" class="form-control" min="0.5" step="0.5" max="100" />

      <label for="tanggal" class="form-label">Tanggal</label>
      <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>">

      <label for="batas-waktu" class="form-label">Batas waktu</label>
      <input type="date" name="batas-waktu" id="batas-waktu" class="form-control">

      <label for="tanggal-bayar" class="form-label">Tanggal pembayaran</label>
      <input type="date" name="tanggal-bayar" id="tanggal-bayar" class="form-control">

      <div class="div-total-bayar mt-4">
        <h3>Total bayar</h3>
        <input type="text" readonly class="form-control-plaintext" name="bayar" id="bayar" value="-" style="font-size: 1.5rem;">
        <!-- <h2 id="harga">-</h2> -->
      </div>

      <center><button type="submit" class="btn btn-success">Submit</button></center>
    </form>

  </div>

  <script>
    // Calculating the bill
    var formatter = new Intl.NumberFormat("en-US", {
      style: "currency",
      currency: "IDR",
    });
    var bayar = document.getElementById("bayar");
    var jenis = document.getElementById("jenis");
    var berat = document.getElementById("berat");

    function setBayarValue(ev) {
      switch (jenis.value) {
        case "kiloan":
          bayar.value = formatter.format(2300 * berat.value);
          break;
        case "selimut":
          bayar.value = formatter.format(3100 * berat.value);
          break;
        case "karpet":
          bayar.value = formatter.format(3700 * berat.value);
          break;
        default:
          bayar.value = "-";
          break;
      }
    }

    berat.addEventListener("input", setBayarValue);
    jenis.addEventListener("input", setBayarValue);
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>