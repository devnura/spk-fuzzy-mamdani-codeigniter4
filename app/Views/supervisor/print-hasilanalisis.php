<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Dashboard 2</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://localhost:8080/themes/plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="http://localhost:8080/themes/dist/css/adminlte.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="http://localhost:8080/themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="http://localhost:8080/themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="http://localhost:8080/themes/plugins/jquery-ui/jquery-ui.min.css">

    <!-- animate -->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="http://localhost:8080/text/css" href="themes/dist/animate/animate.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="http://localhost:8080/themes/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="http://localhost:8080/themes/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="http://localhost:8080/themes/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="http://localhost:8080/themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

</head>

<body>

    <div class="invoice p-5 mb-3" id='DivIdToPrint'>
        <!-- title row -->
        <div class="row text-center">
            <div class="col-md-2">
                <img src="http://localhost:8080/img/majalengka1.png" width="70%">
            </div>
            <div class="col-md-8">
                <h4>PEMERINTAH KABUPATEN MAJALENGKA</h4>
                <h3>DINAS KESEHATAN</h3>
                <h3>UPTD PUSKESMAS CIKIJING</h3>
                <p>Jl. Raya Kasturi No. 29 Telp. (0233) 319082 <br>Email: pkmckjml@yahoo.co.id</p>
            </div>
            <div class="col-md-2">
                <img src="http://localhost:8080/img/logo-puskes.jpg" width="140px">
            </div>
            <!-- /.col -->
        </div>
        <hr>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <h5 class="float-right">Tanggal : <?= $sekarang; ?></h5>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12 text-center">
                <br>
                <br>
                <h4>HASIL PENILAIAN STATUS KESEHATAN KELUARGA</h4>
            </div>
        </div>
        <!-- info row -->
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
                <p class="lead">Indikator kesehatan keluarga : </p>
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
                                <td>nilai a<?= (1 + $i); ?></td>
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
                            <td><?= $status; ?></td>
                        </tr>

                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- this row will not appear when printing -->
    </div>

</body>


<!-- jQuery -->
<script src="http://localhost:8080/themes/plugins/jquery/jquery.min.js"></script>
<script src="http://localhost:8080/themes/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="http://localhost:8080/themes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- jquery-validation -->
<script src="http://localhost:8080/themes/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="http://localhost:8080/themes/plugins/jquery-validation/additional-methods.min.js"></script>

<!-- AdminLTE App -->
<script src="http://localhost:8080/themes/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="http://localhost:8080/themes/dist/js/demo.js"></script>

<!-- DataTables -->
<script src="http://localhost:8080/themes/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="http://localhost:8080/themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="http://localhost:8080/themes/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="http://localhost:8080/themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- Select2 -->
<script src="http://localhost:8080/themes/plugins/select2/js/select2.full.min.js"></script>

<!-- web script -->
<script src="http://localhost:8080/js/<?= $page; ?>.js"></script>
<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>
</body>

</html>