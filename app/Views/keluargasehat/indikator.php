<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-10 y-auto">
                <h5>Anggota Keluarga</h5>
            </div>

        </div>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="tab-content">
            <!-- /.tab-pane -->
            <div class="tab-pane active" id="anggota_keluarga">

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
                <!-- table -->
                <table id="tabel-kuesioner-keluarga" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Hubungan Keluarga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($data_anggota as $data) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $data['nik']; ?></td>
                                <td><?= $data['nama']; ?></td>
                                <td><?= $data['tanggal_lahir']; ?></td>
                                <td><?= $data['jenis_kelamin']; ?></td>
                                <td><?= $data['hubungan_keluarga']; ?></td>
                                <td>
                                    <?php if ($data['status'] == true) { ?>
                                        <button class="btn btn-success btn-sm item-view" data-nik="<?= $data['nik']; ?>" data-idpen="<?= $id_pendataan; ?>" data-nik=" <?= $data['nik']; ?>" data-nama="<?= $data['nama']; ?>" data-tanggal-lahir="<?= $data['tanggal_lahir']; ?>" data-jenis-kelamin="<?= $data['jenis_kelamin']; ?>" data-hubungan-keluarga="<?= $data['hubungan_keluarga']; ?>" data-umur="<?= $data['umur']; ?>"><i class="fas fa-file"></i> Hasil</button>
                                    <?php } else if ($data['status'] == false) { ?>
                                        <button class="btn btn-primary btn-sm item-add" data-nik="<?= $data['nik']; ?>" data-idpen="<?= $id_pendataan; ?>" data-nik=" <?= $data['nik']; ?>" data-nama="<?= $data['nama']; ?>" data-tanggal-lahir="<?= $data['tanggal_lahir']; ?>" data-jenis-kelamin="<?= $data['jenis_kelamin']; ?>" data-hubungan-keluarga="<?= $data['hubungan_keluarga']; ?>" data-umur="<?= $data['umur']; ?>"><i class="fas fa-edit"></i> Isi Kuesioner</button>
                                    <?php }; ?>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Hubungan Keluarga</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
                <!-- /table -->
                <!-- /table -->

            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
    <div class="card-footer">
        <a href="http://localhost:8080/profilkesehatan" class="btn btn-danger float-left">Batal</a>
        <?php if ($jumlah_sudah == $jumlah_art) : ?>
            <a href="http://localhost:8080/fuzzy_mamdani/hitung_nilai/<?= $id_pendataan; ?>" class="btn btn-primary float-right">Simpan</a>
        <?php endif; ?>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kuesioner</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-kuesioner" method="POST">
                <div class="modal-body">
                    <div class="show-kuesioner">
                        <input type="hidden" name="id_pendataan" value="<?= $id_pendataan; ?>">
                        <input type="hidden" name="nkk" value="<?= $nkk; ?>">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="false" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" autocomplete="false" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal lahir</label>
                                    <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" autocomplete="false" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Umur</label>
                                    <input type="text" class="form-control" id="umur" autocomplete="false" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis kelamin</label>
                            <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" autocomplete="false" readonly>
                        </div>
                        <div class="form-group mb-5">
                            <label for="hubungan_keluarga">Hubungan</label>
                            <input type="text" class="form-control" name="hubungan_keluarga" id="hubungan_keluarga" autocomplete="false" readonly>
                        </div>
                        <div class="show-indikator">

                        </div>
                        <?php $i = 0; ?>
                        <ol>
                            <?php foreach ($indikator as $d) : ?>
                                <div class="form-group mb-4 jenis-<?= $d['jenis_indikator']; ?>" data-id="<?= $d['id_indikator']; ?>">
                                    <label>
                                        <li> <?= $d['indikator']; ?></li>
                                    </label>
                                    <div class="custom-control custom-radio m-3">
                                        <input class="custom-control-input" type="radio" id="Y<?= $d['id_indikator']; ?>" name="jawaban_<?= $d['id_indikator']; ?>" value="Y" required>
                                        <label for="Y<?= $d['id_indikator']; ?>" class="custom-control-label">Sesuai</label>
                                    </div>

                                    <div class="custom-control custom-radio m-3">
                                        <input class="custom-control-input" type="radio" id="T<?= $d['id_indikator']; ?>" name="jawaban_<?= $d['id_indikator']; ?>" value="T" required>
                                        <label for="T<?= $d['id_indikator']; ?>" class="custom-control-label">Tidak sesuai</label>
                                    </div>

                                    <div class="custom-control custom-radio m-3">
                                        <input class="custom-control-input" type="radio" id="N<?= $d['id_indikator']; ?>" name="jawaban_<?= $d['id_indikator']; ?>" value="N" required>
                                        <label for="N<?= $d['id_indikator']; ?>" class="custom-control-label">Tidak berlaku</label>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </ol>
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

<div class="modal fade" id="modal-view">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hasil Kuesioner</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="view-nama" name="view-nama" autocomplete="false" readonly>
                </div>
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="view-nik" name="view-nik" autocomplete="false" readonly>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal lahir</label>
                            <input type="text" class="form-control" id="view-tanggal_lahir" name="view-tanggal_lahir" autocomplete="false" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis_kelamin">Umur</label>
                            <input type="text" class="form-control" id="view-umur" autocomplete="false" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis kelamin</label>
                        <input type="text" class="form-control" id="view-jenis_kelamin" name="view-jenis_kelamin" autocomplete="false" readonly>
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="hubungan_keluarga">Hubungan</label>
                    <input type="text" class="form-control" name="view-hubungan_keluarga" id="view-hubungan_keluarga" autocomplete="false" readonly>
                </div>
                <table id="tabel-kuesioner-keluarga" class="table table-bordered table-striped">
                    <thead>
                        <th>No</th>
                        <th>Indikator</th>
                        <th>Hasil</th>
                    </thead>
                    <tbody id="show-data-hasil">

                    </tbody>
                    <tfoot>
                        <th>No</th>
                        <th>Indikator</th>
                        <th>Hasil</th>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection(); ?>