<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
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
                                    <th>no</th>
                                    <th>No Kartu Keluarga</th>
                                    <th>Kepala Keluarga</th>
                                    <th>Tanggal Pendataan</th>
                                    <th>Kelurahan</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($keluarga as $data) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $data['nkk']; ?></td>
                                        <td><?= $data['kepala_keluarga']; ?></td>
                                        <td><?= $data['tgl_pendataan']; ?></td>
                                        <td><?= $data['kelurahan']; ?></td>
                                        <td><?= $data['rt']; ?></td>
                                        <td><?= $data['rw']; ?></td>
                                        <td>
                                            <a href="http://localhost:8080/supervisor/hasil_analisis/<?= $data['nkk']; ?>/<?= $data['id_pendataan']; ?>" role="button" class="btn btn-sm btn-success"><i class="fas fa-file"></i> lihat data</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>No Kartu Keluarga</th>
                                    <th>Kepala Keluarga</th>
                                    <th>Tanggal Pendataan</th>
                                    <th>Kelurahan</th>
                                    <th>RT</th>
                                    <th>RW</th>
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
        <!-- .row -->
    </div>
    </div>

    </div>

</section>
<!-- /.content -->
<?= $this->endSection(); ?>