<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Laporan Hasil Tes - DISC</title>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_GET['id'])) {
            $getUser = mysqli_query($db, "SELECT * FROM `tbl_user` WHERE id_user = '$_GET[id]'");
            if (mysqli_num_rows($getUser) > 0) {
                $user = mysqli_fetch_array($getUser);
                $bday = new DateTime($user['tgl_lahir']);
                $today = new Datetime(date('Y-m-d'));
                $diff = $today->diff($bday);
                $usia = floatval($diff->y . "." . $diff->m);

                $getSoal = mysqli_query($db, "SELECT * FROM `soal_disc`");
                $result = array();
                $i = 1;
                while ($soal = mysqli_fetch_array($getSoal)) {
                    $result[$i] = array(
                        'id_soal' => $soal['id_soal'],
                        'pernyataan1' => $soal['pernyataan_1'],
                        'pernyataan2' => $soal['pernyataan_2'],
                        'pernyataan3' => $soal['pernyataan_3'],
                        'pernyataan4' => $soal['pernyataan_4'],
                        'setuju' => null,
                        'tidak_setuju' => null
                    );
                    $i++;
                }
                $getJawaban = mysqli_query($db, "SELECT * FROM `jawaban_disc` WHERE `id_user` = '$_GET[id]'");
                if (mysqli_num_rows($getJawaban) > 0) {
                    while ($jawaban = mysqli_fetch_array($getJawaban)) {
                        for ($i = 1; $i <= count($result); $i++) {
                            if ($result[$i]['id_soal'] == $jawaban['id_soal']) {
                                $result[$i]['setuju'] = $jawaban['setuju'];
                                $result[$i]['tidak_setuju'] = $jawaban['tidak_setuju'];
                            }
                        }
                    }
                }

        ?>
                <center>
                    <h1>Laporan Hasil Tes - DISC</h1>
                </center>
                <br />
                <h3>A. IDENTITAS SUBJEK</h3>
                <table border="0">
                    <tr>
                        <td>Nama</td>
                        <td>: <?= $user['nama'] ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: <?= $user['gender'] ?></td>
                    </tr>
                    <tr>
                        <td>E-Mail</td>
                        <td>: <?= $user['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: <?= date("d M Y", strtotime($user['tgl_lahir'])) . " (" . $diff->y . " tahun " . $diff->m . " bulan" . ")" ?></td>
                    </tr>
                    <tr>
                        <td>No. HP</td>
                        <td>: <?= $user['noHp'] ?></td>
                    </tr>
                    <tr>
                        <td>Profesi</td>
                        <td>: <?= $user['profesi'] ?></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>: <?= $user['jabatan'] ?></td>
                    </tr>
                </table><br />
                <h3>B. LEMBAR JAWABAN PESERTA</h3>
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <td width="7%" class="text-center"><small><b>No.</b></small></td>
                            <td><small><b>Setuju</b></small></td>
                            <td><small><b>Tidak Setuju</b></small></td>
                            <td width="7%" class="text-center"><small><b>No.</b></small></td>
                            <td><small><b>Setuju</b></small></td>
                            <td><small><b>Tidak Setuju</b></small></td>
                        </thead>
                        <?php
                        $nomorAwal = 1;
                        for ($i = 1; $i <= 12; $i++) {
                            echo "<tr>";
                            for ($j = 0; $j < 2; $j++) {
                        ?>
                                <td class="text-center"><small><b><?= $result[$nomorAwal + $j]['id_soal'] ?></b></small></td>
                                <td><small><?= $result[$nomorAwal + $j]['setuju'] ?></small></td>
                                <td><small><?= $result[$nomorAwal + $j]['tidak_setuju'] ?></small></td>
                        <?php
                            }
                            $nomorAwal += 2;
                            echo "<tr>";
                        }
                        ?>
                    </table>
                </div>
                <div class="row">
                    <?php
                    $getData = mysqli_query($db, "SELECT * FROM `jawaban_disc` INNER JOIN `soal_disc` ON jawaban_disc.id_soal = soal_disc.id_soal WHERE jawaban_disc.id_user = '$_GET[id]'");
                    $sS = 0;
                    $sD = 0;
                    $sI = 0;
                    $sC = 0;
                    $sSimbol = 0;

                    $tsS = 0;
                    $tsD = 0;
                    $tsI = 0;
                    $tsC = 0;
                    $tsSimbol = 0;
                    if (mysqli_num_rows($getData) > 0) {
                        while ($data = mysqli_fetch_array($getData)) {
                            if ($data['setuju'] == $data['pernyataan_1']) {
                                if ($data['s_1'] == 'S') $sS++;
                                else if ($data['s_1'] == 'D') $sD++;
                                else if ($data['s_1'] == 'I') $sI++;
                                else if ($data['s_1'] == 'C') $sC++;
                                else if ($data['s_1'] == '#') $sSimbol++;
                            } else if ($data['setuju'] == $data['pernyataan_2']) {
                                if ($data['s_2'] == 'S') $sS++;
                                else if ($data['s_2'] == 'D') $sD++;
                                else if ($data['s_2'] == 'I') $sI++;
                                else if ($data['s_2'] == 'C') $sC++;
                                else if ($data['s_2'] == '#') $sSimbol++;
                            } else if ($data['setuju'] == $data['pernyataan_3']) {
                                if ($data['s_3'] == 'S') $sS++;
                                else if ($data['s_3'] == 'D') $sD++;
                                else if ($data['s_3'] == 'I') $sI++;
                                else if ($data['s_3'] == 'C') $sC++;
                                else if ($data['s_3'] == '#') $sSimbol++;
                            } else if ($data['setuju'] == $data['pernyataan_4']) {
                                if ($data['s_4'] == 'S') $sS++;
                                else if ($data['s_4'] == 'D') $sD++;
                                else if ($data['s_4'] == 'I') $sI++;
                                else if ($data['s_4'] == 'C') $sC++;
                                else if ($data['s_4'] == '#') $sSimbol++;
                            }

                            if ($data['tidak_setuju'] == $data['pernyataan_1']) {
                                if ($data['ts_1'] == 'S') $tsS++;
                                else if ($data['ts_1'] == 'D') $tsD++;
                                else if ($data['ts_1'] == 'I') $tsI++;
                                else if ($data['ts_1'] == 'C') $tsC++;
                                else if ($data['ts_1'] == '#') $tsSimbol++;
                            } else if ($data['tidak_setuju'] == $data['pernyataan_2']) {
                                if ($data['ts_2'] == 'S') $tsS++;
                                else if ($data['ts_2'] == 'D') $tsD++;
                                else if ($data['ts_2'] == 'I') $tsI++;
                                else if ($data['ts_2'] == 'C') $tsC++;
                                else if ($data['ts_2'] == '#') $tsSimbol++;
                            } else if ($data['tidak_setuju'] == $data['pernyataan_3']) {
                                if ($data['ts_3'] == 'S') $tsS++;
                                else if ($data['ts_3'] == 'D') $tsD++;
                                else if ($data['ts_3'] == 'I') $tsI++;
                                else if ($data['ts_3'] == 'C') $tsC++;
                                else if ($data['ts_3'] == '#') $tsSimbol++;
                            } else if ($data['tidak_setuju'] == $data['pernyataan_4']) {
                                if ($data['ts_4'] == 'S') $tsS++;
                                else if ($data['ts_4'] == 'D') $tsD++;
                                else if ($data['ts_4'] == 'I') $tsI++;
                                else if ($data['ts_4'] == 'C') $tsC++;
                                else if ($data['ts_4'] == '#') $tsSimbol++;
                            }
                        }
                    }
                    ?>
                    <table class="table table-bordered">
                        <tr>
                            <th></th>
                            <th class="text-center" width="10%">D</th>
                            <th class="text-center" width="10%">I</th>
                            <th class="text-center" width="10%">S</th>
                            <th class="text-center" width="10%">C</th>
                            <th class="text-center" width="10%">*</th>
                            <th class="text-center" width="10%">Total</th>
                            <th width="10%"></th>
                        </tr>
                        <tr>
                            <td>Most (Sesuai)</td>
                            <td class="text-center"><?= $sD ?></td>
                            <td class="text-center"><?= $sI ?></td>
                            <td class="text-center"><?= $sS ?></td>
                            <td class="text-center"><?= $sC ?></td>
                            <td class="text-center"><?= $sSimbol ?></td>
                            <td class="text-center"><?= ($sD + $sI + $sS + $sC + $sSimbol) ?></td>
                            <td class="text-center"><small>Must Equal 24</small></td>
                        </tr>
                        <tr>
                            <td>Least (Tidak Sesuai)</td>
                            <td class="text-center"><?= $tsD ?></td>
                            <td class="text-center"><?= $tsI ?></td>
                            <td class="text-center"><?= $tsS ?></td>
                            <td class="text-center"><?= $tsC ?></td>
                            <td class="text-center"><?= $tsSimbol ?></td>
                            <td class="text-center"><?= ($tsD + $tsI + $tsS + $tsC + $tsSimbol) ?></td>
                            <td class="text-center"><small>Must Equal 24</small></td>
                        </tr>
                        <tr>
                            <td>Change</td>
                            <td class="text-center"><?= $sD - $tsD ?></td>
                            <td class="text-center"><?= $sI - $tsI ?></td>
                            <td class="text-center"><?= $sS - $tsS ?></td>
                            <td class="text-center"><?= $sC - $tsC ?></td>
                            <td class="text-center" colspan="3"><small>Don't calculate the "+" value for row 3</small></td>
                        </tr>
                    </table>
                </div>

                <br />
                <b>Keterangan:</b><br />
                <b>D</b>: Dominance<br />
                <b>I</b>: Influence<br />
                <b>S</b>: Steadiness<br />
                <b>C</b>: Compliance<br />
    </div>
</body>
<?php
            }
        }
?>

</html>