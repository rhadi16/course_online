<div class="container pt-5">
    <?= $this->session->flashdata('flash'); ?>
    <div class="row align-items-center justify-content-between">
        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
            <h5 class="fw-bold fs-5">Daftar Lokasi Internasional</h5>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
            <button type="button" class="btn btn-mapel float-end w-100 text-white" data-bs-toggle="modal" data-bs-target="#tambah-lokint">Tambah Lokasi</button>
        </div>
    </div>
    <!-- Modal tambah Lokasi Internasional -->
    <div class="modal fade" id="tambah-lokint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title border-start border-4 border-warning ps-2" id="exampleModalLabel"><b>Tambah</b> Lokasi</h5>
                </div>
                <form action="" method="POST">
                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="negara" class="form-label">Negara</label>
                            <input type="text" class="form-control" id="negara" name="negara">
                            <div class="form-text text-danger"><?= form_error('negara'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi">
                            <div class="form-text text-danger"><?= form_error('provinsi'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota">
                            <div class="form-text text-danger"><?= form_error('kota'); ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat">
                            <div class="form-text text-danger"><?= form_error('alamat'); ?></div>
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
    <!-- end modal tambah Lokasi Internasional -->
    <div class="table-responsive mb-5">
        <table id="mapel" class="table table-striped align-middle text-center table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center text-mapel-mentor">No.</th>
                    <th class="text-center text-mapel-mentor">Negara</th>
                    <th class="text-center text-mapel-mentor">Provinsi</th>
                    <th class="text-center text-mapel-mentor">Kota</th>
                    <th class="text-center text-mapel-mentor">Alamat</th>
                    <th class="text-center text-mapel-mentor">Option</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($lok_int as $li) : ?>
                    <tr>
                        <td class="text-mapel-mentor"><?= $no++; ?>.</td>
                        <td class="text-mapel-mentor"><?= $li['negara']; ?></td>
                        <td class="text-mapel-mentor"><?= $li['provinsi']; ?></td>
                        <td class="text-mapel-mentor"><?= $li['kota']; ?></td>
                        <td class="text-mapel-mentor"><?= $li['alamat']; ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning text-light" data-bs-toggle="modal" data-bs-target="#edit-lokint<?= $li['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" onclick="hapusLokInt('<?= $li['negara']; ?>', '<?= base_url('admin/hapusLokInt/') . $li['id']; ?>')" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <!-- Modal edit Lokasi Internasional -->
                    <div class="modal fade" id="edit-lokint<?= $li['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title border-start border-4 border-warning ps-2" id="exampleModalLabel"><b>Ubah</b> Lokasi</h5>
                                </div>
                                <form action="<?= base_url('admin/editLokInt') ?>" method="POST">
                                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $li['id']; ?>">
                                        <div class="mb-3">
                                            <label for="negara" class="form-label">Negara</label>
                                            <input type="text" class="form-control" id="negara" name="negara" value="<?= $li['negara']; ?>">
                                            <div class="form-text text-danger"><?= form_error('negara'); ?></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="provinsi" class="form-label">Provinsi</label>
                                            <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?= $li['provinsi']; ?>">
                                            <div class="form-text text-danger"><?= form_error('provinsi'); ?></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kota" class="form-label">Kota</label>
                                            <input type="text" class="form-control" id="kota" name="kota" value="<?= $li['kota']; ?>">
                                            <div class="form-text text-danger"><?= form_error('kota'); ?></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $li['alamat']; ?>">
                                            <div class="form-text text-danger"><?= form_error('alamat'); ?></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-batal px-4" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-mapel text-white px-4">Ubah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end modal edit Lokasi Internasional -->
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center text-mapel-mentor">No.</th>
                    <th class="text-center text-mapel-mentor">Negara</th>
                    <th class="text-center text-mapel-mentor">Provinsi</th>
                    <th class="text-center text-mapel-mentor">Kota</th>
                    <th class="text-center text-mapel-mentor">Alamat</th>
                    <th class="text-center text-mapel-mentor">Option</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>