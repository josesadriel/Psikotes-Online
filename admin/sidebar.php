        <?php
        $curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
        ?>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="dashboard.php">Psikotes Online</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

            <!-- Navbar-->
            <ul class="navbar-nav d-none d-md-inline-block ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a href="ganti-password.php" class="dropdown-item">Ganti Password</a>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menuTes" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Menu Tes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="menuTes" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="intruksi-jenis-tes.php">Intruksi Tes</a>
                                    <a class="nav-link" href="kelola-subtes.php">Kelola Subtes</a>
                                    <a class="nav-link" href="kelola-soal.php">Kelola Soal</a>
                                    <a class="nav-link" href="kelola-grup.php">Grup</a>
                                    <a class="nav-link" href="kelola-event.php">Event</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="kelola-paket-gambar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                                Kelola Paket Gambar
                            </a>
                            <a class="nav-link" href="hasil-tes.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-clipboard"></i></div>
                                Hasil Tes
                            </a>
                            <div class="collapse" id="hasilTes" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <!-- <a class="nav-link" href="kelola-subtes.php">Kelola Subtes</a> -->
                                    <a class="nav-link" href="hasil-tes-cfit.php">CFIT</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="daftar-peserta.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Daftar Peserta
                            </a>
                            <!-- <a class="nav-link" href="atur-whatsapp.php">
                                <div class="sb-nav-link-icon"><i class="fab fa-whatsapp"></i></div>
                                Atur WhatsApp
                            </a> -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>