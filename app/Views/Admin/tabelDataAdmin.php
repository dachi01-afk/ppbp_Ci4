<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <table id="tableDataAdmin" class="table table-bordered table-striped">
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

<script>
    $(document).ready(function() {
        // Table data
        $("#tableDataAdmin").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            serverMethod: 'post',
            pagingType: 'full_numbers',
            ajax: {
                url: host + 'admin/getShowData',
                type: 'post',
            },
        });
    })

    function edit(id_admin) {
        $.ajax({
            type: "post",
            url: "<?= site_url('admin/formEditData'); ?>",
            data: {
                id_admin: id_admin
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewModal').html(response.sukses).show();
                    $('#modalEdit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, throwError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        })
    }
</script>