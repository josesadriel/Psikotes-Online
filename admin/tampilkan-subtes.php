<?php
include("../koneksi.php");
$getSubtes = mysqli_query($db, "SELECT * FROM `tbl_subtes` WHERE nama_subtes = '$_GET[subtes]'");
if (mysqli_num_rows($getSubtes) > 0) {
    while ($data = mysqli_fetch_array($getSubtes)) {
?>
        <input type="hidden" id="ts" name="tipe_soal" class="form-control col-lg-6 col-md-12" value="<?= $data['tipe_soal']; ?>" readonly />
<?php
    }
}
?>