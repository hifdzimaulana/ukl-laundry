<nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: 4px 4px 5px -4px">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Wash King</a>

    <button class="navbar-toggler" type="button" data-bs- toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav nav-pills justify-content-end">
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="home.php">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Transaksi</a>
        <ul class="dropdown-menu pull-right" style="right: 0; left: auto;">
          <li>
            <a href="list_transaksi.php" class="dropdown-item">List</a>
            <a href="new_transaksi.php" class="dropdown-item">Tambah</a>
          </li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">User</a>
        <ul class="dropdown-menu pull-right" style="right: 0; left: auto;">
          <li>
            <a href="list_user.php" class="dropdown-item">List</a>
            <a href="new_user.php" class="dropdown-item">Tambah</a>
          </li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Member</a>
        <ul class="dropdown-menu pull-right" style="right: 0; left: auto;">
          <li>
            <a href="list_member.php" class="dropdown-item">List</a>
            <a href="new_member.php" class="dropdown-item">Tambah</a>
          </li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION['username'] ?></a>
        <ul class="dropdown-menu pull-right" style="right: 0; left: auto;">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<div class="container bg-light rounded" style="margin-top: 10px"></div>