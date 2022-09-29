<!-- Main Wrapper -->
<div class="my-container active-cont position-relative">
    <!-- Top Nav -->
    <nav class="navbar top-navbar navbar-light bg-dark px-5 sticky-top">
        <a class="btn border-0" id="menu-btn"><i class="fas fa-bars"></i></a>
    </nav>
    <div class="container mt-3">
        <?= $this->session->flashdata('flash'); ?>
    </div>
    <!--End Top Nav -->
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-11 col-sm-12">
                <div class="card shadow mb-5">
                    <h5 class="card-header text-center">Form Edit Santri</h5>
                    <div class="card-body overflow-hidden">
                        <form action="" method="post">
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                            <input type="hidden" name="id_lama" value="<?= $detail['id']; ?>">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row mb-3 align-items-center">
                                        <label for="id" class="col-sm-3 col-form-label">ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control rounded-4" id="id" name="id" value="<?= $detail['id']; ?>">
                                            <div class="form-text text-danger"><?= form_error('id'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row mb-3 align-items-center">
                                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control rounded-4" id="nama" name="nama" value="<?= $detail['nama']; ?>">
                                            <div class="form-text text-danger"><?= form_error('nama'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row mb-3 align-items-center">
                                        <label for="jkl" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-9">
                                            <select class="form-select rounded-4" aria-label="Default select example" name="jkl" id="jkl">
                                                <option value="0">Pilih Jenis Kelamin</option>
                                                <option <?= $retVal = ($detail['jkl'] == "L") ? "selected" : ""; ?> value="L">Laki - laki</option>
                                                <option <?= $retVal = ($detail['jkl'] == "P") ? "selected" : ""; ?> value="P">Perempuan</option>
                                            </select>
                                            <div class="form-text text-danger"><?= form_error('jkl'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row mb-3 align-items-center">
                                        <label for="asal" class="col-sm-3 col-form-label">Asal Kota</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control rounded-4" id="asal" name="asal" value="<?= $detail['asal']; ?>">
                                            <div class="form-text text-danger"><?= form_error('asal'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row mb-3 align-items-center">
                                        <label for="tglahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control rounded-4" id="tglahir" name="tglahir" value="<?= $detail['tglahir']; ?>">
                                            <div class="form-text text-danger"><?= form_error('tglahir'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row mb-3 align-items-center">
                                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control rounded-4" id="alamat" name="alamat" value="<?= $detail['alamat']; ?>">
                                            <div class="form-text text-danger"><?= form_error('alamat'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row mb-3 align-items-center">
                                        <label for="hafalan" class="col-sm-3 col-form-label">Hafalan Al-Qur'an</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control rounded-4" id="hafalan" name="hafalan" value="<?= $detail['hafalan']; ?>">
                                            <div class="form-text text-danger"><?= form_error('hafalan'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row mb-3 align-items-center">
                                        <label for="kemampuan_ngaji" class="col-sm-3 col-form-label">Kemampuan Mengaji</label>
                                        <div class="col-sm-9">
                                            <select class="form-select rounded-4" aria-label="Default select example" name="kemampuan_ngaji" id="kemampuan_ngaji">
                                                <option value="0">Pilih Kemampuan Mengaji</option>
                                                <option <?= $retVal = ($detail['kemampuan_ngaji'] == "Iqra") ? "selected" : ""; ?> value="Iqra">Iqro</option>
                                                <option <?= $retVal = ($detail['kemampuan_ngaji'] == "Al-Qur'an") ? "selected" : ""; ?> value="Al-Qur'an">Al-Qur'an</option>
                                            </select>
                                            <div class="form-text text-danger"><?= form_error('kemampuan_ngaji'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row mb-3 align-items-center">
                                        <label for="kemampuan_bahasa" class="col-sm-3 col-form-label">Kemampuan Berbahasa</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control rounded-4" id="kemampuan_bahasa" name="kemampuan_bahasa" value="<?= $detail['kemampuan_bahasa']; ?>">
                                            <div class="form-text text-danger"><?= form_error('kemampuan_bahasa'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row mb-3 align-items-center">
                                        <label for="ustadz-dzah" class="col-sm-3 col-form-label">Ustadz/Ustadzah</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control rounded-4" id="ustadz-dzah" name="ustadz-dzah" value="<?= $detail['ustadz-dzah']; ?>">
                                            <div class="form-text text-danger"><?= form_error('ustadz-dzah'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row mb-3 align-items-center">
                                        <label for="no_hp" class="col-sm-3 col-form-label">Nomor HP</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control rounded-4" id="no_hp" name="no_hp" value="<?= $detail['no_hp']; ?>">
                                            <div class="form-text text-danger"><?= form_error('no_hp'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row mb-3 align-items-center">
                                        <label for="program" class="col-sm-3 col-form-label">Program Belajar</label>
                                        <div class="col-sm-9">
                                            <select class="form-select rounded-4" aria-label="Default select example" name="program" id="program">
                                                <option value="0">Pilih Program</option>
                                                <option <?= $retVal = ($detail['program'] == "Online Private") ? "selected" : ""; ?> value="Online Private">Online Private</option>
                                                <option <?= $retVal = ($detail['program'] == "Online Reguler") ? "selected" : ""; ?> value="Online Reguler">Online Reguler</option>
                                                <option <?= $retVal = ($detail['program'] == "Offline Private") ? "selected" : ""; ?> value="Offline Private">Offline Private</option>
                                            </select>
                                            <div class="form-text text-danger"><?= form_error('program'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row mb-3 align-items-center">
                                        <label for="wkt_bljr" class="col-sm-3 col-form-label">Waktu Belajar yang Diharapkan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control rounded-4" id="wkt_bljr" name="wkt_bljr" value="<?= $detail['wkt_bljr']; ?>">
                                            <div class="form-text text-danger"><?= form_error('wkt_bljr'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="row mb-3 align-items-center">
                                        <label for="wkt_luang" class="col-sm-3 col-form-label">Waktu Luang Belajar</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control rounded-4" id="wkt_luang" name="wkt_luang" value="<?= $detail['wkt_luang']; ?>">
                                            <div class="form-text text-danger"><?= form_error('wkt_luang'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-end">Submit</button>
                            <a href="<?= base_url('marketing/santri'); ?>" class="btn btn-danger mx-2 float-end">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>