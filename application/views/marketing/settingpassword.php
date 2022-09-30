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
    <div class="container">
        <h3 class="text-dark text-break my-3 border-warning border-3 border-start ps-3"><b>Setting</b> Password Anda!</h3>
    </div>
    <div class="px-3 mb-5">
        <div class="card mb-3 mx-auto h-auto col-lg-7 col-md-9 shadow overflow-hidden">
            <div class="card-body">
                <form action="<?= base_url('marketing/settingpassword'); ?>" method="post">
                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                    <input type="hidden" name="id" value="<?= $profile['id']; ?>">
                    <div class="row mb-3 align-items-center">
                        <label for="password_lama" class="col-sm-5 col-form-label">Masukkan Password Sekarang</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control rounded-4" id="password_lama" name="password_lama">
                            <?= form_error('password_lama', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <label for="password_baru1" class="col-sm-5 col-form-label">Password Baru</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control rounded-4" id="password_baru1" name="password_baru1">
                            <?= form_error('password_baru1', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <label for="password_baru2" class="col-sm-5 col-form-label">Repeat Password Baru</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control rounded-4" id="password_baru2" name="password_baru2">
                            <?= form_error('password_baru2', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                </form>
            </div>
        </div>
    </div>
</div>