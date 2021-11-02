<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Intruksi Jenis Tes</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Intruksi Jenis Tes</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Intruksi Jenis Tes</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Intruksi Jenis Tes
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <td width="20%">Jenis Tes</td>
                                    <td>Intruksi</td>
                                    <td width="10%">Aksi</td>
                                </thead>
                                <?php
                                $listDataTes = mysqli_query($db, "SELECT * FROM `tbl_jenistes`");
                                if (mysqli_num_rows($listDataTes) > 0) {
                                    while ($data = mysqli_fetch_array($listDataTes)) {
                                ?>
                                        <tr>
                                            <td><?= $data['nama_tes'] ?></td>
                                            <td><?= (isset($data['intruksi_tes'])) ? $data['intruksi_tes'] : "" ?></td>
                                            <td align="center">
                                                <a href="edit-intruksi.php?id=<?php echo $data['id_jenistes']; ?>" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit fa-sm"></i>
                                                </a>
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