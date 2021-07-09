<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card animated fadeInDown">
                    <div class="text-center">
                        <img class="img-fluid img-circle" src="http://localhost:8080/themes/dist/img/family.png" alt="User profile picture">
                        <div class="card-footer">
                            <h3>Data Keluarga</h3>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-9">
                <div class="card animated fadeInDown">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-10">
                                <h3 class="card-title">Data Keluarga</h3>
                            </div>
                            <div class="col-lg-2">
                                <a href="http://localhost:8080/datakeluarga/detil_keluarga" role="button" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus"></i> Tambah data</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
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
                                <div class="table-responsive">
                                    <table id="tabel-keluarga" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>no</th>
                                                <th>No Kartu Keluarga</th>
                                                <th>Kepala Keluarga</th>
                                                <th>Kelurahan</th>
                                                <th>RT</th>
                                                <th>RW</th>
                                                <th>Anggota Keluarga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="show-data">
                                            <?php $i = 1; ?>
                                            <?php foreach ($keluarga as $data) : ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $data['nkk']; ?></td>
                                                    <td><?= $data['kepala_keluarga']; ?></td>
                                                    <td><?= $data['kelurahan']; ?></td>
                                                    <td><?= $data['rt']; ?></td>
                                                    <td><?= $data['rw']; ?></td>
                                                    <td>
                                                        <a href="http://localhost:8080/anggotakeluarga/keluarga/<?= $data['nkk']; ?>" role="button" class="btn btn-sm btn-primary"><i class="fas fa-file"></i> Anggota Keluarga</a>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" role="button" class="btn btn-sm btn-warning item-edit" data-nkk="<?= $data['nkk']; ?>" data-kepala-keluarga="<?= $data['kepala_keluarga']; ?>" data-kelurahan="<?= $data['kelurahan']; ?>" data-rt="<?= $data['rt']; ?>" data-rw="<?= $data['rw']; ?>" data-jumlah-art="<?= $data['jumlah_art']; ?>"><i class="fas fa-edit"></i> Edit</a>
                                                        <a href="http://localhost:8080/datakeluarga/deletekeluarga/<?= $data['nkk']; ?>" role="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
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
                                                <th>Kelurahan</th>
                                                <th>RT</th>
                                                <th>RW</th>
                                                <th>Anggota Keluarga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
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

    <div class="modal fade" id="modal-keluarga">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Keluarga</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="form-keluarga">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>NKK</label>
                            <input type="text" class="form-control" name="nkk" id="nkk" id="nkk" required autocomplete="false" readonly>
                        </div>
                        <div class="form-group">
                            <label>Kepala Keluarga</label>
                            <input type="text" class="form-control" name="kepala_keluarga" id="kepala_keluarga" id="kepala_keluarga" required autocomplete="false">
                        </div>
                        <div class="form-group">
                            <label>Jumlah ART</label>
                            <input type="text" class="form-control" name="jumlah_art" id="jumlah_art" id="jumlah_art" required autocomplete="false">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>RT</label>
                                    <input type="text" class="form-control" name="rt" id="rt" id="rt" required autocomplete="false">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>RW</label>
                                    <input type="text" class="form-control" name="rw" id="rw" id="rw" required autocomplete="false">
                                </div>
                            </div>
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

</section>
<!-- /.content -->
<?= $this->endSection(); ?>