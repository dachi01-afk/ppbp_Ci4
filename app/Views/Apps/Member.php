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
                                <a href="<?= site_url(); ?><?= strtolower($path); ?>/<?= strtolower($module); ?>/add" type="button" class="btn btn-sm bg-gradient-success  tombol_addData"> <i class="fa-solid fa-circle-plus"></i> Tambah Data </a>
                            </div>
                            <div class="card-body">
                                <table class="dataTableView table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No.Pendaftaran</th>
                                            <th>NISN</th>
                                            <th>Nama</th>
                                            <th>Tgl.Lahir</th>
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

    <?php break;
    case 'Add': ?>

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
                                <i class="fa-solid fa-circle-plus"></i> Tambah Data
                            </div>
                            <div class="card-body">
                                isi form
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

    <?php break;
    case 'Edit': ?>

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
                                <i class="fa-solid fa-pen-to-square"></i> Edit Data
                            </div>
                            <div class="card-body">
                                isi form
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
<?php break;
} ?>

<script>
    var dataTableView;
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
    })
</script>

<?= $this->endSection() ?>