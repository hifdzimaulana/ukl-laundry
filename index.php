<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
</head>

<body>
    <div id="login" style="margin-top: 10%;">
        <h1 align='center' style='margin-bottom:20;'>Wash King Laundry</h1>
        <form method="POST" action="proses_login.php" style="margin-top: 40px;">
            <table cellpadding="10" cellspacing="10" style="margin: 0 auto;">
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><input type="text" name="username" value="" class="form-control" /></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="password" value="" class="form-control" /></td>
                </tr>
                <tr>
                    <td colspan="1" align="left"><a href="register_form.php">Registrasi</a></td>
                    <td></td>
                    <td colspan="1" align="right"><input type="submit" value="Masuk" class="btn btn-primary" /></td>
                </tr>
            </table>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>