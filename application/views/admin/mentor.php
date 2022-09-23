<!--Container Main start-->
<div class="container pt-3">
    <h4 class="text-center mb-3">Daftar Mentor</h4>
    <?= $this->session->flashdata('flash'); ?>
    <div class="row justify-content-between">
        <div class="col-md-5 col-sm-12 mb-3">
            <a href="<?= base_url('admin/tambah_mentor'); ?>" class="btn btn-primary">Tambah Mentor</a>
        </div>
        <div class="col-md-5 col-sm-12">
            <form action="" method="post" class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Data Akun" name="keyword" value="<?= $this->session->userdata('keyword'); ?>" id="search">
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
    <?php if (empty($mentor)) : ?>
        <div class="alert alert-danger text-center mt-3" role="alert">
            Data Mentor Tidak Ditemukan
        </div>
    <?php endif; ?>
    <div class="row justify-content-center mt-3 mb-5">
        <?php foreach ($mentor as $mn) : ?>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card shadow">
                    <div class="w-100 card-img-top">
                        <div class="img-profile h-100 w-100 rounded" style="background-image: url('<?= base_url('assets/img-profile/') . $mn['image']; ?>')"></div>
                    </div>
                    <div class="card-body text-center pb-0">
                        <h5 class="card-title fw-bold fs-6" id="nama"><?= $mn['nama']; ?></h5>
                        <?php $mMentor = $this->Admin_model->mapelMentor($mn['id_mentor']); ?>
                        <?php foreach ($mMentor as $mm) : ?>
                            <span class="text-mapel-mentor"><?= $mm['nama_mapel']; ?></span><br>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-body d-flex justify-content-center flex-nowrap w-100">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm my-1 mx-1" data-bs-toggle="modal" data-bs-target="#detail-mentor<?= $mn['id_mentor']; ?>">
                            <i class="fa-solid fa-circle-info"></i>
                        </button>
                        <a href="<?= base_url('admin/edit_mentor/') . $mn['id_mentor']; ?>" class="btn btn-warning btn-sm text-light my-1 mx-1"><i class="fa-solid fa-pen-to-square"></i></a>
                        <button type="button" class="btn btn-danger btn-sm my-1 mx-1" onclick="hapusMentor('<?= $mn['nama']; ?>', '<?= base_url('admin/hapus_mentor/') . $mn['id_mentor']; ?>')"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>

                <!-- Start Modal Detail Guru -->
                <div class="modal fade" id="detail-mentor<?= $mn['id_mentor']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mx-auto" id="exampleModalLabel">Detail Mentor</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <img src="<?= base_url('assets/img-profile/') . $mn['image']; ?>" class="img-fluid rounded shadow" alt="...">
                                    </div>
                                    <div class="col-12 mt-3">
                                        <table class="table table-borderless mb-0 table-sm">
                                            <tbody>
                                                <tr>
                                                    <th scope="row" class="text-mapel-mentor">ID</th>
                                                    <td class="text-mapel-mentor"><?= $mn['id_mentor']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-mapel-mentor">Nama</th>
                                                    <td class="text-mapel-mentor"><?= $mn['nama']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-mapel-mentor">Email</th>
                                                    <td class="text-mapel-mentor"><?= $mn['email']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-mapel-mentor">Nomor HP</th>
                                                    <td class="text-mapel-mentor"><?= $mn['no_hp']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-mapel-mentor">Tempat, Tanggal Lahir</th>
                                                    <td class="text-mapel-mentor"><?= $mn['asal'] . ', ' . date_indo($mn['tglahir']); ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-mapel-mentor">Mentor</th>
                                                    <td class="text-mapel-mentor"><?php foreach ($mMentor as $mm) : ?>
                                                            <i class="fa-solid fa-arrow-right"></i> <?= $mm['nama_mapel']; ?><br>
                                                        <?php endforeach; ?>
                                                    </td>
                                                </tr>
                                                <?php $kMentor = $this->Admin_model->kelasMentor($mn['id_mentor']); ?>
                                                <tr>
                                                    <th scope="row" class="text-mapel-mentor">Kelas Yang Diajar</th>
                                                    <td class="text-mapel-mentor"><?php foreach ($kMentor as $km) : ?>
                                                            <i class="fa-solid fa-arrow-right"></i> <?= $km['nama_kls'] . ' ' . $km['nama_mapel'] . ' hari ' . $km['hari'] . ' jam ' . date('H:i', strtotime($km['jam_masuk'])) . ' - ' . date('H:i', strtotime($km['jam_keluar'])); ?><br>
                                                        <?php endforeach; ?>
                                                    </td>
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
                <!-- End Of Modal Detail Guru -->
            </div>
        <?php endforeach; ?>
    </div>
    <?php echo $this->pagination->create_links(); ?>
</div>
<!--Container Main end-->