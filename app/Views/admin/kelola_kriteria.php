<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-3">
        <div class="card animated fadeInDown">
            <div class="text-center m-2">
                <img class="img-thumbnail" src="http://localhost:8080/img/bussiness/026-checklist.svg">
                <h3>Kelola Kriteria</h3>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                Data Kriteria
                <button class="btn btn-sm btn-primary float-right" id="btn-add"> <i class="fas fa-plus"></i> Tambah Kriteria</button>
            </div><!-- /.card-header -->
            <div class="card-body">
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show animated headShake" role="alert">
                        <?= session()->getFlashdata('success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('sub_kriteria_updated')) : ?>
                    <div class="alert alert-success alert-dismissible fade show animated headShake" role="alert">
                        <?= session()->getFlashdata('sub_kriteria_updated'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <table id="tabel-kriteria" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Keterangan</th>
                            <th>Kategori</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="show-data">
                        <?php foreach ($kriteria as $row) : ?>
                            <tr>
                                <td><?= $row['nama']; ?> </td>
                                <td><?= $row['keterangan'] == 'input' ? '<span class="badge badge-info">Input</span>' : '<span class="badge badge-danger">Output</span>'; ?></td>
                                <td>
                                    <a href="http://localhost:8080/kriteria/kategori/<?= $row['id_kriteria']; ?>" class="btn btn-success btn-sm" id="btn-kategori"><i class="fas fa-search"></i> Lihat Kategori</a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm item-edit-kriteria" data-id="<?= $row['id_kriteria']; ?>" data-nama="<?= $row['nama']; ?>" data-keterangan="<?= $row['keterangan']; ?>"><i class="fas fa-edit "></i> Edit</a>
                                    <a href="http://localhost:8080/kriteria/delete_kriteria/<?= $row['id_kriteria']; ?>" onclick="return confirm('Apakah data akan dihapus?');" class="btn btn-danger  btn-sm" id="btn-delete"><i class="fas fa-trash "></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Kriteria</th>
                            <th>Keterangan</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kriteria (variabel fuzzy)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="http://localhost:8080/kriteria/save_kriteria" method="post" id="form-add">
                <div class="modal-body">
                    <input type="hidden" name="keterangan">
                    <div class="form-group">
                        <label>Kriteria </label>
                        <input type="text" class="form-control" autocomplete="off" name="nama" id="nama" required>
                        </input>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?= $this->endSection(); ?>