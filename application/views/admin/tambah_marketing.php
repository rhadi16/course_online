<div class="container pt-3 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="card shadow">
                <h5 class="card-header text-center">Form Tambah Marketing</h5>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
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
                            <label for="no_hp" class="form-label">Nomor Hp</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $input['no_hp']; ?>">
                            <div class="form-text text-danger"><?= form_error('no_hp'); ?></div>
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
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" aria-label="Default select example" name="status" id="status">
                                <option selected value="0">Pilih status</option>
                                <option value="Glow">Glow</option>
                                <option value="Elite">Elite</option>
                                <option value="TS">TS</option>
                                <option value="DS">DS</option>
                                <option value="Shine">Shine</option>
                                <option value="STRTR">STRTR</option>
                            </select>
                            <div class="form-text text-danger"><?= form_error('status'); ?></div>
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