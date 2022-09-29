<div class="container">
    <div class="card card-parent shadow col-lg-5 mx-auto h-auto mb-5">
        <div class="card-body p-0">
            <div class="card mx-auto w-50 ket sign-up-logo">
                <div class="card-body p-0">
                    <img src="<?= base_url('assets/img-login/logo.png'); ?>" class="img-fluid" alt="...">
                </div>
            </div>
            <div class="row h-100">
                <div class="col-sm-12 px-5">
                    <form action="<?= base_url('auth/registrasi'); ?>" method="post">
                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                        <div class="form-floating mb-3">
                            <input type="text" id="nama" class="form-control rounded-4" name="nama" value="<?= set_value('nama'); ?>" placeholder="Nama">
                            <label for="nama">Nama</label>
                            <?= form_error('nama', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" id="asal" class="form-control rounded-4" name="asal" value="<?= set_value('asal'); ?>" placeholder="Asal">
                            <label for="asal">Asal</label>
                            <?= form_error('asal', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" id="tglahir" class="form-control rounded-4" name="tglahir" value="<?= set_value('tglahir'); ?>" placeholder="Tanggal Lahir">
                            <label for="tglahir">Tanggal Lahir</label>
                            <?= form_error('tglahir', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" id="no_hp" class="form-control rounded-4" name="no_hp" value="<?= set_value('no_hp'); ?>" placeholder="Nomor HP">
                            <label for="no_hp">Nomor HP</label>
                            <?= form_error('no_hp', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" id="email" class="form-control rounded-4" placeholder="Email" name="email" value="<?= set_value('email'); ?>">
                            <label for="email">Email</label>
                            <?= form_error('email', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select rounded-4" id="lok_inter" aria-label="Floating label select example" name="lok_inter">
                                <option selected value="0">Pilih Lokasi Mentoring</option>
                                <?php foreach ($lok_int as $li) : ?>
                                    <option value="<?= $li['id']; ?>"><?= $li['negara'] . ', ' . $li['provinsi'] . ', ' . $li['kota'] . ', ' . $li['alamat']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="lok_inter">Pilih Lokasi Mentoring</label>
                            <?= form_error('lok_inter', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" id="password" class="form-control rounded-4" placeholder="Password" name="password">
                            <label for="password">Password</label>
                            <?= form_error('password', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" id="repeat_password" class="form-control rounded-4" placeholder="Repeat Password" name="repeat_password">
                            <label for="repeat_password">Repeat Password</label>
                            <?= form_error('repeat_password', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn rounded-5 py-2 ket text-white"><i class="fas fa-registered px-2"></i>Registrasi Akun</button>
                        </div>
                    </form>
                    <hr>
                    <a href="<?= base_url(); ?>" class="text-warning w-100 d-block text-center mt-2 text-decoration-none mb-3"><b>Login!</b></a>
                </div>
            </div>
        </div>
    </div>
</div>