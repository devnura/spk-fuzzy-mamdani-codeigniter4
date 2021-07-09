<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row animated fadeInDown">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h3 class="card-title">Pendataan</h3>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-add">
                                    Tambah Data
                                </button>
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
                        <!-- table -->
                        <table id="tabel-pendataan-keluarga" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pendataan</th>
                                    <th>Status Pendataan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($data_pendataan as $data) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $data['tgl_pendataan']; ?></td>
                                        <td>
                                            <?php if ($data['status_pendataan'] == 1) : ?>
                                                <span class="badge badge-success">Lengkap</span>
                                            <?php else : ?>
                                                <span class="badge badge-warning">Belum Lengkap</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($data['status_pendataan'] == 1) : ?>
                                                <a href="http://localhost:8080/profilkesehatan/indikator/<?= $data['nkk']; ?>/<?= $data['id_pendataan']; ?>" role="button" class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Lihat data</a>
                                            <?php else : ?>
                                                <a href="http://localhost:8080/profilkesehatan/indikator/<?= $data['nkk']; ?>/<?= $data['id_pendataan']; ?>" role="button" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Lengkapi data</a>
                                            <?php endif; ?>
                                            <a href="http://localhost:8080/profilkesehatan/delete/<?= $data['nkk']; ?>/<?= $data['id_pendataan']; ?>" role="button" class="btn btn-sm btn-danger ml-2"><i class="fas fa-trash"></i> Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pendataan</th>
                                    <th>Status Pendataan</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- /table -->
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>

            <!-- /.card -->
        </div>
        <!-- .row -->
    </div>
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tanggal Pendataan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= $form_action; ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="tgl_pendataan" required class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : ''; ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask id="tanggal_pendataan" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</section>

<?= $this->endSection(); ?>