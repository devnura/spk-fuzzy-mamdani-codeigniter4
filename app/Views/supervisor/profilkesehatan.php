<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card animated fadeInDown">
                    <div class="text-center m-2">
                        <img class="img-thumbnail" src="http://localhost:8080/img/bussiness/046-data analytics.svg">
                        <h3>Hasil Analisis</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-12">
                        <div class="card animated fadeInDown">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <h3 class="card-title">Data Keluarga</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <?php if (session()->getFlashdata('success')) : ?>
                                    <div class="alert alert-success alert-dismissible fade show animated headShake" role="alert">
                                        <?= session()->getFlashdata('success'); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <?php if (session()->getFlashdata('success_delete')) : ?>
                                    <div class="alert alert-success alert-dismissible fade show animated headShake" role="alert">
                                        <?= session()->getFlashdata('success_delete'); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <table id="tabel-tahun" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tahun Aktif</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show-data">
                                        <?php foreach ($data_tahun_aktif as $row) : ?>
                                            <tr>
                                                <td><?= $row['tahun_aktif']; ?></td>

                                                <td>
                                                    <a href="http://localhost:8080/supervisor/view_tahun/<?= $row['tahun_aktif']; ?>" class="btn btn-sm btn-success"><i class="fas fa-file"></i> Lihat Data</a>
                                                    <a href="http://localhost:8080/supervisor/to_print_tahun/<?= $row['tahun_aktif']; ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fas fa-print"></i> Cetak Data</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Tahun Aktif</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>

        <!-- .row -->
    </div>
    </div>

    </div>

</section>
<!-- /.content -->
<?= $this->endSection(); ?>