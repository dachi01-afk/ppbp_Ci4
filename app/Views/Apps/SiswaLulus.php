<?= $this->extend('Apps/Pages') ?>
<?= $this->section('content-page') ?>
<?php switch ($act) {
    default: ?>
        <div class="content-header">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12 col-12">
                        <h2><i class="fa-solid fa-desktop"></i> <?= $title; ?> </h2>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12 col-12">

                        <div class="card">
                            <!-- <div class="card-header">
                                <a class="btn btn-sm bg-gradient-success  tombol_addData"><i class="fa-solid fa-circle-plus"></i> Tambah Data </a>
                            </div> -->
                            <div class="card-body">
                                <table class="dataTableView table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NISN</th>
                                            <th>Nama</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Asal Sekolah</th>
                                            <th>Pas Foto</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <!-- modal detail data -->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class=" modal-title" id="dataPendaftar"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>NISN</th>
                                <td id="detailNISN"></td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td id="detailNama"></td>
                            </tr>
                            <tr>
                                <th>Tempat</th>
                                <td id="detailTempat"></td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td id="detailTanggalLahir"></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td id="detailJenisKelamin"></td>
                            </tr>
                            <tr>
                                <th>Asal Sekolah</th>
                                <td id="detailAsalSekolah"></td>
                            </tr>
                            <tr>
                                <th>Nama Ayah</th>
                                <td id="detailAyah"></td>
                            </tr>
                            <tr>
                                <th>Nama Ibu</th>
                                <td id="detailIbu"></td>
                            </tr>
                            <tr>
                                <th>Pekerjaan Orang Tua</th>
                                <td id="detailPekerjaanOrangTua"></td>
                            </tr>
                            <tr>
                                <th>Pas Foto</th>
                                <td><img id="detailFoto" src="" width="100" class="img-thumbnail"></td>
                            </tr>
                            <tr>
                                <th>Foto SKHU</th>
                                <td id="detailSKHU"></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td id="detailAlamat"></td>
                            </tr>
                            <tr>
                                <th>No Telp</th>
                                <td id="detailNoTelp"></td>
                            </tr>
                        </table>

                        <table class="table table-bordered">
                            <p class="text-bold">Nilai UN</p>

                            <tr>
                                <th>Bahasa Indonesia</th>
                                <td id="detailBahasaIndonesia"></td>
                            </tr>
                            <tr>
                                <th>Ipa</th>
                                <td id="detailIpa"></td>
                            </tr>
                            <tr>
                                <th>Matematika</th>
                                <td id="detailMatematika"></td>
                            </tr>
                            <tr>
                                <th>Bahasa Inggris</th>
                                <td id="detailBahasaInggris"></td>
                            </tr>
                        </table>

                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

<?php break;
} ?>

<script>
    var dataTableView;

    function formReload() {
        $('.is-invalid').removeClass('is-invalid');
        $('.form-control').val("");
    }

    $(document).ready(function() {
        // Table data
        dataTableView = $(".dataTableView").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            serverMethod: 'post',
            pagingType: 'full_numbers',
            ajax: {
                url: host + path.toLowerCase() + '/' + module.toLowerCase() + '/getshowdatalulus',
                type: 'post',
            },
        });

        // modal detail data
        $(document).on('click', '.tombol_detailData', function() {
            var id_pendaftaran = $(this).data('id');

            $.ajax({
                url: host + path.toLowerCase() + '/' + module.toLowerCase() + '/getbyId/' + id_pendaftaran,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.rcode == "00") {

                        $("#dataPendaftar").text('Detail Data ' + response.data.nama);

                        $("#detailNISN").text(response.data.NISN);
                        $("#detailNama").text(response.data.nama);
                        $("#detailTempat").text(response.data.tempat_lahir);
                        $("#detailTanggalLahir").text(response.data.tgl_lahir);
                        $("#detailJenisKelamin").text(response.data.jenis_kelamin);
                        $("#detailAsalSekolah").text(response.data.asal_sekolah);
                        $("#detailAyah").text(response.data.nm_ayah);
                        $("#detailIbu").text(response.data.nm_ibu);
                        $("#detailPekerjaanOrangTua").text(response.data.pekerjaan);

                        $("#detailBahasaIndonesia").text(response.data.bahasa_indonesia);
                        $("#detailIpa").text(response.data.ipa);
                        $("#detailMatematika").text(response.data.matematika);
                        $("#detailBahasaInggris").text(response.data.bahasa_inggris);

                        $("#detailFoto").attr("src", "<?= base_url('images/Pasfoto/') ?>" + response.data.pas_foto);
                        $("#detailSKHU").text(response.data.foto_skhu);
                        $("#detailAlamat").text(response.data.alamat);
                        $("#detailNoTelp").text(response.data.no_tlp);

                        $("#detailModal").modal("show");
                    } else {
                        alert("Data tidak ditemukan!");
                    }
                },
                error: function(xhr, ajaxOptions, throwError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                }
            });
        })

        // select status
        // $(document).on("change", ".status-dropdown", function() {
        //     var id_pendaftaran = $(this).data("id");
        //     var konfirmasi_status = $(this).val();

        //     $.ajax({
        //         url: host + path.toLowerCase() + '/' + module.toLowerCase() + '/status',
        //         type: "POST",
        //         data: {
        //             id_pendaftaran: id_pendaftaran,
        //             konfirmasi_status: konfirmasi_status
        //         },
        //         dataType: "json",
        //         success: function(response) {
        //             if (response.rcode === '00') {
        //                 alert("Status berhasil diperbarui!");
        //             } else {
        //                 alert("Gagal memperbarui status: " + response.message);
        //             }
        //         },
        //         error: function() {
        //             alert("Terjadi kesalahan saat mengupdate status.");
        //         }
        //     });
        // });

        // $('.btnFormCloseModal').click(function(e) {
        //     e.preventDefault();
        //     $('#foto_galeri').val('');
        //     formReload();
        // });

        // tampilakan form add data
        // $('.tombol_addData').click(function(e) {
        //     e.preventDefault();
        //     $('#addModalLabel').text('Tambah Data');
        //     $('#addModal').modal('show');
        // });

        // insert data
        // $('.formAdd').submit(function(e) {
        //     e.preventDefault();
        //     let formData = new FormData(this);
        //     $.ajax({
        //         type: "post",
        //         url: $(this).attr('action'),
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         dataType: "json",

        //         beforeSend: function() {
        //             $('.btnsimpan').prop('disabled', true);
        //             $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>')
        //         },

        //         complete: function() {
        //             $('.btnsimpan').prop('disabled', false);
        //             $('.btnsimpan').html('Save');
        //         },

        //         success: function(response) {
        //             if (response.rcode == "00") {
        //                 Swal.fire({
        //                     icon: "success",
        //                     title: "Berhasil",
        //                     text: response.message
        //                 });
        //                 $('#addModal').modal('hide');
        //                 $('.formAdd')[0].reset();
        //                 $('#foto_galeri').val('');
        //                 dataTableView.ajax.reload();
        //                 formReload();
        //             } else if (response.rcode == "11") {
        //                 $('.is-invalid').removeClass('is-invalid');
        //                 Object.keys(response.errors).forEach(key => {
        //                     $('#' + key).addClass('is-invalid');
        //                     $('.error_' + key).html(response.errors[key]);
        //                 });
        //             }
        //         },
        //         error: function(xhr, ajaxOptions, throwError) {
        //             alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
        //         }
        //     });
        //     return false;
        // });



        // tampilakan form Edit data
        // $(document).on('click', '.tombol_editData', function() {
        //     const id_foto = $(this).data('id');

        //     $.ajax({
        //         url: host + path.toLowerCase() + '/' + module.toLowerCase() + '/getbyId/' + id_foto,
        //         type: 'GET',
        //         dataType: 'json',
        //         success: function(response) {
        //             console.log(response);
        //             if (response.rcode === '00') {
        //                 $('#editModalLabel').text('Edit Data');
        //                 $('#id_foto_edit').val(response.data.id_foto);
        //                 $('#nama_foto_edit').val(response.data.nama_foto);

        //                 $('#editModal').modal('show');
        //             } else {
        //                 alert('Data tidak ditemukan!');
        //             }
        //         },
        //         error: function(xhr, ajaxOptions, throwError) {
        //             alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
        //         }
        //     });
        // });

        // update data
        // $('.formEdit').submit(function(e) {
        //     e.preventDefault();
        //     let formData = new FormData(this);

        //     $.ajax({
        //         type: "post",
        //         url: $(this).attr('action'),
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         dataType: "json",

        //         beforeSend: function() {
        //             $('.btnsimpan').prop('disabled', true);
        //             $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i> Saving...');
        //         },

        //         complete: function() {
        //             $('.btnsimpan').prop('disabled', false);
        //             $('.btnsimpan').html('Save');
        //         },

        //         success: function(response) {
        //             // console.log("Data yang dikirim:", response.data);
        //             if (response.rcode == "00") {
        //                 Swal.fire({
        //                     icon: "success",
        //                     title: "Berhasil",
        //                     text: response.message
        //                 });

        //                 $('.formEdit')[0].reset();
        //                 $('#editModal').modal('hide');
        //                 dataTableView.ajax.reload();
        //                 formReload();
        //             } else if (response.rcode == "11") {
        //                 $('.is-invalid').removeClass('is-invalid');
        //                 Object.keys(response.errors).forEach(key => {
        //                     $('#' + key + '_edit').addClass('is-invalid');
        //                     $('.error_' + key + '_edit').html(response.errors[key]);
        //                 });
        //             }
        //         },
        //         error: function(xhr, ajaxOptions, throwError) {
        //             alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
        //         }
        //     });

        //     return false;
        // });

        // delete data
        // $(document).on('click', '.tombol_deletData', function(e) {
        //     var id_foto = $(this).data('id');

        //     Swal.fire({
        //         title: "Konfirmasi",
        //         text: "Yakin ingin menghapus data ini?",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#d33",
        //         cancelButtonColor: "#3085d6",
        //         confirmButtonText: "Ya, Hapus!"
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.ajax({
        //                 type: "POST",
        //                 url: host + path.toLowerCase() + '/' + module.toLowerCase() + '/delete',
        //                 data: {
        //                     id_foto: id_foto
        //                 },
        //                 dataType: "json",
        //                 success: function(response) {
        //                     if (response.rcode == "00") {
        //                         Swal.fire("Deleted!", response.message, "success");
        //                         dataTableView.ajax.reload();
        //                     } else {
        //                         Swal.fire("Error!", response.message, "error");
        //                     }
        //                 },
        //                 error: function(xhr, ajaxOptions, thrownError) {
        //                     alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        //                 }
        //             });
        //         }
        //     });
        // });
    });
</script>

<?= $this->endSection() ?>