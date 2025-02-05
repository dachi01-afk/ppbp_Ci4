<?= $this->extend('Pages') ?>
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
                                            <th>Status</th>
                                            <th>Detail</th>
                                            <th>Aksi</th>
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

        <!-- form modal Add data -->
        <div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open(strtolower($path) . '/' . strtolower($module) . '/insert', ['class' => 'formAdd', 'enctype' => 'multipart/form-data']) ?>
                    <div class="modal-body">
                        <input type="hidden" id="id_foto" name="id_foto">
                        <div class="form-group">
                            <label for="">Nama Foto</label>
                            <input type="text" class="form-control" id="nama_foto" name="nama_foto">
                            <div class="invalid-feedback error_nama_foto"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Upload Foto</label>
                            <input type="file" class="form-control-file" id="foto_galeri" name="foto_galeri">
                            <div class="invalid-feedback error_foto_galeri"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btnsimpan">Save</button>
                            <button type="button" class="btn btn-secondary btnFormCloseModal" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>

        <!-- from edit data admin -->
        <div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open(strtolower($path) . '/' . strtolower($module) . '/update', ['class' => 'formEdit', 'enctype' => 'multipart/form-data']) ?>
                    <div class="modal-body">
                        <input type="hidden" id="id_pendaftaran_edit" name="id_pendaftaran_edit">
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_edit" name="nama_edit">
                            <div class="invalid-feedback error_nama_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Tampat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir_edit" name="tempat_lahir_edit">
                            <div class="invalid-feedback error_tempat_lahir_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir_edit" name="tgl_lahir_edit">
                            <div class="invalid-feedback error_tgl_lahir_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin_edit" id="jenis_kelamin_edit">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <div class="invalid-feedback error_jenis_kelamin_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Agama</label>
                            <select class="form-control" id="agama_edit" name="agama_edit">
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <div class="invalid-feedback error_agama_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Asal Sekolah</label>
                            <input type="text" class="form-control" id="asal_sekolah_edit" name="asal_sekolah_edit">
                            <div class="invalid-feedback error_asal_sekolah_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Ayah</label>
                            <input type="text" class="form-control" id="nm_ayah_edit" name="nm_ayah_edit">
                            <div class="invalid-feedback error_nm_ayah_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Ibu</label>
                            <input type="text" class="form-control" id="nm_ibu_edit" name="nm_ibu_edit">
                            <div class="invalid-feedback error_nm_ibu_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Pekerjaan Orang Tua</label>
                            <input type="text" class="form-control" id="pekerjaan_edit" name="pekerjaan_edit">
                            <div class="invalid-feedback error_pekerjaan_edit"></div>
                        </div>
                        <p>Nilai UN</p>
                        <div class="form-group">
                            <label for="">Bahasa Indonesia</label>
                            <input type="text" class="form-control" id="bahasa_indonesia_edit" name="bahasa_indonesia_edit">
                            <div class="invalid-feedback error_bahasa_indonesia_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Ipa</label>
                            <input type="text" class="form-control" id="ipa_edit" name="ipa_edit">
                            <div class="invalid-feedback error_ipa_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Matematika</label>
                            <input type="text" class="form-control" id="matematika_edit" name="matematika_edit">
                            <div class="invalid-feedback error_matematika_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Bahasa Inggris</label>
                            <input type="text" class="form-control" id="bahasa_inggris_edit" name="bahasa_inggris_edit">
                            <div class="invalid-feedback error_bahasa_inggris_edit"></div>
                        </div>
                        <div class=" form-group">
                            <label for="">Pas Foto</label>
                            <input type="file" class="form-control" name="pas_foto_edit" id="pas_foto_edit">
                            <div class="invalid-feedback error_pas_foto_edit"></div>
                        </div>
                        <div class=" form-group">
                            <label for="">Foto SKHU</label>
                            <input type="file" class="form-control" name="foto_skhu_edit" id="foto_skhu_edit">
                            <div class="invalid-feedback error_foto_skhu_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat Lengkap</label>
                            <input type="text" class="form-control" id="alamat_edit" name="alamat_edit">
                            <div class="invalid-feedback error_alamat_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="">No Telp</label>
                            <input type="text" class="form-control" id="no_tlp_edit" name="no_tlp_edit">
                            <div class="invalid-feedback error_no_tlp_edit"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btnsimpan">Save</button>
                            <button type="button" class="btn btn-secondary btnFormCloseModal" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>


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
                url: host + path.toLowerCase() + '/' + module.toLowerCase() + '/getshowdata',
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
                    console.log(response);
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
        $(document).on("change", ".status-dropdown", function() {
            var id_pendaftaran = $(this).data("id");
            var konfirmasi_status = $(this).val();

            $.ajax({
                url: host + path.toLowerCase() + '/' + module.toLowerCase() + '/status',
                type: "POST",
                data: {
                    id_pendaftaran: id_pendaftaran,
                    konfirmasi_status: konfirmasi_status
                },
                dataType: "json",
                success: function(response) {
                    if (response.rcode === '00') {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.message
                        });
                    } else {
                        // alert("Gagal memperbarui status: " + response.message);
                        Swal.fire({
                            icon: "Warning",
                            title: "Gagal",
                            text: "Gagal memperbarui status: " + response.message
                        });
                    }
                },
                error: function() {
                    alert("Terjadi kesalahan saat mengupdate status.");
                }
            });
        });

        $('.btnFormCloseModal').click(function(e) {
            e.preventDefault();
            $('#foto_galeri').val('');
            formReload();
        });

        $('.close').click(function(e) {
            e.preventDefault();
            formReload();
        });

        // tampilakan form add data
        // $('.tombol_addData').click(function(e) {
        //     e.preventDefault();
        //     $('#addModalLabel').text('Tambah Data');
        //     $('#addModal').modal('show');
        // });

        // // insert data
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
        $(document).on('click', '.tombol_editData', function() {
            const id_pendaftaran = $(this).data('id');

            $.ajax({
                url: host + path.toLowerCase() + '/' + module.toLowerCase() + '/getbyId/' + id_pendaftaran,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.rcode === '00') {
                        $('#editModalLabel').text('Edit Data Siswa ' + response.data.nama);

                        $('#id_pendaftaran_edit').val(response.data.id_pendaftaran);
                        $('#nama_edit').val(response.data.nama);
                        $('#tempat_lahir_edit').val(response.data.tempat_lahir);
                        $('#tgl_lahir_edit').val(response.data.tgl_lahir);
                        $('#jenis_kelamin_edit').val(response.data.jenis_kelamin).change();
                        $('#agama_edit').val(response.data.agama).change();
                        $('#asal_sekolah_edit').val(response.data.asal_sekolah);
                        $('#nm_ayah_edit').val(response.data.nm_ayah);
                        $('#nm_ibu_edit').val(response.data.nm_ibu);
                        $('#pekerjaan_edit').val(response.data.pekerjaan);

                        $('#bahasa_indonesia_edit').val(response.data.bahasa_indonesia);
                        $('#ipa_edit').val(response.data.ipa);
                        $('#matematika_edit').val(response.data.matematika);
                        $('#bahasa_inggris_edit').val(response.data.bahasa_inggris);

                        $('#alamat_edit').val(response.data.alamat);
                        $('#no_tlp_edit').val(response.data.no_tlp);

                        $('#editModal').modal('show');
                    } else {
                        alert('Data tidak ditemukan!');
                    }
                },
                error: function(xhr, ajaxOptions, throwError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                }
            });
        });

        // update data
        $('.formEdit').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",

                beforeSend: function() {
                    $('.btnsimpan').prop('disabled', true);
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i> Saving...');
                },

                complete: function() {
                    $('.btnsimpan').prop('disabled', false);
                    $('.btnsimpan').html('Save');
                },

                success: function(response) {
                    // console.log("Data yang dikirim:", response.data);
                    if (response.rcode == "00") {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.message
                        });

                        $('.formEdit')[0].reset();
                        $('#editModal').modal('hide');
                        dataTableView.ajax.reload();
                        formReload();
                    } else if (response.rcode == "11") {
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').html('').hide();
                        Object.keys(response.errors).forEach(key => {
                            let inputField = $('#' + key);
                            if (inputField.length) {
                                inputField.addClass('is-invalid');
                                $('.error_' + key).html(response.errors[key]).show();

                            }
                        });
                    }
                },
                error: function(xhr, ajaxOptions, throwError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                }
            });

            return false;
        });

        // delete data
        $(document).on('click', '.tombol_deletData', function(e) {
            var id_pendaftaran = $(this).data('id');

            Swal.fire({
                title: "Konfirmasi",
                text: "Yakin ingin menghapus data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: host + path.toLowerCase() + '/' + module.toLowerCase() + '/delete',
                        data: {
                            id_pendaftaran: id_pendaftaran
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.rcode == "00") {
                                Swal.fire("Deleted!", response.message, "success");
                                dataTableView.ajax.reload();
                            } else {
                                Swal.fire("Error!", response.message, "error");
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>