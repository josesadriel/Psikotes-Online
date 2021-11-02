<style>
    body {
        color: white
    }
</style>
<?php
session_start();
include("../koneksi.php");

if (isset($_POST['id_soal']) && isset($_POST['jawaban'])) {
    $cekJawaban = mysqli_query($db, "SELECT * FROM `jawaban_papi` WHERE id_user = '$_SESSION[id_user]' AND id_soal = '$_POST[id_soal]'");
    if (mysqli_num_rows($cekJawaban) == 0) {
        $inputSql = mysqli_query($db, "INSERT INTO `jawaban_papi` (id_user, id_soal, jawaban) VALUES ('$_SESSION[id_user]', '$_POST[id_soal]', '$_POST[jawaban]');");
        if ($inputSql) echo json_encode(array("statusCode" => 200));
    } else if (mysqli_num_rows($cekJawaban) > 0) {
        $jawaban = mysqli_fetch_array($cekJawaban);
        if ($_POST['jawaban'] != $jawaban['jawaban']) {
            $updateSql = mysqli_query($db, "UPDATE `jawaban_papi` SET `jawaban` = '$_POST[jawaban]' WHERE id_user = '$_SESSION[id_user]' AND id_soal = '$_POST[id_soal]'");
            if ($updateSql) echo json_encode(array("statusCode" => 200));
        }
    }
}
