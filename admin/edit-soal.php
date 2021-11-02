<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Edit Soal</title>

    <!-- Summernote JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Edit Soal</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="kelola-soal.php">Kelola Soal</a></li>
                    <li class="breadcrumb-item active">Edit Soal</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <?php
                            $alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X ', 'Y', 'Z');
                            if (isset($_GET['id']) && isset($_GET['tipe'])) {
                                if ($_GET['tipe'] == "soal") {
                                    $dataSoal = mysqli_query($db, "SELECT * FROM `tbl_soal` WHERE id_soal = '$_GET[id]'");
                                } else if ($_GET['tipe'] == "contoh") {
                                    $dataSoal = mysqli_query($db, "SELECT * FROM `tbl_contohsoal` WHERE id_soal = '$_GET[id]'");
                                }
                                if (mysqli_num_rows($dataSoal) > 0) {
                                    $data = mysqli_fetch_array($dataSoal);
                                    if (isset($data['pilihan'])) {
                                        $pilihan = $data['pilihan'];
                                        $pilihan = explode("#", $pilihan);
                                    }
                            ?>
                                    Soal:<br />
                                    <textarea id="summernote" name="soal"><?php echo $data['soal']; ?></textarea><br />
                                    <div id="uploadGambar">
                                        Gambar (optional):<br />
                                        <?php
                                        if (!empty($data['gambar'])) {
                                            echo '<img src="../image/' . $data['gambar'] . '" style="max-width:100%"/><br/>';
                                        }
                                        ?>
                                        <input type="file" name="gambarSoal" accept="image/*" /><br />
                                    </div>
                                    <br />
                                    <?php
                                    if (($data['jenis_jawaban'] == "Pilihan Ganda" || $data['jenis_jawaban'] == "Hafalan") && isset($data['pilihan'])) {
                                        echo "Pilihan Ganda:<br />";
                                        for ($i = 0; $i < count($pilihan); $i++) {

                                    ?>
                                            <div class="d-flex justify-between-content mb-1">
                                                <div class="mt-1 mr-4"><?= $alpha[$i] ?></div>
                                                <input type="text" name="pilihan[]" class="form-control col-5" value="<?= $pilihan[$i] ?>" />
                                                <?php
                                                if ($data['jenis_tes'] == "IST") {
                                                ?>
                                                    <input type="radio" name="pilihanBenar" value="<?= $alpha[$i] ?>" class="mt-2 ml-2" <?= (isset($data['jawaban_benar']) && $data['jawaban_benar'] == $alpha[$i]) ? "checked" : "" ?> />
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        <?php
                                        }
                                    } else if ($data['jenis_jawaban'] == "Isian" || $data['jenis_jawaban'] == "Aritmatika") {
                                        ?>
                                        <?php
                                        if ($data['subtes'] == "GE") {
                                            $ekstrak = explode("|", $data['jawaban_benar']);
                                            if (count($ekstrak) > 1) {
                                                $point2 = explode("#", $ekstrak[0]);
                                                $point1 = explode("#", $ekstrak[1]);
                                                $point0 = explode("#", $ekstrak[2]);
                                            }
                                        ?>
                                            <div id="poinBenar">
                                                Jumlah jawaban yang bernilai <b>2 poin</b>:<br />
                                                <input type="number" name="2poin" id="2poin" oninput="tambahField('2poin')" class="form-control col-lg-6 col-md-12" value="<?= count($point2) ?>"><br />
                                                <div id="field_2poin"></div><br />
                                                Jumlah jawaban yang bernilai <b>1 poin</b>:<br />
                                                <input type="number" name="1poin" id="1poin" oninput="tambahField('1poin')" class="form-control col-lg-6 col-md-12" value="<?= count($point1) ?>"><br />
                                                <div id="field_1poin"></div><br />
                                                Jumlah jawaban yang bernilai <b>0 poin</b>:<br />
                                                <input type="number" name="0poin" id="0poin" oninput="tambahField('0poin')" class="form-control col-lg-6 col-md-12" value="<?= count($point0) ?>"><br />
                                                <div id="field_0poin"></div><br />
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="isianBenar">
                                                Jawaban Benar:<br />
                                                <input type="text" name="jawaban_benar" value="<?= $data['jawaban_benar'] ?>" class="form-control col-lg-6 col-md-12" />
                                            </div>
                                        <?php
                                        }
                                    } else if ($data['jenis_jawaban'] == "Gambar") {
                                        ?>
                                        Paket Gambar:<br />
                                        <select name="paket_gambar" class="form-control col-lg-6 col-md-12">
                                            <option value="" disabled selected>-</option>
                                            <?php
                                            $getListPaketGambar = mysqli_query($db, "SELECT * FROM `tbl_paketgambar`");
                                            if (mysqli_num_rows($getListPaketGambar) > 0) {
                                                while ($paketGambar = mysqli_fetch_array($getListPaketGambar)) {
                                            ?>
                                                    <option value="<?= $paketGambar['nama_paket'] ?>" <?= (isset($data['paket_gambar']) && $data['paket_gambar'] == $paketGambar['nama_paket']) ? "selected" : "" ?>><?= $paketGambar['nama_paket'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select><br />
                                        <div class="isianBenar">
                                            Jawaban Benar:<br />
                                            <input type="text" name="jawaban_benar" value="<?= $data['jawaban_benar'] ?>" class="form-control col-lg-6 col-md-12" />
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <br />

                                    <input type="submit" name="edit" class="btn bg-primary" value="Edit Soal" />
                            <?php
                                }
                            }
                            ?>
                        </form>
                        <?php
                        if (isset($_POST['edit'])) {
                            if (is_uploaded_file($_FILES['gambarSoal']['tmp_name'])) {
                                $dirGambar = "../image/";
                                if (isset($data['gambar'])) {
                                    $namaFile = $data['gambar'];
                                    $moveGambar = move_uploaded_file($_FILES['gambarSoal']['tmp_name'], $dirGambar . $namaFile);
                                    if ($moveGambar) {
                                        if ($data['jenis_jawaban'] == "Pilihan Ganda" || $data['jenis_jawaban'] == "Hafalan") {
                                            $pilihan = implode("#", $_POST['pilihan']);
                                            if ($data['jenis_tes'] == "IST") {
                                                if ($_GET['tipe'] == "soal") {
                                                    $sql = "UPDATE `tbl_soal` SET `soal` = '$_POST[soal]', `gambar` = '$namaFile', `pilihan` = '$pilihan', `jawaban_benar` = '$_POST[pilihanBenar]' WHERE `id_soal` = '$_GET[id]';";
                                                } else if ($_GET['tipe'] == "contoh") {
                                                    $sql = "UPDATE `tbl_contohsoal` SET `soal` = '$_POST[soal]', `gambar` = '$namaFile', `pilihan` = '$pilihan', `jawaban_benar` = '$_POST[pilihanBenar]' WHERE `id_soal` = '$_GET[id]';";
                                                }
                                            } else {
                                                if ($_GET['tipe'] == "soal") {
                                                    $sql = "UPDATE `tbl_soal` SET `soal` = '$_POST[soal]', `gambar` = '$namaFile', `pilihan` = '$pilihan' WHERE `id_soal` = '$_GET[id]';";
                                                } else if ($_GET['tipe'] == "contoh") {
                                                    $sql = "UPDATE `tbl_contohsoal` SET `soal` = '$_POST[soal]', `gambar` = '$namaFile', `pilihan` = '$pilihan' WHERE `id_soal` = '$_GET[id]';";
                                                }
                                            }
                                        } else if ($data['jenis_jawaban'] == "Isian" || $data['jenis_jawaban'] == "Aritmatika") {
                                            if ($_GET['tipe'] == "soal") {
                                                $sql = "UPDATE `tbl_soal` SET `soal` = '$_POST[soal]', `gambar` = '$namaFile', `jawaban_benar` = '$_POST[jawaban_benar]' WHERE `id_soal` = '$_GET[id]';";
                                            } else if ($_GET['tipe'] == "contoh") {
                                                $sql = "UPDATE `tbl_contohsoal` SET `soal` = '$_POST[soal]', `gambar` = '$namaFile', `jawaban_benar` = '$_POST[jawaban_benar]' WHERE `id_soal` = '$_GET[id]';";
                                            }
                                        } else if ($data['jenis_jawaban'] == "Gambar") {
                                            if ($_GET['tipe'] == "soal") {
                                                $sql = "UPDATE `tbl_soal` SET `soal` = '$_POST[soal]', `gambar` = '$namaFile', `jawaban_benar` = '$_POST[jawaban_benar]', `paket_gambar` = '$_POST[paket_gambar]' WHERE `id_soal` = '$_GET[id]';";
                                            }
                                            if ($_GET['tipe'] == "contoh") {
                                                $sql = "UPDATE `tbl_contohsoal` SET `soal` = '$_POST[soal]', `gambar` = '$namaFile', `jawaban_benar` = '$_POST[jawaban_benar]', `paket_gambar` = '$_POST[paket_gambar]' WHERE `id_soal` = '$_GET[id]';";
                                            }
                                        }
                                        if (isset($sql)) {
                                            $editSql = mysqli_query($db, $sql);
                                            if ($editSql) {
                                                echo "<meta http-equiv='refresh' content='0; url=kelola-soal.php'>";
                                            }
                                        }
                                    }
                                }
                            } else {
                                if ($data['jenis_jawaban'] == "Pilihan Ganda" || $data['jenis_jawaban'] == "Hafalan") {
                                    $pilihan = implode("#", $_POST['pilihan']);
                                    if ($data['jenis_tes'] == "IST") {
                                        if ($_GET['tipe'] == "soal") {
                                            $sql = "UPDATE `tbl_soal` SET `soal` = '$_POST[soal]', `pilihan` = '$pilihan', `jawaban_benar` = '$_POST[pilihanBenar]' WHERE `id_soal` = '$_GET[id]';";
                                        } else if ($_GET['tipe'] == "contoh") {
                                            $sql = "UPDATE `tbl_contohsoal` SET `soal` = '$_POST[soal]', `pilihan` = '$pilihan', `jawaban_benar` = '$_POST[pilihanBenar]' WHERE `id_soal` = '$_GET[id]';";
                                        }
                                    } else {
                                        if ($_GET['tipe'] == "soal") {
                                            $sql = "UPDATE `tbl_soal` SET `soal` = '$_POST[soal]', `pilihan` = '$pilihan' WHERE `id_soal` = '$_GET[id]';";
                                        } else if ($_GET['tipe'] == "contoh") {
                                            $sql = "UPDATE `tbl_contohsoal` SET `soal` = '$_POST[soal]', `pilihan` = '$pilihan' WHERE `id_soal` = '$_GET[id]';";
                                        }
                                    }
                                } else if ($data['jenis_jawaban'] == "Isian" || $data['jenis_jawaban'] == "Aritmatika") {
                                    if ($_GET['tipe'] == "soal") {
                                        if ($data['subtes'] == "GE") {
                                            $point2 = implode("#", $_POST['pgBenar2poin']);
                                            $point1 = implode("#", $_POST['pgBenar1poin']);
                                            $point0 = implode("#", $_POST['pgBenar0poin']);
                                            $penilaian = $point2 . "|" . $point1 . "|" . $point0;

                                            $sql = "UPDATE `tbl_soal` SET `soal` = '$_POST[soal]', `jawaban_benar` = '$penilaian' WHERE `id_soal` = '$_GET[id]';";
                                        } else {
                                            $sql = "UPDATE `tbl_soal` SET `soal` = '$_POST[soal]', `jawaban_benar` = '$_POST[jawaban_benar]' WHERE `id_soal` = '$_GET[id]';";
                                        }
                                    } else if ($_GET['tipe'] == "contoh") {
                                        if ($data['subtes'] == "GE") {
                                            $point2 = implode("#", $_POST['pgBenar2poin']);
                                            $point1 = implode("#", $_POST['pgBenar1poin']);
                                            $point0 = implode("#", $_POST['pgBenar0poin']);
                                            $penilaian = $point2 . "|" . $point1 . "|" . $point0;

                                            $sql = "UPDATE `tbl_contohsoal` SET `soal` = '$_POST[soal]', `jawaban_benar` = '$penilaian' WHERE `id_soal` = '$_GET[id]';";
                                        } else {
                                            $sql = "UPDATE `tbl_contohsoal` SET `soal` = '$_POST[soal]', `jawaban_benar` = '$_POST[jawaban_benar]' WHERE `id_soal` = '$_GET[id]';";
                                        }
                                    }
                                } else if ($data['jenis_jawaban'] == "Gambar") {
                                    if ($_GET['tipe'] == "soal") {
                                        $sql = "UPDATE `tbl_soal` SET `soal` = '$_POST[soal]', `jawaban_benar` = '$_POST[jawaban_benar]', `paket_gambar` = '$_POST[paket_gambar]' WHERE `id_soal` = '$_GET[id]';";
                                    }
                                    if ($_GET['tipe'] == "contoh") {
                                        $sql = "UPDATE `tbl_contohsoal` SET `soal` = '$_POST[soal]', `jawaban_benar` = '$_POST[jawaban_benar]', `paket_gambar` = '$_POST[paket_gambar]' WHERE `id_soal` = '$_GET[id]';";
                                    }
                                }
                                if (isset($sql)) {
                                    $updateSql = mysqli_query($db, $sql);
                                    if ($updateSql) echo "<meta http-equiv='refresh' content='0; url=kelola-soal.php'>";
                                }
                            }
                        }
                        ?>
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
<script>
    function tambahField(namaId) {
        var val = document.getElementById(namaId).value;
        var str = "";
        var jwb_soal = "<?= $data['jawaban_benar'] ?>";
        var jwb_soal = jwb_soal.split("|");
        if (jwb_soal.length > 1) {
            if (namaId == "2poin") {
                var jawaban = jwb_soal[0].split("#");
            } else if (namaId == "1poin") {
                var jawaban = jwb_soal[1].split("#");
            } else if (namaId == "0poin") {
                var jawaban = jwb_soal[2].split("#");
            }
        } else {
            var jawaban = jwb_soal;
        }
        for (i = 0; i < val; i++) {
            if (jawaban[i] == null) {
                str += "Jawaban [" + (i + 1) + "]:<br/><input type='text' name='pgBenar" + namaId + "[]' value='' class = 'form-control col-lg-6 col-md-12' /> <br/>";
            } else {
                str += "Jawaban [" + (i + 1) + "]:<br/><input type='text' name='pgBenar" + namaId + "[]' value='" + jawaban[i] + "' class = 'form-control col-lg-6 col-md-12' /> <br/>";
            }
        }
        if (namaId == "2poin") document.getElementById('field_2poin').innerHTML = str;
        else if (namaId == "1poin") document.getElementById('field_1poin').innerHTML = str;
        if (namaId == "0poin") document.getElementById('field_0poin').innerHTML = str;
    }
    $(document).ready(function() {
        tambahField("2poin");
        tambahField("1poin");
        tambahField("0poin");
    });
    $('#summernote').summernote({
        placeholder: 'Ketik Soal...',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['view', ['fullscreen', 'help']]
        ]
    });
</script>

</html>