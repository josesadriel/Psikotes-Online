<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Kelola Jenis Tes</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Kelola Jenis Tes</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kelola Jenis Tes</li>
                </ol>
                <div class="row mb-4 ml-0">
                    <a class="btn btn-primary" href="add-jenis-tes.php"><i class="fa fa-plus"></i> Tambah Jenis Tes</a>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Jenis Tes
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <td>Nama Tes</td>
                                    <td width="25%">Aksi</td>
                                </thead>
                                <?php
                                $listDataJenisTes = mysqli_query($db, "SELECT * FROM `tbl_jenistes`");
                                if (mysqli_num_rows($listDataJenisTes) > 0) {
                                    while ($data = mysqli_fetch_array($listDataJenisTes)) {
                                ?>
                                        <tr>
                                            <td><a href="kelola-subtes.php?jenis_tes=<?= $data['nama_tes']; ?>"><?= $data['nama_tes'] ?></td>
                                            <!-- <td>
                                                <?php
                                                $intruksi = strip_tags($data['keterangan']);
                                                if (strlen($intruksi) > 100) {
                                                    echo substr($intruksi, 0, 100) . "...";
                                                } else echo $intruksi;
                                                ?>
                                            </td> -->
                                            <td align=" center">
                                                <a href="edit-jenis-tes.php?id=<?php echo $data['id_jenistes']; ?>" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit fa-sm"></i>
                                                </a>
                                                <a href="hapus-jenis-tes.php?id=<?php echo $data['id_jenistes']; ?>" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash fa-sm"></i>
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