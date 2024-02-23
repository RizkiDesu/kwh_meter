<nav class="navbar navbar-expand-lg navbar-dark bg-gradient mb-5 py-3">
  <div class="container">
    <a class="navbar-brand" href="index.php"><i class="bi bi-lightning-charge-fill"></i> KWH Meter</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active px-3" aria-current="page" href="index.php"><i class="bi bi-house-door-fill"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active px-3" aria-current="page" href="data.php"><i class="bi bi-file-bar-graph-fill"></i> Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active px-3" aria-current="page" href="grafik.php"><i class="bi bi-graph-up-arrow"></i> Grafik</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active px-3" aria-current="page" href="pengaturan.php"><i class="bi bi-gear-fill"></i> Pengaturan</a>
        </li>
      </ul>
      <form class="d-flex" action="logout.php">
        <button class="btn btn-dark" type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
      </form>
    </div>
  </div>
</nav>