<style>
	body {
		color: white
	}
</style>
<?php
session_start();
include("../koneksi.php");

if (isset($_POST['id_soal']) && isset($_POST['jawaban']) || isset($_GET)) {
	$idUser = $_SESSION['id_user'];
	if (isset($_POST['id_soal']) && isset($_POST['jawaban'])) {
		$idSoal = $_POST['id_soal'];
		$idEvent = $_POST['event'];
		$jawaban = $_POST['jawaban'];
		$getDataSoal = mysqli_query($db, "SELECT * FROM `tbl_soal` WHERE id_soal = '$_POST[id_soal]'");
		$dataSoal = mysqli_fetch_array($getDataSoal);
	}
	if (isset($_GET['id_soal']) && isset($_GET['jawaban'])) {
		$idSoal = $_GET['id_soal'];
		$idEvent = $_GET['event'];
		$jawaban = $_GET['jawaban'];
		$getDataSoal = mysqli_query($db, "SELECT * FROM `tbl_soal` WHERE id_soal = '$_GET[id_soal]'");
		echo "SELECT * FROM `tbl_soal` WHERE id_soal = '$_GET[id_soal]'";
		$dataSoal = mysqli_fetch_array($getDataSoal);
	}
	$sql = "";

	$cekDataJawaban = mysqli_query($db, "SELECT * FROM `tbl_jwbuser` WHERE id_user = '$idUser' AND id_soal = '$idSoal'");
	$getDataJawaban = mysqli_fetch_array($cekDataJawaban);
	if (mysqli_num_rows($cekDataJawaban) > 0) {
		if ($jawaban != $getDataJawaban['jawaban']) {
			if ($dataSoal['jumlah_benar'] > 1 || $dataSoal['jenis_jawaban'] == "Aritmatika") {
				$jawabanUser = str_split($jawaban);
				$jawabanBenar = str_split($dataSoal['jawaban_benar']);
				$totalKecocokan = 0;
				for ($i = 0; $i < count($jawabanBenar); $i++) {
					for ($j = 0; $j < count($jawabanUser); $j++) {
						if (strtoupper($jawabanUser[$j]) == strtoupper($jawabanBenar[$i])) {
							$totalKecocokan++;
						}
					}
				}
				echo $totalKecocokan;
				if ($totalKecocokan == count($jawabanBenar)) {
					$sql = "UPDATE `tbl_jwbuser` SET `jawaban`= '$jawaban', `keterangan` = 'Benar', `point` = '1' WHERE id_user = '$idUser' AND id_soal = '$idSoal'";
				} else $sql = "UPDATE `tbl_jwbuser` SET `jawaban`= '$jawaban', `keterangan` = 'Salah', `point` = '0' WHERE id_user = '$idUser' AND id_soal = '$idSoal'";
			} else if ($dataSoal['jumlah_benar'] == 1 || $dataSoal['jumlah_benar'] == 0) {
				if ($dataSoal['subtes'] == "GE") {
					$ekstrak1 = explode("|", $dataSoal['jawaban_benar']);
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
						$sql = "UPDATE `tbl_jwbuser` SET `jawaban`= '$jawaban', `keterangan` = 'Benar', `point` = '$poin' WHERE id_user = '$idUser' AND id_soal = '$idSoal'";
					} else $sql = "UPDATE `tbl_jwbuser` SET `jawaban`= '$jawaban', `keterangan` = 'Salah', `point` = '$poin' WHERE id_user = '$idUser' AND id_soal = '$idSoal'";
				} else {
					if (strtoupper($jawaban) == strtoupper($dataSoal['jawaban_benar'])) {
						$sql = "UPDATE `tbl_jwbuser` SET `jawaban`= '$jawaban', `keterangan` = 'Benar', `point` = '1' WHERE id_user = '$idUser' AND id_soal = '$idSoal'";
					} else $sql = "UPDATE `tbl_jwbuser` SET `jawaban`= '$jawaban', `keterangan` = 'Salah', `point` = '0' WHERE id_user = '$idUser' AND id_soal = '$idSoal'";
				}
			}
		} else {
			//ketika klik tombol submit jawaban dan tidak ada perubahan jawaban akhir
			if (isset($_GET['id_soal']) && isset($_GET['jawaban'])) {
				echo "<meta http-equiv='refresh' content='0; url=selesai.php?status=selesai'>";
			}
		}
	} else {
		if ($dataSoal['jumlah_benar'] > 1 || $dataSoal['jenis_jawaban'] == "Aritmatika") {
			$jawabanUser = str_split($jawaban);
			$jawabanBenar = str_split($dataSoal['jawaban_benar']);
			$totalKecocokan = 0;
			for ($i = 0; $i < count($jawabanBenar); $i++) {
				for ($j = 0; $j < count($jawabanUser); $j++) {
					if (strtoupper($jawabanUser[$j]) == strtoupper($jawabanBenar[$i])) {
						$totalKecocokan++;
					}
				}
			}
			if ($totalKecocokan == count($jawabanBenar)) {
				$sql = "INSERT INTO `tbl_jwbuser`(`id_user`, `id_soal`, `id_event`, `jawaban`, `keterangan`, `point`) VALUES ('$idUser','$idSoal','$idEvent','$jawaban', 'Benar', '1')";
			} else $sql = "INSERT INTO `tbl_jwbuser`(`id_user`, `id_soal`, `id_event`, `jawaban`, `keterangan`, `point`) VALUES ('$idUser','$idSoal','$idEvent','$jawaban', 'Salah', '0')";
		} else if ($dataSoal['jumlah_benar'] == 1 || $dataSoal['jumlah_benar'] == 0) {
			if ($dataSoal['subtes'] == "GE") {
				$ekstrak1 = explode("|", $dataSoal['jawaban_benar']);
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
					$sql = "INSERT INTO `tbl_jwbuser`(`id_user`, `id_soal`, `id_event`, `jawaban`, `keterangan`, `point`) VALUES ('$idUser','$idSoal','$idEvent','$jawaban', 'Benar', '$poin')";
				} else $sql = "INSERT INTO `tbl_jwbuser`(`id_user`, `id_soal`, `id_event`, `jawaban`, `keterangan`, `point`) VALUES ('$idUser','$idSoal','$idEvent','$jawaban', 'Salah', '$poin')";
			} else {
				if (strtoupper($jawaban) == strtoupper($dataSoal['jawaban_benar'])) {
					$sql = "INSERT INTO `tbl_jwbuser`(`id_user`, `id_soal`, `id_event`, `jawaban`, `keterangan`, `point`) VALUES ('$idUser','$idSoal','$idEvent','$jawaban', 'Benar', '1')";
				} else $sql = "INSERT INTO `tbl_jwbuser`(`id_user`, `id_soal`, `id_event`, `jawaban`, `keterangan`, `point`) VALUES ('$idUser','$idSoal','$idEvent','$jawaban', 'Salah', '0')";
			}
		}
	}
	$runSql = mysqli_query($db, $sql);
	if ($runSql) {
		echo json_encode(array("statusCode" => 200));
		//ketika klik tombol submit jawaban
		if (isset($_GET['id_soal']) && isset($_GET['jawaban'])) {
			echo "<meta http-equiv='refresh' content='0; url=selesai.php?status=selesai'>";
		}
	}
} else {
	echo json_encode(array("statusCode" => 201));
	//ketika klik tombol submit jawaban
	if (isset($_GET['id_soal']) && isset($_GET['jawaban'])) {
		echo "<meta http-equiv='refresh' content='0; url=selesai.php?status=selesai'>";
	}
}
