<?= $this->extend('Layout/Pages') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<section id="hero" class="hero section dark-background">

    <img src="<?= site_url() ?>images/img/02.jpg" alt="" data-aos="fade-in">

    <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2>Welcome to</h2>
                <p>SMP NEGERI 8 PADANG</p>
            </div>
        </div>
    </div>
</section><!-- /Hero Section -->
<br>

<!-- About Section -->
<?= $this->include('Layout/About') ?>
<!-- /About Section -->

<!-- Services Section -->
<?= $this->include('Layout/VisiMisi') ?>
<!-- /Services Section -->

<!-- Portfolio Section -->
<?= $this->include('Layout/Informasi') ?>
<!-- /Portfolio Section -->



<?= $this->endSection() ?>