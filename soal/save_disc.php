<style>
    body {
        color: white
    }
</style>
<?php
session_start();
include("../koneksi.php");

if (isset($_POST['id_soal']) && isset($_POST['setuju']) && isset($_POST['tidak_setuju'])) {
    $cekJawaban = mysqli_query($db, "SELECT * FROM `jawaban_disc` WHERE id_user = '$_SESSION[id_user]' AND id_soal = '$_POST[id_soal]'");
    if (mysqli_num_rows($cekJawaban) == 0) {
        $inputSql = mysqli_query($db, "INSERT INTO `jawaban_disc` (id_user, id_soal, setuju, tidak_setuju) VALUES ('$_SESSION[id_user]', '$_POST[id_soal]', '$_POST[setuju]', '$_POST[tidak_setuju]');");
        if ($inputSql) echo json_encode(array("statusCode" => 200));
    } else if (mysqli_num_rows($cekJawaban) > 0) {
        $jawaban = mysqli_fetch_array($cekJawaban);
        if ($_POST['setuju'] != $jawaban['setuju'] || $_POST['tidak_setuju'] != $jawaban['tidak_setuju']) {
            $updateSql = mysqli_query($db, "UPDATE `jawaban_disc` SET `setuju` = '$_POST[setuju]', `tidak_setuju` = '$_POST[tidak_setuju]' WHERE id_user = '$_SESSION[id_user]' AND id_soal = '$_POST[id_soal]'");
            if ($updateSql) echo json_encode(array("statusCode" => 200));
        }
    }
}
