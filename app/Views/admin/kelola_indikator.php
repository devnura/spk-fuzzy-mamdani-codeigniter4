<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row animated fadeInDown">
            <div class="col-md-3">
                <div class="card animated fadeInDown">
                    <div class="text-center m-2">
                        <img class="img-thumbnail" src="http://localhost:8080/img/bussiness/002-stamp.svg">
                        <h3>Indikator Kesehatan</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h3 class="card-title">Tabel Indikator</h3>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-add">
                                    <i class="fas fa-plus"></i> Tambah Data
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
                        <table id="tabel-kuesioner" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Indikator</th>
                                    <th>Kriteria</th>
                                    <!-- <th>Keterangan</th> -->
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="show-indikator">
                                <?php $i = 1; ?>
                                <?php foreach ($indikator as $q) : ?>
                                    <tr>
                                        <td>
                                            <?= $i; ?>
                                        </td>
                                        <td>
                                            <?= $q['indikator']; ?>
                                        </td>

                                        <td>
                                            <?= $q['nama']; ?>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-primary btn-sm item-edit" data-id='<?= $q['id_indikator']; ?>' data-indikator="<?= $q['indikator']; ?>" data-kriteria="<?= $q['id_kriteria']; ?>"><i class="fas fa-edit "></i> Edit</a>
                                            <a href="http://localhost:8080/Admin/delete_indikator/<?= $q['id_indikator']; ?>" role="button" onclick="return confirm('Apakah data akan dihapus?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Indikator</th>
                                    <th>Kriteria</th>
                                    <!-- <th>Keterangan</th> -->
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
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Indikator</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="http://localhost:8080/admin/insert_indikator" method="post" id="form-indikator">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kriteria </label>
                            <select class="form-control" name="id_kriteria" id="id_kriteria" required>
                                <option value="">Id Kriteria</option>
                                <?php foreach ($kriteria as $k) : ?>
                                    <?php if ($k['keterangan'] != 'output') : ?>
                                        <option value="<?= $k['id_kriteria']; ?>"><?= $k['id_kriteria'] . ' | ' . $k['nama']; ?> </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Textarea</label>
                            <textarea class="form-control" rows="3" placeholder="Indikator ..." name="indikator"></textarea>
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

<!-- /.content -->
<?= $this->endSection(); ?>