<!-- Main Wrapper -->
<div class="my-container active-cont position-relative">
    <!-- Top Nav -->
    <nav class="navbar top-navbar navbar-light px-5 sticky-top shadow">
        <a class="btn" id="menu-btn"><i class="fas fa-bars"></i></a>
    </nav>
    <div class="container mt-3">
        <?= $this->session->flashdata('flash'); ?>
    </div>
    <!--End Top Nav -->
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12">
                <div class="card shadow mb-5">
                    <div class="card-header py-3">
                        <h5 class="border-start border-4 border-warning m-0 ps-3"><b>Tambah</b> Santri</h5>
                    </div>
                    <div class="card-body overflow-hidden">
                        <form action="" method="post">
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-4" placeholder="ID" id="id" name="id" value="<?= set_value('id'); ?>">
                                        <label for="id">ID</label>
                                        <div class="form-text text-danger text-center"><?= form_error('id'); ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-4" placeholder="Nama" id="nama" name="nama" value="<?= set_value('nama'); ?>">
                                        <label for="nama">Nama</label>
                                        <div class="form-text text-danger text-center"><?= form_error('nama'); ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-select rounded-4" aria-label="Default select example" name="jkl" id="jkl">
                                            <option selected value="0">Pilih Jenis Kelamin</option>
                                            <option value="L">Laki - laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        <label for="jkl">Jenis Kelamin</label>
                                        <div class="form-text text-danger text-center"><?= form_error('jkl'); ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-4" placeholder="Asal Kota" id="asal" name="asal" value="<?= set_value('asal'); ?>">
                                        <label for="asal">Asal Kota</label>
                                        <div class="form-text text-danger text-center"><?= form_error('asal'); ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control rounded-4" id="tglahir" name="tglahir" value="<?= set_value('tglahir'); ?>">
                                        <label for="tglahir">Tanggal Lahir</label>
                                        <div class="form-text text-danger text-center"><?= form_error('tglahir'); ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-4" placeholder="Alamat" id="alamat" name="alamat" value="<?= set_value('alamat'); ?>">
                                        <label for="alamat">Alamat</label>
                                        <div class="form-text text-danger text-center"><?= form_error('alamat'); ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-4" placeholder="Hafalan Al-Qur'an" id="hafalan" name="hafalan" value="<?= set_value('hafalan'); ?>">
                                        <label for="hafalan">Hafalan Al-Qur'an</label>
                                        <div class="form-text text-danger text-center"><?= form_error('hafalan'); ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-select rounded-4" aria-label="Default select example" name="kemampuan_ngaji" id="kemampuan_ngaji">
                                            <option value="0">Pilih Kemampuan Mengaji</option>
                                            <option value="Iqra">Iqro</option>
                                            <option value="Al-Qur'an">Al-Qur'an</option>
                                        </select>
                                        <label for="kemampuan_ngaji">Kemampuan Mengaji</label>
                                        <div class="form-text text-danger text-center"><?= form_error('kemampuan_ngaji'); ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-4" placeholder="Kemampuan Berbahasa" id="kemampuan_bahasa" name="kemampuan_bahasa" value="<?= set_value('kemampuan_bahasa'); ?>">
                                        <label for="kemampuan_bahasa">Kemampuan Berbahasa</label>
                                        <div class="form-text text-danger text-center"><?= form_error('kemampuan_bahasa'); ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-4" placeholder="Ustadz/Ustadzah" id="ustadz-dzah" name="ustadz-dzah" value="<?= set_value('ustadz-dzah'); ?>">
                                        <label for="ustadz-dzah">Ustadz/Ustadzah</label>
                                        <div class="form-text text-danger text-center"><?= form_error('ustadz-dzah'); ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-4" placeholder="Nomor HP" id="no_hp" name="no_hp" value="<?= set_value('no_hp'); ?>">
                                        <label for="no_hp">Nomor HP</label>
                                        <div class="form-text text-danger text-center"><?= form_error('no_hp'); ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-select rounded-4" aria-label="Default select example" name="program" id="program">
                                            <option selected value="0">Pilih Program</option>
                                            <option value="Online Private">Online Private</option>
                                            <option value="Online Reguler">Online Reguler</option>
                                            <option value="Offline Private">Offline Private</option>
                                        </select>
                                        <label for="program">Program Belajar</label>
                                        <div class="form-text text-danger text-center"><?= form_error('program'); ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-4" placeholder="Waktu Belajar yang Diharapkan" id="wkt_bljr" name="wkt_bljr" value="<?= set_value('wkt_bljr'); ?>">
                                        <label for="wkt_bljr">Waktu Belajar yang Diharapkan</label>
                                        <div class="form-text text-danger text-center"><?= form_error('wkt_bljr'); ?></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control rounded-4" placeholder="Waktu Luang Belajar" id="wkt_luang" name="wkt_luang" value="<?= set_value('wkt_luang'); ?>">
                                        <label for="wkt_luang">Waktu Luang Belajar</label>
                                        <div class="form-text text-danger text-center"><?= form_error('wkt_luang'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-end">Submit</button>
                            <a href="<?= base_url('marketing/santri'); ?>" class="btn btn-outline-warning mx-2 float-end">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>