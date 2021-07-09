<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-10 y-auto">
                <h5>Anggota Keluarga</h5>
            </div>
            <div class="col-md-2">
                <?php if (count($data_sudah) == $jumlah_art) : ?>
                    <a href="http://localhost:8080/pendataan_keluarga/pendataan_selesai/<?= $id_pendataan; ?>" class="btn btn-primary float-right">Simpan</a>
                <?php endif; ?>
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
                        <?php $i = 0; ?>
                        <?php foreach ($data_anggota as $data) : ?>
                            <tr>
                                <td><?= 1 + $i; ?></td>
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
                                        <?php if (count($data_sudah) > 0) : ?>
                                            <?php for ($dt = 0; $dt < count($data_sudah); $dt++) { ?>
                                                <?php if ($data['nik'] == $data_sudah[$dt]) : ?>
                                                    <a href="http://localhost:8080/profilkesehatan/view_kuesioner/<?= $data['nkk']; ?>/<?= $id_pendataan; ?>/<?= $data['nik']; ?>" role="button" class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Lihat Kuesioner</a>
                                                <?php else : ?>
                                                    <a href="http://localhost:8080/profilkesehatan/add_kuesioner/<?= $id_pendataan; ?>/<?= $data['nik']; ?>" role="button" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> isi Kuesioner</a>
                                                <?php endif; ?>
                                            <?php } ?>
                                        <?php else : ?>
                                            <a href="http://localhost:8080/profilkesehatan/add_kuesioner/<?= $id_pendataan; ?>/<?= $data['nik']; ?>" role="button" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> isi Kuesioner</a>
                                        <?php endif; ?>

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
                <!-- /table -->

            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
</div>

<?= $this->endSection(); ?>