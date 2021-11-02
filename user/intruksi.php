<?php
include("../koneksi.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Intruksi Subtes</title>
    <?php
    include('header.php');
    ?>
    <link href="../css/sticky-navbar-footer.css" rel="stylesheet" />

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>

<body>
    <?php
    $getDataUser = mysqli_query($db, "SELECT * FROM `tbl_user` INNER JOIN `tbl_event` ON tbl_user.acara = tbl_event.id_event WHERE id_user = '$_SESSION[id_user]'");
    $dataUser = mysqli_fetch_array($getDataUser);
    if (strtotime($dataUser['tgl_akhir'] . $dataUser['waktu_akhir']) <= time()) {
        echo "<meta http-equiv='refresh' content='0; url=../logout.php'>";
    }
    ?>
    <nav class="navbar navbar-dark bg-dark justify-content-between">
        <span class="navbar-brand">Halo, <?= $dataUser['nama']; ?></span>
        <a href="../logout.php" class="btn btn-primary">Logout</a>
    </nav>
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>: <?= $dataUser['nama']; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: <?= ($dataUser['tgl_lahir'] != "0000-00-00") ? date("d M Y", strtotime($dataUser['tgl_lahir'])) : "" ?></td>
                    </tr>
                    <tr>
                        <td>Usia</td>
                        <td>: <?php
                                if ($dataUser['tgl_lahir'] != "0000-00-00") {
                                    $bday = new DateTime($dataUser['tgl_lahir']); // Your date of birth
                                    $today = new Datetime(date('Y-m-d'));
                                    $diff = $today->diff($bday);
                                    printf('%d tahun, %d bulan, %d hari', $diff->y, $diff->m, $diff->d);
                                }
                                ?>
                        </td>
                    </tr>
                </table>
            </div>
            <?php
            if ($dataUser['tgl_lahir'] == "0000-00-00") {
            ?>
                <div class="align-middle">
                    <button type="button" class="btn btn-danger p-1" data-toggle="modal" data-target="#exampleModalCenter">
                        Masukkan tanggal lahir
                    </button>
                </div>
            <?php } ?>
        </div>
        <?php
        $getIntruksi = mysqli_query($db, "SELECT tbl_subtes.*, tbl_jenistes.intruksi_tes FROM `tbl_subtes` INNER JOIN `tbl_jenistes` ON tbl_jenistes.id_jenistes = tbl_subtes.id_jenistes WHERE tbl_subtes.id_subtes = '$_SESSION[id_subtes]'");
        $data = mysqli_fetch_array($getIntruksi);
        ?>
        <div class="card">
            <div class="card-header">
                <a href="list-tes.php" class="btn btn-sm btn-primary">
                    < Kembali</a>
                        Intruksi <?= $data['nama_subtes'] ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $data['nama_subtes'] ?></h5>
                <p class="card-text"><?= (isset($data['intruksi']) && $data['intruksi'] != "") ? $data['intruksi'] : $data['intruksi_tes']; ?></p>
                <?php
                if ($_SESSION['jenis_tes'] == "DISC" || $_SESSION['jenis_tes'] == "MBTI" || $_SESSION['jenis_tes'] == "MSDT") {
                ?>
                    <form action="#" method="post">
                        <?php
                        $getLog = mysqli_query($db, "SELECT tbl_jenistes.nama_tes, tbl_subtes.nama_subtes, tbl_subtes.tipe_soal, log.id_user, log.tipe, log.status FROM tbl_subtes INNER JOIN `tbl_jenistes` ON tbl_jenistes.id_jenistes = tbl_subtes.id_jenistes LEFT JOIN (SELECT * FROM `tbl_log` WHERE id_user = '$_SESSION[id_user]' AND tipe = 'Contoh') log ON log.id_subtes = tbl_subtes.id_subtes WHERE tbl_jenistes.nama_tes = '$_SESSION[jenis_tes]' AND tbl_subtes.id_subtes = '$_SESSION[id_subtes]'");
                        $log = mysqli_fetch_array($getLog);
                        $getLogSoal = mysqli_query($db, "SELECT tbl_jenistes.nama_tes, tbl_subtes.nama_subtes, tbl_subtes.tipe_soal, log.id_user, log.tipe, log.status FROM tbl_subtes INNER JOIN `tbl_jenistes` ON tbl_jenistes.id_jenistes = tbl_subtes.id_jenistes LEFT JOIN (SELECT * FROM `tbl_log` WHERE id_user = '$_SESSION[id_user]' AND tipe = 'Soal') log ON log.id_subtes = tbl_subtes.id_subtes WHERE tbl_jenistes.nama_tes = '$_SESSION[jenis_tes]' AND tbl_subtes.id_subtes = '$_SESSION[id_subtes]'");
                        $logSoal = mysqli_fetch_array($getLogSoal);
                        if (empty($logSoal['tipe']) || $logSoal['status'] == "Belum Selesai") {
                            echo '<input type="submit" name="submit" class="btn btn-lg btn-block btn-primary" value="MULAI">';
                        } else echo '<br/><br/><center>Tes sudah dikerjakan!</center>';
                        ?>
                    </form>
                <?php
                } else {
                ?>
                    <form action="#" method="post">
                        <?php
                        $getLog = mysqli_query($db, "SELECT tbl_jenistes.nama_tes, tbl_subtes.nama_subtes, tbl_subtes.tipe_soal, log.id_user, log.tipe, log.status FROM tbl_subtes INNER JOIN `tbl_jenistes` ON tbl_jenistes.id_jenistes = tbl_subtes.id_jenistes LEFT JOIN (SELECT * FROM `tbl_log` WHERE id_user = '$_SESSION[id_user]' AND tipe = 'Contoh') log ON log.id_subtes = tbl_subtes.id_subtes WHERE tbl_jenistes.nama_tes = '$_SESSION[jenis_tes]' AND tbl_subtes.id_subtes = '$_SESSION[id_subtes]'");
                        $log = mysqli_fetch_array($getLog); // log contoh
                        $getLogSoal = mysqli_query($db, "SELECT tbl_jenistes.nama_tes, tbl_subtes.nama_subtes, tbl_subtes.tipe_soal, log.id_user, log.tipe, log.status FROM tbl_subtes INNER JOIN `tbl_jenistes` ON tbl_jenistes.id_jenistes = tbl_subtes.id_jenistes LEFT JOIN (SELECT * FROM `tbl_log` WHERE id_user = '$_SESSION[id_user]' AND tipe = 'Soal') log ON log.id_subtes = tbl_subtes.id_subtes WHERE tbl_jenistes.nama_tes = '$_SESSION[jenis_tes]' AND tbl_subtes.id_subtes = '$_SESSION[id_subtes]'");
                        $logSoal = mysqli_fetch_array($getLogSoal); // log soal
                        if (empty($log['tipe']) || $log['status'] == "Belum Selesai") {
                            echo '<input type="submit" name="submit" class="btn btn-lg btn-block btn-primary" value="CONTOH SOAL">';
                        } else {
                            if (empty($logSoal['tipe']) || $logSoal['status'] == "Belum Selesai") {
                                echo '<input type="submit" name="submit" class="btn btn-lg btn-block btn-primary" value="MULAI">';
                            }
                        }
                        ?>
                    </form>
                <?php
                }
                if (isset($_POST['submit'])) {
                    $tanggalSekarang = date("Y-m-d H:i:s");
                    if ($_POST['submit'] == "MULAI") {
                        if ($_SESSION['jenis_tes'] != "DISC" && $_SESSION['jenis_tes'] != "PAPI KOSTICK") {
                            $cekLog = mysqli_query($db, "SELECT * FROM `tbl_log` WHERE id_user = '$_SESSION[id_user]' AND id_subtes = '$_SESSION[id_subtes]' AND tipe = 'Soal'");
                            if (mysqli_num_rows($cekLog) == 0) {
                                $inputLog = mysqli_query($db, "INSERT INTO `tbl_log` (id_user, id_subtes, tipe, tanggal) VALUES ('$_SESSION[id_user]', '$_SESSION[id_subtes]', 'Soal', '$tanggalSekarang')");
                                if ($inputLog) {
                                    echo "<meta http-equiv='refresh' content='0; url=../soal/soal.php'>";
                                }
                            } else {
                                echo "<meta http-equiv='refresh' content='0; url=../soal/soal.php'>";
                            }
                        } else if ($_SESSION['jenis_tes'] == "DISC" || $_SESSION['jenis_tes'] == "PAPI KOSTICK") {
                            $cekLog = mysqli_query($db, "SELECT * FROM `tbl_log` WHERE id_user = '$_SESSION[id_user]' AND id_subtes = '$_SESSION[id_subtes]' AND tipe = 'Soal'");
                            if (mysqli_num_rows($cekLog) == 0) {
                                $inputLog = mysqli_query($db, "INSERT INTO `tbl_log` (id_user, id_subtes, tipe, tanggal) VALUES ('$_SESSION[id_user]', '$_SESSION[id_subtes]', 'Soal', '$tanggalSekarang')");
                                if ($inputLog) {
                                    if ($_SESSION['jenis_tes'] == "PAPI KOSTICK") {
                                        echo "<meta http-equiv='refresh' content='0; url=../soal/papi.php'>";
                                    } else if ($_SESSION['jenis_tes'] == "DISC") {
                                        echo "<meta http-equiv='refresh' content='0; url=../soal/disc.php'>";
                                    }
                                }
                            } else {
                                if ($_SESSION['jenis_tes'] == "PAPI KOSTICK") {
                                    echo "<meta http-equiv='refresh' content='0; url=../soal/papi.php'>";
                                } else if ($_SESSION['jenis_tes'] == "DISC") {
                                    echo "<meta http-equiv='refresh' content='0; url=../soal/disc.php'>";
                                }
                            }
                        }
                    } else if ($_POST['submit'] == "CONTOH SOAL") {
                        $cekLog = mysqli_query($db, "SELECT * FROM `tbl_log` WHERE id_user = '$_SESSION[id_user]' AND id_subtes = '$_SESSION[id_subtes]' AND tipe = 'Contoh'");
                        if (mysqli_num_rows($cekLog) == 0) {
                            $inputLog = mysqli_query($db, "INSERT INTO `tbl_log` (id_user, id_subtes, tipe, tanggal) VALUES ('$_SESSION[id_user]', '$_SESSION[id_subtes]', 'Contoh', '$tanggalSekarang')");
                            if ($inputLog) {
                                if ($log['tipe_soal'] == "Hafalan") {
                                    echo "<meta http-equiv='refresh' content='0; url=../soal/hafalan.php?t=c'>";
                                } else echo "<meta http-equiv='refresh' content='0; url=../soal/contoh-soal.php'>";
                            }
                        } else {
                            if ($log['tipe_soal'] == "Hafalan") {
                                echo "<meta http-equiv='refresh' content='0; url=../soal/hafalan.php?t=c'>";
                            } else echo "<meta http-equiv='refresh' content='0; url=../soal/contoh-soal.php'>";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>