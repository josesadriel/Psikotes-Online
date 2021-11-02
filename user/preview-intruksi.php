<?php
include("../koneksi.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Intruksi</title>
    <?php
    include('header.php');
    ?>
    <link href="../css/sticky-navbar-footer.css" rel="stylesheet" />

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>

<body>
    <nav class="navbar navbar-dark bg-dark justify-content-between">
        <span class="navbar-brand">Halo, Admin</span>
        <a href="#" class="btn btn-primary">Logout</a>
    </nav>
    <div class="container">
        <?php
        if (isset($_GET['jenis_tes']) && isset($_GET['id_subtes'])) {
            $getIntruksi = mysqli_query($db, "SELECT tbl_subtes.*, tbl_jenistes.intruksi_tes FROM `tbl_subtes` INNER JOIN `tbl_jenistes` ON tbl_jenistes.id_jenistes = tbl_subtes.id_jenistes WHERE tbl_subtes.id_subtes = '$_GET[id_subtes]'");
            $data = mysqli_fetch_array($getIntruksi);
        ?>
            <div class="card">
                <div class="card-header">
                    Intruksi <?= $data['nama_subtes'] ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $data['nama_subtes'] ?></h5>
                    <p class="card-text"><?= (isset($data['intruksi']) && $data['intruksi'] != "") ? $data['intruksi'] : $data['intruksi_tes']; ?></p>
                    <?php
                    if ($_GET['jenis_tes'] == "DISC" || $_GET['jenis_tes'] == "MBTI" || $_GET['jenis_tes'] == "MSDT") {
                    } else {
                        if ($_GET['jenis_tes'] == "IST" && $_GET['id_subtes'] == "13") {
                            echo '<a onclick="openHafalan()" class="btn btn-block btn-primary text-white">SOAL HAFALAN</a>';
                        } else {
                    ?>
                            <a onclick="openWin()" class="btn btn-block btn-primary text-white">CONTOH SOAL</a>
                    <?php
                        }
                    }

                    ?>
                </div>
            </div>
        <?php
        }
        ?>
        <script>
            function openWin() {
                myWindow = window.open("preview-contoh.php?jenis_tes=<?= $_GET['jenis_tes'] ?>&id_subtes=<?= $_GET['id_subtes'] ?>");
            }

            function openHafalan() {
                myWindow = window.open("../user/preview-hafalan.php");
            }
        </script>
    </div>
</body>

</html>