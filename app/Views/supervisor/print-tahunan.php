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
        <div class="ror">
            <div class="col-md-12">
                <h5 class="float-right">Tanggal : <?= $sekarang; ?></h5>
            </div>
        </div>
        <br><br><br>
        <!-- Table rekapitulasi -->
        <div class="row">
            <div class="col-12">
                <h5 class="m-3 text-center">HASIL PENILAIAN STATUS KESEHATAN KELUARGA</h5><br>
                <table id="tabel-keluarga" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun Aktif</th>
                            <th>Tanggal Pendataan</th>
                            <th>No Kartu Keluarga</th>
                            <th>Kepala Keluarga</th>
                            <th>Kelurahan</th>
                            <th>RT</th>
                            <th>RW</th>
                            <th>Surveyor</th>
                            <th>Nlai</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($keluarga_terdata as $data) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $data['tahun_aktif']; ?></td>
                                <td><?= $data['tgl_pendataan']; ?></td>
                                <td><?= $data['nkk']; ?></td>
                                <td><?= $data['kepala_keluarga']; ?></td>
                                <td><?= $data['kelurahan']; ?></td>
                                <td><?= $data['rt']; ?></td>
                                <td><?= $data['rw']; ?></td>
                                <td><?= $data['name']; ?></td>
                                <td><?= $data['nilai'] ?></td>
                                <td><b><?= $data['nilai'] <= 50 ? 'Tidak sehat' : ($data['nilai'] > 50 && $data['nilai'] < 80 ? 'Pra-sehat' : 'Sehat'); ?><b></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <br><br><br><br>
        <div class="row">
            <div class="col-md-3 offset-md-9">
                <table class="text-center">
                    <tr>
                        <td>
                            MENGETAHUI :
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br><br><br><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h1>___________</h1><br>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

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