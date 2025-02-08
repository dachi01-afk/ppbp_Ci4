<?= $this->extend('Pages') ?>
<?= $this->section('content') ?>

<section id="panduan" class="hero section dark-background">

    <img src="<?= site_url() ?>images/img/bgpanduan.jpg" alt="" data-aos="fade-in">

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row ">
            <div class="col-lg-9">
            </div>
        </div>
    </div>

</section>
<section id="panduan" class="panduan section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>PANDUAN</h2>
    </div>
    <!-- End Section Title -->

    <div class="container">
        <div class="row gy-3 d-flex justify-content-between">
            <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="about-content ps-0 ps-lg-3">
                    <ul>
                        <h2>Welcome to Panduan</h2><br>
                        <li>
                            <p>Melakukan Registrasi Online Untuk Membuat Akun</p>
                        </li>
                        <li>
                            <p>Melengkapi Formulir Online Pada Akun Ketika Sudah Login</p>
                        </li>
                        <li>
                            <p>Hasil Kelulusan Bisa Di Lihat Di Akun Masing-Masing Pada Menu Pengumuman</p>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <img src="<?= site_url() ?>images/img/graduate.png" alt="" class="img-fluid">
            </div>
        </div>

    </div>

</section>

<?= $this->endSection() ?>