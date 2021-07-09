<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <?php if (session()->getFlashdata('welcome')) : ?>
            <div class="alert alert-success alert-dismissible fade show animated headShake" role="alert">
                Selamat datang <?= session()->get('name') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="row">
            <!-- Surveyor -->
            <div class="col-lg-3">
                <!-- menu surveyor -->
                <?php if (session('level') == 3) {
                ?>
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                Menu Surveyor
                            </div>
                            <div class="card-body">
                                <a href="http://localhost:8080/datakeluarga" class="info-box bg-success">
                                    <div class="info-box-content">
                                        <div class="text-center">
                                            <img src="img/bussiness/022-file.svg" width="30%" class="img-fluid">
                                        </div>
                                        <span class="info-box-text mt-2 text-center">
                                            <h6>Data Keluarga</h6>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </a>
                                <!-- /.info-box -->

                                <!-- /.col -->
                                <!-- fix for small devices only -->
                                <div class="clearfix hidden-md-up"></div>

                                <a href="http://localhost:8080/profilkesehatan" class="info-box bg-success">
                                    <div class="info-box-content">
                                        <div class="text-center">
                                            <img src="img/bussiness/026-checklist.svg" width="30%" class="img-fluid">
                                        </div>
                                        <span class="info-box-text mt-2 text-center">
                                            <h6>Profil Kesehatan</h6>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </a>

                                <a href="http://localhost:8080/profilkesehatan" class="info-box bg-success">
                                    <div class="info-box-content">
                                        <div class="text-center">
                                            <img src="img/bussiness/031-time management.svg" width="30%" class="img-fluid">
                                        </div>
                                        <span class="info-box-text mt-2 text-center">
                                            <h6>Riwayat pendataan</h6>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </a>
                                <!-- /.info-box -->
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>
                    <!-- menu supervisor -->
                <?php } else if (session('level') == 2) { ?>
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                Menu Supervisor
                            </div>
                            <div class="card-body">
                                <a href="http://localhost:8080/supervisor" class="info-box bg-warning">
                                    <div class="info-box-content">
                                        <div class="text-center">
                                            <img src="img/bussiness/046-data analytics.svg" width="30%" class="img-fluid">
                                        </div>
                                        <span class="info-box-text mt-2 text-center">
                                            <h6>Hasil Analisis</h6>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </a>
                                <!-- /.info-box -->
                            </div>
                        </div>
                    </div>
                    <!-- menu admin -->
                <?php } else if (session('level') == 1) { ?>
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                Menu Admin
                            </div>
                            <div class="card-body">
                                <a href="http://localhost:8080/admin/manage_user" class="info-box bg-danger">
                                    <div class="info-box-content">
                                        <div class="text-center">
                                            <img src="img/bussiness/001-management.svg" width="30%" class="img-fluid">
                                        </div>
                                        <span class="info-box-text mt-2 text-center">
                                            <h6>Kelola user</h6>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </a>
                                <!-- /.info-box -->

                                <!-- /.col -->
                                <!-- fix for small devices only -->
                                <div class="clearfix hidden-md-up"></div>

                                <a href="http://localhost:8080/kriteria" class="info-box bg-danger">
                                    <div class="info-box-content">
                                        <div class="text-center">
                                            <img src="img/bussiness/016-chart.svg" width="30%" class="img-fluid">
                                        </div>
                                        <span class="info-box-text mt-2 text-center">
                                            <h6>Kelola kritieria</h6>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </a>

                                <a href="http://localhost:8080/admin/kelola_indikator" class="info-box bg-danger">
                                    <div class="info-box-content">
                                        <div class="text-center">
                                            <img src="img/bussiness/002-stamp.svg" width="30%" class="img-fluid">
                                        </div>
                                        <span class="info-box-text mt-2 text-center">
                                            <h6>Kelola Indikator</h6>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </a>
                                <!-- /.info-box -->
                                <!-- /.info-box -->
                                <!-- <a href="http://localhost:8080/admin/kelola_tahun_aktif" class="info-box bg-danger">
                                    <div class="info-box-content">
                                        <div class="text-center">
                                            <img src="http://localhost:8080/img/bussiness/030-briefcase.svg" width="30%" class="img-fluid">
                                        </div>
                                        <span class="info-box-text mt-2 text-center">
                                            <h6>Kelola Target Wilayah</h6>
                                        </span>
                                    </div>
                                </a>
                            -->
                                <a href="http://localhost:8080/admin/kelola_tahun_aktif" class="info-box bg-danger">
                                    <div class="info-box-content">
                                        <div class="text-center">
                                            <img src="http://localhost:8080/img/bussiness/017-schedule.svg" width="30%" class="img-fluid">
                                        </div>
                                        <span class="info-box-text mt-2 text-center">
                                            <h6>Kelola Tahun Aktif</h6>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </a>
                                <!-- /.info-box -->
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-lg-9">
                <div class="card bg-light">

                    <div class="card-body mx-5">
                        <div class="row">
                            <div class="col-md-12 text-center mb-3">
                                <h1>
                                    UPTD Puskesmas Cikijing
                                </h1>
                            </div>
                        </div>
                        <div class="row animated fadeInDown">
                            <div class="col-12">
                                <div class="col-md-12 text-center">
                                    <div class="logo">
                                        <img src="img/majalengka.png" width="15%" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row animated fadeInDown mt-3">
                            <div class="col-12">
                                <div class="col-md-12 text-center">
                                    <div class="logo">
                                        <h3>Sistem Penunjang Keputusan
                                            <br>Untuk Menentukan Status Kesehatan Keluarga</h3>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-3 animated fadeIn delay-1s">
                            <div class="col-12">
                                <div class="row">
                                    Aplikasi ini adalah SPK untuk menentukasn setatus kesehatan keluarga dengan menggunakan metode perhitungan Fuzzy Mamdani dengan kriteria-kriteria yang telah ditentukan dalam "buku pedoman umum program indonesia sehat dengan pendekatan keluarga" oleh Kementrian Kesehatan Republik Indonesia tahuan 2016. buku tersebut bisa diunduh <a href="as">disini</a>
                                </div>
                                <div class="row mt-2">
                                    kriteria yang terdapat dalam buku pedoman diantaranya :
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <ul>
                                            <li>Keluarga mengikuti program Keluarga Berencana (KB)</li>
                                            <li>Ibu melakukan persalinan di fasilitas kesehatan</li>
                                            <li>Bayi mendapat imunisasi dasar lengkap</li>
                                            <li>Bayi mendapat air susu ibu (ASI) eksklusif</li>
                                            <li>Balita mendapatkan pemantauan pertumbuhan</li>
                                            <li>Penderita tuberkulosis paru mendapatkan pengobatan sesuai standar</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul>
                                            <li>Penderita hipertensi melakukan pengobatan secara teratur</li>
                                            <li>Penderita gangguan jiwa mendapatkan pengobatan dan tidak ditelantarkan</li>
                                            <li>Anggota keluarga tidak ada yang merokok</li>
                                            <li>Keluarga sudah menjadi anggota Jaminan Kesehatan Nasional (JKN)</li>
                                            <li>Keluarga mempunyai akses sarana air bersih</li>
                                            <li>Keluarga mempunyai akses atau menggunakan jamban sehat</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    Aktor Aplikasi Web Keluarga Sehat (KS)
                                    <ul>
                                        <li>Administrator</li>
                                        <p>
                                            Administrator / Operator Puskesmas
                                            Merupakan aktor yang bertugas melakukan administrasi sistem.
                                            Aktor ini memiliki tugas dan kewenangan untuk membuat (Create) aktor pengguna lainnya di level puskesmas yaitu aktor supervisor dan aktor
                                            pengumpul data/ enumerator/surveyor.
                                        </p>
                                        <li>Supervisor</li>
                                        <p>
                                            Merupakan aktor yang bertugas melakukan review terhadap kinerja para enumerator/surveyor di lapangan.
                                            aktor ini juga berkewanangan untuk melakukan pengambilan keputusan terhadap intervensi yang akan dilakukan
                                        </p>
                                        <li>Surveyor</li>
                                        <p>
                                            Merupakan aktor yang bertugas melakukan entri data kuesioner KS di lapangan
                                        </p>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
<?= $this->endSection(); ?>