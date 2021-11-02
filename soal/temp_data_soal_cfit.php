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
$jumlahSoal = mysqli_query($db, "SELECT COUNT(tbl_soal.id_soal) AS 'jumlah' FROM `tbl_soal` INNER JOIN `tbl_jenistes` ON tbl_soal.jenis_tes = tbl_jenistes.nama_tes INNER JOIN `tbl_subtes` ON tbl_subtes.nama_subtes = tbl_soal.subtes WHERE tbl_jenistes.nama_tes = 'CFIT' AND tbl_subtes.id_subtes = '$_GET[id_subtes]'");
$getJumlah = mysqli_fetch_array($jumlahSoal);

$sql = "SELECT tbl_soal.* FROM `tbl_soal` INNER JOIN `tbl_jenistes` ON tbl_soal.jenis_tes = tbl_jenistes.nama_tes INNER JOIN `tbl_subtes` ON tbl_subtes.nama_subtes = tbl_soal.subtes WHERE tbl_jenistes.nama_tes = 'CFIT' AND tbl_subtes.id_subtes = '$_GET[id_subtes]' LIMIT $start_from, $limit";
$rs_result = mysqli_query($db, $sql);
while ($data = mysqli_fetch_array($rs_result)) {
    if (mysqli_num_rows($rs_result) > 0) {
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

                if ($data['jumlah_benar'] == 1) {
                    for ($ulang = 0; $ulang < $data['jumlah_jawaban']; $ulang++) {

                ?>
                        <input type="radio" id="jawaban<?php echo $nomor . $ulang; ?>" name="jawaban" value="<?php echo $alpha[$ulang]; ?>" />
                        <label for="jawaban<?php echo $nomor . $ulang; ?>" class="mt-2 mr-2 mb-2"><?php echo $alpha[$ulang]; ?></label><br />
                    <?php
                    }
                } else if ($data['jumlah_benar'] > 1) {
                    for ($ulang = 0; $ulang < $data['jumlah_jawaban']; $ulang++) {

                    ?>

                        <input type="checkbox" id="jawaban<?php echo $nomor . $ulang; ?>" name="jawaban_lebih[]" value="<?php echo $alpha[$ulang]; ?>" />
                        <label for="jawaban<?php echo $nomor . $ulang; ?>" class="mt-2 mr-2 mb-2"><?php echo $alpha[$ulang]; ?></label><br />
                    <?php
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