<!--Container Main start-->
<div class="my-container active-cont position-relative">
    <!-- Top Nav -->
    <nav class="navbar top-navbar navbar-light bg-dark px-5 sticky-top">
        <a class="btn border-0" id="menu-btn"><i class="fas fa-bars"></i></a>
    </nav>
    <div class="container mt-3">
        <?= $this->session->flashdata('flash'); ?>
    </div>
    <!--End Top Nav -->
    <div class="container">
        <?php if (empty($kls_mentor)) : ?>
            <div class="alert alert-danger text-center mt-3" role="alert">
                Kelas Tidak Ditemukan
            </div>
        <?php endif; ?>
        <?php foreach ($kls_mentor as $klsm) : ?>
            <h5 class="text-center">Kelas <?= $klsm['nama_kls']; ?> <a class="fs-6 pointer" data-bs-toggle="modal" data-bs-target="#list-santri"><i class="fa-solid fa-circle-info"></i></a></h5>
            <!-- Modal detail kelas -->
            <div class="modal fade" id="list-santri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mx-auto" id="exampleModalLabel">List Siswa Kelas <?= $klsm['nama_kls']; ?></h5>
                        </div>
                        <div class="modal-body text-capitalize">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($list_santri as $lssan) : ?>
                                    <li class="list-group-item">
                                        <?= $lssan['nama'] . ' - ' . $lssan['no_hp']; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3 mb-5">
                <?php foreach ($hari as $h) : ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-3 mt-3">
                        <div class="card shadow">
                            <div class="card-body text-center pt-4">
                                <div class="card position-absolute rounded-4 header-hari text-white">
                                    <div class="card-body pt-2 pb-2 ps-3 pe-3">
                                        <h5 class="fs-6 mb-0" id="hari"><?= $h; ?></h5>
                                    </div>
                                </div>
                                <?php $jadwal = $this->Mentor_model->jadwalMentor($klsm['nama_kls'], $h, $klsm['id_mentor']); ?>
                                <?php if (empty($jadwal)) : ?>
                                    <span class="fw-normal size-08 text-danger">Jadwal Belum Ada</span>
                                <?php endif; ?>
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
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!--Container Main end-->