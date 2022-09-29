<div class="container pt-3 mb-5">
    <h4 class="mb-3 fw-bold">Kelas</h4>
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h5 class="border-start border-4 border-warning m-0 ps-3"><b>Tambah</b> Kelas</h5>
                </div>
                <div class="card-body overflow-hidden">
                    <form action="" method="post">
                        <input type="hidden" id="csrf" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="nama_kls" class="col-sm-4 col-form-label">Nama Kelas</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control rounded-4" id="nama_kls" name="nama_kls" value="<?= $input['nama_kls']; ?>">
                                        <div class="form-text text-danger"><?= form_error('nama_kls'); ?></div>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label for="id_mapel" class="col-sm-4 col-form-label">Nama Mata Pelajaran</label>
                                    <div class="col-sm-8">
                                        <select class="form-select rounded-4" aria-label="Default select example" name="id_mapel" id="id_mapel" onchange="selectMentor()">
                                            <option selected value="0">Pilih Mata Pelajaran</option>
                                            <?php foreach ($mapel as $m) : ?>
                                                <option value="<?= $m['id']; ?>"><?= $m['nama_mapel']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="form-text text-danger"><?= form_error('id_mapel'); ?></div>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label for="jam_masuk" class="col-sm-4 col-form-label">Jam Masuk</label>
                                    <div class="col-sm-8">
                                        <input type="time" class="form-control rounded-4" id="jam_masuk" name="jam_masuk" value="<?= $input['jam_masuk']; ?>">
                                        <div class="form-text text-danger"><?= form_error('jam_masuk'); ?></div>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label for="detail_mentor" class="col-sm-4 col-form-label">Nama Mentor</label>
                                    <div class="col-sm-8">
                                        <select class="form-select rounded-4" aria-label="Default select example" name="id_mentor" id="detail-mentor">
                                            <option selected value="0">Pilih Mentor</option>
                                        </select>
                                        <div class="form-text text-danger"><?= form_error('id_mentor'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row mb-3 align-items-center">
                                    <label for="program" class="col-sm-2 col-md-4 col-form-label">Program</label>
                                    <div class="col-sm-10 col-md-8">
                                        <select class="form-select rounded-4" aria-label="Default select example" id="program" name="program">
                                            <option value="0">Pilih Program</option>
                                            <option value="Online Private">Online Private</option>
                                            <option value="Online Reguler">Online Reguler</option>
                                            <option value="Offline Private">Offline Private</option>
                                        </select>
                                        <div class="form-text text-danger"><?= form_error('program'); ?></div>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label for="hari" class="col-sm-2 col-md-4 col-form-label">Hari</label>
                                    <div class="col-sm-10 col-md-8">
                                        <select class="form-select rounded-4" aria-label="Default select example" id="hari" name="hari">
                                            <option selected value="0">Pilih Hari</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                            <option value="Minggu">Minggu</option>
                                        </select>
                                        <div class="form-text text-danger"><?= form_error('hari'); ?></div>
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label for="jam_keluar" class="col-sm-2 col-md-4 col-form-label">Jam Keluar</label>
                                    <div class="col-sm-10 col-md-8">
                                        <input type="time" class="form-control rounded-4" id="jam_keluar" name="jam_keluar" value="<?= $input['jam_keluar']; ?>">
                                        <div class="form-text text-danger"><?= form_error('jam_keluar'); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-mapel text-white px-4 mx-2 float-end">Submit</button>
                        <a href="<?= base_url('admin/jadwal_kelas'); ?>" class="btn btn-danger btn-batal px-4 mx-2 float-end">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>