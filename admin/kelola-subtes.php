<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Kelola Subtes</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Kelola Subtes <?= (isset($_GET['jenis_tes'])) ? '- ' . $_GET['jenis_tes'] : ""; ?></h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kelola Subtes</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Subtes
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <td>Subtes</td>
                                    <td>Jenis Tes</td>
                                    <td>Timer</td>
                                    <td width="10%">Aksi</td>
                                </thead>
                                <?php
                                $listDataSubtes = mysqli_query($db, "SELECT tbl_subtes.*, tbl_jenistes.nama_tes FROM `tbl_subtes` INNER JOIN `tbl_jenistes` ON tbl_subtes.id_jenistes = tbl_jenistes.id_jenistes");
                                if (mysqli_num_rows($listDataSubtes) > 0) {
                                    while ($data = mysqli_fetch_array($listDataSubtes)) {
                                ?>
                                        <tr>
                                            <td><?= $data['nama_subtes'] ?></td>
                                            <td><?= $data['nama_tes'] ?></td>
                                            <td><?= $data['timer'] ?> Menit</td>
                                            <td align="center">
                                                <?php
                                                if ($data['nama_tes'] == "PAPI KOSTICK" || $data['nama_tes'] == "MSDT" || $data['nama_tes'] == "MBTI" || $data['nama_tes'] == "DISC") {
                                                ?>
                                                    <a class="btn btn-secondary btn-sm">
                                                        <i class="fa fa-edit fa-sm"></i>
                                                    </a>
                                                <?php
                                                } else {
                                                ?>
                                                    <a href="edit-subtes.php?id=<?php echo $data['id_subtes']; ?>" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-edit fa-sm"></i>
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                                <a href="../user/preview-intruksi.php?jenis_tes=<?= $data['nama_tes'] ?>&id_subtes=<?= $data['id_subtes'] ?>" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </table>
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