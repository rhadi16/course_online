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
    <?= form_open_multipart('mentor/edit'); ?>
    <div class="container">
        <h3 class="text-dark text-break my-3 border-warning border-3 border-start ps-3"><b>My</b> Profile!</h3>
        <div class="row">
            <div class="col-md-3 col-sm-12 mb-3">
                <div class="img-profile w-100 rounded shadow mb-3" style="background-image: url('<?= base_url('assets/img-profile/') . $profile['image']; ?>')"></div>
                <input class="form-control p-1 rounded-4" type="file" id="image" name="image">
            </div>
            <div class="col-md-9 col-sm-12 mb-5">
                <div class="card shadow">
                    <div class="card-body">
                        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                        <input type="hidden" name="id" value="<?= $profile['id']; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control rounded-4" id="email" placeholder="Email address" value="<?= $account['email']; ?>" name="email">
                                    <label for="email">Email address</label>
                                    <?= form_error('email', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control rounded-4" id="nama" placeholder="Nama" value="<?= $profile['nama']; ?>" name="nama">
                                    <label for="nama">Nama</label>
                                    <?= form_error('nama', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control rounded-4" id="asal" placeholder="Asal" value="<?= $profile['asal']; ?>" name="asal">
                                    <label for="asal">Asal</label>
                                    <?= form_error('asal', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control rounded-4" id="no_hp" placeholder="Nomor HP" value="<?= $profile['no_hp']; ?>" name="no_hp">
                                    <label for="no_hp">Nomor HP</label>
                                    <?= form_error('no_hp', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control rounded-4" id="tglahir" placeholder="Tanggal Lahir" value="<?= $profile['tglahir']; ?>" name="tglahir">
                                    <label for="tglahir">Tanggal Lahir</label>
                                    <?= form_error('tglahir', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select rounded-4" aria-label="Default select example" name="lok_inter" id="lok_inter">
                                        <option value="0">Pilih Lokasi Mentoring</option>
                                        <?php foreach ($lok_int as $li) : ?>
                                            <option <?= $retVal = ($li['id'] == $profile['lok_inter']) ? "selected" : ""; ?> value="<?= $li['id']; ?>"><?= $li['negara'] . ', ' . $li['provinsi'] . ', ' . $li['kota'] . ', ' . $li['alamat']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="lok_inter">Lokasi Mentoring</label>
                                    <?= form_error('lok_inter', '<p class="m-0 form-text text-danger text-center">', '</p>'); ?>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>