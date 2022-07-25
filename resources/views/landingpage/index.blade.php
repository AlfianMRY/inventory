<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Gudangin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Scripts -->
   <script src="{{asset('js/app.js') }}" defer></script>
  <!-- Favicons -->
  <link href="{{asset('landingpage/img/logo_g.png')}}" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('landingpage/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  <!-- Template Main CSS File -->
  <link href="{{asset('landingpage/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: OnePage - v4.7.0
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  @include('landingpage.header')
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-9 text-center">
          <h1>Sistem Manajemen Gudang Terintegrasi</h1>
          <h2>Optimalkan pemanfaatan ruangan, serta mudahkan pelacakan dan perhitungan kapasitas gudang secara otomatis dengan Software Manajemen Gudang terbaik.</h2>
        </div>
      </div>
      <div class="text-center">
        <a href="{{url('dashboard')}}" class="btn-get-started scrollto">Get Started</a>
      </div>
      </div>
    </div>
  </section><!-- End Hero -->
  <br><br>

  <main id="main">

    <!-- ======= About Section ======= -->
    @include('landingpage.about')
    <!-- End About Section -->

    <!-- ======= Testimonials Section ======= -->
    @include('landingpage.testimoni')
    <!-- End Testimonials Section -->

    <!-- ======= Portfolio Section ======= -->
    @include('landingpage.portofolio')
    <!-- End Portfolio Section -->

    <!-- ======= Team Section ======= -->
    @include('landingpage.team')
    <!-- End Team Section -->

    <!-- ======= Contact Section ======= -->
    @include('landingpage.contact')
    <!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('landingpage.footer')
  <!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('landingpage/vendor/purecounter/purecounter.js')}}"></script>
  <script src="{{asset('landingpage/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('landingpage/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('landingpage/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('landingpage/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('landingpage/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('landingpage/js/main.js')}}"></script>

  <script>
    function logout() {
      document.getElementById("logout-form").submit();
    }
  </script>
</body>

</html>
