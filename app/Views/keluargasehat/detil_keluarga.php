<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        Form Keluarga
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active" id="keluarga">
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show animated headShake" role="alert">
                        <?= session()->getFlashdata('success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal" method="POST" action="<?= $form_action; ?>">
                    <div class="form-group row">
                        <label for="nkk" class="col-sm-2 col-form-label">Nomor Kartu Keluarga</label>
                        <div class="col-sm-10">
                            <input type="text" name="nkk" class="form-control <?= ($validation->hasError('nkk')) ? 'is-invalid' : ''; ?>" id="nkk" placeholder="No Kartu Keluarga" autocomplete="off" value="<?= old('nkk'); ?><?= $keluarga['nkk']; ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('nkk'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kepala_keluarga" class="col-sm-2 col-form-label">Kepala Keluarga</label>
                        <div class="col-sm-10">
                            <input type="text" name="kepala_keluarga" class="form-control <?= ($validation->hasError('kepala_keluarga')) ? 'is-invalid' : ''; ?>" id="kepala_keluarga" placeholder="kepala keluarga" autocomplete="off" value="<?= old('kepala_keluarga'); ?><?= $keluarga['kepala_keluarga']; ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('kepala_keluarga'); ?>
                            </div>
                        </div>
                    </div>
                    <div class=" form-group row">
                        <label for="jumlah_art" class="col-sm-2 col-form-label">Jumlah Anggota Keluarga</label>
                        <div class="col-sm-10">
                            <input type="text" name="jumlah_art" class="form-control <?= ($validation->hasError('jumlah_art')) ? 'is-invalid' : ''; ?>" id="jumlah_art" placeholder="Jumlah Anggota Keluarga" autocomplete="off" value="<?= old('jumlah_art'); ?><?= $keluarga['jumlah_art']; ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('jumlah_art'); ?>
                            </div>
                        </div>
                    </div>
                    <div class=" form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Kelurahan</label>
                        <div class="col-sm-10">
                            <select class="form-control <?= ($validation->hasError('kelurahan')) ? 'is-invalid' : ''; ?>" name="kelurahan" id="kelurahan">
                                <option value="">Kelurahan </option>
                                <?php foreach ($kelurahan as $kel) : ?>
                                    <option value="<?= $kel['nama']; ?>" <?= $kel['nama'] == $keluarga['kelurahan'] ? 'selected' : ''  ?>><?= $kel['nama']; ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class=" invalid-feedback">
                                <?= $validation->getError('kelurahan'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rt" class="col-sm-2 col-form-label">RT / RW</label>
                        <div class="col-sm-5">
                            <input type="text" name="rt" class="form-control <?= ($validation->hasError('rt')) ? 'is-invalid' : ''; ?>" id="rt" placeholder="RT" autocomplete="off" value="<?= $keluarga['rt']; ?><?= old('rt'); ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('rt'); ?>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="rw" class="form-control <?= ($validation->hasError('rw')) ? 'is-invalid' : ''; ?>" id="rw" placeholder="RW" autocomplete="off" value="<?= old('rw'); ?><?= $keluarga['rw']; ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('rw'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-11 col-sm-1 mt-2">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="anggota_keluarga">
                ahahahs
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
</div>

<?= $this->endSection(); ?>