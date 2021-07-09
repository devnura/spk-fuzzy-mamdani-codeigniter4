<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card animated fadeInDown">
                    <div class="text-center">
                        <img class="img-thumbnail" src="http://localhost:8080/img/bussiness/031-time management.svg">
                        <h3>Profil Kesehatan</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <!-- if disabled -->

                <!--  -->
                <div class="row">
                    <div class="col-12">
                        <div class="card animated fadeInDown">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h3 class="card-title">Riwayat pendataan</h3>
                                    </div>
                                    <div class="col-6">

                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <?php if ($status == false) :
                                ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning alert-dismissible fade show animated headShake" role="alert">
                                                Belum ada tugas aktif !!!
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;
                                ?>
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
                                <table id="tabel-keluarga" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun aktif</th>
                                            <th>Tanggal pendataan</th>
                                            <th>No Kartu Keluarga</th>
                                            <th>Kepala Keluarga</th>
                                            <th>Kelurahan</th>
                                            <th>RT</th>
                                            <th>RW</th>
                                            <th>Status Pendataan</th>
                                            <th>Nlai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="data-keluarga">
                                        <?php if ($status == true) :
                                        ?>
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
                                                    <td><?= $data['status_pendataan'] == 1 ? ' <span class="badge badge-success">Selesai</span>' : ' <span class="badge badge-danger">Belum selesai</span>'; ?></td>
                                                    <td><?= $data['nilai'] <= 50 ? '<span class="badge badge-danger">Tidak sehat</span>' : ($data['nilai'] > 50 && $data['nilai'] < 80 ? '<span class="badge badge-warning">Pra-sehat</span>' : '<span class="badge badge-success">Sehat</spam.'); ?></td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-success item-view" data-id_pendataan="<?= $data['id_pendataan']; ?>" data-nkk="<?= $data['nkk']; ?>" data-kepala-keluarga="<?= $data['kepala_keluarga']; ?>" data-tanggal-pendataan="<?= $data['tgl_pendataan']; ?>" data-kelurahan="<?= $data['kelurahan']; ?>" data-rt="<?= $data['rt']; ?>" data-rw="<?= $data['rw']; ?>" data-nilai="<?= $data['nilai']; ?>"><i class="fas fa-list"></i> Lihat Hasil</a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach ?>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun aktif</th>
                                            <th>Tanggal pendataan</th>
                                            <th>No Kartu Keluarga</th>
                                            <th>Kepala Keluarga</th>
                                            <th>Kelurahan</th>
                                            <th>RT</th>
                                            <th>RW</th>
                                            <th>Status Pendataan</th>
                                            <th>Nlai</th>
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

    <div class="modal fade" id="modal-view">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Rekapitulasi Keluarga</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kepala_keluarga">Kepala keluarga</label>
                        <input class="form-control" disabled type="text" name="kepala_keluarga" id="kepala_keluarga">
                    </div>
                    <div class="form-group">
                        <label for="nkk">NKK</label>
                        <input class="form-control" disabled type="text" name="nkk" id="nkk">
                    </div>
                    <div class="form-group">
                        <label for="keluragan">Kelurahan</label>
                        <input class="form-control" disabled type="text" name="kelurahan" id="kelurahan">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rt">Rt</label>
                                <input class="form-control" disabled type="text" name="rt" id="rt">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rw">Rw</label>
                                <input class="form-control" disabled type="text" name="rw" id="rw">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nilai">Nilai</label>
                                <input class="form-control" disabled type="text" name="nilai" id="nilai">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input class="form-control" disabled type="text" name="status" id="status">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label>Tabel Rekappitulasi :</label>
                            <table id="tabel" class="table table-bordered table-striped">
                                <thead>
                                    <th>No</th>
                                    <th>Indikator</th>
                                    <th>Nilai</th>
                                </thead>
                                <tbody id="show-rek"></tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</section>
<!-- /.content -->
<?= $this->endSection(); ?>