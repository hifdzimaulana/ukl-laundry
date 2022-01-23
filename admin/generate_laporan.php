<?php
require_once "../koneksi.php";

function extract_as_table_data($data, $converters = null)
{
    foreach ($data as $key => $value) {
        if ($key === "id") continue;

        $content = isset($converters[$key]) ? $converters[$key]($value) : ucwords(str_replace("_", "", $value));
?>
        <td><?= $content ?></td>
    <?php
    }
}

function report_table($mysqli_result, $converters = null)
{
    ?>
    <table class="table table-striped table-borderless mt-3">
        <thead>
            <tr>
                <th> # </th>
                <?php foreach (mysqli_fetch_fields($mysqli_result) as $field) : if ($field->name === "id") continue; ?>
                    <th scope="col"> <?= ucwords(str_replace("_", " ", $field->name)) ?> </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 0;

            while ($data = mysqli_fetch_assoc($mysqli_result)) {
                ++$no;
            ?>
                <tr>
                    <th scope="row"><?= $no ?></th>
                    <?php extract_as_table_data($data, $converters); ?>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry | Generate laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
</head>

<body>
    <main class="container py-5">
        <div class="row">
            <div class="col">
                <h1>Laporan King Wash</h1>
                <?php
                $query_transaksi = mysqli_query($conn, "SELECT t.id, m.nama as nama_member, t.tanggal_transaksi, t.status, t.status_bayar, u.nama as operator, p.jenis, p.harga * d_t.qty as harga FROM transaksi t, detail_transaksi d_t, paket p, member m, user u WHERE t.id_member = m.id AND t.id_user = u.id AND t.id = d_t.id_transaksi AND p.id = d_t.id_paket");
                $query_member = mysqli_query($conn, "SELECT * FROM `member`");
                $query_outlet = mysqli_query($conn, "SELECT * FROM `outlet`");
                $query_paket = mysqli_query($conn, "SELECT * FROM `paket`");

                echo "<h2 class='mt-3'>Transaksi</h2>";
                report_table($query_transaksi);
                echo "<div style='page-break-after: always;'></div>";

                echo "<h2 class='mt-3'>Member</h2>";
                report_table($query_member);
                echo "<div style='page-break-after: always;'></div>";

                echo "<h2 class='mt-3'>Outlet</h2>";
                report_table($query_outlet);
                echo "<div style='page-break-after: always;'></div>";

                echo "<h2 class='mt-3'>Paket</h2>";
                report_table($query_paket);
                echo "<div style='page-break-after: always;'></div>";
                ?>

            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <script defer>
        window.print()
        window.onafterprint = (event) => {
            location.assign('home.php')
        }
    </script>
</body>

</html>