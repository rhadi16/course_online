<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $judul; ?></title>
    <!-- CSS Bootstrap 5 -->
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap5/css/bootstrap.min.css'); ?>">
    <!-- Icon -->
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Viga&display=swap" rel="stylesheet">
    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <!-- My CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin_style.css'); ?>">
</head>

<body id="body-pd" class="bg-gray-200">
    <header class="header mb-3 shadow" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        <div class="header_img">
            <div class="img-profile h-100 w-100" style="background-image: url('<?= base_url('assets/img-profile/not.jpg') ?>')"></div>
        </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div class="h-90">
                <a href="#" class="nav_logo ps-2 mb-3">
                    <img src="<?= base_url('assets/img-login/icon.png'); ?>" class="brand-logo" alt="...">
                    <div>
                        <span class="nav_logo-name fs-4 d-block">KAFFAH</span>
                        <span class="fs-6 d-block text-white ms-2">PRIORITY</span>
                    </div>
                </a>
                <div class="nav_list h-80 overflow-auto">
                    <a href="<?= base_url('admin') ?>" class="nav_link <?php if ($judul == "Home") {
                                                                            echo "active";
                                                                        } ?>">
                        <i class='fa-solid fa-house nav_icon'></i>
                        <span class="nav_name fs-6">Home</span>
                    </a>
                    <a href="<?= base_url('admin/akun_baru') ?>" class="nav_link <?php if ($judul == "Kelola Akun Baru") {
                                                                                        echo "active";
                                                                                    } ?>">
                        <i class="fa-solid fa-square-plus nav_icon"></i>
                        <span class="nav_name fs-6">Kelola Akun Baru</span>
                    </a>
                    <a href="<?= base_url('admin/mapel') ?>" class="nav_link <?php if ($judul == "Kelola Mata Pelajaran") {
                                                                                    echo "active";
                                                                                } ?>">
                        <i class="fa-solid fa-book nav_icon"></i>
                        <span class="nav_name fs-6">Kelola Mata<br>Pelajaran</span>
                    </a>
                    <a href="<?= base_url('admin/lokasi_internasional') ?>" class="nav_link <?php if ($judul == "Kelola Lokasi Internasional") {
                                                                                                echo "active";
                                                                                            } ?>">
                        <i class="fa-solid fa-globe nav_icon"></i>
                        <span class="nav_name fs-6">Kelola Lokasi<br>Internasional</span>
                    </a>
                    <a href="<?= base_url('admin/jadwal_kelas') ?>" class="nav_link <?php if ($judul == "Kelola Jadwal Kelas") {
                                                                                        echo "active";
                                                                                    } ?>">
                        <i class="fa-solid fa-list nav_icon"></i>
                        <span class="nav_name fs-6">Kelola Jadwal Kelas</span>
                    </a>
                    <a href="<?= base_url('admin/mentor') ?>" class="nav_link <?php if ($judul == "Kelola Mentor") {
                                                                                    echo "active";
                                                                                } ?>">
                        <i class="fa-solid fa-person-chalkboard nav_icon"></i>
                        <span class="nav_name fs-6">Kelola Mentor</span>
                    </a>
                    <a href="<?= base_url('admin/marketing') ?>" class="nav_link <?php if ($judul == "Kelola Marketing") {
                                                                                        echo "active";
                                                                                    } ?>">
                        <i class="fa-solid fa-money-bill-trend-up nav_icon"></i>
                        <span class="nav_name fs-6">Kelola Marketing</span>
                    </a>
                    <a href="<?= base_url('admin/santri') ?>" class="nav_link <?php if ($judul == "Kelola Santri") {
                                                                                    echo "active";
                                                                                } ?>">
                        <i class="fa-solid fa-user-plus nav_icon"></i>
                        <span class="nav_name fs-6">Kelola Santri</span>
                    </a>
                    <!-- <a href="<?= base_url('admin/absen_santri') ?>" class="nav_link <?php if ($judul == "Absensi Santri") {
                                                                                                echo "active";
                                                                                            } ?>">
                        <i class="fa-solid fa-clipboard-check nav_icon"></i>
                        <span class="nav_name fs-6">Absensi Santri</span>
                    </a> -->
                </div>
            </div>
            <div class="h-10">
                <a class="nav_link nav_icon" id="logout" onclick="logout('<?= base_url('auth/logout'); ?>')"><i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Logout</span> </a>
            </div>
        </nav>
    </div>