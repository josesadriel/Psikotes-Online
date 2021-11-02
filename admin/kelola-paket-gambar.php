<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Kelola Paket Gambar</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Kelola Paket Gambar</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kelola Paket Gambar</li>
                </ol>
                <div class="row mb-4 ml-0">
                    <a class="btn btn-primary" href="add-paket-gambar.php"><i class="fa fa-plus"></i> Tambah Paket Gambar</a>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Paket Gambar
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <td>Nama Paket</td>
                                    <td width="20%">Jumlah Gambar</td>
                                    <td width="10%">Aksi</td>
                                </thead>
                                <?php
                                $listPaket = mysqli_query($db, "SELECT * FROM `tbl_paketgambar`");
                                if (mysqli_num_rows($listPaket) > 0) {
                                    while ($data = mysqli_fetch_array($listPaket)) {
                                ?>
                                        <tr>
                                            <td><?= $data['nama_paket'] ?></td>
                                            <td><?= $data['jumlah_gambar'] ?></td>
                                            <td align="center">
                                                <a href="edit-paket-gambar.php?id=<?php echo $data['id_paket']; ?>" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit fa-sm"></i>
                                                </a>
                                                <!-- <a href="hapus-subtes.php?id=<?php echo $data['id_jenistes']; ?>" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash fa-sm"></i>
                                                </a> -->
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