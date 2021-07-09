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
                            <div class="col-md-10">
                                <div class="card-title">
                                    <h3 class="card-title">Form Tahun Aktif</h3>
                                </div>
                            </div>
                            <div class="col-md-2">

                            </div>
                        </div>
                    </div>
                    <form action="<?= $form_action; ?>" method="post">
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
                            <div class="form-group">
                                <label for="periode">Tahun Periode</label>
                                <input type="number" class="form-control <?= ($validation->hasError('tahun_aktif')) ? 'is-invalid' : ''; ?>" id="tahun_aktif" autocomplete="false" name="tahun_aktif" value="<?= old('tahun_aktif'); ?><?= $update['tahun_aktif']; ?>">
                                <div class=" invalid-feedback">
                                    <?= $validation->getError('tahun_aktif'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tahun_aktif">Tanggal Penutupan</label>
                                <input type="date" class="form-control <?= ($validation->hasError('tanggal_penutupan')) ? 'is-invalid' : ''; ?>" name="tanggal_penutupan" placeholder="Masukan Tahun Aktif.." autocomplete="false" value="<?= old('tanggal_penutupan'); ?><?= $update['tanggal_penutupan']; ?>">
                                <div class=" invalid-feedback">
                                    <?= $validation->getError('tanggal_penutupan'); ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="" class="btn btn-danger float-left">Simpan</a>
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </form>
                </div>
            </div>

        </div>

        <!-- /.card -->
    </div>
    <!-- .row -->
    </div>
</section>

<!-- /.content -->
<?= $this->endSection(); ?>