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
        <h3 class="text-dark text-break my-3 border-warning border-3 border-start ps-3"><b>Daftar</b> Santri</h3>
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
                                <button type="button" class="btn btn-sm btn-primary text-light" data-bs-toggle="modal" data-bs-target="#detail-santri<?= $s['id']; ?>"><i class="fa-solid fa-circle-info"></i></button>
                                <a href="<?= base_url('marketing/edit_santri/') . $s['id']; ?>" class="btn btn-sm btn-warning text-light"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                        <!-- Modal edit santri -->
                        <div class="modal fade" id="detail-santri<?= $s['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title border-start border-4 border-warning ps-2" id="exampleModalLabel"><b>Detail</b> Santri</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-4" id="kelas" placeholder="Kelas" value="<?= $retVal = ($s['nama_kls'] == null) ? 'Belum Ada Kelas' : $s['nama_kls']; ?>" readonly>
                                            <label for="kelas">Kelas</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-4" id="pa" placeholder="Pembimbing Akademik" value="<?= $profile['nama']; ?>" readonly>
                                            <label for="pa">Pembimbing Akademik</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-4" id="id" placeholder="ID Santri" value="<?= $s['id']; ?>" readonly>
                                            <label for="id">ID Santri</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-4" id="nama" placeholder="Nama Santri" value="<?= $s['nama']; ?>" readonly>
                                            <label for="nama">Nama Santri</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-4" id="jkl" placeholder="Jenis Kelamin" value="<?= $retVal = ($s['jkl'] == "L") ? "Laki - laki" : "Perempuan"; ?>" readonly>
                                            <label for="jkl">Jenis Kelamin</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-4" id="ttl" placeholder="Tempat, Tanggal Lahir" value="<?= $s['asal'] . ', ' . date_indo($s['tglahir']); ?>" readonly>
                                            <label for="ttl">Tempat, Tanggal Lahir</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-4" id="umur" placeholder="umur" value="<?= umur($s['tglahir']); ?>" readonly>
                                            <label for="umur">umur</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-4" id="alamat" placeholder="Alamat Santri" value="<?= $s['alamat']; ?>" readonly>
                                            <label for="alamat">Alamat Santri</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-4" id="hafalan" placeholder="Hafalan Santri" value="<?= $s['hafalan']; ?>" readonly>
                                            <label for="hafalan">Hafalan Santri</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-4" id="kemampuan_ngaji" placeholder="Kemampuan Mengaji" value="<?= $s['kemampuan_ngaji']; ?>" readonly>
                                            <label for="kemampuan_ngaji">Kemampuan Mengaji</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-4" id="kemampuan_bahasa" placeholder="Kemampuan Berbahasa" value="<?= $s['kemampuan_bahasa']; ?>" readonly>
                                            <label for="kemampuan_bahasa">Kemampuan Berbahasa</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-4" id="ustadz-dzah" placeholder="Ustadz/Ustadzah" value="<?= $s['ustadz-dzah']; ?>" readonly>
                                            <label for="ustadz-dzah">Ustadz/Ustadzah</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-4" id="no_hp" placeholder="Nomor HP" value="<?= $s['no_hp']; ?>" readonly>
                                            <label for="no_hp">Nomor HP</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-4" id="program" placeholder="Program Belajar" value="<?= $s['program']; ?>" readonly>
                                            <label for="program">Program Belajar</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control rounded-4" id="wkt_bljr" placeholder="Waktu Belajar yang Diharapkan" value="<?= $s['wkt_bljr']; ?>" readonly>
                                            <label for="wkt_bljr">Waktu Belajar yang Diharapkan</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="text" class="form-control rounded-4" id="wkt_luang" placeholder="Waktu Luang Belajar" value="<?= $s['wkt_luang']; ?>" readonly>
                                            <label for="wkt_luang">Waktu Luang Belajar</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Close</button>
                                    </div>
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