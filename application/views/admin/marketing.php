<!--Container Main start-->
<div class="container pt-3">
    <h4 class="mb-3 fw-bold">Daftar Marketing</h4>
    <?= $this->session->flashdata('flash'); ?>
    <div class="row justify-content-between">
        <div class="col-md-5 col-sm-12 mb-3">
            <a href="<?= base_url('admin/tambah_marketing'); ?>" class="btn btn-mapel text-white">Tambah Marketing</a>
            <a href="<?= base_url('admin/export_excel_marketing'); ?>" class="btn btn-success excel" target="_blank"><i class="fa-solid fa-file-csv"></i></a>
        </div>
        <div class="col-md-5 col-sm-12">
            <form action="" method="post" class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari Data Akun" name="keyword" value="<?= $this->session->userdata('keyword'); ?>" id="search">
                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                <!-- <button class="btn btn-primary" type="submit">Cari</button> -->
                <input class="btn btn-mapel text-white" type="submit" name="submit" value="Cari" id="button">
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
    <?php if (empty($marketing)) : ?>
        <div class="alert alert-danger text-center mt-3" role="alert">
            Data Marketing Tidak Ditemukan
        </div>
    <?php endif; ?>
    <div class="row justify-content-center mt-3 mb-5">
        <?php foreach ($marketing as $m) : ?>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <?php $smarketing = $this->Admin_model->statusMarketing($m['id_marketing']); ?>
                <div class="card shadow">
                    <div class="w-100 card-img-top">
                        <div class="img-profile h-100 w-100 rounded" style="background-image: url('<?= base_url('assets/img-profile/') . $m['image']; ?>')"></div>
                    </div>
                    <div class="card-body text-center pb-0">
                        <h5 class="card-title fw-bold fs-6" id="nama"><?= $m['nama']; ?></h5>
                        <p class="text-marketing mb-0">
                            <?php if (!$smarketing) {
                                echo "<span class='text-danger'>Belum Ada Status</span>";
                            }
                            foreach ($smarketing as $sm) :
                                if ($smarketing[0]['status'] == '') {
                                    echo "<span class='text-danger'>Belum Ada Status</span>";
                                } else {
                            ?>
                                    Status <?= $sm['status']; ?><br>
                            <?php }
                            endforeach; ?>
                        </p>
                    </div>
                    <div class="card-body d-flex justify-content-center flex-nowrap w-100">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-mapel text-white btn-sm my-1 mx-1" data-bs-toggle="modal" data-bs-target="#detail-marketing<?= $m['id_marketing']; ?>">
                            <i class="fa-solid fa-circle-info"></i>
                        </button>
                        <a href="<?= base_url('admin/edit_marketing/') . $m['id_marketing']; ?>" class="btn btn-warning btn-sm text-light my-1 mx-1"><i class="fa-solid fa-pen-to-square"></i></a>
                        <button type="button" class="btn btn-danger btn-sm my-1 mx-1" onclick="hapusMarketing('<?= $m['nama']; ?>', '<?= base_url('admin/hapus_marketing/') . $m['id_marketing']; ?>')"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>

                <!-- Start Modal Detail Guru -->
                <div class="modal fade" id="detail-marketing<?= $m['id_marketing']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title border-start border-4 border-warning ps-2" id="exampleModalLabel"><b>Detail</b> Mentor</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <img src="<?= base_url('assets/img-profile/') . $m['image']; ?>" class="img-fluid rounded shadow" alt="...">
                                    </div>
                                    <div class="col-12 mt-3">
                                        <table class="table table-borderless mb-0 table-sm">
                                            <tbody>
                                                <tr>
                                                    <th scope="row" class="text-marketing">ID</th>
                                                    <td class="text-marketing"><?= $m['id_marketing']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-marketing">Nama</th>
                                                    <td class="text-marketing"><?= $m['nama']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-marketing">Email</th>
                                                    <td class="text-marketing"><?= $m['email']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-marketing">Nomor HP</th>
                                                    <td class="text-marketing"><?= $m['no_hp']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-marketing">Tempat, Tanggal Lahir</th>
                                                    <td class="text-marketing"><?= $m['asal'] . ', ' . date_indo($m['tglahir']); ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-mapel-mentor">Tempat Mentoring</th>
                                                    <?php if (isset($m['negara'])) { ?>
                                                        <td class="text-mapel-mentor"><?= $m['negara'] . ', ' . $m['provinsi'] . ', ' . $m['kota'] . ', ' . $m['alamat']; ?></td>
                                                    <?php } else {
                                                        echo '<td><span class="text-mapel-mentor text-danger">Belum Ada Lokasi Mentoring</span></td>';
                                                    } ?>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="text-mapel-guru">Status</th>
                                                    <td class="text-mapel-guru"><?php if (!$smarketing) {
                                                                                    echo "Belum Ada Status";
                                                                                }
                                                                                foreach ($smarketing as $sm) : ?><?= $sm['status']; ?><br>
                                                    <?php endforeach; ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-batal" data-bs-dismiss="modal">Close</button>
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