<?= $this->extend('Layout/Pages') ?>
<?= $this->section('content') ?>

<div>

    <section id="hero" class="hero section dark-background">

        <img src="<?= site_url() ?>images/img/02.jpg" alt="" data-aos="fade-in">

        <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2>GALERI</h2>
                </div>
            </div>
        </div>

    </section>


    <section id="portfolio" class="portfolio section">
        <div class="container">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <div id="galeri" class="row gy-5 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                </div>

            </div>

        </div>
    </section>

</div>


<!-- detail data galeri-->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "<?= base_url() ?>apps/landing/getalldatagaleri",
            type: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data);
                let html = "";
                data.forEach(item => {
                    html += `
                        <div class="col-md-6 d-flex justify-content-center">
                            <div class="card shadow-sm" style="width: 35rem;">
                                <img src="<?= base_url('images/Galeri/') ?>${item.foto_galeri}" class="card-img-top" alt="${item.nama_foto}">
                                <div class="card-body" >
                                <h5>${item.nama_foto}</h5> 
                                <button type="button" class="btn btn-primary btn-detail mt-2 btn-sm"
                                    data-title="${item.nama_foto}" 
                                    data-image="<?= base_url('images/Galeri/') ?>${item.foto_galeri}"
                                >Detail...
                                </button>
                                </div>
                            </div>
                        </div>
                    `;
                });
                $("#galeri").html(html);

                // Event klik tombol detail untuk menampilkan modal
                $(".btn-detail").click(function() {
                    $("#modalTitle").text($(this).data("title"));
                    $("#modalImage").attr("src", $(this).data("image"));
                    $("#detailModal").modal("show");
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
</script>

<?= $this->endSection() ?>