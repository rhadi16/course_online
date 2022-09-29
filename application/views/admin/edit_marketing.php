<div class="container pt-3 mb-5">
    <h4 class="mb-3 fw-bold">Marketing</h4>
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h5 class="border-start border-4 border-warning m-0 ps-3"><b>Edit</b> Marketing</h5>
                </div>
                <div class="card-body overflow-hidden">
                    <form action="" method="post">
                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                        <input type="hidden" name="id_lama" value="<?= $detail['id_marketing']; ?>">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="id" class="col-sm-3 col-form-label">ID</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="id" name="id" value="<?= $detail['id']; ?>">
                                        <div class="form-text text-danger"><?= form_error('id'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $detail['nama']; ?>">
                                        <div class="form-text text-danger"><?= form_error('nama'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="asal" class="col-sm-3 col-form-label">Asal Kota</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="asal" name="asal" value="<?= $detail['asal']; ?>">
                                        <div class="form-text text-danger"><?= form_error('asal'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="no_hp" class="col-sm-3 col-form-label">Nomor HP</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $detail['no_hp']; ?>">
                                        <div class="form-text text-danger"><?= form_error('no_hp'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="tglahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="tglahir" name="tglahir" value="<?= $detail['tglahir']; ?>">
                                        <div class="form-text text-danger"><?= form_error('tglahir'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="email" name="email" value="<?= $detail['email']; ?>">
                                        <div class="form-text text-danger"><?= form_error('email'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="lok_inter" class="col-sm-3 col-form-label">Lokasi Mentoring</label>
                                    <div class="col-sm-9">
                                        <select class="form-select rounded-4" aria-label="Default select example" name="lok_inter" id="lok_inter">
                                            <option value="0">Pilih Lokasi Mentoring</option>
                                            <?php foreach ($lok_int as $li) : ?>
                                                <option <?= $retVal = ($li['id'] == $detail['lok_inter']) ? "selected" : ""; ?> value="<?= $li['id']; ?>"><?= $li['negara'] . ', ' . $li['provinsi'] . ', ' . $li['kota'] . ', ' . $li['alamat']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="form-text text-danger"><?= form_error('lok_inter'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="status" class="col-sm-3 col-form-label">status</label>
                                    <div class="col-sm-9">
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
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <div class="form-text text-danger"><?= form_error('password'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="password2" class="col-sm-3 col-form-label">Repeat Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password2" name="password2">
                                        <div class="form-text text-danger"><?= form_error('password2'); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-mapel text-white px-4 mx-2 float-end">Submit</button>
                        <a href="<?= base_url('admin/marketing'); ?>" class="btn btn-danger btn-batal px-4 mx-2 float-end">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>