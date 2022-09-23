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
            <div class="col-md-6 col-sm-12">
                <div class="card shadow mb-5">
                    <h5 class="card-header text-center">Form Tambah Santri</h5>
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
                                <label for="no_hp" class="form-label">Nomor HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $input['no_hp']; ?>">
                                <div class="form-text text-danger"><?= form_error('no_hp'); ?></div>
                            </div>
                            <div class="mb-3">
                                <label for="tglahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tglahir" name="tglahir" value="<?= $input['tglahir']; ?>">
                                <div class="form-text text-danger"><?= form_error('tglahir'); ?></div>
                            </div>
                            <div class="mb-3">
                                <label for="jkl" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" aria-label="Default select example" name="jkl" id="jkl">
                                    <option selected value="0">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki - laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <div class="form-text text-danger"><?= form_error('jkl'); ?></div>
                            </div>
                            <div class="mb-3">
                                <label for="program" class="form-label">Program Belajar</label>
                                <select class="form-select" aria-label="Default select example" name="program" id="program">
                                    <option selected value="0">Pilih Program</option>
                                    <option value="Online Private">Online Private</option>
                                    <option value="Online Reguler">Online Reguler</option>
                                    <option value="Offline Private">Offline Private</option>
                                </select>
                                <div class="form-text text-danger"><?= form_error('program'); ?></div>
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