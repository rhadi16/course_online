<div class="container pt-5">
    <?= $this->session->flashdata('flash'); ?>
    <div class="row align-items-center justify-content-between">
        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
            <h5 class="fw-bold fs-5">Daftar Akun Baru</h5>
        </div>
    </div>

    <div class="table-responsive mb-5">
        <table id="mapel" class="table table-striped align-middle text-center table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center text-mapel-mentor">No.</th>
                    <th class="text-center text-mapel-mentor">Nama</th>
                    <th class="text-center text-mapel-mentor">Tempat, Tanggal Lahir</th>
                    <th class="text-center text-mapel-mentor">Nomor HP</th>
                    <th class="text-center text-mapel-mentor">Email</th>
                    <th class="text-center text-mapel-mentor">Option</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($akun_baru as $ab) : ?>
                    <tr>
                        <td class="text-mapel-mentor"><?= $no++; ?>.</td>
                        <td class="text-mapel-mentor"><?= $ab['nama']; ?></td>
                        <td class="text-mapel-mentor"><?= $ab['asal'] . ', ' . date_indo($ab['tglahir']); ?></td>
                        <td class="text-mapel-mentor"><?= $ab['no_hp']; ?></td>
                        <td class="text-mapel-mentor"><?= $ab['email']; ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-success text-light" data-bs-toggle="modal" data-bs-target="#add-akun<?= $ab['id']; ?>"><i class="fa-solid fa-plus"></i></button>
                            <button type="button" onclick="hapusMapel('<?= $ab['nama']; ?>', '<?= base_url('admin/hapusMapel/') . $ab['id']; ?>')" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <!-- Modal edit mapel -->
                    <div class="modal fade" id="add-akun<?= $ab['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title border-start border-4 border-warning ps-2" id="exampleModalLabel"><b>Tambah</b> Akun Baru</h5>
                                </div>
                                <form action="<?= base_url('admin/akun_baru') ?>" method="POST">
                                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                    <div class="modal-body">
                                        <input type="hidden" name="id_akun_baru" value="<?= $ab['id']; ?>">
                                        <input type="hidden" name="image" value="<?= $ab['image']; ?>">
                                        <input type="hidden" name="password" value="<?= $ab['password']; ?>">
                                        <div class="form-floating mb-3">
                                            <input type="text" id="id" class="form-control rounded-4" name="id" placeholder="ID">
                                            <label for="id">ID</label>
                                            <?= form_error('id', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                                        </div>
                                        <div class="row mb-3 align-items-center">
                                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control rounded-4" id="nama" name="nama" value="<?= $ab['nama']; ?>">
                                                <div class="form-text text-danger"><?= form_error('nama'); ?></div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-center">
                                            <label for="asal" class="col-sm-3 col-form-label">Asal</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control rounded-4" id="asal" name="asal" value="<?= $ab['asal']; ?>">
                                                <div class="form-text text-danger"><?= form_error('asal'); ?></div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-center">
                                            <label for="tglahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control rounded-4" id="tglahir" name="tglahir" value="<?= $ab['tglahir']; ?>">
                                                <div class="form-text text-danger"><?= form_error('tglahir'); ?></div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-center">
                                            <label for="no_hp" class="col-sm-3 col-form-label">Nomor HP</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control rounded-4" id="no_hp" name="no_hp" value="<?= $ab['no_hp']; ?>">
                                                <div class="form-text text-danger"><?= form_error('no_hp'); ?></div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-center">
                                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control rounded-4" id="email" name="email" value="<?= $ab['email']; ?>">
                                                <div class="form-text text-danger"><?= form_error('email'); ?></div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-center">
                                            <label for="lok_inter" class="col-sm-3 col-form-label">Lokasi Mentoring</label>
                                            <div class="col-sm-9">
                                                <select class="form-select rounded-4" aria-label="Default select example" name="lok_inter" id="lok_inter">
                                                    <option value="0">Pilih Lokasi Mentoring</option>
                                                    <?php foreach ($lok_int as $li) : ?>
                                                        <option <?= $retVal = ($li['id'] == $ab['lok_inter']) ? "selected" : ""; ?> value="<?= $li['id']; ?>"><?= $li['negara'] . ', ' . $li['provinsi'] . ', ' . $li['kota'] . ', ' . $li['alamat']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="form-text text-danger"><?= form_error('lok_inter'); ?></div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-center">
                                            <label for="role_id" class="col-sm-3 col-form-label">Role</label>
                                            <div class="col-sm-9">
                                                <select class="form-select rounded-4" aria-label="Default select example" id="role_id" name="role_id">
                                                    <option selected value="0">Pilih Role</option>
                                                    <!-- <option value="1">Admin</option> -->
                                                    <option value="2">Mentor</option>
                                                    <option value="3">Marketing</option>
                                                </select>
                                                <div class="form-text text-danger"><?= form_error('role_id'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-batal px-4" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-mapel text-white px-4">Tambah Akun</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end modal edit mapel -->
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center text-mapel-mentor">No.</th>
                    <th class="text-center text-mapel-mentor">Nama</th>
                    <th class="text-center text-mapel-mentor">Tempat, Tanggal Lahir</th>
                    <th class="text-center text-mapel-mentor">Nomor HP</th>
                    <th class="text-center text-mapel-mentor">Email</th>
                    <th class="text-center text-mapel-mentor">Option</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>