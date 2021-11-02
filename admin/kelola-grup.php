<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include("header.php");
        ?>
        <title>Kelola Grup</title>
    </head>
    <body class="sb-nav-fixed">
        <?php
        include("sidebar.php");
        ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Grup</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Grup</li>
                        </ol>
                        <div class="row mb-4 ml-0">
                        <a class="btn btn-primary" href="add-grup.php"><i class="fa fa-plus"></i> Tambah Grup</a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Daftar Grup
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <td>Nama Grup</td>
                                            <td width="65%">Jenis Tes</td>
                                            <td>Aksi</td>
                                        </thead>
                                        <?php
                                        $listDataGrup = mysqli_query($db, "SELECT * FROM `tbl_grup`");
                                        if (mysqli_num_rows($listDataGrup) > 0 ) {
                                            while($data = mysqli_fetch_array($listDataGrup)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $data['nama_grup'];?></td>
                                            <td><?php echo $data['jenis_tes'];?></td>
                                            <td>
                                                <a href="edit-grup.php?id=<?php echo $data['id_grup'];?>" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit fa-sm"></i>
                                                </a>
                                                <a href="hapus-grup.php?id=<?php echo $data['id_grup'];?>" class="btn btn-danger btn-sm">
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
