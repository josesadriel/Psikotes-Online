<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Daftar Peserta</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Daftar Peserta</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Peserta</li>
                </ol>
                <a href="tambah-peserta-perusahaan.php" class="btn btn-primary mb-2">Tambah Peserta Perusahaan</a>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Daftar Peserta
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="data-table" width="100%" cellspacing="0">
                                <thead>
                                    <td>Nama Peserta</td>
                                    <td>Keperluan</td>
                                    <td>Nama Perusahaan</td>
                                    <td>Status</td>
                                    <td>Tanggal Daftar</td>
                                    <td>Aksi</td>
                                </thead>
                                <?php
                                $dataPeserta = mysqli_query($db, "SELECT * FROM `tbl_user` ORDER BY tgl_daftar DESC");
                                if (mysqli_num_rows($dataPeserta) > 0) {
                                    while ($data = mysqli_fetch_array($dataPeserta)) {
                                ?>
                                        <tr>
                                            <td><?php echo $data['nama']; ?></td>
                                            <td><?= $data['keperluan'] ?></td>
                                            <td>
                                                <?= (!empty($data['perusahaan'])) ? $data['perusahaan'] : "-" ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($data['status'] == "Aktif") echo "<span class='badge badge-success'>" . $data['status'] . "</span>";
                                                else if ($data['status'] == "Belum Aktif") echo "<span class='badge badge-danger'>" . $data['status'] . "</span>";
                                                ?>
                                            </td>
                                            <td><?= $data['tgl_daftar'] ?></td>
                                            <td>
                                                <button data-id="<?= $data['id_user'] ?>" class="detail btn btn-primary">Detail</button>
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
        <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['updateStatus'])) {
            $updateSql = mysqli_query($db, "UPDATE `tbl_user` SET `status` = '$_POST[status]' WHERE id_user = '$_POST[id_user]'");
            if ($updateSql) {
                echo "<meta http-equiv='refresh' content='0; url=daftar-peserta.php'>";
            }
        }
        ?>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Psikotes Online 2021</div>
                </div>
            </div>
        </footer>
    </div>
    </div>

    <?php include("script.php") ?>
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable({
                "order": [
                    [4, "desc"]
                ]
            });
        });
        $('.detail').click(function() {

            var userid = $(this).data('id');
            // AJAX request
            $.ajax({
                url: 'view-daftar-peserta.php',
                type: 'post',
                data: {
                    userid: userid
                },
                success: function(response) {
                    // Add response in Modal body
                    $('.modal-body').html(response);

                    // Display Modal
                    $('#modalDetail').modal('show');
                }
            });
        });
    </script>
</body>

</html>