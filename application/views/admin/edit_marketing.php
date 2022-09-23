<div class="container pt-3 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="card shadow">
                <h5 class="card-header">Form Edit Marketing</h5>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                        <input type="hidden" name="id_lama" value="<?= $detail['id_marketing']; ?>">
                        <div class="mb-3">
                            <label for="id" class="form-label">ID</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?= $detail['id']; ?>">
                            <div class="form-text text-danger"><?= form_error('id'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $detail['nama']; ?>">
                            <div class="form-text text-danger"><?= form_error('nama'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="asal" class="form-label">Asal Kota</label>
                            <input type="text" class="form-control" id="asal" name="asal" value="<?= $detail['asal']; ?>">
                            <div class="form-text text-danger"><?= form_error('asal'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $detail['no_hp']; ?>">
                            <div class="form-text text-danger"><?= form_error('no_hp'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="tglahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tglahir" name="tglahir" value="<?= $detail['tglahir']; ?>">
                            <div class="form-text text-danger"><?= form_error('tglahir'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $detail['email']; ?>">
                            <div class="form-text text-danger"><?= form_error('email'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">status</label>
                            <select class="form-select" aria-label="Default select example" name="status" id="status">
                                <option value="0">Pilih status</option>
                                <option <?= $retVal = ($stat_detail[0]['status'] == "Glow") ? "selected" : ""; ?> value="Glow">Glow</option>
                                <option <?= $retVal = ($stat_detail[0]['status'] == "Elite") ? "selected" : ""; ?> value="Elite">Elite</option>
                                <option <?= $retVal = ($stat_detail[0]['status'] == "TS") ? "selected" : ""; ?> value="TS">TS</option>
                                <option <?= $retVal = ($stat_detail[0]['status'] == "DS") ? "selected" : ""; ?> value="DS">DS</option>
                                <option <?= $retVal = ($stat_detail[0]['status'] == "Shine") ? "selected" : ""; ?> value="Shine">Shine</option>
                                <option <?= $retVal = ($stat_detail[0]['status'] == "STRTR") ? "selected" : ""; ?> value="STRTR">STRTR</option>
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
                        <a href="<?= base_url('admin/marketing'); ?>" class="btn btn-danger mx-2 float-end">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>