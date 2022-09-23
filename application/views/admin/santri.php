<!--Container Main start-->
<div class="container pt-3">
    <h4 class="text-center mb-3"><?= $retVal = (isset($judul2)) ? $judul2 : "Daftar Santri"; ?></h4>
    <?= $this->session->flashdata('flash'); ?>
    <div class="row justify-content-between">
        <div class="col-md-5 col-sm-12 mb-3">
            <?php if (isset($judul2)) { ?>
                <a href="<?= base_url('admin/santri'); ?>" class="btn btn-primary">Daftar Santri Lama</a>
            <?php } else { ?>
                <a href="<?= base_url('admin/santri_baru'); ?>" class="btn btn-primary">Santri Baru</a>
            <?php } ?>
        </div>
        <div class="col-md-5 col-sm-12">
            <form action="" method="post" class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Data Santri" name="keyword" value="<?= $this->session->userdata('keyword'); ?>" id="search">
                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                <!-- <button class="btn btn-primary" type="submit">Cari</button> -->
                <input class="btn btn-primary" type="submit" name="submit" value="Cari" id="button">
            </form>
            <?php if ($this->session->userdata('keyword') != '') { ?>
                <form action="" method="post">
                    <input type="hidden" name="keyword" value="">
                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                    <!-- <button class="btn btn-primary" type="submit">Cari</button> -->
                    <input class="btn btn-danger" type="submit" name="submit" value="Batal Cari">
                </form>
            <?php } ?>
        </div>
    </div>
    <?php if (empty($santri)) : ?>
        <div class="alert alert-danger text-center mt-3" role="alert">
            Data Santri Tidak Ditemukan
        </div>
    <?php endif; ?>
    <div class="row justify-content-center mt-3 mb-5">
        <?php foreach ($santri as $s) : ?>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card shadow">
                    <div class="w-100 card-img-top">
                        <div class="img-profile h-100 w-100 rounded" style="background-image: url('<?= base_url('assets/img-profile/not.png'); ?>')"></div>
                    </div>
                    <div class="card-body text-center pb-0">
                        <h5 class="card-title fw-bold fs-6" id="nama"><?= $s['nama']; ?></h5>
                        <span class="text-mapel-mentor"><?= $retVal = ($s['nama_kls'] == '') ? "Belum Ada Kelas" : $s['nama_kls']; ?></span><br>
                    </div>
                    <div class="card-body d-flex justify-content-center flex-nowrap w-100">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm my-1 mx-1" data-bs-toggle="modal" data-bs-target="#detail-santri<?= $s['id']; ?>">
                            <i class="fa-solid fa-circle-info"></i>
                        </button>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning btn-sm text-light my-1 mx-1" data-bs-toggle="modal" data-bs-target="#edit-santri<?= $s['id']; ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </div>
                </div>

                <!-- Start Modal Edit Santri -->
                <div class="modal fade" id="edit-santri<?= $s['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mx-auto" id="exampleModalLabel">Detail Santri</h5>
                            </div>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="mb-3">
                                            <input type="hidden" id="csrf" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                            <input type="text" class="form-control" value="<?= $s['nama']; ?>" readonly>
                                            <input type="hidden" class="form-control" value="<?= $s['id']; ?>" name="id">
                                        </div>
                                        <div>
                                            <label for="nama_kls" class="form-label">Nama Kelas</label>
                                            <input class="form-control" list="nama-kls" id="nama_kls" placeholder="Pilih Kelas" name="nama_kls" autocomplete="off" value="<?= $s['nama_kls']; ?>">
                                            <datalist id="nama-kls">
                                                <?php foreach ($kelas as $kls) : ?>
                                                    <option value="<?= $kls['nama_kls']; ?>">
                                                    <?php endforeach; ?>
                                            </datalist>
                                            <div class="form-text text-danger"><?= form_error('nama_kls'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <?php if (isset($judul2)) { ?>
                                        <button type="submit" class="btn btn-success">Tambah</button>
                                    <?php } else { ?>
                                        <button type="submit" class="btn btn-success">Ubah Kelas</button>
                                    <?php } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Of Modal Edit Santri -->
                <!-- Start Modal Detail Santri -->
                <div class="modal fade" id="detail-santri<?= $s['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mx-auto" id="exampleModalLabel">Detail Santri</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <img src="<?= base_url('assets/img-profile/not.png'); ?>" class="img-fluid rounded" alt="..." style="-webkit-filter: drop-shadow(5px 5px 5px rgba(0,0,0,.14)); filter: drop-shadow(5px 5px 5px rgba(0,0,0,.14));">
                                    </div>
                                    <div class="col-12 mt-3">
                                        <table class="table table-borderless mb-0 table-sm">
                                            <tbody>
                                                <tr>
                                                    <th scope="row" class="text-mapel-mentor">ID</th>
                                                    <td class="text-mapel-mentor"><?= $s['id']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-mapel-mentor">Nama</th>
                                                    <td class="text-mapel-mentor"><?= $s['nama']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-mapel-mentor">Tempat, Tanggal Lahir</th>
                                                    <td class="text-mapel-mentor"><?= $s['asal'] . ', ' . date_indo($s['tglahir']); ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-mapel-mentor">Nomor HP</th>
                                                    <td class="text-mapel-mentor"><?= $s['no_hp']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-mapel-mentor">Jenis Kelamin</th>
                                                    <td class="text-mapel-mentor"><?= $retVal = ($s['jkl'] == "L") ? "Laki - laki" : "Perempuan"; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-mapel-mentor">Program</th>
                                                    <td class="text-mapel-mentor"><?= $s['program']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-mapel-mentor">Kelas</th>
                                                    <td class="text-mapel-mentor"><?= $retVal = ($s['nama_kls'] == '') ? "Belum Ada Kelas" : $s['nama_kls']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Of Modal Detail Santri -->
            </div>
        <?php endforeach; ?>
    </div>
    <?php echo $this->pagination->create_links(); ?>
</div>
<!--Container Main end-->