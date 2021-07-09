<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card animated fadeInDown">
                    <div class="text-center">
                        <img class="img-thumbnail" src="http://localhost:8080/img/bussiness/026-checklist.svg">
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
                                        <h3 class="card-title">Profil Kesehatan</h3>
                                    </div>
                                    <div class="col-6">
                                        <?php if ($status == true) :
                                        ?>
                                            <button class="btn btn-sm btn-primary float-right" id="btn-add-keluarga"> <i class="fas fa-plus"></i> tambah data</button>
                                        <?php endif; ?>
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
                                            <th>no</th>
                                            <th>Kepala Keluarga</th>
                                            <th>No Kartu Keluarga</th>
                                            <th>jumlah anggota keluarga</th>
                                            <th>Kelurahan</th>
                                            <th>RT</th>
                                            <th>RW</th>
                                            <th>Status Pendataan</th>

                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($status == true) :
                                        ?>
                                            <?php $i = 1; ?>
                                            <?php foreach ($keluarga_terdata as $data) : ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $data['kepala_keluarga']; ?></td>
                                                    <td><?= $data['nkk']; ?></td>
                                                    <td><?= $data['jumlah_art']; ?></td>
                                                    <td><?= $data['kelurahan']; ?></td>
                                                    <td><?= $data['rt']; ?></td>
                                                    <td><?= $data['rw']; ?></td>
                                                    <td><?= $data['status_pendataan'] == 1 ? ' <span class="badge badge-success">Selesai</span>' : ' <span class="badge badge-danger">Belum selesai</span>'; ?></td>
                                                    <td>
                                                        <a href="http://localhost:8080/profilkesehatan/indikator/<?= $data['nkk']; ?>/<?= $data['id_pendataan']; ?>" role="button" class="btn btn-sm btn-success"><i class="fas fa-list"></i> Data</a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach ?>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kepala Keluarga</th>
                                            <th>No Kartu Keluarga</th>
                                            <th>jumlah anggota keluarga</th>
                                            <th>Kelurahan</th>
                                            <th>RT</th>
                                            <th>RW</th>
                                            <th>Status Pendataan</th>

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

    <div class="modal fade" id="modal-add">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Keluarga</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="http://localhost:8080/pendataan_keluarga/add" method="post" id="form-indikator">
                    <div class="modal-body">
                        <!-- <div class="show-alert"> -->
                        <div class="alert alert-warning alert-dismissible collapsed animated headShake" id="alert-keluarga">
                            Data sudah ada!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input type="hidden" name="tahun_aktif" value="<?= $tahun_aktif; ?>">
                        <div class="form-group">
                            <label for="tgl_pendataan">Tanggal Pendataan</label>
                            <input type="text" name="tgl_pendataan" required class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask id="tanggal_pendataan" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="nkk">No KK</label>
                            <input type="text" name="nkk" readonly required class="form-control" id="nkk" autocomplete="off">
                        </div>
                        <input type="hidden" name="id_user" value="<?= session('id_user'); ?>">
                        <!-- </div> -->
                        <label> Pilih Keluarga :</label>
                        <!-- <br> -->
                        <table class="table table-bordered table-striped" id="tabel-tambah-keluarga">
                            <thead>
                                <th>No</th>
                                <th>NKK</th>
                                <th>Kepala Keluarga</th>
                                <th>Kelurahan</th>
                                <th>Rt</th>
                                <th>Rw</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($keluarga as $row) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['nkk']; ?></td>
                                        <td><?= $row['kepala_keluarga']; ?></td>
                                        <td><?= $row['kelurahan']; ?></td>
                                        <td><?= $row['rt']; ?></td>
                                        <td><?= $row['rw']; ?></td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-primary" id="item-add" data-nkk="<?= $row['nkk']; ?>" data-tahun-aktif="<?= $tahun_aktif; ?>"><i class="fas fa-plus"></i></button>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <th>No</th>
                                <th>NKK</th>
                                <th>Kepala Keluarga</th>
                                <th>Kelurahan</th>
                                <th>Rt</th>
                                <th>Rw</th>
                                <th>Aksi</th>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
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