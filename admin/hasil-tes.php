<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hasil Tes</title>
    <?php
    include('header.php');
    ?>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Hasil Tes</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Hasil Tes IST</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Hasil Tes
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="hasil-tes" width="100%" cellspacing="0">
                                <thead>
                                    <td>Nama Peserta</td>
                                    <td>Jenis Tes</td>
                                    <td>Tanggal</td>
                                    <td>Laporan</td>
                                </thead>
                                <?php
                                $getData = mysqli_query($db, "SELECT tbl_jenistes.nama_tes, tbl_subtes.nama_subtes, log.id_user, tbl_user.nama, log.status, log.tipe, COUNT(log.status) 'jumlah_selesai', MAX(log.tanggal) 'tanggal' FROM `tbl_subtes` LEFT JOIN (SELECT * FROM `tbl_log` WHERE tbl_log.tipe = 'Soal' AND tbl_log.status = 'Selesai') AS log ON tbl_subtes.id_subtes = log.id_subtes LEFT JOIN `tbl_jenistes` ON tbl_jenistes.id_jenistes = tbl_subtes.id_jenistes INNER JOIN `tbl_user` ON tbl_user.id_user = log.id_user WHERE log.id_user IS NOT NULL GROUP BY log.id_user, tbl_jenistes.nama_tes");
                                if (mysqli_num_rows($getData) > 0) {
                                    while ($data = mysqli_fetch_array($getData)) {
                                        if ($data['nama_tes'] == "CFIT" && $data['jumlah_selesai'] == 4) {
                                ?>
                                            <tr>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['nama_tes'] ?></td>
                                                <td><?= date("d-m-Y", strtotime($data['tanggal'])) ?></td>
                                                <td><a href="laporan-cfit.php?id=<?= $data['id_user'] ?>" target="_blank">Laporan</a></td>
                                            </tr>
                                        <?php
                                        }
                                        if ($data['nama_tes'] == "IST" && $data['jumlah_selesai'] == 9) {
                                        ?>
                                            <tr>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['nama_tes'] ?></td>
                                                <td><?= date("d-m-Y", strtotime($data['tanggal'])) ?></td>
                                                <td><a href="laporan-ist.php?id=<?= $data['id_user'] ?>" target="_blank">Laporan</a></td>
                                            </tr>
                                        <?php
                                        }
                                        if ($data['nama_tes'] == "MBTI" && $data['jumlah_selesai'] == 1) {
                                        ?>
                                            <tr>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['nama_tes'] ?></td>
                                                <td><?= date("d-m-Y", strtotime($data['tanggal'])) ?></td>
                                                <td><a href="laporan-mbti.php?id=<?= $data['id_user'] ?>" target="_blank">Laporan</a></td>
                                            </tr>
                                        <?php
                                        }
                                        if ($data['nama_tes'] == "MSDT" && $data['jumlah_selesai'] == 1) {
                                        ?>
                                            <tr>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['nama_tes'] ?></td>
                                                <td><?= date("d-m-Y", strtotime($data['tanggal'])) ?></td>
                                                <td><a href="laporan-msdt.php?id=<?= $data['id_user'] ?>" target="_blank">Laporan</a></td>
                                            </tr>
                                        <?php
                                        }
                                        if ($data['nama_tes'] == "PAPI KOSTICK" && $data['jumlah_selesai'] == 1) {
                                        ?>
                                            <tr>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['nama_tes'] ?></td>
                                                <td><?= date("d-m-Y", strtotime($data['tanggal'])) ?></td>
                                                <td><a href="laporan-papi.php?id=<?= $data['id_user'] ?>" target="_blank">Laporan</a></td>
                                            </tr>
                                        <?php
                                        }
                                        if ($data['nama_tes'] == "DISC" && $data['jumlah_selesai'] == 1) {
                                        ?>
                                            <tr>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['nama_tes'] ?></td>
                                                <td><?= date("d-m-Y", strtotime($data['tanggal'])) ?></td>
                                                <td><a href="laporan-disc.php?id=<?= $data['id_user'] ?>" target="_blank">Laporan</a></td>
                                            </tr>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php
    include("script.php");
    ?>
</body>
<script>
    $(document).ready(function() {
        $('#hasil-tes').DataTable();
        $("#jenis_tes").on('change', function(e) {
            e.preventDefault();
            $.get("hasil-tes.php?jenis_tes=" + this.value, function(data) {
                // Display the returned data in browser
                $("body").html(data);
            });
        });
    });
</script>

</html>