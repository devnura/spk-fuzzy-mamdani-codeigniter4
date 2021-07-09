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
                            <div class="col-md-6">
                                <div class="card-title">
                                    <h3 class="card-title">Daftar Tahun Aktif</h3>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <a href="javascript:void(0);" type="button" id="btn-add-tahun" class="btn btn-success btn-sm float-right">
                                    <i class="fas fa-plus"></i>
                                    Tambah Tahun Aktif
                                </a>
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
                        <?php if (session()->getFlashdata('deleted')) : ?>
                            <div class="alert alert-warning alert-dismissible fade show animated headShake" role="alert">
                                <?= session()->getFlashdata('deleted'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <table id="tabel-tahun-aktif" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tahun Aktif</th>
                                    <th>Tanggal Pembukaan</th>
                                    <th>Tanggal Penutupan</th>
                                    <th>Status Aktif</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="show-data">
                                <?php foreach ($data_tahun_aktif as $row) : ?>
                                    <tr>
                                        <td><?= $row['tahun_aktif']; ?></td>
                                        <td><?= $row['tanggal_pembukaan']; ?></td>
                                        <td><?= $row['tanggal_penutupan']; ?></td>
                                        <td><?= $row['status_aktif'] == 1 ? ' <span class="badge badge-success">Aktif</span>' : ' <span class="badge badge-danger">Non-aktif</span>'; ?></td>
                                        <td>
                                            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a> -->
                                            <a href="http://localhost:8080/admin/activated/<?= $row['tahun_aktif']; ?>" onclick="return confirm('Dengan mengaktifkan tahun ini maka tahun lain nya akan di non-aktifkan !')" class="btn btn-sm btn-success"><i class="fas fa-retweet"></i> Aktifkan</a>
                                            <?php if ($row['status_aktif'] != 1) : ?>
                                                <a href="http://localhost:8080/admin/delete_tahun/<?= $row['tahun_aktif']; ?>" onclick="return confirm('Dengan menghapus tahun ini maka tahun sebelumnya akan diaktifkan !')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tahun Aktif</th>
                                    <th>Tanggal Pembukaan</th>
                                    <th>Tanggal Penutupan</th>
                                    <th>Status Aktif</th>
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
</section>

<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tahun Aktif</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-add" method="post">
                <div class="modal-body">
                    <!-- Date range -->
                    <div class="alert alert-warning alert-dismissible collapsed animated headShake" id="alert-tahun">
                        Data sudah ada!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-group">
                        <label>Tahun Aktif:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" required name="tahun_aktif" id="tahun_aktif">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>Masukan waktu pendataan:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" name="tanggal" id="reservation">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-submit" id="btn-submit">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.content -->
<?= $this->endSection(); ?>