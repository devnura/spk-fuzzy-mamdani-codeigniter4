<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Main content -->
                <div class="invoice p-5 mb-3" id='DivIdToPrint'>
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <a>
                                    <img src="http://localhost:8080/img/keluarga_sehat.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8" width="3%">
                                    <span>UPTD PUSKESMAS CIKIJING</span>
                                </a>
                                <small class="float-right">Tanggal pendataan : <?= $sekarang; ?></small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row">
                        <div class="col-lg-12 text-center"><br>
                            <h4>HASIL PENILAIAN STATUS KESEHATAN KELUARGA</h4>
                        </div>
                        <br>
                    </div>
                    <dl class="row my-3">
                        <dt class="col-sm-2"> Kepala Keluarga </dt>
                        <dd class="col-sm-10">: <?= $keluarga['kepala_keluarga']; ?> </dd>
                        <dt class="col-sm-2"> No Kartu Keluarga </dt>
                        <dd class="col-sm-10">: <?= $keluarga['nkk']; ?> </dd>
                        <dt class="col-sm-2"> Kelurahan </dt>
                        <dd class="col-sm-10">: <?= $keluarga['kelurahan']; ?> </dd>
                        <dt class="col-sm-2"> Rt / Rw </dt>
                        <dd class="col-sm-10">: <?= $keluarga['rt']; ?> / <?= $keluarga['rw']; ?> </dd>
                    </dl>
                    <!-- /.row -->

                    <!-- Table rekapitulasi -->
                    <div class="row">
                        <div class="col-12">
                            <p class="lead">indikator kesehatan keluarga : </p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 8px">#</th>
                                        <th>indikator</th>
                                        <th style="width: 15%" class="text-center">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($hasil_kuesioner); $i++) { ?>
                                        <tr>
                                            <td>
                                                <?= (1 + $i); ?>
                                            </td>
                                            <td>
                                                <?= $kuesioner[$i]['indikator']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $hasil_kuesioner[$i]; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table Fuzzyfikasi -->
                    <div class="row">
                        <div class="col-12">
                            <p class="lead">Nilai Fuzzyfikasi : </p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 8px">#</th>
                                        <th style="width: 15%">Nilai Keanggotaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($fuzzyfikasi); $i++) { ?>
                                        <tr>
                                            <td><?= (1 + $i); ?></td>
                                            <td><?= $fuzzyfikasi[$i]['nilai']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table implikasi -->
                    <div class="row">
                        <div class="col-12">
                            <p class="lead">Nilai implikasi : </p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Predikat </th>
                                        <th style="width: 15%">Nilai </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($implikasi); $i++) { ?>
                                        <tr>
                                            <td><?= (1 + $i); ?></td>
                                            <td>Predikat- <?= (1 + $i); ?></td>
                                            <td><?= $implikasi[$i]['nilai_implikasi']; ?></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12">
                            <p class="lead">Nilai Komposisi Aturan : </p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Implikasi</th>
                                        <th style="width: 15%">nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($komposisi_aturan); $i++) { ?>
                                        <tr>
                                            <td><?= (1 + $i); ?></td>
                                            <td>nilai a-<?= (1 + $i); ?></td>
                                            <td><?= $komposisi_aturan[$i]['nilai']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12">
                            <p class="lead">Nilai Defuzzyfikasi : </p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th style="width: 15%">Nilai Momen</th>
                                        <th style="width: 15%">Nilai Luas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($defuzzyfikasi); $i++) { ?>
                                        <tr>
                                            <td>D<?= (1 + $i); ?></td>
                                            <td><?= $defuzzyfikasi[$i]['momen']; ?></td>
                                            <td><?= $defuzzyfikasi[$i]['luas']; ?></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->


                    <div class="row mt-3">
                        <!-- accepted payments column -->
                        <div class="col-6">

                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <p class="lead">Nilai Hasil Analisis</p>

                            <div class="table-responsive">
                                <table class="table text-nowarp">
                                    <tr>
                                        <th style="width:50%">Nilai Z :</th>
                                        <td><?= $nilai_z['nilai']; ?></td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Status :</th>
                                        <td>
                                            <h5><?= $status; ?></h5>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                </div>
                <div class="row no-print mt-3">
                    <div class="col-12">

                        <a href="http://localhost:8080/supervisor/to_print/<?= $keluarga['nkk']; ?>/<?= $id_pen; ?>" target="_blank" type="button" class="btn btn-primary float-right" id="btn-print" style="margin-right: 5px;">
                            <i class="fas fa-print"></i> Print
                        </a>
                    </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<!-- /.content  -->
<?= $this->endSection(); ?>