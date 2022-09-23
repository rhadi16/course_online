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
        <h4 class="text-center mb-3">Daftar Santri</h4>
        <a href="<?= base_url('marketing/tambah_santri'); ?>" class="btn btn-primary">Tambah Santri</a>
        <div class="table-responsive mt-3 mb-5">
            <table id="list-santri" class="table table-striped align-middle text-center table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center text-mapel-santri">No.</th>
                        <th class="text-center text-mapel-santri">Nama Santri</th>
                        <th class="text-center text-mapel-santri">Tempat, Tanggal Lahir</th>
                        <th class="text-center text-mapel-santri">Jenis Kelamin</th>
                        <th class="text-center text-mapel-santri">Nomor HP</th>
                        <th class="text-center text-mapel-santri">Program</th>
                        <th class="text-center text-mapel-santri">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($santri as $s) : ?>
                        <tr>
                            <td class="text-mapel-santri"><?= $no++; ?>.</td>
                            <td class="text-mapel-santri"><?= $s['nama']; ?></td>
                            <td class="text-mapel-santri"><?= $s['asal'] . ', ' . date_indo(date('Y-m-d', strtotime($s['tglahir']))); ?></td>
                            <td class="text-mapel-santri text-break">
                                <?= $retVal = ($s['jkl'] == "L") ? "Laki-laki" : "Perempuan"; ?>
                            </td>
                            <td class="text-mapel-santri text-break"><?= $s['no_hp']; ?></td>
                            <td class="text-mapel-santri text-break align-middle text-wrap"><?= $s['program']; ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning text-light" data-bs-toggle="modal" data-bs-target="#edit-santri<?= $s['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                            </td>
                        </tr>
                        <!-- Modal edit santri -->
                        <div class="modal fade" id="edit-santri<?= $s['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mx-auto" id="exampleModalLabel">Form Edit Jadwal</h5>
                                    </div>
                                    <?= form_open_multipart(''); ?>
                                    <div class="modal-body">
                                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                        <input type="hidden" name="id" value="<?= $s['id']; ?>">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Santri</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $s['nama']; ?>">
                                            <div class="form-text text-danger text-center"><?= form_error('nama'); ?></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="asal" class="form-label">Asal Kota</label>
                                            <input type="text" class="form-control" id="asal" name="asal" value="<?= $s['asal']; ?>">
                                            <div class="form-text text-danger text-center"><?= form_error('asal'); ?></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="no_hp" class="form-label">Nomor HP</label>
                                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $s['no_hp']; ?>">
                                            <div class="form-text text-danger text-center"><?= form_error('no_hp'); ?></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tglahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tglahir" name="tglahir" value="<?= $s['tglahir']; ?>">
                                            <div class="form-text text-danger text-center"><?= form_error('tglahir'); ?></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jkl" class="form-label">jkl</label>
                                            <select class="form-select" aria-label="Default select example" name="jkl" id="jkl">
                                                <option value="0">Pilih Jenis Kelamin</option>
                                                <option <?= $retVal = ($s['jkl'] == "L") ? "selected" : ""; ?> value="L">Laki - laki</option>
                                                <option <?= $retVal = ($s['jkl'] == "P") ? "selected" : ""; ?> value="P">Perempuan</option>
                                            </select>
                                            <div class="form-text text-danger"><?= form_error('jkl'); ?></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="program" class="form-label">program</label>
                                            <select class="form-select" aria-label="Default select example" name="program" id="program">
                                                <option value="0">Pilih Program</option>
                                                <option <?= $retVal = ($s['program'] == "Online Private") ? "selected" : ""; ?> value="Online Private">Online Private</option>
                                                <option <?= $retVal = ($s['program'] == "Online Reguler") ? "selected" : ""; ?> value="Online Reguler">Online Reguler</option>
                                                <option <?= $retVal = ($s['program'] == "Offline Private") ? "selected" : ""; ?> value="Offline Private">Offline Private</option>
                                            </select>
                                            <div class="form-text text-danger"><?= form_error('program'); ?></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Ubah</button>
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
                        <th class="text-center text-mapel-santri">No.</th>
                        <th class="text-center text-mapel-santri">Nama Santri</th>
                        <th class="text-center text-mapel-santri">Tempat, Tanggal Lahir</th>
                        <th class="text-center text-mapel-santri">Jenis Kelamin</th>
                        <th class="text-center text-mapel-santri">Nomor HP</th>
                        <th class="text-center text-mapel-santri">Program</th>
                        <th class="text-center text-mapel-santri">Option</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>