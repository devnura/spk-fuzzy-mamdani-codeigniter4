<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row animated fadeInDown">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Users</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if (session()->getFlashdata('success_create')) : ?>
                            <div class="alert alert-success alert-dismissible fade show animated headShake" role="alert">
                                <?= session()->getFlashdata('success_create'); ?>
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
                        <?php if (session()->getFlashdata('success_update')) : ?>
                            <div class="alert alert-success alert-dismissible fade show animated headShake" role="alert">
                                <?= session()->getFlashdata('success_update'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <table id="tabel-user" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Jenis User</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="show-data">
                                <?php $i = 1; ?>
                                <?php foreach ($tabel_user as $data) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $data['name']; ?></td>
                                        <td><?= $data['email']; ?></td>
                                        <td><?= $data['level'] == '1' ? '<span class="badge badge-danger">Admin</span>' : ($data['level'] == '2' ? '<span class="badge badge-warning">Supervisor</span>' : '<span class="badge badge-success">Surveyor</span>'); ?></td>
                                        <td><?= $data['active'] == '1' ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">non-Active</span>'; ?></td>
                                        <td>
                                            <a href="http://localhost:8080/admin/user/<?= $data['id']; ?>" class="btn btn-warning btn-sm mr-2"><i class="fas fa-pencil-alt"></i> Edit</a>
                                            <form action="http://localhost:8080/admin/user/<?= $data['id']; ?>" method="post" class="d-inline">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <?= csrf_field(); ?>
                                                <button type="submit" class="btn btn-danger btn-sm mr-2" onclick="return confirm('apakah data akan dihapus ?');"><i class="fas fa-trash-alt"></i> Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Jenis User</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form User</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="form-user" action="<?= $form_action; ?>" method="POST">
                        <div class="card-body">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id" value="<?= $update['id']; ?>">
                            <input type="hidden" name="op" value="<?= $update['password']; ?>">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" name="name" placeholder="Nama" value="<?= old('name'); ?><?= $update['name']; ?>">
                                <div class=" invalid-feedback">
                                    <?= $validation->getError('name'); ?>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label for="email">Alamat email</label>
                                <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Email" value="<?= old('email'); ?><?= $update['email']; ?>" <?= ($update['email']) ? 'read-only' : ''; ?>>
                                <div class=" invalid-feedback">
                                    <?= $validation->getError('email'); ?>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password" value="<?= old('password'); ?>">
                                <div class=" invalid-feedback">
                                    <?= $validation->getError('password'); ?>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label>Jenis User</label>
                                <div class="row mt-2">
                                    <div class="col-md-3">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="admin" name="level" value="1" <?= ($update['level'] == "1") ? 'checked' : ''; ?>>
                                            <label for="admin" class="custom-control-label"><span class="badge badge-danger">Admin</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="supervisor" name="level" value="2" <?= ($update['level'] == "2") ? 'checked' : ''; ?>>
                                            <label for="supervisor" class="custom-control-label"><span class="badge badge-warning">Surpervisor</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="surveyor" name="level" value="3" <?= ($update['level'] == "3") ? 'checked' : ''; ?>>
                                            <label for="surveyor" class="custom-control-label"><span class="badge badge-success">Surveyor</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status user</label>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="active" value="1" <?= ($update['active'] == "1") ? 'checked' : ''; ?>>
                                    <label for="customCheckbox1" class="custom-control-label">Aktif</label>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer" id="btn-aksi">
                            <button type="submit" class="btn btn-primary float-right" id="btn-submit-user">Submit</button>
                            <a href="http://localhost:8080/admin/" class="btn btn-default float-left" id="btn-cancel">Cancel</button>
                        </div>
                </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- .row -->
    </div>
</section>

<!-- /.content -->
<?= $this->endSection(); ?>