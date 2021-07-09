  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="index3.html" class="nav-link">Home</a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <!-- Profile Image -->
                  <div class="card card-primary card-outline">
                      <div class="card-body box-profile">
                          <div class="text-center">
                              <img class="profile-user-img img-fluid img-circle" src="http://localhost:8080/themes/dist/img/avatar5.png" alt="User profile picture">
                          </div>

                          <h3 class="profile-username text-center">Nina Mcintire</h3>

                          <p class="text-muted text-center">Surveyor</p>

                          <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item">
                                  <b>Username</b> <a class="float-right">543</a>
                              </li>
                              <li class="list-group-item">
                                  <b>Email</b> <a class="float-right">1,322</a>
                              </li>
                          </ul>

                          <a href="#" class="btn btn-primary btn-block"> <i class="fa sign-out"></i> <b>Keluar</b></a>
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
              </div>

          <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                  <img src="http://localhost:8080/themes/dist/img/avatar5.png" class="user-image img-circle elevation-2" alt="User Image">
                  <span class="d-none d-md-inline"><?= session('name'); ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <!-- User image -->
                  <li class="user-header bg-primary">
                      <img src="http://localhost:8080/themes/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">

                      <p>
                          <?= session('name'); ?>
                          <small><?= session('level') == 1 ? 'Admin' : (session('level') == '2' ? 'Supervisor' : 'Surveyor'); ?></small>
                      </p>
                  </li>
                  <div class="card card-primary">
                      <div class="card-body box-profile">
                          <a href="http://localhost:8080/auth/log_out" class="btn btn-primary btn-block"> <i class="fas fa-sign-out-alt"></i> <b>Keluar</b></a>
                      </div>
                      <!-- /.card-body -->
                  </div>
              </ul>
          </li>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->