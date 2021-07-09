<?= $this->include('layout/_partials/header'); ?>
<?= $this->include('layout/_partials/navbar'); ?>
<?= $this->include('layout/_partials/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <?php if (isset($title)) {
                            echo $title;
                        }; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php if (isset($tahun_aktif)) : ?>
                        <button class="btn btn-success btn-sm float-right btn-flat" data-toggle="modal" data-target="#modal-aktif"> Aktif : <?= $tahun_aktif; ?> <i class="fas fa-calendar"></i></button>
                    <?php endif; ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <?= $this->renderSection('content'); ?>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<div class="modal fade" id="modal-aktif">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tahun Aktif</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kriteria </label>
                        <input type="text" class="form-control" name="aktif" readonly></input>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Penutupan </label>
                        <input type="text" class="form-control" name="penutupan" readonly></input>
                    </div>
                    <div class="form-group">
                        <label>Status Aktif </label>
                        <input type="text" class="form-control" name="penutupan" readonly></input>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.content-wrapper -->
<?= $this->include('layout/_partials/footer'); ?>