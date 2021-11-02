<?php
include("../koneksi.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Mulai Tes</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/sticky-navbar-footer.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .form-control:focus {
            border-color: #ff0000;
            box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset, 0px 0px 8px rgba(255, 100, 255, 0.5);
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['id_subtes'])) {
        $getDataSubtes = mysqli_query($db, "SELECT * FROM `tbl_contohsoal` INNER JOIN `tbl_subtes` ON tbl_contohsoal.subtes = tbl_subtes.nama_subtes WHERE tbl_subtes.id_subtes = '$_SESSION[id_subtes]' LIMIT 1");
        if (mysqli_num_rows($getDataSubtes) > 0) {
            $dataSubtes = mysqli_fetch_array($getDataSubtes);
    ?>
            <nav class="navbar navbar-dark bg-dark">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1 mx-auto">Contoh <?= $dataSubtes['nama_subtes'] ?></span>
                </div>
            </nav>
            <div class="container mt-1">
                <div class="card my-auto">
                    <div class="card-header d-flex">
                        <div class="pr-2 flex-fill"><?= $_SESSION['jenis_tes'] . ' - ' . $dataSubtes['nama_subtes'] ?></div>
                    </div>
                    <?php
                    if (isset($_SESSION['id_subtes'])) {
                        // paging
                        $limit = 1; // berapa banyak soal yang akan ditampilkan
                        $hitungSoal = mysqli_query($db, "SELECT COUNT(tbl_contohsoal.id_soal) AS 'jumlah' FROM `tbl_contohsoal` INNER JOIN `tbl_jenistes` ON tbl_contohsoal.jenis_tes = tbl_jenistes.nama_tes INNER JOIN `tbl_subtes` ON tbl_subtes.nama_subtes = tbl_contohsoal.subtes WHERE tbl_jenistes.nama_tes = '$_SESSION[jenis_tes]' AND tbl_subtes.id_subtes = '$_SESSION[id_subtes]'");
                        $getRow = mysqli_fetch_row($hitungSoal);
                        $total_records = $getRow[0]; // ambil baris pertama dari hasil query
                        $total_pages = ceil($total_records / $limit);
                        // selesai paging

                        $alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X ', 'Y', 'Z');
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else $page = 1;
                        $limit = 1;
                        $start_from = $start_from = ($page - 1) * $limit;
                        $listSoal = mysqli_query($db, "SELECT * FROM `tbl_contohsoal` WHERE jenis_tes = '$_SESSION[jenis_tes]' AND subtes = '$dataSubtes[nama_subtes]' ORDER BY added_at ASC LIMIT $start_from, $limit");
                        if (mysqli_num_rows($listSoal) > 0) {
                            $soal = mysqli_fetch_array($listSoal);
                    ?>
                            <div class="card-body">
                                <form action="#" method="POST">
                                    <input type="hidden" name="id_soal" value="<?= $soal['id_soal'] ?>" />
                                    <?php
                                    echo $soal['soal'];
                                    if (isset($soal['gambar']) && $soal['gambar'] != "") { //cek apakah ada gambar pada soal
                                        echo "<img src='../image/" . $soal['gambar'] . "' class='img-fluid'/><br/>";
                                    }
                                    echo '<div id="lembarJawab">';
                                    if ($soal['jenis_jawaban'] == "Pilihan Ganda" || $soal['jenis_jawaban'] == "Hafalan") {
                                        if ($soal['jumlah_benar'] == 0) {
                                            $pilihan = explode("#", $soal['pilihan']);
                                            for ($i = 0; $i < count($pilihan); $i++) {
                                    ?>
                                                <input type="radio" name="jawaban" id="jawaban_<?= $i; ?>" value="<?= $alpha[$i] ?>" />
                                                <label for="jawaban_<?= $i; ?>"><?= $pilihan[$i] ?></label><br />
                                            <?php
                                            }
                                        } else if ($soal['jumlah_benar'] == 1) {
                                            for ($i = 0; $i < $soal['jumlah_jawaban']; $i++) {
                                            ?>
                                                <input type="radio" name="jawaban" id="jawaban_<?= $i; ?>" value="<?= $alpha[$i] ?>" />
                                                <label for="jawaban_<?= $i; ?>"><?= $alpha[$i] ?></label><br />
                                            <?php
                                            }
                                        } else if ($soal['jumlah_benar'] > 1) {
                                            for ($i = 0; $i < $soal['jumlah_jawaban']; $i++) {
                                            ?>
                                                <input type="checkbox" id="jawaban_<?= $i; ?>" name="jawaban_lebih[]" value="<?= $alpha[$i]; ?>" />
                                                <label for="jawaban_<?= $i; ?>" class="mt-2 mr-2 mb-2"><?= $alpha[$i]; ?></label><br />
                                            <?php
                                            }
                                        }
                                    } else if ($soal['jenis_jawaban'] == "Isian") {
                                        echo '<input type="text" name="jawaban" class="form-control col-lg-6 col-md-12" autofocus/><br/>';
                                    } else if ($soal['jenis_jawaban'] == "Aritmatika") {
                                        for ($i = 0; $i < 10; $i++) {
                                            ?>
                                            <input type="checkbox" id="jawaban_<?= $i; ?>" name="jawaban_lebih[]" value="<?= $i ?>" />
                                            <label for="jawaban_<?= $i; ?>" class="mt-2 mr-2 mb-2"><?= $i; ?></label><br />
                                            <?php
                                        }
                                    } else if ($soal['jenis_jawaban'] == "Gambar") {
                                        echo '<div class="d-flex flex-row">';
                                        if (isset($soal['paket_gambar'])) {
                                            $paketGambar = mysqli_query($db, "SELECT * FROM `tbl_paketgambar` WHERE nama_paket = '$soal[paket_gambar]'");
                                            if (mysqli_num_rows($paketGambar) > 0) {
                                                $row = mysqli_fetch_array($paketGambar);
                                                $format = explode('.', $row['gambar']);
                                                for ($i = 0; $i < $row['jumlah_gambar']; $i++) {
                                            ?>
                                                    <div class="p-2" align="center">
                                                        <label for="jawaban<?php echo $i ?>" class="mt-2 mr-2 mb-2"><img src="../image/<?= $row['nama_paket'] . '-' . ($i + 1) . "." . end($format) ?>" style="max-width:65%" /></label><br />
                                                        <input type="radio" id="jawaban<?php echo $i ?>" name="jawaban" value="<?= $alpha[$i] ?>" /><br />
                                                    </div>
                                    <?php
                                                }
                                            }
                                        }
                                        echo "</div>";
                                    }
                                    echo "</div>";
                                    ?>
                                    <div id="selanjutnya" style="display:none">
                                        <a href="?page=<?= $page + 1; ?>" class="btn btn-primary">Selanjutnya</a>
                                    </div>
                                    <div id="tombolPeriksa">
                                        <input type="submit" value="Submit" name="periksa" class="btn btn-primary" />
                                    </div>
                                    <div id="kembaliKerjakan" style="display:none">
                                        <input type="submit" value="Selesai" name="periksa" class="btn btn-primary" />
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['periksa']) && $_POST['periksa'] == "Submit") {
                                    if (isset($_POST['jawaban']) || isset($_POST['jawaban_lebih'])) {
                                        echo '<script>$("#lembarJawab").hide();</script>';
                                        echo '<script>$("#tombolPeriksa").hide();</script>';
                                        echo '<script>$("#selanjutnya").show();</script>';
                                        if ($soal['jenis_jawaban'] == "Pilihan Ganda" || $soal['jenis_jawaban'] == "Hafalan") {
                                            if ($soal['jumlah_benar'] == 0 || $soal['jumlah_benar'] == 1) {
                                                $jawaban = $_POST['jawaban'];
                                            } else $jawaban = implode("|", $_POST['jawaban_lebih']);
                                        } else if ($soal['jenis_jawaban'] == "Isian" || $soal['jenis_jawaban'] == "Gambar") {
                                            $jawaban = $_POST['jawaban'];
                                        } else if ($soal['jenis_jawaban'] == "Aritmatika") {
                                            $jawaban = str_split(implode("|", $_POST['jawaban_lebih']));
                                        }
                                        // Periksa Jawaban
                                        $periksaSoal = mysqli_query($db, "SELECT * FROM `tbl_contohsoal` WHERE id_soal = '$_POST[id_soal]'");
                                        $hasil = mysqli_fetch_array($periksaSoal);
                                        $infoBenar = '<div class="p-1 mt-3 mb-3 ml-2 mr-2 text-success"><i class="fas fa-check-circle"></i> Jawaban Benar</div>';
                                        $infoSalah = '<div class="p-1 mt-3 mb-3 ml-2 mr-2 border border-secondary"><span class="text-danger"><i class="fas fa-times-circle"></i> Jawaban Salah</span><br/>' . $hasil['penjelasan'] . '</div>';
                                        if ($soal['jenis_tes'] == "PAPI KOSTICK") {
                                            echo '<div class="p-1 mt-3 mb-3 ml-2 mr-2 border border-secondary">' . $soal['penjelasan'] . '</div>';
                                        } else {
                                            if ($soal['jenis_jawaban'] == "Pilihan Ganda" || $soal['jenis_jawaban'] == "Isian" || $soal['jenis_jawaban'] == "Gambar" || $soal['jenis_jawaban'] == "Hafalan") {
                                                if ($soal['subtes'] == "GE") {
                                                    $ekstrak1 = explode("|", $soal['jawaban_benar']);
                                                    if (count($ekstrak1) > 1) {
                                                        $poin2 = explode("#", $ekstrak1[0]);
                                                        $poin1 = explode("#", $ekstrak1[1]);
                                                        $poin0 = explode("#", $ekstrak1[2]);

                                                        $poin = 0;
                                                        $cari = strtolower($jawaban);
                                                        if (in_array($cari, array_map("strtolower", $poin2))) {
                                                            $poin = 2;
                                                        } else if (in_array($cari, array_map("strtolower", $poin1))) {
                                                            $poin = 1;
                                                        } else if (in_array($cari, array_map("strtolower", $poin0))) {
                                                            $poin = 0;
                                                        }
                                                        if ($poin > 0) {
                                                            echo $infoBenar;
                                                        } else echo $infoSalah;
                                                    } else {
                                                        if (strtoupper($jawaban) == strtoupper($hasil['jawaban_benar'])) {
                                                            echo $infoBenar;
                                                        } else echo $infoSalah;
                                                    }
                                                } else {
                                                    if (strtoupper($jawaban) == strtoupper($hasil['jawaban_benar'])) {
                                                        echo $infoBenar;
                                                    } else echo $infoSalah;
                                                }
                                            } else if ($soal['jenis_jawaban'] == "Aritmatika") {
                                                $jawabanBenar = str_split($soal['jawaban_benar']);
                                                $totalKecocokan = 0;
                                                for ($i = 0; $i < count($jawabanBenar); $i++) {
                                                    for ($j = 0; $j < count($jawaban); $j++) {
                                                        if (strtoupper($jawaban[$j]) == strtoupper($jawabanBenar[$i])) {
                                                            $totalKecocokan++;
                                                        }
                                                    }
                                                }
                                                if ($totalKecocokan == count($jawabanBenar)) {
                                                    echo $infoBenar;
                                                } else echo $infoSalah;
                                            }
                                        }
                                        if ($page == $total_pages) {
                                            echo '<script>$("#selanjutnya").hide();</script>';
                                            echo '<script>$("#kembaliKerjakan").show();</script>';
                                        }
                                    }
                                }
                                if (isset($_POST['periksa']) && $_POST['periksa'] == "Selesai") {
                                    $updateSql = mysqli_query($db, "UPDATE `tbl_log` SET `status` = 'Selesai' WHERE id_user = '$_SESSION[id_user]' AND id_subtes = '$_SESSION[id_subtes]' AND tipe = 'Contoh'");
                                    if ($updateSql) echo "<meta http-equiv='refresh' content='0; url=../user/intruksi.php'>";
                                }
                                ?>
                            </div>
            <?php
                        }
                    }
                }
            }
            ?>
                </div>
            </div>
</body>

</html>