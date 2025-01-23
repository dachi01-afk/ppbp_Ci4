<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Tambah Admin</h2>
        <form action="/admin/store" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="nama_admin">Nama Admin</label>
                <input type="text" name="nama_admin" id="nama_admin" class="form-control <?= isset(session('errors')['nama_admin']) ? 'is-invalid' : '' ?>" value="<?= old('nama_admin') ?>">
                <div class="invalid-feedback">
                    <?= session('errors')['nama_admin'] ?? '' ?>
                </div>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control <?= isset(session('errors')['username']) ? 'is-invalid' : '' ?>" value="<?= old('username') ?>">
                <div class="invalid-feedback">
                    <?= session('errors')['username'] ?? '' ?>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control <?= isset(session('errors')['password']) ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= session('errors')['password'] ?? '' ?>
                </div>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" class="form-control <?= isset(session('errors')['jabatan']) ? 'is-invalid' : '' ?>" value="<?= old('jabatan') ?>">
                <div class="invalid-feedback">
                    <?= session('errors')['jabatan'] ?? '' ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>

</html>