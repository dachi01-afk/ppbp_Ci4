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
                            <div class="card-header">
                                <a class="btn btn-sm bg-gradient-success  tombol_addData"><i class="fa-solid fa-circle-plus"></i> Tambah Data </a>
                            </div>
                            <div class="card-body">
                                <table class="dataTableView table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Foto</th>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open(strtolower($path) . '/' . strtolower($module) . '/update', ['class' => 'formEdit', 'enctype' => 'multipart/form-data']) ?>
                    <div class="modal-body">
                        <input type="hidden" id="id_foto_edit" name="id_foto_edit">
                        <div class="form-group">
                            <label for="">Nama Foto</label>
                            <input type="text" class="form-control" id="nama_foto_edit" name="nama_foto_edit">
                            <div class="invalid-feedback error_nama_foto_edit"></div>
                        </div>
                        <div class=" form-group">
                            <label for="">Upload Foto</label>
                            <input type="file" class="form-control" name="foto_galeri_edit" id="foto_galeri_edit">
                            <div class="invalid-feedback error_foto_galeri_edit"></div>
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

        $('.btnFormCloseModal').click(function(e) {
            e.preventDefault();
            $('#foto_galeri').val('');
            formReload();
        });

        // tampilakan form add data
        $('.tombol_addData').click(function(e) {
            e.preventDefault();
            $('#addModalLabel').text('Tambah Data');
            $('#addModal').modal('show');
        });

        // insert data
        $('.formAdd').submit(function(e) {
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
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>')
                },

                complete: function() {
                    $('.btnsimpan').prop('disabled', false);
                    $('.btnsimpan').html('Save');
                },

                success: function(response) {
                    if (response.rcode == "00") {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.message
                        });
                        $('#addModal').modal('hide');
                        $('.formAdd')[0].reset();
                        $('#foto_galeri').val('');
                        dataTableView.ajax.reload();
                        formReload();
                    } else if (response.rcode == "11") {
                        $('.is-invalid').removeClass('is-invalid');
                        Object.keys(response.errors).forEach(key => {
                            $('#' + key).addClass('is-invalid');
                            $('.error_' + key).html(response.errors[key]);
                        });
                    }
                },
                error: function(xhr, ajaxOptions, throwError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                }
            });
            return false;
        });



        // tampilakan form Edit data
        $(document).on('click', '.tombol_editData', function() {
            const id_foto = $(this).data('id');

            $.ajax({
                url: host + path.toLowerCase() + '/' + module.toLowerCase() + '/getbyId/' + id_foto,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.rcode === '00') {
                        $('#editModalLabel').text('Edit Data');
                        $('#id_foto_edit').val(response.data.id_foto);
                        $('#nama_foto_edit').val(response.data.nama_foto);

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
                        Object.keys(response.errors).forEach(key => {
                            $('#' + key + '_edit').addClass('is-invalid');
                            $('.error_' + key + '_edit').html(response.errors[key]);
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
            var id_foto = $(this).data('id');

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
                            id_foto: id_foto
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