  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="http://localhost:8080/home" class="brand-link">
          <img src="http://localhost:8080/img/keluarga_sehat.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">SPK Status Kesehatan</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item">
                      <a href="http://localhost:8080/home" class="nav-link">
                          <img src="http://localhost:8080/img/bussiness/012-bank.svg" width="30%" class="nav-icon">
                          <p>Dashboard</p>
                      </a>
                  </li>
                  <!-- <li class="nav-header">MENU UTAMA</li> -->
                  <?php if (session('level') == '3') {
                    ?>
                      <li class="nav-item">
                          <a href="http://localhost:8080/datakeluarga" class="nav-link">
                              <img src="http://localhost:8080/img/bussiness/022-file.svg" width="30%" class="nav-icon">
                              <p>
                                  Data Keluarga
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="http://localhost:8080/profilkesehatan" class="nav-link">
                              <img src="http://localhost:8080/img/bussiness/026-checklist.svg" width="30%" class="nav-icon">
                              <p>
                                  Profil kesehatan keluarga
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="http://localhost:8080/profilkesehatan/riwayat_pendataan" class="nav-link">
                              <img src="http://localhost:8080/img/bussiness/031-time management.svg" width="30%" class="nav-icon">
                              <p>
                                  Riwayat pendataan
                              </p>
                          </a>
                      </li>
                  <?php }
                    ?>
                  <?php if (session('level') == '2') {
                    ?>
                      <li class="nav-item">
                          <a href="http://localhost:8080/supervisor" class="nav-link">
                              <img src="http://localhost:8080/img/bussiness/046-data analytics.svg" width="30%" class="nav-icon">
                              <p>
                                  Hasil Analisis
                              </p>
                          </a>
                      </li>
                  <?php }
                    ?>
                  <?php if (session('level') == 1) {
                    ?>
                      <li class="nav-item">
                          <a href="http://localhost:8080/admin/manage_user" class="nav-link">
                              <img src="http://localhost:8080/img/bussiness/001-management.svg" width="30%" class="nav-icon">
                              <p>
                                  Kelola user
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="http://localhost:8080/kriteria" class="nav-link">
                              <img src="http://localhost:8080/img/bussiness/016-chart.svg" width="30%" class="nav-icon">
                              <p>
                                  Kelola Kriteria
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="http://localhost:8080/admin/kelola_indikator" class="nav-link">
                              <img src="http://localhost:8080/img/bussiness/002-stamp.svg" width="30%" class="nav-icon">
                              <p>
                                  Kelola Indikator
                              </p>
                          </a>
                      </li>
                      <!--<li class="nav-item">
                          <a href="http://localhost:8080/admin/kelola_tahun_aktif" class="nav-link">
                              <img src="http://localhost:8080/img/bussiness/030-briefcase.svg" width="30%" class="nav-icon">
                              <p>
                                  Kelola Target Wilayah
                              </p>
                          </a>
                      </li>-->
                      <li class="nav-item">
                          <a href="http://localhost:8080/admin/kelola_tahun_aktif" class="nav-link">
                              <img src="http://localhost:8080/img/bussiness/017-schedule.svg" width="30%" class="nav-icon">
                              <p>
                                  Kelola Tahun Aktif
                              </p>
                          </a>
                      </li>
                  <?php }
                    ?>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>