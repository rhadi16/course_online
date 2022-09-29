<div class="container pt-4 pb-5">
    <h5 class="fw-bold">Dashboard Admin</h5>
    <hr>
    <div class="row mt-4">
        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="card shadow-sm position-relative pt-4">
                <div class="card position-absolute rounded-4 header-card-dash text-white top-0 end-0 me-2 mt-2">
                    <div class="card-body pt-2 pb-2 ps-3 pe-3">
                        <h5 class="fs-6 mb-0">Marketing</h5>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Total : <?= $jum_marketing; ?></h6>
                    <div>
                        <canvas id="chart_marketing"></canvas>
                    </div>
                    <!-- <table class="table table-borderless mb-0 table-sm text-center">
                        <tbody>
                            <tr>
                                <?php foreach ($detJumMarketing as $djm) : ?>
                                    <th scope="row" class="text-mapel-mentor">
                                        <?= $djm['status']; ?><br>
                                        <?= $djm['jum_status']; ?>
                                    </th>
                                <?php endforeach; ?>
                            </tr>
                        </tbody>
                    </table> -->
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="card shadow-sm position-relative pt-4">
                <div class="card position-absolute rounded-4 header-card-dash text-white top-0 end-0 me-2 mt-2">
                    <div class="card-body pt-2 pb-2 ps-3 pe-3">
                        <h5 class="fs-6 mb-0">Mentor</h5>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Total : <?= $jum_mentor; ?></h6>
                    <!-- <div>
                        <canvas id="chart_mentor"></canvas>
                    </div> -->
                    <table class="table table-borderless mb-0 table-sm w-75">
                        <tbody>
                            <?php foreach ($allMapel as $am) : ?>
                                <?php $jum_mentor_mapel = $this->Admin_model->detJumMentorMapel($am['id']); ?>
                                <tr>
                                    <th scope="row" class="text-mapel-mentor"><?= $am['nama_mapel']; ?></th>
                                    <th>:</th>
                                    <th><?= $jum_mentor_mapel['jum_mapel']; ?></th>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="card shadow-sm position-relative pt-4">
                <div class="card position-absolute rounded-4 header-card-dash text-white top-0 end-0 me-2 mt-2">
                    <div class="card-body pt-2 pb-2 ps-3 pe-3">
                        <h5 class="fs-6 mb-0">Santri</h5>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Total : <?= $jum_santri; ?></h6>
                    <div>
                        <canvas id="chart_santri"></canvas>
                    </div>
                    <!-- <table class="table table-borderless mb-0 table-sm text-center">
                        <tbody>
                            <tr>
                                <th scope="row" class="text-mapel-mentor">
                                    Santri Baru<br>
                                    <?= $jum_santri_baru; ?>
                                </th>
                                <th scope="row" class="text-mapel-mentor">
                                    Santri Lama<br>
                                    <?= $jum_santri_lama; ?>
                                </th>
                            </tr>
                        </tbody>
                    </table> -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // marketing
    const labels_marketing = [
        <?php foreach ($detJumMarketing as $djm) : ?> '<?= $djm['status']; ?>',
        <?php endforeach; ?>
    ];
    const jum_data_marketing = [
        <?php foreach ($detJumMarketing as $djm) : ?>
            <?= $djm['jum_status']; ?>,
        <?php endforeach; ?>
    ];

    const data_marketing = {
        labels: labels_marketing,
        datasets: [{
            label: 'Jumlah Status Marketing',
            barPercentage: 0.5,
            backgroundColor: [
                'rgba(255, 153, 0, 0.8)',
                'rgba(204, 102, 0, 0.8)',
                'rgba(193, 49, 0, 0.8)',
                'rgba(255, 251, 208, 0.8)',
                'rgba(255, 204, 0, 0.8)',
            ],
            data: jum_data_marketing,
        }]
    };

    const config_marketing = {
        type: 'pie',
        data: data_marketing,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    const chart_marketing = new Chart(
        document.getElementById('chart_marketing'),
        config_marketing
    );

    // santri
    const labels_santri = [
        'Santri Baru',
        'Santri Lama',
    ];
    const jum_data_santri = [
        <?= $jum_santri_baru; ?>,
        <?= $jum_santri_lama; ?>
    ];

    const data_santri = {
        labels: labels_santri,
        datasets: [{
            label: 'Jumlah Santri',
            barPercentage: 0.5,
            backgroundColor: [
                'rgba(255, 153, 0, 0.8)',
                'rgba(204, 102, 0, 0.8)',
                'rgba(193, 49, 0, 0.8)',
                'rgba(255, 251, 208, 0.8)',
                'rgba(255, 204, 0, 0.8)',
            ],
            data: jum_data_santri,
        }]
    };

    const config_santri = {
        type: 'pie',
        data: data_santri,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    const chart_santri = new Chart(
        document.getElementById('chart_santri'),
        config_santri
    );
</script>