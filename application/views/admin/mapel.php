<div class="container pt-5">
    <?= $this->session->flashdata('flash'); ?>
    <div class="row align-items-center justify-content-between">
        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
            <h5 class="fw-bold fs-5">Daftar Mata Pelajaran</h5>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
            <button type="button" class="btn btn-mapel float-end w-100 text-white" data-bs-toggle="modal" data-bs-target="#tambah-mapel">Tambah Mata Pelajaran</button>
        </div>
    </div>
    <!-- Modal tambah mapel -->
    <div class="modal fade" id="tambah-mapel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title border-start border-4 border-warning ps-2" id="exampleModalLabel"><b>Tambah</b> Mata Pelajaran</h5>
                </div>
                <form action="" method="POST">
                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_mapel" class="form-label">Nama Mata Pelajaran</label>
                            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel">
                            <div class="form-text text-danger"><?= form_error('nama_mapel'); ?></div>
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
    <!-- end modal tambah mapel -->
    <div class="table-responsive mb-5">
        <table id="mapel" class="table table-striped align-middle text-center table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center text-mapel-mentor">No.</th>
                    <th class="text-center text-mapel-mentor">Nama Mata Pelajaran</th>
                    <th class="text-center text-mapel-mentor">Option</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($mapel as $m) : ?>
                    <tr>
                        <td class="text-mapel-mentor"><?= $no++; ?>.</td>
                        <td class="text-mapel-mentor"><?= $m['nama_mapel']; ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning text-light" data-bs-toggle="modal" data-bs-target="#edit-mapel<?= $m['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" onclick="hapusMapel('<?= $m['nama_mapel']; ?>', '<?= base_url('admin/hapusMapel/') . $m['id']; ?>')" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    <!-- Modal edit mapel -->
                    <div class="modal fade" id="edit-mapel<?= $m['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title border-start border-4 border-warning ps-2" id="exampleModalLabel"><b>Ubah</b> Mata Pelajaran</h5>
                                </div>
                                <form action="<?= base_url('admin/editMapel') ?>" method="POST">
                                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $m['id']; ?>">
                                        <div class="mb-3">
                                            <label for="nama_mapel" class="form-label">Nama Mata Pelajaran</label>
                                            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" value="<?= $m['nama_mapel']; ?>">
                                            <div class="form-text text-danger"><?= form_error('nama_mapel'); ?></div>
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
                    <!-- end modal edit mapel -->
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center text-mapel-mentor">No.</th>
                    <th class="text-center text-mapel-mentor">Nama Mata Pelajaran</th>
                    <th class="text-center text-mapel-mentor">Option</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>