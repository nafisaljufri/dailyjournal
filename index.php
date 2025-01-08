<?php
include "koneksi.php"; 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adidas</title>
    <link rel="icon" href="image/adidas-logo.png"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <style>
        .nav-item a:hover {
        border-bottom: 3px solid black;
        padding-bottom: 0cm;
        }
  </style>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- nav begin -->
    <nav>

    </nav>
    <!-- nav end -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="image/adidaslogo.jpg" width="280">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0 text-dark">
              <li class="nav-item ms-5">
                <a class="nav-link" aria-current="page" href="#"><b>HOME</b></a>
              </li>
              <li class="nav-item ms-5">
                <a class="nav-link" href="#article"><b>ARTICLE</b></a>
              </li>
              <li class="nav-item ms-5">
                <a class="nav-link" href="#gallery"><b>GALLERY</b></a>
              </li>
              <li class="nav-item1 ms-5 dropdown">
                <a class="nav-link dropdown-toggle" href="#gallery" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <b>PROMO</b>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#gallery">Pria</a></li>
                  <li><a class="dropdown-item" href="#article">Wanita</a></li>
                  <li><br class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#gallery" style="font-size: x-small;"><b>Lihat Lainnya</b></b></a></li>
                </ul>
              </li>
              <li class="nav-item ms-5">
                <a class="nav-link" href="login.php" target"_blank"><b>LOGIN</b></a>
              </li>
              <li class="nav-item ms-5">
                <a class="nav-link" href="logout.php" target"_blank"><b>LOGOUT</b></a>
              </li>
            </ul>
            <form class="d-flex m-2" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-dark" type="submit">Search</button>
            </form>
            <div class="darkmode d-flex">
              <div>
              <button id="darkbutton" type="button" class="btn btn-dark m-1">
                <i class="bi bi-moon-fill"></i>
              </button>
            </div>
            <div>
              <button id="lightbutton" type="button" class="btn btn-outline-dark m-1">
                <i class="bi bi-brightness-high-fill"></i>
              </button>
            </div>
          </div>
        </div>
        </div>
      </nav>
    <!-- hero begin -->
    <section id="hero" class="isi text-center p-5 bg-warning-subtle text-sm-start">
        <div class="container">
        <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                <img src="image/admd.jpg" class="img-fluid" width="350">
                <img src="image/admd2.jpg" class="img-fluid" width="350">
            <div class="p-5">
                <h1 class="fw-bold display-4">
                    TEMUKAN KOLEKSI TENNIS-LUXE!
                </h1>
                <h4 class="lead display-6">
                    Lengkapi hobi kamu dengan berbagai fashion tennis.
                </h4>
                <br>
                <div>
                  <a href="#article" class="btn btn-light p-3" type="button"><b>BELANJA SEKARANG 🡭</b></a>
                </div>
            </div>
        </div>
    </section>
    <!-- hero end -->
<!-- article begin -->
<section id="article" class="text-left p-5">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      while($row = $hasil->fetch_assoc()){
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="image/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"]?></h5>
              <p class="card-text">
                <?= $row["harga"]?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">
                <?= $row["tanggal"]?>
              </small>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
<!-- article end -->
    <!-- gallery begin -->
    <section id="gallery" class="text-center p-4 bg-secondary-subtle">
    <div class="container">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <?php
                $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
                $hasil = $conn->query($sql);
                $counter = 0;

                // Generate indicators dynamically
                while ($row = $hasil->fetch_assoc()) {
                    echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="' . $counter . '" class="' . ($counter === 0 ? 'active' : '') . '" aria-current="true" aria-label="Slide ' . ($counter + 1) . '"></button>';
                    $counter++;
                }

                // Reset pointer for re-looping
                $hasil->data_seek(0);
                ?>
            </div>
            <div class="carousel-inner">
                <?php
                $counter = 0;

                // Generate slides dynamically
                while ($row = $hasil->fetch_assoc()) {
                    echo '<div class="carousel-item ' . ($counter === 0 ? 'active' : '') . '">';
                    echo '<img src="image/' . $row["gambar"] . '" class="d-block w-100" alt="Slide ' . ($counter + 1) . '">';
                    echo '</div>';
                    $counter++;
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
    <!-- gallery end -->
    <!-- footer begin -->
    <footer class="ms-auto p-5 text-center">
      <div class="container-fluid">
        <div class="d-sm-flex flex-sm-row">
          <img src="image/adidas-logo.png" width="100">
            <div class="p-5 ms-auto">
              <a href="https://www.instagram.com/adidas/"><i class="p-2 text-dark bi bi-instagram"></i></a>
              <a href="https://www.x.com/adidas"><i class="p-2 text-dark bi bi-twitter-x"></i></a>
              <a href="https://www.facebook.com/adidas/"><i class="p-2 h-2 text-dark bi bi-facebook"></i></a>
              <a href="https://www.youtube.com/adidas/"><i class="p-2 h-2 text-dark bi bi-youtube"></i></a>
            </div>
        </div>
        <hr>
        <section id="schedule" class="text-center p-3">
          <h1 class="fw-bold text-center display-4 pb-4">Schedule</h1>
          <div class="container">
              <div class="row row-cols-1 row-cols-md-3 g-3 text-center">
                  <div class="col">
                   <a class="nav-link active h-100" href="#">
                      <div class="card text-light" style="height: 15rem;width: 25rem;">
                          <div class="card-header bg-danger">
                            Senin
                          </div>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">Basis Data</li>
                            <li class="list-group-item">Rekayasa Perangkat Lunak</li>
                          </ul>
                        </div>
                   </a>
                  </div>
                  <div class="col">
                      <a class="nav-link active h-100" href="#">
                         <div class="card text-light" style="height: 15rem;width: 25rem;">
                             <div class="card-header bg-danger">
                               Selasa
                             </div>
                             <ul class="list-group list-group-flush">
                               <li class="list-group-item">Pemrograman Berbasis Web</li>
                               <li class="list-group-item">Pendidikan Pancasila</li>
                             </ul>
                           </div>
                      </a>
                     </div>
                     <div class="col">
                      <a class="nav-link active h-100" href="#">
                         <div class="card text-light" style="height: 15rem;width: 25rem;">
                             <div class="card-header bg-danger">
                               Rabu
                             </div>
                             <ul class="list-group list-group-flush">
                               <li class="list-group-item">Logika Informatika</li>
                               <li class="list-group-item">Probabilitas dan Statistik</li>
                             </ul>
                           </div>
                      </a>
                     </div>
                     <div class="col">
                      <a class="nav-link active h-100" href="#">
                         <div class="card text-light" style="height: 15rem;width: 25rem;">
                             <div class="card-header bg-danger">
                               Kamis
                             </div>
                             <ul class="list-group list-group-flush">
                               <li class="list-group-item">Basis Data</li>
                               <li class="list-group-item">Sistem Operasi</li>
                             </ul>
                           </div>
                      </a>
                     </div>
                     <div class="col">
                      <a class="nav-link active h-100" href="#">
                         <div class="card text-light" style="height: 15rem;width: 25rem;">
                             <div class="card-header bg-danger">
                               Jumat
                             </div>
                             <ul class="list-group list-group-flush">
                               <li class="list-group-item text-danger">Libur</li>
                             </ul>
                           </div>
                      </a>
                     </div>
                     <div class="col">
                      <a class="nav-link active h-100" href="#">
                         <div class="card text-light" style="height: 15rem;width: 25rem;">
                             <div class="card-header bg-danger">
                               Sabtu
                             </div>
                             <ul class="list-group list-group-flush">
                               <li class="list-group-item text-danger">Libur</li>
                             </ul>
                           </div>
                      </a>
                     </div>
                     </div>
                  </div>
                </div>
          </div>
      </section>
      <!-- hero end -->
      <!-- aboutme begin -->
      <section id="aboutme" class="text-center p-5 bg-info-subtle">
    <div class="container d-flex justify-content-center align-items-center flex-column">
        <div class="d-flex flex-column flex-sm-row align-items-center">
            <img 
                src="https://imagedelivery.net/LBWXYQ-XnKSYxbZ-NuYGqQ/f69f1ba2-802c-4160-b24f-e54c5cffc200/avatarhd" 
                class="img-fluid rounded-circle me-4 mb-4 mb-sm-0" 
                width="300" 
                alt="Foto Profil Muchamad Nafis Aljufri">
            <div class="text-start">
                <h5 class="lead">
                    A11.2023.15328
                </h5>
                <h1 class="fw-bold display-4">
                    Muchamad Nafis Aljufri
                </h1>
                <h6>
                    Program Studi Teknik Informatika
                </h6>
                <h6 class="fw-bold">
                    Universitas Dian Nuswantoro
                </h6>
            </div>
        </div>
    </div>
</section>
<!-- aboutme end -->
      <!-- footer begin -->
      <footer class="p-5 text-center">
                <div>
                  <a href="https://www.instagram.com/nafisaljufrii/"><i class="text-dark bi bi-instagram"></i></a>
                  <a href="https://www.x.com/adidas"><i class="h-2 p-2 text-dark bi bi-twitter-x"></i></a>
                  <a href="https://www.facebook.com/nafisaljufri10/"><i class="p-2 h-2 text-dark bi bi-whatsapp"></i></a>
                </div>
            </div>
            <div>
              © 2024 Muchamad Nafis Aljufri
            </div>
    </footer>
    <!-- footer end -->
    <script type="text/javascript">
      document.getElementById("darkbutton").onclick = function () {

        const collection = document.getElementsByClassName("isi");
        for (let i = 0; i < collection.length; i++){     
          collection[i].classList.remove("bg-warning-subtle");
          collection[i].classList.add("bg-dark");
          collection[i].classList.add("text-white");
        }

        document.getElementById("gallery").classList.remove("bg-secondary-subtle");
        document.getElementById("gallery").classList.add("bg-secondary");    

        document.body.classList.add("bg-dark-subtle");

        document.getElementById("card").classList.remove("bg-danger");
        document.getElementById("card").classList.add("bg-dark"); 
      }
      document.getElementById("lightbutton").onclick = function () {

        const collection = document.getElementsByClassName("isi");
        for (let i = 0; i < collection.length; i++){
          collection[i].classList.remove("bg-dark");
          collection[i].classList.add("bg-warning-subtle");
          collection[i].classList.remove("text-white");
        }

        document.getElementById("gallery").classList.remove("bg-secondary");
        document.getElementById("gallery").classList.add("bg-secondary-subtle");
        
        document.body.classList.remove("bg-dark-subtle");

        document.getElementById("card").classList.remove("bg-dark");
        document.getElementById("card").classList.add("bg-danger"); 
      }
    </script>
</body>
</html>