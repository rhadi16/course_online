<!-- Main Wrapper -->
<div class="my-container active-cont position-relative">
    <!-- Top Nav -->
    <nav class="navbar top-navbar navbar-light px-5 sticky-top shadow">
        <a class="btn" id="menu-btn"><i class="fas fa-bars"></i></a>
    </nav>
    <!--End Top Nav -->
    <div class="container">
        <h3 class="text-dark text-break my-3 border-warning border-3 border-start ps-3"><b>Selamat</b> Datang <?= $profile['nama']; ?>!</h3>
    </div>
    <div class="px-3 mb-5">
        <div class="card mb-3 mx-auto h-auto col-lg-7 col-md-9 shadow">
            <div class="row g-0">
                <div class="col-md-6 col-sm-12">
                    <div class="img-profile h-100 w-100 rounded" style="background-image: url('<?= base_url('assets/img-profile/') . $profile['image']; ?>')"></div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card-body fs-6">
                        <h5 class="card-title text-capitalize fs-5"><?= $profile['nama']; ?></h5>
                        <p class="card-text fs-6"><?= $account['email']; ?></p>
                        <p class="card-text fs-6"><small class="text-muted"><?= date_indo(date('Y-m-d', strtotime($account['date_created']))); ?></small></p>
                        Mata Pelajaran yang Diajarkan<br>
                        <?php $mMentor = $this->Admin_model->mapelMentor($profile['id']); ?>
                        <?php if (empty($mMentor)) : ?>
                            <div class="text-danger text-center">
                                Belum Ada
                            </div>
                        <?php endif; ?>
                        <?php foreach ($mMentor as $mm) : ?>
                            - <?= $mm['nama_mapel']; ?><br>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>