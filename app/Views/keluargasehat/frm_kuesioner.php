<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link" href="http://localhost:8080/datakeluarga/detil_keluarga">Keluarga</a></li>
            <li class="nav-item"><a class="nav-link active" href="http://localhost:8080/datakeluarga/anggota_keluarga">Anggota Keluarga</a></li>
        </ul>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="tab-content">
            <!-- /.tab-pane -->
            <div class="tab-pane active" id="anggota_keluarga">
                <!-- form -->
                <form class="form-horizontal">
                    <div class="form-group row">
                        <label for="nkk" class="col-sm-2 col-form-label">Nomor Induk Kependudukan</label>
                        <div class="col-sm-10">
                            <input type="number" name="nik" class="form-control" id="nik" placeholder="NIK" autocomplete="off" value="<?= $data_anggota_keluarga['nik']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" autocomplete="off" value="<?= $data_anggota_keluarga['nama']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" name="tanggal_lahir" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask id="tanggal_lahir" placeholder="Jumlah Anggota Keluarga" autocomplete="off" value="<?= $data_anggota_keluarga['tanggal_lahir']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" disabled>
                                <option value="">Jenis kelamin </option>
                                <option value="1" <?= $data_anggota_keluarga['jenis_kelamin'] == 1 ? 'selected' : ''; ?>>Laki-laki </option>
                                <option value="2" <?= $data_anggota_keluarga['jenis_kelamin'] == 2 ? 'selected' : ''; ?>>Perempuan </option>
                            </select>
                            <div class=" invalid-feedback">
                                <?= $validation->getError('jenis_kelamin'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hubungan_keluarga" class="col-sm-2 col-form-label">Hubungan Keluarga</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="hubungan_keluarga" id="hubungan_keluarga" disabled>
                                <option value="">Keluarga</option>
                                <option value="1" <?= $data_anggota_keluarga['hubungan_keluarga'] == '1' ? 'selected' : '' ?>>Kepala keluarga</option>
                                <option value="2" <?= $data_anggota_keluarga['hubungan_keluarga'] == '2' ? 'selected' : '' ?>>Istri</option>
                                <option value="3" <?= $data_anggota_keluarga['hubungan_keluarga'] == '3' ? 'selected' : '' ?>>Anak</option>
                                <option value="4" <?= $data_anggota_keluarga['hubungan_keluarga'] == '4' ? 'selected' : '' ?>>Menantu</option>
                                <option value="5" <?= $data_anggota_keluarga['hubungan_keluarga'] == '5' ? 'selected' : '' ?>>Cucu</option>
                                <option value="6" <?= $data_anggota_keluarga['hubungan_keluarga'] == '6' ? 'selected' : '' ?>>Orang Tua</option>
                                <option value="7" <?= $data_anggota_keluarga['hubungan_keluarga'] == '7' ? 'selected' : '' ?>>Lainnya</option>
                            </select>
                        </div>
                    </div>
                </form>
                <!-- /form -->
                <div class="row">
                    <div class="col-md-10 offset-md-2">
                        <form action="<?= $form_action; ?>" method="post">
                            <?php $i = 0; ?>
                            <?php foreach ($indikator as $d) : ?>
                                <div class=" form-group">
                                    <label><?= 1 + $i; ?>. <?= $d['indikator']; ?></label>
                                    <div class="row mt-2">
                                        <div class="col-md-2">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="Y<?= $d['id_indikator']; ?>" name="<?= $d['id_indikator']; ?>" value="Y" <?= $hasil_indikator ? ($hasil_indikator[$i]['jawaban'] == 'Y' ? 'checked' : '') : ''; ?>>
                                                <label for="Y<?= $d['id_indikator']; ?>" class="custom-control-label">Sesuai</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="T<?= $d['id_indikator']; ?>" name="<?= $d['id_indikator']; ?>" value="T" <?= $hasil_indikator ? ($hasil_indikator[$i]['jawaban'] == 'T' ? 'checked' : '') : ''; ?>>
                                                <label for="T<?= $d['id_kuesioner']; ?>" class="custom-control-label">Tidak sesuai</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="N<?= $d['id_indikator']; ?>" name="<?= $d['id_indikator']; ?>" value="N" <?= $hasil_indikator ? ($hasil_indikator[$i]['jawaban'] == 'N' ? 'checked' : '') : ''; ?>>
                                                <label for="N<?= $d['id_indikator']; ?>" class="custom-control-label">Tidak berlaku</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            <input type="submit" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
</div>

<?= $this->endSection(); ?>