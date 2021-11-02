<?php
session_start();
include('../koneksi.php');

$limit = 1;
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;
$nomor = 1;
$jumlahSoal = mysqli_query($db, "SELECT COUNT(tbl_soal.id_soal) AS 'jumlah' FROM `tbl_soal` INNER JOIN `tbl_jenistes` ON tbl_soal.jenis_tes = tbl_jenistes.nama_tes INNER JOIN `tbl_subtes` ON tbl_subtes.nama_subtes = tbl_soal.subtes WHERE tbl_jenistes.nama_tes = '$_SESSION[jenis_tes]' AND tbl_subtes.id_subtes = '$_SESSION[id_subtes]'");
$getJumlah = mysqli_fetch_array($jumlahSoal);

$sql = "SELECT tbl_soal.* FROM `tbl_soal` INNER JOIN `tbl_jenistes` ON tbl_soal.jenis_tes = tbl_jenistes.nama_tes INNER JOIN `tbl_subtes` ON tbl_subtes.nama_subtes = tbl_soal.subtes WHERE tbl_jenistes.nama_tes = '$_SESSION[jenis_tes]' AND tbl_subtes.id_subtes = '$_SESSION[id_subtes]' LIMIT $start_from, $limit";
$rs_result = mysqli_query($db, $sql);
while ($data = mysqli_fetch_array($rs_result)) {
    if (mysqli_num_rows($rs_result) > 0) {
        $cekJawaban = mysqli_query($db, "SELECT * FROM `tbl_jwbuser` WHERE id_soal = '$data[id_soal]' AND id_user = '$_SESSION[id_user]'");
        $jawabanUser = mysqli_fetch_array($cekJawaban);
?>
        <div>
            <form id="form-jawaban" method="post">
                <input type="number" value="<?php echo $data['id_soal']; ?>" name="id" style="display:none" />
                <?php echo $data['soal']; ?>
                <?php
                if (isset($data['gambar']) && $data['gambar'] != "") { //cek apakah ada gambar pada soal
                    echo "<img src='../image/" . $data['gambar'] . "' class='img-fluid'/><br/>";
                }
                $alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X ', 'Y', 'Z');
                echo "<div class='mt-3 mb-2'>Jawab:</div>";
                if ($data['jenis_jawaban'] == "Pilihan Ganda" || $data['jenis_jawaban'] == "Hafalan") {
                    if (isset($data['pilihan']) && $data['pilihan'] != "") {
                        $pilihan = explode("#", $data['pilihan']);
                        for ($i = 0; $i < count($pilihan); $i++) {
                            if (isset($jawabanUser['jawaban']) && $jawabanUser['jawaban'] == $alpha[$i]) {
                ?>
                                <input type="radio" id="jawaban<?php echo $nomor . $i ?>" name="jawaban" value="<?= $alpha[$i] ?>" checked />
                                <label for="jawaban<?php echo $nomor . $i ?>" class="mt-2 mr-2 mb-2"><?= $pilihan[$i]; ?></label><br />
                            <?php
                            } else {
                            ?>
                                <input type="radio" id="jawaban<?php echo $nomor . $i ?>" name="jawaban" value="<?= $alpha[$i] ?>" />
                                <label for="jawaban<?php echo $nomor . $i ?>" class="mt-2 mr-2 mb-2"><?= $pilihan[$i]; ?></label><br />
                                <?php
                            }
                        }
                    } else {
                        if ($data['jumlah_benar'] == 1) {
                            for ($ulang = 0; $ulang < $data['jumlah_jawaban']; $ulang++) {
                                if (isset($jawabanUser['jawaban']) && $jawabanUser['jawaban'] == $alpha[$ulang]) {
                                ?>
                                    <input type="radio" id="jawaban<?php echo $nomor . $ulang; ?>" name="jawaban" value="<?php echo $alpha[$ulang]; ?>" checked />
                                    <label for="jawaban<?php echo $nomor . $ulang; ?>" class="mt-2 mr-2 mb-2"><?php echo $alpha[$ulang]; ?></label><br />
                                <?php
                                } else {
                                ?>
                                    <input type="radio" id="jawaban<?php echo $nomor . $ulang; ?>" name="jawaban" value="<?php echo $alpha[$ulang]; ?>" />
                                    <label for="jawaban<?php echo $nomor . $ulang; ?>" class="mt-2 mr-2 mb-2"><?php echo $alpha[$ulang]; ?></label><br />
                                    <?php
                                }
                            }
                        } else if ($data['jumlah_benar'] > 1) {
                            for ($ulang = 0; $ulang < $data['jumlah_jawaban']; $ulang++) {
                                if (isset($jawabanUser['jawaban'])) {
                                    $jawaban = $jawabanUser['jawaban'];
                                    if (strpos($jawaban, $alpha[$ulang]) !== false) {
                                    ?>

                                        <input type="checkbox" id="jawaban<?php echo $nomor . $ulang; ?>" name="jawaban_lebih[]" value="<?php echo $alpha[$ulang]; ?>" checked />
                                        <label for="jawaban<?php echo $nomor . $ulang; ?>" class="mt-2 mr-2 mb-2"><?php echo $alpha[$ulang]; ?></label><br />
                                    <?php
                                    } else {
                                    ?>
                                        <input type="checkbox" id="jawaban<?php echo $nomor . $ulang; ?>" name="jawaban_lebih[]" value="<?php echo $alpha[$ulang]; ?>" />
                                        <label for="jawaban<?php echo $nomor . $ulang; ?>" class="mt-2 mr-2 mb-2"><?php echo $alpha[$ulang]; ?></label><br />
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <input type="checkbox" id="jawaban<?php echo $nomor . $ulang; ?>" name="jawaban_lebih[]" value="<?php echo $alpha[$ulang]; ?>" />
                                    <label for="jawaban<?php echo $nomor . $ulang; ?>" class="mt-2 mr-2 mb-2"><?php echo $alpha[$ulang]; ?></label><br />
                    <?php
                                }
                            }
                        }
                    }
                } else if ($data['jenis_jawaban'] == "Isian") {
                    ?>
                    <input type="text" name="jawaban" class="form-control col-lg-6 col-md-12" autofocus /><br />
                    <?php
                } else if ($data['jenis_jawaban'] == "Aritmatika") {
                    for ($i = 0; $i < 10; $i++) {
                    ?>
                        <input type="checkbox" id="jawaban<?php echo $nomor . $i; ?>" name="jawaban_lebih[]" value="<?php echo $i; ?>" />
                        <label for="jawaban<?php echo $nomor . $i; ?>" class="mt-2 mr-2 mb-2"><?php echo $i; ?></label><br />
                        <?php
                    }
                    if (isset($jawabanUser['jawaban'])) {
                        $jawaban = $jawabanUser['jawaban'];
                        echo "<script>";
                        for ($j = 0; $j < strlen((string)$data['jawaban_benar']); $j++) {
                            if (strpos($jawaban, $data['jawaban_benar'][$j]) !== false) {
                                echo "$('#jawaban" . $nomor . $data['jawaban_benar'][$j] . "').prop('checked',true);";
                            }
                        }
                        echo "</script>";
                    }
                } else if ($data['jenis_jawaban'] == "Gambar") {
                    if (isset($data['paket_gambar'])) {
                        $paketGambar = mysqli_query($db, "SELECT * FROM `tbl_paketgambar` WHERE nama_paket = '$data[paket_gambar]'");
                        if (mysqli_num_rows($paketGambar) > 0) {
                            $row = mysqli_fetch_array($paketGambar);
                            $format = explode('.', $row['gambar']);
                            for ($i = 0; $i < $row['jumlah_gambar']; $i++) {
                                if (isset($jawabanUser['jawaban']) && $jawabanUser['jawaban'] == $alpha[$i]) {
                        ?>
                                    <input type="radio" id="jawaban<?php echo $nomor . $i ?>" name="jawaban" value="<?= $alpha[$i] ?>" checked />
                                    <label for="jawaban<?php echo $nomor . $i ?>" class="mt-2 mr-2 mb-2"><img src="../image/<?= $row['nama_paket'] . '-' . ($i + 1) . "." . end($format) ?>" /></label><br />
                                <?php
                                } else {
                                ?>
                                    <input type="radio" id="jawaban<?php echo $nomor . $i ?>" name="jawaban" value="<?= $alpha[$i] ?>" />
                                    <label for="jawaban<?php echo $nomor . $i ?>" class="mt-2 mr-2 mb-2"><img src="../image/<?= $row['nama_paket'] . '-' . ($i + 1) . "." . end($format) ?>" /></label><br />
                    <?php
                                }
                            }
                        }
                    }
                }
                if ($page == $getJumlah['jumlah']) {
                    ?>
                    <input type="submit" id="submit_jawaban" name="submit_jawaban" class="btn btn-primary btn-md btn-block" value="Submit Jawaban" />
                <?php
                }
                ?>
            </form>
        </div>
<?php
    }
}
?>