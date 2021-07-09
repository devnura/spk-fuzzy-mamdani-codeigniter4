<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        Anggota Keluarga
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="tab-content">
            <!-- /.tab-pane -->
            <div class="tab-pane active" id="anggota_keluarga">
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info"></i> Alert!</h5>
                    Jumlah anggota yang harus di inputkan adalan <?= count($data_anggota); ?>/<?= $jumlah_art; ?>.
                </div>

                <?php if (session()->getFlashdata('success_anggota')) : ?>
                    <div class="alert alert-success alert-dismissible fade show animated headShake" role="alert">
                        <?= session()->getFlashdata('success_anggota'); ?>
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

                <!-- form -->
                <form class="form-horizontal" method="POST" action="<?= $form_action; ?>">
                    <div class="form-group row">
                        <label for="nkk" class="col-sm-2 col-form-label">Nomor Induk Kependudukan</label>
                        <div class="col-sm-10">
                            <input type="number" name="nik" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" placeholder="NIK" autocomplete="off" value="<?= old('nik'); ?><?= $data_anggota_keluarga['nik']; ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('nik'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" placeholder="Nama" autocomplete="off" value="<?= old('nama'); ?><?= $data_anggota_keluarga['nama']; ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" name="tanggal_lahir" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : ''; ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask id="tanggal_lahir" placeholder="DD/MM/YYYY" autocomplete="off" value="<?= old('tanggal_lahir'); ?><?= $data_anggota_keluarga['tanggal_lahir']; ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('tanggal_lahir'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="">Jenis kelamin </option>
                                <option value="1" <?= old('jenis_kelamin') == 1 ? 'selected' : ''; ?> <?= $data_anggota_keluarga['jenis_kelamin'] == 1 ? 'selected' : ''; ?>>Laki-laki </option>
                                <option value="2" <?= old('jenis_kelamin') == 2 ? 'selected' : ''; ?> <?= $data_anggota_keluarga['jenis_kelamin'] == 2 ? 'selected' : ''; ?>>Perempuan </option>
                            </select>
                            <div class=" invalid-feedback">
                                <?= $validation->getError('jenis_kelamin'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hubungan_keluarga" class="col-sm-2 col-form-label">Hubungan Keluarga</label>
                        <div class="col-sm-10">
                            <select class="form-control  <?= ($validation->hasError('hubungan_keluarga')) ? 'is-invalid' : ''; ?>" name="hubungan_keluarga" id="hubungan_keluarga">
                                <option value="">Keluarga</option>
                                <option value="1" <?= $data_anggota_keluarga['hubungan_keluarga'] == '1' ? 'selected' : '' ?>>Kepala keluarga</option>
                                <option value="2" <?= $data_anggota_keluarga['hubungan_keluarga'] == '2' ? 'selected' : '' ?>>Istri</option>
                                <option value="3" <?= $data_anggota_keluarga['hubungan_keluarga'] == '3' ? 'selected' : '' ?>>Anak</option>
                                <option value="4" <?= $data_anggota_keluarga['hubungan_keluarga'] == '4' ? 'selected' : '' ?>>Menantu</option>
                                <option value="5" <?= $data_anggota_keluarga['hubungan_keluarga'] == '5' ? 'selected' : '' ?>>Cucu</option>
                                <option value="6" <?= $data_anggota_keluarga['hubungan_keluarga'] == '6' ? 'selected' : '' ?>>Orang Tua</option>
                                <option value="7" <?= $data_anggota_keluarga['hubungan_keluarga'] == '7' ? 'selected' : '' ?>>Lainnya</option>
                            </select>
                            <div class=" invalid-feedback">
                                <?= $validation->getError('hubungan_keluarga'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="offset-sm-11 col-sm-1 mt-2">
                            <?php if (count($data_anggota) != $jumlah_art || $update == true) : ?>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            <?php else : ?>
                                <a href="http://localhost:8080/datakeluarga" class="btn btn-success">Selesai</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
                <!-- /form -->

                <!-- table -->
                <table id="tabel-anggota-keluarga" class="table table-bordered table-striped">
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
                                <td><?= $data['jenis_kelamin'] == '1' ? 'Laki-laki' : 'Perempuan'; ?></td>
                                <td><?php if ($data['hubungan_keluarga'] == '1') {
                                        echo "Kepala keluarga";
                                    } else if ($data['hubungan_keluarga'] == '2') {
                                        echo "Istri";
                                    } else if ($data['hubungan_keluarga'] == '3') {
                                        echo "Anak";
                                    } ?></td>
                                <td>
                                    <div class="float-right">
                                        <a href="http://localhost:8080/anggotakeluarga/get_anggota/<?= $data['nkk']; ?>/<?= $data['nik']; ?>" role="button" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> edit</a>
                                        <a href="http://localhost:8080/anggotakeluarga/delete_anggota/<?= $data['nkk']; ?>/<?= $data['nik']; ?>" role="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> hapus</a>
                                    </div>
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

            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
</div>

<?= $this->endSection(); ?>