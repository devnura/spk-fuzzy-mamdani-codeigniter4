<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="http://localhost/penelitian/themes/plugins/progresbar/step-progress.min.css">
<link rel="stylesheet" href="http://localhost/penelitian/themes/plugins/progresbar/styles.css">
<!-- Main content -->
<section class="content animated fadeInDown">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="steps">
                    <ul class="steps-container">
                        <li style="width:25%;" class="activated">
                            <div class="step">
                                <div class="step-image"><span></span></div>
                                <div class="step-current">
                                    <button class="btn btn-success btn-sm"> Pengenalan Tempat </button>
                                </div>
                            </div>
                        </li>
                        <li style="width:25%;" class="activated">
                            <div class="step">
                                <div class="step-image"><span></span></div>
                                <div class="step-current">
                                    <button class="btn btn-success btn-sm"> Keterangan Keluarga </button>
                                </div>
                            </div>
                        </li>
                        <li style="width:25%;">
                            <div class="step">
                                <div class="step-image"><span></span></div>
                                <div class="step-current">
                                    <button class="btn btn-success btn-sm disabled"> Data Aanggota Rumah Tangga </button>
                                </div>
                            </div>
                        </li>
                        <li style="width:25%;">
                            <div class="step">
                                <div class="step-image"><span></span></div>
                                <div class="step-current">
                                    <button class="btn btn-success btn-sm disabled"> Isi Quisioner </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="step-bar" style="width: 37%;"></div>
                </div>

            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Keterangan Keluarga</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body mx-3 my-3">
                        <form action="http://localhost:8080/keterangankeluarga/create_data" method="post" id='form_keterangan_keluarga'>
                            <input type="hidden" name="form" value="keterangan_keluarga">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="nama_kk">Nama Kepala Keluarga </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="kepala_keluarga" id="kepala_keluarga" placeholder="Nama Kepala Keluarga" value="" />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="jumlah_art">Jumlah Anggota Rumah Tangga </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="jumlah_art" id="jumlah_art" placeholder="Jumlah ART" value="" />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                            <div class="row mt-3">
                                <div class="col-sm-6">

                                    <div class="form-group clearfix" id='quisioner3'>
                                        <label for="q4">1. Apakah tersedia sarana air bersih di lingkungan rumah ?</label>
                                        <div class="icheck-primary">
                                            <input type="radio" name="q3" id="q3y" value="Y">
                                            <label for="q3y">
                                                Ya
                                            </label>
                                        </div>
                                        <div class="icheck-primary pt-2">
                                            <input type="radio" name="q3" id="q3n" value="N">
                                            <label for="q3n">
                                                tidak
                                            </label>
                                        </div>
                                    </div>
                                    <!--  -->

                                    <div class="form-group clearfix" id='quisioner4'>
                                        <label for="q4">2. Bila ya apa jenis airnya terlindung? (PDAM, sumur pompa, sumur gali terlindung, mata air terlindung)</label>
                                        <div class="icheck-primary">
                                            <input type="radio" name="q4" id="q4y" value="Y">
                                            <label for="q4y">
                                                Ya
                                            </label>
                                        </div>
                                        <div class="icheck-primary pt-2">
                                            <input type="radio" name="q4" id="q4n" value="N">
                                            <label for="q4n">
                                                tidak
                                            </label>
                                        </div>
                                    </div>
                                    <!--  -->

                                    <div class="form-group clearfix" id="quisioner5">
                                        <label for="q5">3. Apakah tersedia jamban keluarga?</label>
                                        <div class="icheck-primary">
                                            <input type="radio" name="q5" id="q5y" value="Y">
                                            <label for="q5y">
                                                Ya
                                            </label>
                                        </div>
                                        <div class="icheck-primary pt-2">
                                            <input type="radio" name="q5" id="q5n" value="N">
                                            <label for="q5n">
                                                tidak
                                            </label>
                                        </div>
                                    </div>
                                    <!--  -->
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group clearfix ml-1" id='quisioner6'>
                                        <label for="q6">4. Bila ya apakah jenis jambannya saniter (kloset/leher angsa/plengsengan) ?</label>
                                        <div class="icheck-primary">
                                            <input type="radio" name="q6" id="q6y" value="Y">
                                            <label for="q6y">
                                                Ya
                                            </label>
                                        </div>
                                        <div class="icheck-primary pt-2">
                                            <input type="radio" name="q6" id="q6n" value="N">
                                            <label for="q6n">
                                                tidak
                                            </label>
                                        </div>
                                    </div>
                                    <!--  -->

                                    <div class="form-group clearfix ml-1 qusioner15">
                                        <label for="q7">5. Apakah ada ART yang pernah didiagnosis menderita gangguan jiwa berat (Schizoprenia)?</label>
                                        <div class="icheck-primary">
                                            <input type="radio" name="q7" id="q7y" value="Y">
                                            <label for="q7y">
                                                Ya
                                            </label>
                                        </div>
                                        <div class="icheck-primary pt-2">
                                            <input type="radio" name="q7" id="q7n" value="N">
                                            <label for="q7n">
                                                tidak
                                            </label>
                                        </div>
                                    </div>
                                    <!--  -->

                                    <div class="form-group clearfix qusioner6">
                                        <label for="q8">6. Apakah ada ART yang dipasung?</label>
                                        <div class="icheck-primary">
                                            <input type="radio" name="q8" id="q8y" value="Y">
                                            <label for="q8y">
                                                Ya
                                            </label>
                                        </div>
                                        <div class="icheck-primary pt-2">
                                            <input type="radio" name="q8" id="q8n" value="N">
                                            <label for="q8n">
                                                tidak
                                            </label>
                                        </div>
                                    </div>
                                    <!--  -->
                                </div>
                            </div>
                            <!--  -->
                            <input type="hidden" name="id_keluarga" value="" />
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix p-3">
                        <a href="<?php echo site_url('pengenalan_tempat/return'); ?>" class="btn btn-sm btn-secondary float-left">Kembali</a>
                        <button type="submit" class="btn btn-sm btn-info float-right">Selanjutnya</button>
                    </div>
                    </form>
                    <!-- /.card-body -->
                </div>

            </div>
            <!-- /.card -->
        </div>
</section>
<!-- /.content -->
<?= $this->endSection(); ?>