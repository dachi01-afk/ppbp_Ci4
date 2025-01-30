<?= $this->extend('Pages') ?>
<?= $this->section('content-page') ?>

<!-- Content Header (Page header) -->


<div class="card">
    <div class="card-body">
        <div>
            <button type="button" class="btn bg-gradient-success  tombol_addData">Add Data Admin</button>
        </div>
        <p class="card-text viewdata">
        </p>
    </div>
</div>


<!-- getmodal -->
<div class="viewModal" style="display: none;"></div>

<script>
    function dataAdmin() {
        $.ajax({
            url: "<?= site_url(); ?>admin/getDataAdmin",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);

            },
            error: function(xhr, ajaxOptions, throwError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        })
    }

    $(document).ready(function() {

        dataAdmin();

        $('.tombol_addData').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url(); ?>admin/formTambahData",
                dataType: "json",
                success: function(response) {
                    $('.viewModal').html(response.data).show();

                    $('#modalTambah').modal('show');
                },
                error: function(xhr, ajaxOptions, throwError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                }
            })
        })
    })
</script>

<?= $this->endSection() ?>