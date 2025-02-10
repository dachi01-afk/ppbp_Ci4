<?= $this->extend('PageMember/Pages') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<div class="container-lg shadow mt-5">
    <section id="hero" class="m-5">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2>DATA DIRI</h2>
                    <p>Lengkapi Data Diri Sesungguhnya</p>
                </div>
            </div>
        </div>

        <form>
            <div class="form-group mb-3">
                <label for="nisn" class="mb-1">NISN</label>
                <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukkan NISN">
            </div>

            <div class="form-group mb-3">
                <label for="tempat_lahir" class="mb-1">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan tempat lahir">
            </div>

            <div class="form-group mb-3">
                <label for="tanggal_lahir" class="mb-1">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
            </div>
            <div class="form-group mb-3 ">
                <label for="jenis_kelamin" class="mb-1">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                    <option value="">---- PILIH ----</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="agama" class="mb-1">Agama</label>
                <select class="form-control" id="agama" name="agama">
                    <option value="">---- PILIH ----</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="asal_sekolah " class="mb-1">Asal Sekolah</label>
                <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" placeholder="Masukkan asal sekolah">
            </div>

            <div class="form-group mb-3">
                <label for="nama_ayah" class="mb-1">Nama Ayah</label>
                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Masukkan nama ayah">
            </div>

            <div class="form-group mb-3">
                <label for="nama_ibu" class="mb-1">Nama Ibu</label>
                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Masukkan nama ibu">
            </div>

            <div class="form-group mb-3">
                <label for="pekerjaan_ortu" class="mb-1">Pekerjaan Orang Tua</label>
                <input type="text" class="form-control" id="pekerjaan_ortu" name="pekerjaan_ortu" placeholder="Masukkan pekerjaan orang tua">
            </div>
            <p><strong>Nilai UN :</strong></p>
            <div class="form-group mb-3">
                <label for="nilai_bindo" class="mb-1">Bahasa Indonesia</label>
                <input type="text" class="form-control" id="nilai_bindo" name="nilai_bindo" placeholder="Masukkan nilai">
            </div>
            <div class="form-group mb-3">
                <label for="nilai_ipa" class="mb-1">IPA</label>
                <input type="text" class="form-control" id="nilai_ipa" name="nilai_ipa" placeholder="Masukkan nilai">
            </div>
            <div class="form-group mb-3">
                <label for="nilai_mtk" class="mb-1">Matematika</label>
                <input type="text" class="form-control" id="nilai_mtk" name="nilai_mtk" placeholder="Masukkan nilai">
            </div>
            <div class="form-group mb-3">
                <label for="nilai_bing" class="mb-1">Bahasa Inggris</label>
                <input type="text" class="form-control" id="nilai_bing" name="nilai_bing" placeholder="Masukkan nilai">
            </div>

            <div class="form-group mb-3">
                <label for="pas_photo">Pas Photo</label>
                <input type="file" class="form-control" id="pas_photo" name="pas_photo">
            </div>

            <div class="form-group mb-3">
                <label for="scan_skhu">Scan SKHU</label>
                <input type="file" class="form-control" id="scan_skhu" name="scan_skhu">
            </div>

            <div class="form-group mb-3">
                <label for="alamat" class="mb-1">Alamat Lengkap</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="no_telp" class="mb-1">No Telp</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan nomor telepon">
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mt-3">Daftar</button>
            </div>
        </form>

        <!-- Pesan Penting -->
        <div class="alert alert-warning mt-3">
            <h6 style="color: red;">
                <i class="fas fa-exclamation-triangle"></i> <b>Pesan Penting</b>
            </h6>
            <ul style="color: black; padding-left: 20px;">
                <li>Perubahan Data Dapat Dilakukan Sebelum Data Diverifikasi</li>
                <li>Pastikan Data Yang Diisi Sesuai Dengan Identitas Anda</li>
                <li>Sebelum Dikirim Pastikan Data Yang Diisi Sudah Benar</li>
            </ul>
        </div>

    </section>
</div>



<?= $this->endSection() ?>