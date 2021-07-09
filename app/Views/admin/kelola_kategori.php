<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-3">
        <div class="card animated fadeInDown">
            <div class="text-center m-2">
                <img class="img-thumbnail" src="http://localhost:8080/img/bussiness/026-checklist.svg">
                <h3><?= $title; ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                Data Kategori
                <button class="btn btn-sm btn-primary float-right" id="btn-add" data-id-kriteria="<?= $id_kriteria; ?>"> <i class=" fas fa-plus"></i> Tambah Kategori</button>
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
                            <th>Kategori</th>
                            <th>Titik awal</th>
                            <th>Titik tengan</th>
                            <th>Titik akhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="show-data">
                        <?php foreach ($kategori as $row) : ?>
                            <tr>
                                <td><?= $row['nama_kategori']; ?> </td>
                                <td><?= $row['left_side']; ?> </td>
                                <td><?= $row['mid']; ?> </td>
                                <td><?= $row['right_side']; ?> </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm item-edit-kategori" data-id="<?= $row['id_kategori']; ?>" data-id-kriteria="<?= $row['id_kriteria']; ?>" data-nama="<?= $row['nama_kategori']; ?>" data-left-side="<?= $row['left_side']; ?>" data-mid="<?= $row['mid']; ?>" data-right-side="<?= $row['right_side']; ?>"><i class="fas fa-edit "></i> Edit</a>
                                    <a href="http://localhost:8080/kriteria/delete_kategori/<?= $row['id_kategori']; ?>/<?= $row['id_kriteria']; ?>" onclick="return confirm('Apakah data akan dihapus?');" class="btn btn-danger  btn-sm" id="btn-delete"><i class="fas fa-trash "></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Kategori</th>
                            <th>Titik awal</th>
                            <th>Titik tengan</th>
                            <th>Titik akhir</th>
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
                <h4 class="modal-title">Tambah Kategori (himpunan fuzzy)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="http://localhost:8080/kriteria/save_kategori/<?= $id_kriteria; ?>" method="post" id="form-add">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" name="nama_kategori" id="kategori" class="form-control" required autocomplete="false">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="left_side">Nilai Awal</label>
                                <input type="number" name="left_side" id="left_side" class="form-control" required autocomplete="false">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mid">Nilai Tengah</label>
                                <input type="number" name="mid" id="mid" class="form-control" required autocomplete="false">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="right_side">Nilai Akhir</label>
                                <input type="number" name="right_side" id="right_side" class="form-control" required autocomplete="false">
                            </div>
                        </div>
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