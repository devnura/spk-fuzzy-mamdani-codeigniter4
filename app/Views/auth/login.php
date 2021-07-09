<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Keluarga Sehat </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="themes/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="themes/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="themes/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- animate -->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="http://localhost/penelitian/themes/dist/animate/animate.css">
</head>

<body class="hold-transition login-page">

    <div class="container-login">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-body">
                    <div class="login-box">
                        <div class="login-logo animated infinite pulse slow">
                            <picture>
                                <source type="img/svg+xml">
                                <img src="img/keluarga_sehat.png" class="img-fluid w-75">
                            </picture>
                        </div>
                        <div class="login-logo py-2">
                            <h4>UPTD PUSKESMAS CIKIJING</h4>
                        </div>
                        <!-- /.login-logo -->
                        <?php if (session()->getFlashdata('failed_username')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show animated headShake" role="alert">
                                <?= session()->getFlashdata('failed_username'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('failed_password')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show animated headShake" role="alert">
                                <?= session()->getFlashdata('failed_password'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <form action="auth/login" method="post">
                            <div class="input-group mb-3">
                                <input type="text" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" placeholder="Email/Username" value="<?= old('username'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username'); ?>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" placeholder="Password">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password'); ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Sign In</button>
                                    </div>
                                    <!-- /.col -->
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-left mt-2">
                                        <p>
                                            <a href="forgot-password.html">I forgot my password</a>
                                        </p>
                                    </div>
                                </div>
                        </form>
                    </div>

                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="themes/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="themes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="themes/dist/js/adminlte.min.js"></script>
    <!-- jquery-validation -->
    <script src="themes/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="themes/plugins/jquery-validation/additional-methods.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form-login').validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 6
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    username: {
                        required: "Harap masukan username",
                        minlength: "Masukan setidaknya 6 karakter"
                    },
                    password: {
                        required: "Harap masukan password",
                        minlength: "Masukan setidaknya 6 karakter"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

    </div>
</body>

</html>