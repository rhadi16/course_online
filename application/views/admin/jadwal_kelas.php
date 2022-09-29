<!--Container Main start-->
<div class="container pt-3">
    <h4 class="mb-3 fw-bold">Daftar Kelas</h4>
    <?= $this->session->flashdata('flash'); ?>
    <div class="row justify-content-between align-items-center mb-3">
        <div class="col-md-8 col-sm-12 mb-3">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 pe-0">
                    <p class="m-0 text-warning"><b>Kategori</b> Kelas</p>
                </div>
                <div class="col-lg-9 col-md-8 ps-0">
                    <form action="" method="post" class="input-group">
                        <input type="hidden" id="csrf" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                        <select class="form-select" name="keyword">
                            <option value="">Semua Kelas</option>
                            <?php foreach ($kelases as $kls) : ?>
                                <option <?= $retVal = ($kls['nama_kls'] == $this->session->userdata('keyword')) ? "selected" : ''; ?> value="<?= $kls['nama_kls']; ?>"><?= $kls['nama_kls']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select class="form-select" name="keyword2">
                            <option <?= $retVal = ($this->session->userdata('keyword2') == "") ? "selected" : ''; ?> value="">Semua Program</option>
                            <option <?= $retVal = ($this->session->userdata('keyword2') == "Online Private") ? "selected" : ''; ?> value="Online Private">Online Private</option>
                            <option <?= $retVal = ($this->session->userdata('keyword2') == "Online Reguler") ? "selected" : ''; ?> value="Online Reguler">Online Reguler</option>
                            <option <?= $retVal = ($this->session->userdata('keyword2') == "Offline Private") ? "selected" : ''; ?> value="Offline Private">Offline Private</option>
                        </select>
                        <input class="btn btn-mapel text-white" type="submit" name="submit" value="Cari" id="button">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 d-flex justify-content-end mb-3">
            <div>
                <a href="<?= base_url('admin/tambah_kelas'); ?>" class="btn btn-mapel text-white">Tambah Kelas</a>
            </div>
        </div>
    </div>
    <?php if (empty($kelas)) : ?>
        <div class="alert alert-danger text-center mt-3" role="alert">
            Kelas Tidak Ditemukan
        </div>
    <?php endif; ?>
    <?php foreach ($kelas as $kls) : ?>
        <h5 class="border-start border-4 border-warning ps-3 mb-3">Kelas <?= $kls['nama_kls']; ?></h5>
        <a class="badge text-bg-success btn-mapel text-white pointer fw-normal text-break" data-bs-toggle="modal" data-bs-target="#tambah-mapel-kls<?= str_replace(' ', '', $kls['nama_kls']); ?>">Tambah Mapel</a>
        <a class="badge text-bg-danger pointer fw-normal text-break" onclick="hapusKelas('<?= $kls['nama_kls']; ?>', '<?= base_url('admin/hapus_kelas/') . $kls['nama_kls']; ?>')">Hapus Kelas</a>
        <!-- Modal add jadwal -->
        <div class="modal fade" id="tambah-mapel-kls<?= str_replace(' ', '', $kls['nama_kls']); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title border-start border-4 border-warning ps-2" id="exampleModalLabel"><b>Tambah</b> Mata Pelajaran</h5>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" id="csrf<?= str_replace(' ', '', $kls['nama_kls']); ?>" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="text" class="form-control rounded-4" id="nama_kls" name="nama_kls" value="<?= $kls['nama_kls']; ?>" readonly>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <label for="program" class="col-sm-3 col-form-label">Nama Program</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control rounded-4" id="program" name="program" value="<?= $kls['program']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <label for="id_mapel" class="col-sm-3 col-form-label">Nama Mata Pelajaran</label>
                                <div class="col-sm-9">
                                    <select class="form-select rounded-4" aria-label="Default select example" name="id_mapel" id="id_mapel<?= str_replace(' ', '', $kls['nama_kls']); ?>" onchange="selectMentor1('<?= str_replace(' ', '', $kls['nama_kls']); ?>')">
                                        <option selected value="0">Pilih Mata Pelajaran</option>
                                        <?php foreach ($mapel as $m) : ?>
                                            <option value="<?= $m['id']; ?>"><?= $m['nama_mapel']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="form-text text-danger"><?= form_error('id_mapel'); ?></div>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <label for="hari" class="col-sm-3 col-form-label">Hari</label>
                                <div class="col-sm-9">
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
                                <label for="jam_masuk" class="col-sm-3 col-form-label">Jam Masuk</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control rounded-4" id="jam_masuk" name="jam_masuk">
                                    <div class="form-text text-danger"><?= form_error('jam_masuk'); ?></div>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <label for="jam_keluar" class="col-sm-3 col-form-label">Jam Keluar</label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control rounded-4" id="jam_keluar" name="jam_keluar">
                                    <div class="form-text text-danger"><?= form_error('jam_keluar'); ?></div>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <label for="detail_mentor" class="col-sm-3 col-form-label">Nama Mentor</label>
                                <div class="col-sm-9">
                                    <select class="form-select rounded-4" aria-label="Default select example" name="id_mentor" id="detail-mentor<?= str_replace(' ', '', $kls['nama_kls']); ?>">
                                        <option selected value="0">Pilih Mentor</option>
                                    </select>
                                    <div class="form-text text-danger"><?= form_error('id_mentor'); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-batal px-4" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-mapel text-white px-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end add jadwal -->
        <div class="row justify-content-center mt-3 mb-5">
            <?php foreach ($hari as $h) : ?>
                <?php $Jadwal = $this->Admin_model->getDetailJadwal($kls['nama_kls'], $h); ?>
                <?php if ($Jadwal != null) { ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-3 mt-3">
                        <div class="card shadow position-relative pt-4">
                            <div class="card position-absolute rounded-4 header-hari text-white ms-3">
                                <div class="card-body pt-2 pb-2 ps-3 pe-3">
                                    <h5 class="fs-6 mb-0" id="hari"><?= $h; ?></h5>
                                </div>
                            </div>
                            <div class="card-body text-center overflow-hidden pt-2">
                                <table class="table table-sm align-middle table-jadwal mx-auto table-borderless mb-0">
                                    <tbody>
                                        <?php foreach ($Jadwal as $j) : ?>
                                            <tr class="border border-bottom-0">
                                                <th scope="row" class="text-break">
                                                    <a class="link-danger pointer" onclick="hapusJadwal('<?= $j['nama_mapel']; ?>', '<?= base_url('admin/hapus_jadwal/') . $j['id_kls']; ?>')"><i class="fa-solid fa-trash"></i></a>
                                                    <?= $j['nama_mapel']; ?>
                                                </th>
                                                <td><?= date('H:i', strtotime($j['jam_masuk'])); ?></td>
                                                <td>-</td>
                                                <td><?= date('H:i', strtotime($j['jam_keluar'])); ?></td>
                                            </tr>
                                            <tr class="border border-top-0">
                                                <th colspan="4" scope="row" class="text-break"><?= $j['nama']; ?></th>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>
<!--Container Main end-->