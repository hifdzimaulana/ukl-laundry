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
  <h3>Order form</h3>
  <form action="proses_order_form.php" method="post">
    <label for="jenis">Jenis</label>
    <select name="jenis" id="jenis" class="form-control">
      <option value=""></option>
      <option value="kiloan">Kiloan (Rp2.300/Kg)</option>
      <option value="selimut">Selimut (Rp3.100/Kg)</option>
      <option value="karpet">Karpet (Rp3.700/Kg)</option>
    </select>

    <label for="berat">Berat (kg)</label>
    <input type="number" id="berat" class="form-control" />
  </form>

  <h2>Harga</h2>
  <h2 id="harga">-</h2>

  <script>
    var formatter = new Intl.NumberFormat("en-US", {
      style: "currency",
      currency: "IDR",
    });
    var harga = document.getElementById("harga");
    var jenis = document.getElementById("jenis");
    var berat = document.getElementById("berat");

    berat.addEventListener("keyup", (ev) => {
      switch (jenis.value) {
        case "kiloan":
          harga.innerHTML = formatter.format(2300 * berat.value);
          break;
        case "selimut":
          harga.innerHTML = formatter.format(3100 * berat.value);
          break;
        case "karpet":
          harga.innerHTML = formatter.format(3700 * berat.value);
          break;
        default:
          harga.innerHTML = "-";
          break;
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle
        .min.js" integrity="sha384-
        gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>