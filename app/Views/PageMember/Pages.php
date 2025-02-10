<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Home</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="<?= site_url(); ?>images/img/logo.jpg" rel="icon">
    <link href="<?= site_url(); ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= site_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= site_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= site_url(); ?>assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= site_url(); ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= site_url(); ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= site_url(); ?>assets/css/main.css" rel="stylesheet">

    <script src="<?= site_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top shadow-sm bg-light">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

            <a href="" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Logo lebih besar -->
                <!-- <img src="<?= site_url() ?>images/img/logoo.jpg" alt="Logo" style="height:300px; width: auto;"> -->
                <img src="<?= site_url() ?>images/img/logo.jpg" alt="Logo" style="height: 200px; width: auto; margin-right: 30px;">

                <!-- Teks PSB Online -->
                <div class="text-container d-flex flex-column">
                    <p style="font-weight: bold; font-size: 2em; color: blue; margin: 0;">PSB Online</p>
                    <p style="font-size: 1.3em; color: gray; margin: 0;">SMP NEGERI 8 PADANG</p>
                </div>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="<?= site_url() ?>apps/pagemember/">HOME</a></li>
                    <li><a href="<?= site_url() ?>apps/pagemember/addmember">DATA PENDAFTAR</a></li>
                    <li><a href="<?= site_url() ?>apps/pagemember/pengumuman">PENGUMUMAN</a></li>
                    <li><a href="<?= site_url() ?>apps/pagemember/">KELUAR</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <main class="main">

        <?= $this->renderSection('content') ?>

    </main>

    <footer id="footer" class="footer light-background">

        <!-- <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-6 col-md-12 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename"><i class="bi bi-geo-alt-fill"></i> Location</span>
                    </a>
                    <p class="mt-2"><strong>JL. DR. Sutomo, Kubu Marapalam, Kubu Marapalam, Kec. Padang Tim., Kota Padang, Sumatera Barat 25143</strong></p>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4><i class="bi bi-envelope-fill"></i> Mail Us :</h4>
                    <p class="mt-2"><strong>Phone :</strong> <span>+1 5589 55488 55</span></p>
                    <p><strong>Email :</strong> <span>info@example.com</span></p>
                </div>

                <div class="col-lg-2 col-md-12 footer-contact text-center text-md-start">
                    <h4><i class="bi bi-house-fill"></i> Open :</h4>
                    <p class="mt-2"><strong>Setiap Hari :</trong> <span>08 : 15 WIB</span></p>
                    <p><strong>Minggu (Libur)</trong>
                    </p>
                </div>



            </div>
        </div> -->

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Lumia</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= site_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= site_url(); ?>assets/vendor/php-email-form/validate.js"></script>
    <script src="<?= site_url(); ?>assets/vendor/aos/aos.js"></script>
    <script src="<?= site_url(); ?>assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="<?= site_url(); ?>assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?= site_url(); ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= site_url(); ?>assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?= site_url(); ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= site_url(); ?>assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="<?= site_url(); ?>assets/js/main.js"></script>

</body>

</html>