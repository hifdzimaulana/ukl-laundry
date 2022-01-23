<?php
session_start();
if ($_SESSION['login_status'] == false) {
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">
    <script src="https://kit.fontawesome.com/9b9e64b4a5.js" crossorigin="anonymous"></script>

    <style>
        i {
            font-size: 3rem;
        }
    </style>
</head>

<body>
    <?php include "../components/navbar.php" ?>

    <?php
    require_once '../koneksi.php';
    $qry_revenues = mysqli_query($conn, "SELECT SUM(harga) FROM paket");
    $qry_orders = mysqli_query($conn, "SELECT COUNT(id) FROM transaksi");
    $qry_employees = mysqli_query($conn, "SELECT COUNT(id) FROM user WHERE NOT role='admin'");
    ?>

    <div style="max-width: 80%; margin: auto;">
        <h3>Dashboard</h3>

        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center bg-danger">
                                <i class="fas fa-chart-area text-light"></i>
                            </div>
                            <div class="col-8">
                                <p>Revenue</p>
                                <h5 id="revenue"><?= mysqli_fetch_array($qry_revenues)[0] ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center bg-warning">
                                <i class="las la-clipboard-list text-light"></i>
                            </div>
                            <div class="col-8">
                                <p>Orders</p>
                                <h5><?= mysqli_fetch_array($qry_orders)[0] ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-4 d-flex align-items-center bg-info">
                                <i class="las la-id-card text-light"></i>
                            </div>
                            <div class="col-8">
                                <p>Employees</p>
                                <h5><?= mysqli_fetch_array($qry_employees)[0] ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script defer src="../components/navbar.js"></script>

    <script>
        const formatRupiah = (money) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(money);
        }
        var revenue = document.getElementById('revenue');
        revenue.innerHTML = formatRupiah(revenue.innerHTML);
    </script>
</body>

</html>