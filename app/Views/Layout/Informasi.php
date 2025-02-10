    <section id="portfolio" class="portfolio section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>INFORMASI</h2>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <div id="pengumuman-container" class="row gy-5 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                </div>

            </div>
        </div>
    </section>

    <!-- detail data informasi -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" class="img-fluid mb-3" alt="">
                    <h5 id="modalTitle"></h5>
                    <p id="modalContent"></p>
                    <small class="text-muted" id="modalDate"></small>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: "<?= base_url() ?>apps/landing/informasi",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    let html = "";
                    data.forEach(item => {
                        html += `
                        <div class="col-md-6 d-flex justify-content-center">
                        <div class="card" style="width: 35 rem;">
                            <img src="<?= base_url('images/Pengumuman/') ?>${item.foto_pengumuman}" class="card-img-top" alt="${item.judul_pengumuman}">
                            <div class="card-body">
                                <h5 class="card-title">${item.judul_pengumuman}</h5>
                                <p class="card-text text-truncate" style="max-height: 5em; overflow: hidden;">
                                    ${item.isi_pengumuman}
                                </p>
                                <button class="btn btn-primary btn-detail" 
                                    data-title="${item.judul_pengumuman}" 
                                    data-content="${item.isi_pengumuman}"
                                    data-image="<?= base_url('images/Pengumuman/') ?>${item.foto_pengumuman}"
                                    data-date="${item.tgl_pengumuman}">
                                    Detail
                                </button>
                            </div>
                        </div>
                        </div>
                    `;
                    });
                    $("#pengumuman-container").html(html);

                    // Event klik tombol detail untuk menampilkan modal
                    $(".btn-detail").click(function() {
                        $("#modalTitle").text($(this).data("title"));
                        $("#modalContent").text($(this).data("content"));
                        $("#modalImage").attr("src", $(this).data("image"));
                        $("#modalDate").text("Tanggal: " + $(this).data("date"));
                        $("#detailModal").modal("show");
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>