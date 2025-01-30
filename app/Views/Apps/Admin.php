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
                                            <th>Nama Admin</th>
                                            <th>Username</th>
                                            <th>Jabatan</th>
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
        <!-- <div class="viewModal" style="display: none;"></div> -->

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
                    <?= form_open(strtolower($path) . '/' . strtolower($module) . '/insert', ['class' => 'formAddAdmin']) ?>
                    <div class="modal-body">
                        <input type="hidden" id="id_admin" name="id_admin">
                        <div class="form-group">
                            <label for="">Nama Admin</label>
                            <input type="text" class="form-control" id="nama_admin" name="nama_admin">
                            <div class="invalid-feedback error_nama_admin"></div>
                        </div>
                        <div class=" form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" id="username">
                            <div class="invalid-feedback error_username"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <div class="invalid-feedback error_password"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Jabatan</label>
                            <input type="text" class="form-control " name="level" id="level">
                            <div class="invalid-feedback error_level"></div>
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
                    <?= form_open(strtolower($path) . '/' . strtolower($module) . '/update', ['class' => 'formEditAdmin']) ?>
                    <div class="modal-body">
                        <input type="hidden" id="id_admin_edit" name="id_admin">
                        <div class="form-group">
                            <label for="">Nama Admin</label>
                            <input type="text" class="form-control" id="nama_admin_edit" name="nama_admin">
                            <div class="invalid-feedback error_nama_admin_edit"></div>
                        </div>
                        <div class=" form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" id="username_edit">
                            <div class="invalid-feedback error_username_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" id="password_edit">
                            <div class="invalid-feedback error_password_edit"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Jabatan</label>
                            <input type="text" class="form-control " name="level" id="level_edit">
                            <div class="invalid-feedback error_level_edit"></div>
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
            formReload();
        });

        // tampilakan form add data
        $('.tombol_addData').click(function(e) {
            e.preventDefault();
            $('#addModalLabel').text('Tambah Data Admin');
            $('#addModal').modal('show');
        });

        // insert data
        $('.formAddAdmin').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
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
            const id_admin = $(this).data('id');

            $.ajax({
                url: host + path.toLowerCase() + '/' + module.toLowerCase() + '/getbyId/' + id_admin,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.rcode === '00') {
                        $('#editModalLabel').text('Edit Data Admin');
                        $('#id_admin_edit').val(response.data.id_admin);
                        $('#nama_admin_edit').val(response.data.nama_admin);
                        $('#username_edit').val(response.data.username);
                        $('#password_edit').val('');
                        $('#level_edit').val(response.data.level);

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
        $('.formEditAdmin').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
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
                    console.log("Data yang dikirim:", response.data);
                    if (response.rcode == "00") {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.message
                        });

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
            var id_admin = $(this).data('id');

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
                            id_admin: id_admin
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