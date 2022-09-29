<!--Container Main start-->
<div class="my-container active-cont position-relative">
    <!-- Top Nav -->
    <nav class="navbar top-navbar navbar-light px-5 sticky-top shadow">
        <a class="btn" id="menu-btn"><i class="fas fa-bars"></i></a>
    </nav>
    <div class="container mt-3">
        <?= $this->session->flashdata('flash'); ?>
    </div>
    <!--End Top Nav -->
    <div class="container">
        <h4 class="mb-3 fw-bold">Jadwal Mengajar</h4>
        <?php if (empty($kls_mentor)) : ?>
            <div class="alert alert-danger text-center mt-3" role="alert">
                Kelas Tidak Ditemukan
            </div>
        <?php endif; ?>
        <?php foreach ($kls_mentor as $klsm) : ?>
            <h5 class="border-start border-4 border-warning ps-3">Kelas <?= $klsm['nama_kls']; ?></h5>
            <a class="badge text-bg-success text-white pointer fw-normal text-break" data-bs-toggle="modal" data-bs-target="#list-santri<?= str_replace(' ', '', $klsm['nama_kls']); ?>">List Santri</a>
            <!-- Modal detail kelas -->
            <div class="modal fade" id="list-santri<?= str_replace(' ', '', $klsm['nama_kls']); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title border-start border-4 border-warning ps-2" id="exampleModalLabel">List Santri Kelas <b><?= $klsm['nama_kls']; ?></b></h5>
                        </div>
                        <?php $list_santri = $this->Mentor_model->listSantriDalamKls($klsm['nama_kls']); ?>
                        <div class="modal-body text-capitalize">
                            <table class="table table-borderless mb-0 table-sm w-auto">
                                <tbody>
                                    <?php foreach ($list_santri as $lssan) : ?>
                                        <tr>
                                            <th scope="row" class="text-mapel-mentor"><?= $lssan['nama']; ?></th>
                                            <td>-</td>
                                            <td class="text-mapel-mentor"><?= $lssan['no_hp']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-3 mb-5">
                <?php foreach ($hari as $h) : ?>
                    <?php $jadwal = $this->Mentor_model->jadwalMentor($klsm['nama_kls'], $h, $klsm['id_mentor']); ?>
                    <?php if ($jadwal != null) { ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-3 mt-3">
                            <div class="card shadow position-relative pt-4">
                                <div class="card position-absolute rounded-4 header-hari text-white ms-2">
                                    <div class="card-body pt-2 pb-2 ps-3 pe-3">
                                        <h5 class="fs-6 mb-0" id="hari"><?= $h; ?></h5>
                                    </div>
                                </div>
                                <div class="card-body text-center overflow-hidden pt-2">
                                    <table class="table table-sm align-middle table-jadwal mx-auto table-borderless mb-0 text-capitalize">
                                        <tbody>
                                            <?php foreach ($jadwal as $j) : ?>
                                                <tr class="border border-bottom-0">
                                                    <th scope="row" class="text-break"><?= $j['nama_mapel']; ?></th>
                                                    <td><?= date('H:i', strtotime($j['jam_masuk'])); ?></td>
                                                    <td>-</td>
                                                    <td><?= date('H:i', strtotime($j['jam_keluar'])); ?></td>
                                                </tr>
                                                <tr class="border border-top-0">
                                                    <th colspan="4" scope="row" class="text-break">
                                                        <?= $j['nama']; ?>
                                                    </th>
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
</div>
<!--Container Main end-->