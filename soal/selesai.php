<?php
include('../koneksi.php');
session_start();
?>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Selesai Tes</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    if (isset($_SESSION['id_subtes'])) {
        $getDataSubtes = mysqli_query($db, "SELECT * FROM `tbl_soal` INNER JOIN `tbl_subtes` ON tbl_soal.subtes = tbl_subtes.nama_subtes WHERE tbl_subtes.id_subtes = '$_SESSION[id_subtes]' LIMIT 1");
        $dataSubtes = mysqli_fetch_array($getDataSubtes);
    }
    if (isset($_GET['status']) && $_GET['status'] == "selesai") {
        $updateStatus = mysqli_query($db, "UPDATE `tbl_log` SET `status`= 'Selesai' WHERE id_user = '$_SESSION[id_user]' AND id_subtes = '$_SESSION[id_subtes]'");
        if ($updateStatus) {
        }
    }
    ?>
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-6 col-sm-offset-3">
                <br><br>
                <h2 style="color:#0fad00">Selesai</h2>
                <i class="fas fa-check-circle fa-10x" style="color:#0fad00"></i>
                <h3>Hai, <?= $_SESSION['nama'] ?></h3>
                <p style="font-size:20px;color:#5C5C5C;">Kamu sudah selesai mengerjakan test, lanjutkan mengerjakan test lainnya!</p>
                <?php
                $getSubtes = mysqli_query($db, "SELECT tbl_jenistes.nama_tes, tbl_subtes.nama_subtes, log.id_user, tbl_user.nama, log.status, log.tipe, COUNT(log.status) 'jumlah_selesai', MAX(log.tanggal) 'tanggal' FROM `tbl_subtes` LEFT JOIN (SELECT * FROM `tbl_log` WHERE tbl_log.tipe = 'Soal') AS log ON tbl_subtes.id_subtes = log.id_subtes LEFT JOIN `tbl_jenistes` ON tbl_jenistes.id_jenistes = tbl_subtes.id_jenistes INNER JOIN `tbl_user` ON tbl_user.id_user = log.id_user WHERE log.id_user IS NOT NULL AND log.id_user = '$_SESSION[id_user]' AND tbl_jenistes.nama_tes ='$_SESSION[jenis_tes]' GROUP BY log.id_user, tbl_jenistes.nama_tes");
                if (mysqli_num_rows($getSubtes) > 0) {
                    $subtes = mysqli_fetch_array($getSubtes);
                    if ($subtes['nama_tes'] == "CFIT" && $subtes['jumlah_selesai'] == 4) {
                        echo '<a href="../user/list-tes.php" class="btn btn-success">Kembali ke Daftar Tes</a>';
                    } else if ($subtes['nama_tes'] == "IST" && $subtes['jumlah_selesai'] == 9) {
                        echo '<a href="../user/list-tes.php" class="btn btn-success">Kembali ke Daftar Tes</a>';
                    } else if ($subtes['nama_tes'] == "MBTI" && $subtes['jumlah_selesai'] == 1) {
                        echo '<a href="../user/list-tes.php" class="btn btn-success">Kembali ke Daftar Tes</a>';
                    } else if ($subtes['nama_tes'] == "MSDT" && $subtes['jumlah_selesai'] == 1) {
                        echo '<a href="../user/list-tes.php" class="btn btn-success">Kembali ke Daftar Tes</a>';
                    } else if ($subtes['nama_tes'] == "PAPI KOSTICK" && $subtes['jumlah_selesai'] == 1) {
                        echo '<a href="../user/list-tes.php" class="btn btn-success">Kembali ke Daftar Tes</a>';
                    } else if ($subtes['nama_tes'] == "DISC" && $subtes['jumlah_selesai'] == 1) {
                        echo '<a href="../user/list-tes.php" class="btn btn-success">Kembali ke Daftar Tes</a>';
                    } else {
                        echo '<a href="../user/list-subtes.php" class="btn btn-success">Kembali ke Daftar Tes</a>';
                    }
                }
                ?>
                <br><br>
            </div>
            <?php
            // $_SESSION['jenis_tes'] = null;
            // $_SESSION['id_subtes'] = null;
            ?>
        </div>
    </div>
</body>

</html>