<?php
include("../koneksi.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Dashboard</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="row justify-content-md-center">
                    <div class="col-xl-3 col-md-6">
                        <?php
                        $jumlahUser = mysqli_query($db, "SELECT COUNT(*) 'jumlah' FROM `tbl_user`");
                        $user = mysqli_fetch_array($jumlahUser);
                        ?>
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body d-flex justify-content-between">
                                <i class="fa fa-user fa-2x"></i>
                                <b style="font-size:24px"><?= $user['jumlah'] ?></b>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="daftar-peserta.php">Jumlah Peserta</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <?php
                        $jumlahGrup = mysqli_query($db, "SELECT COUNT(*) 'jumlah' FROM `tbl_grup`");
                        $grup = mysqli_fetch_array($jumlahGrup);
                        ?>
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body d-flex justify-content-between">
                                <i class="fa fa-users fa-2x"></i>
                                <b style="font-size:24px"><?= $grup['jumlah'] ?></b>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="kelola-grup.php">Jumlah Grup</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <?php
                        $jumlahEvent = mysqli_query($db, "SELECT COUNT(*) 'jumlah' FROM `tbl_event`");
                        $event =  mysqli_fetch_array($jumlahEvent);
                        ?>
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body d-flex justify-content-between">
                                <i class="fa fa-calendar-alt fa-2x"></i>
                                <b style="font-size:24px"><?= $event['jumlah'] ?></b>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="kelola-event.php">Jumlah Event</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Psikotes Online 2021</div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <?php
    include("script.php");
    ?>
</body>

</html>