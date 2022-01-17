<?php
session_start();
if ($_SESSION['login_status'] == false) {
    header('location: login.php');
} else if ($_SESSION['role'] != 'admin') {
    header('location: home.php');
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
</head>

<body>
    <?php include "../components/navbar.php" ?>
    <div style="max-width: 780px; background-color: #EEEEEE; padding: 30px; margin: auto;">
        <form action="proses_new_user.php" method="post">
            <h1>Create new user</h1>
            <div class="row" style="margin-top: 15px;">
                <div class="col">
                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name">
                </div>
                <div class="col">
                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name">
                </div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="username" id="username">
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="owner" id="owner" value="true">
                        <label class="form-check-label" for="inlineRadio1">Owner</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="kasir" id="kasir" value="true">
                        <label class="form-check-label" for="inlineRadio2">Kasir</label>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 15px;">
                <button type="submit" class="btn btn-success">Register</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="../components/navbar.js"></script>
</body>

</html>