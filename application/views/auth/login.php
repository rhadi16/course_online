<div class="position-fixed mt-4 end-0 alerting">
    <?= $this->session->flashdata('flash'); ?>
</div>
<div class="col-md-6 col-lg-6 col-sm-12 ket vh-100 p-4">
    <div class="row align-content-between h-100 text-white">
        <div class="col-12">
            <img src="<?= base_url('assets/img-login/logo.png'); ?>" class="brand-logo" alt="...">
        </div>
        <div class="col-12">
            <ul class="ps-4 start-text">
                <li class="p-0">Sibuk bekerja sehingga tidak punya waktu untuk mendidik anak dengan Al-Qur'an</li>
                <li class="p-0">Belum menemukan metode belajar yang cocok untuk anak</li>
                <li class="p-0">Belum mempunyai ilmu Al-Qur'an yang memadai untuk mengajari anak</li>
                <li class="p-0">Jauhnya akses pendidikan Al-Qur'an dari tempat tinggal</li>
            </ul>
            <p class="middle-text">Kaffah Priority Menghadirkan Solusi</p>
            <p class="end-text">Dengan Program-Program Inovatif untuk Membantu Putra-Putri Anda Belajar Al-Qur’an dengan Nyaman, Mudah, Menyenangkan.</p>
        </div>
        <div class="col-12 text-center hadist fst-italic">
            <p>
                <b>Abdullah bin Mas’ud ra</b>. berkata: <br> “Siapa yang ingin mengetahui bahwa dia mencintai Allah dan Rasul-Nya, maka <br> perhatikanlah jika dia <b>mencintai Al-Qur’an</b> maka sesungguhnya <b>dia mencintai Allah dan Rasul-Nya</b>.” <br><br>(Atsar Shahih dalam kitab Syu’ab Al Iman Imam Al Baihaqi)
            </p>
        </div>
    </div>
</div>
<div class="col-md-6 col-lg-6 col-sm-12 vh-100">
    <div class="row align-content-center justify-content-center h-100">
        <div class="w-75">
            <div class="text-center">
                <img src="<?= base_url('assets/img-login/login.png'); ?>" class="logo-login text-center" alt="...">
            </div>
            <p class="text-muted text-form">Silahkan masukkan username dan password untuk bisa mengakses akun anda.</p>
            <form action="<?= base_url('auth'); ?>" method="post">
                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                <div class="mb-3 position-relative">
                    <i class="fa-regular fa-envelope position-absolute icon-input text-muted"></i>
                    <input type="text" class="form-control ps-5 py-2 pe-3 rounded-4" id="email" name="email" placeholder="Username">
                    <?= form_error('email', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                </div>
                <div class="mb-3 position-relative">
                    <i class="fa-solid fa-lock position-absolute icon-input text-muted"></i>
                    <input type="password" class="form-control ps-5 py-2 pe-3 rounded-4" id="password" name="password" placeholder="Password">
                    <?= form_error('password', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
                    <label class="form-check-label text-muted" for="remember">Remember Me</label>
                </div>
                <div class="text-center button">
                    <button type="submit" class="btn rounded-5 mt-2 mb-2 mx-auto px-5 btn-login text-white">Login</button>
                    <p class="text-muted mb-0">Belum Punya <a href="<?= base_url('auth/registrasi'); ?>" class="text-decoration-none lh-lg fs-6"><b>Akun</b></a>?</p>
                    <p class="text-muted">Anda <a href="#" class="text-decoration-none lh-lg fs-6"><b>Lupa Password</b></a>?</p>
                </div>
            </form>
        </div>
    </div>
</div>