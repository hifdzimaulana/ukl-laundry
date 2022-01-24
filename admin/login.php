<?php
if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) or empty($password)) {
        echo "<script>alert('Username/password tidak boleh kosong!'); location.href='login.php';</script>";
    }

    include "../koneksi.php";
    $result = mysqli_query($conn, "select id, nama, role from user where username='" . $username . "' and password='" . md5($password) . "'");
    $login_data = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if (mysqli_num_rows($result) == 0) {
        echo "<script>alert('Username/password salah!'); location.href='login.php';</script>";
    } else {
        session_start();

        $_SESSION['id'] = $login_data['id'];
        $_SESSION['nama'] = $login_data['nama'];
        $_SESSION['role'] = $login_data['role'];
        $_SESSION['username'] = $username;
        $_SESSION['login_status'] = true;

        header("location: home.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6 text-black">

                    <div class="px-5 ms-xl-4">
                        <span class="h1 fw-bold mb-0">Wash King</span>
                    </div>

                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

                        <form style="width: 23rem;" method="POST" action="login.php">

                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                            <div class="form-outline mb-4">
                                <input type="username" id="username" name="username" class="form-control form-control-lg" />
                                <label class="form-label" for="username">Username</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                <label class="form-label" for="password">Password</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                            </div>

                        </form>

                    </div>

                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="http://www.usahalaundry.co.id/wp-content/uploads/2017/07/laundry.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>