<div class="container pt-3 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="card shadow">
                <h5 class="card-header text-center">Form Tambah Siswa</h5>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="id" class="form-label">ID</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?= $input['id']; ?>">
                            <div class="form-text text-danger"><?= form_error('id'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $input['nama']; ?>">
                            <div class="form-text text-danger"><?= form_error('nama'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="asal" class="form-label">Asal Kota</label>
                            <input type="text" class="form-control" id="asal" name="asal" value="<?= $input['asal']; ?>">
                            <div class="form-text text-danger"><?= form_error('asal'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="tglahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tglahir" name="tglahir" value="<?= $input['tglahir']; ?>">
                            <div class="form-text text-danger"><?= form_error('tglahir'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $input['email']; ?>">
                            <div class="form-text text-danger"><?= form_error('email'); ?></div>
                        </div>
                        <div class="mb-3">
                            <?php $kelas = $this->Admin_model->getkelas(); ?>
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-select" aria-label="Default select example" name="kelas" id="kelas">
                                <option selected value="0">Pilih Kelas</option>
                                <?php foreach ($kelas as $k) : ?>
                                    <option value="<?= $k['nama_kls']; ?>"><?= $k['nama_kls']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text text-danger"><?= form_error('kelas'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="form-text text-danger"><?= form_error('password'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="form-label">Repeat Password</label>
                            <input type="password" class="form-control" id="password2" name="password2">
                            <div class="form-text text-danger"><?= form_error('password2'); ?></div>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                        <a href="<?= base_url('admin/siswa'); ?>" class="btn btn-danger mx-2 float-end">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>