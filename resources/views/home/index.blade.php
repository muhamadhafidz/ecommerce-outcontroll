<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/home/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Aleo:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Crete+Round:ital@0;1&family=Dosis:wght@200;300;400;500;600;700;800&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Hello, world!</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="{{ asset('assets/image/logo.png') }}" alt="" height="50"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-link active" href="#">Beranda <span class="sr-only">(current)</span></a>
                    <a class="nav-link" href="#">Tentang Kami</a>
                    <a class="nav-link" href="#">Berita</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="landing">
        <div class="container">
        
            <div class="row">
                <div class="col-md-5 offset-md-1">
                    <h1 class="landing-text">Sistem Manajemen Pembelajaran</h1>
                    <p class="font-weight-light"><span class="labo-text">LABORATORIUM</span> SISTEM INFORMASI & MANAJEMEN INFOMATIKA</p>
                    <div class="p-2 btn-masuk-out">
                        <a href="{{ route('login') }}" class="btn btn-danger btn-masuk px-3">Masuk</a>
                    </div>
                </div>
                <div class="col-md-5">
                    <img src="{{ asset('assets/image/comp-landing.png') }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>    
    </div>
    <div class="quote-part mt-5 pt-2">
        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
                    <h4 class="quote-title text-center mb-4">Quote hari ini</h4>
                    <h4 class="quote text-center">"Waktu bekerja orang rajin adalah sekarang, sedangkan waktu bekerja orang yang malas adalah besok." <br>_<br> Abdullah Gymnastiar</h4>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <lottie-player src="https://assets7.lottiefiles.com/private_files/lf30_sbsvs4ki.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"    autoplay></lottie-player>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>