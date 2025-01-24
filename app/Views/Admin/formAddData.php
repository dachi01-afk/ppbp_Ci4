<!-- Modal Add data -->
<div class="modal fade" id="modalTambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('admin/simpanData', ['class' => 'formAdmin']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <!-- <form method="post" action=""> -->
                <div class="form-group">
                    <label for="">Nama Admin</label>
                    <input type="text" class="form-control" id="nama_admin" name="nama_admin">
                    <div class="invalid-feedback errorNamaAdmin"></div>
                </div>
                <div class=" form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                    <div class="invalid-feedback errorUsername"></div>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <div class="invalid-feedback errorPassword"></div>
                </div>
                <div class="form-group">
                    <label for="">Jabatan</label>
                    <input type="text" class="form-control " name="level" id="level">
                    <div class="invalid-feedback errorLevel"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnsimpan">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                <!-- </form> -->
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.formAdmin').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",

                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>')
                },

                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Save');
                },

                success: function(response) {
                    if (response.error) {

                        // res err Admin
                        if (response.error.nama_admin) {
                            $('#nama_admin').addClass('is-invalid');
                            $('.errorNamaAdmin').html(response.error.nama_admin);
                        } else {
                            $('#nama_admin').removeClass('is-invalid');
                            $('.errorNamaAdmin').html();
                        }

                        // res err Username
                        if (response.error.username) {
                            $('#username').addClass('is-invalid');
                            $('.errorUsername').html(response.error.username);
                        } else {
                            $('#username').removeClass('is-invalid');
                            $('.errorUsername').html();
                        }

                        // res err Password
                        if (response.error.password) {
                            $('#password').addClass('is-invalid');
                            $('.errorPassword').html(response.error.password);
                        } else {
                            $('#password').removeClass('is-invalid');
                            $('.errorPassword').html();
                        }

                        // res err level(jabatan)
                        if (response.error.level) {
                            $('#level').addClass('is-invalid');
                            $('.errorLevel').html(response.error.level);
                        } else {
                            $('#level').removeClass('is-invalid');
                            $('.errorLevel').html();
                        }
                    } else {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.sukses
                        });

                        $('#modalTambah').modal('hide');
                        dataAdmin();

                    }
                },
                error: function(xhr, ajaxOptions, throwError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                }
            });
            return false;
        });
    });
</script>