 <?= $this->extend('PageMember/Pages') ?>
 <?= $this->section('content') ?>


 <!-- lulus -->
 <div class="container mt-5">
     <div class="card shadow-lg">
         <div class="card-header text-center bg-primary text-white">
             <h3>Hasil PSB Online</h3>
             <h5>SMP Negeri 8 Padang</h5>
         </div>
         <div class="card-body">
             <?php
                // Simulasi Data (Ganti dengan data dari database)
                $no_pendaftaran = "NP-20241216100755";
                $nama_peserta = "David R Jira";
                $tanggal_lahir = "12 Februari 2009";
                $status_lulus = false; // Ubah sesuai hasil dari database
                ?>

             <table class="table table-bordered">
                 <tr>
                     <th>No Pendaftaran</th>
                     <td><?= $no_pendaftaran ?></td>
                 </tr>
                 <tr>
                     <th>Nama Peserta</th>
                     <td><?= $nama_peserta ?></td>
                 </tr>
                 <tr>
                     <th>Tanggal Lahir</th>
                     <td><?= $tanggal_lahir ?></td>
                 </tr>
             </table>

             <div class="text-center mt-4">
                 <?php if ($status_lulus): ?>
                     <h4 class="text-success fw-bold">Selamat! Anda Lulus</h4>
                     <p class="text-muted">Silakan cetak bukti kelulusan untuk pendaftaran ulang.</p>
                     <a href="cetak_bukti.php?no=<?= $no_pendaftaran ?>" class="btn btn-success">Cetak Bukti Kelulusan</a>
                 <?php else: ?>
                     <h4 class="text-danger fw-bold">Maaf, Anda Belum Lulus</h4>
                     <p class="text-muted">Jangan berkecil hati, tetap semangat dan coba lagi tahun depan!</p>
                 <?php endif; ?>
             </div>
         </div>
         <div class="card-footer text-center text-muted">
             Untuk informasi lebih lanjut, silakan kunjungi halaman utama website ini.
         </div>
     </div>
 </div>

 <!-- tidak lulus -->
 <!-- <div class="container mt-5">
     <div class="card shadow-lg">
         <div class="card-header text-center bg-danger text-white">
             <h3>Hasil PSB Online</h3>
             <h5>SMP Negeri 8 Padang</h5>
         </div>
         <div class="card-body text-center">
             <h4 class="text-danger fw-bold">😔 Maaf, Anda Belum Lulus</h4>
             <p class="text-muted">Jangan berkecil hati, tetap semangat dan coba lagi tahun depan!</p>
             <table class="table table-bordered mt-3">
                 <tr>
                     <th>No Pendaftaran</th>
                     <td>NP-20241216100755</td>
                 </tr>
                 <tr>
                     <th>Nama Peserta</th>
                     <td>David R Jira</td>
                 </tr>
                 <tr>
                     <th>Tanggal Lahir</th>
                     <td>12 Februari 2009</td>
                 </tr>
             </table>
             <a href="index.php" class="btn btn-primary mt-3">Kembali ke Beranda</a>
         </div>
         <div class="card-footer text-center text-muted">
             Informasi lebih lanjut dapat dilihat di halaman utama website ini.
         </div>
     </div>
 </div> -->

 <?= $this->endSection() ?>