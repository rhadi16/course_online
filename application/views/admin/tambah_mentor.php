<div class="container pt-3 mb-5 mentor">
    <h4 class="mb-3 fw-bold">Mentor</h4>
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h5 class="border-start border-4 border-warning m-0 ps-3"><b>Tambah</b> Mentor</h5>
                </div>
                <div class="card-body overflow-hidden">
                    <form action="" method="post">
                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="id" class="col-sm-3 col-form-label">ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control rounded-4" id="id" name="id" value="<?= $input['id']; ?>">
                                        <div class="form-text text-danger"><?= form_error('id'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control rounded-4" id="nama" name="nama" value="<?= $input['nama']; ?>">
                                        <div class="form-text text-danger"><?= form_error('nama'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="asal" class="col-sm-3 col-form-label">Asal Kota</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control rounded-4" id="asal" name="asal" value="<?= $input['asal']; ?>">
                                        <div class="form-text text-danger"><?= form_error('asal'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="no_hp" class="col-sm-3 col-form-label">Nomor HP</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control rounded-4" id="no_hp" name="no_hp" value="<?= $input['no_hp']; ?>">
                                        <div class="form-text text-danger"><?= form_error('no_hp'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="tglahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control rounded-4" id="tglahir" name="tglahir" value="<?= $input['tglahir']; ?>">
                                        <div class="form-text text-danger"><?= form_error('tglahir'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control rounded-4" id="email" name="email" value="<?= $input['email']; ?>">
                                        <div class="form-text text-danger"><?= form_error('email'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="lok_inter" class="col-sm-3 col-form-label">Lokasi Mentoring</label>
                                    <div class="col-sm-9">
                                        <select class="form-select rounded-4" aria-label="Default select example" name="lok_inter" id="lok_inter">
                                            <option selected value="0">Pilih Lokasi Mentoring</option>
                                            <?php foreach ($lok_int as $li) : ?>
                                                <option value="<?= $li['id']; ?>"><?= $li['negara'] . ', ' . $li['provinsi'] . ', ' . $li['kota'] . ', ' . $li['alamat']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="form-text text-danger"><?= form_error('lok_inter'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control rounded-4" id="password" name="password">
                                        <div class="form-text text-danger"><?= form_error('password'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="password2" class="col-sm-3 col-form-label">Repeat Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control rounded-4" id="password2" name="password2">
                                        <div class="form-text text-danger"><?= form_error('password2'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="mb-3">
                                    <?php foreach ($mapel as $m) : ?>
                                        <div class="form-check d-inline-block">
                                            <input class="form-check-input" type="checkbox" value="<?= $m['id']; ?>" id="mapel<?= $m['id']; ?>" name="mapel[]">
                                            <label class="form-check-label" for="mapel<?= $m['id']; ?>">
                                                <?= $m['nama_mapel']; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-mapel text-white px-4 mx-2 float-end">Submit</button>
                        <a href="<?= base_url('admin/mentor'); ?>" class="btn btn-danger btn-batal px-4 mx-2 float-end">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>