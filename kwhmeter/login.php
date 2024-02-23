<?php include('layout/header.php') ?>
<?php include('layout/navbar_login.php') ?>

<div class="container col-md-6">

<h1 class="text-center mb-5">Silakan Login</h1>
  <div class="card border-0 shadow-sm p-5">
    <div class="card-body">

    <?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "username_salah") {
            echo "<div class='alert alert-danger' role='alert'>Username tidak ditemukan!</div>";
        } else if ($_GET['pesan'] == "password_salah") {
            echo "<div class='alert alert-danger' role='alert'>Password salah!</div>";
        }else if ($_GET['pesan'] == "logout") {
            echo "<div class='alert alert-success' role='alert'>Anda telah berhasil logout!</div>";
        }else if ($_GET['pesan'] == "belum_login") {
            echo "<div class='alert alert-danger' role='alert'>Anda harus login untuk mengakses halaman admin!</div>";
        }
    }
    ?>

      <form action="login_proses.php" method="POST">
        <div class="mb-3">
          <label class="form-label">Username</label>
            <input type="text" class="form-control p-3 border-0 bg-light" name="username" placeholder="Isi Username..." required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control p-3 border-0 bg-light" name="password" placeholder="Isi Password.." required>
        </div>
        <button type="submit" class="btn btn-primary bg-primary border-0 p-3 px-5">Login</button>
      </form>

    </div>
  </div>

</div>

<?php include('layout/footer.php') ?>