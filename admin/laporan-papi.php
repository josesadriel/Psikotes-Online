<?php
include("../koneksi.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Laporan Hasil Tes - PAPI KOSTICK</title>
    <style>
        @page {
            margin-left: 0mm;
            margin-right: 0mm;
            margin-bottom: 0mm;
            /* this affects the margin in the printer settings */
        }

        @media print {

            sup.bg-danger,
            sub.bg-danger {
                -webkit-print-color-adjust: exact;
                background-color: #dc3545;
            }
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET['id'])) {
        $getUser = mysqli_query($db, "SELECT * FROM `tbl_user` WHERE id_user = '$_GET[id]'");
        if (mysqli_num_rows($getUser) > 0) {
            $user = mysqli_fetch_array($getUser);
            $bday = new DateTime($user['tgl_lahir']);
            $today = new Datetime(date('Y-m-d'));
            $diff = $today->diff($bday);
            $usia = floatval($diff->y . "." . $diff->m);

            $result = array();
            $getSoal = mysqli_query($db, "SELECT * FROM `soal_papi`");
            $i = 1;
            while ($soal = mysqli_fetch_array($getSoal)) {
                $result[$i] = array(
                    'id_soal' => $soal['id_papi'],
                    'pernyataan1' => $soal['pernyataan1'],
                    'var1' => $soal['var1'],
                    'pernyataan2' => $soal['pernyataan2'],
                    'var2' => $soal['var2'],
                    'jawabanDipilih' => "",
                    'G' => 0,
                    'L' => 0,
                    'I' => 0,
                    'T' => 0,
                    'V' => 0,
                    'S' => 0,
                    'R' => 0,
                    'D' => 0,
                    'C' => 0,
                    'E' => 0,
                    'N' => 0,
                    'A' => 0,
                    'P' => 0,
                    'X' => 0,
                    'B' => 0,
                    'O' => 0,
                    'Z' => 0,
                    'K' => 0,
                    'F' => 0,
                    'W' => 0
                );
                $i++;
            }
            $getJawaban = mysqli_query($db, "SELECT jawaban_papi.id_user, soal_papi.id_papi, jawaban_papi.jawaban, IF(jawaban_papi.jawaban = 'A', soal_papi.var1, IF(jawaban_papi.jawaban = 'B', soal_papi.var2, NULL)) var FROM `jawaban_papi` LEFT JOIN `soal_papi` ON soal_papi.id_papi = jawaban_papi.id_soal WHERE jawaban_papi.id_user = '$_GET[id]' ORDER BY jawaban_papi.added_at ASC");
            if (mysqli_num_rows($getJawaban) > 0) {
                while ($hasil = mysqli_fetch_array($getJawaban)) {
                    for ($i = 1; $i <= count($result); $i++) {
                        if ($result[$i]['id_soal'] == $hasil['id_papi']) {
                            $result[$i]['jawabanDipilih'] = $hasil['jawaban'];
                            if ($hasil['var'] == "G") $result[$i]['G'] = 1;
                            else if ($hasil['var'] == "L") $result[$i]['L'] = 1;
                            else if ($hasil['var'] == "I") $result[$i]['I'] = 1;
                            else if ($hasil['var'] == "T") $result[$i]['T'] = 1;
                            else if ($hasil['var'] == "V") $result[$i]['V'] = 1;
                            else if ($hasil['var'] == "S") $result[$i]['S'] = 1;
                            else if ($hasil['var'] == "R") $result[$i]['R'] = 1;
                            else if ($hasil['var'] == "D") $result[$i]['D'] = 1;
                            else if ($hasil['var'] == "C") $result[$i]['C'] = 1;
                            else if ($hasil['var'] == "E") $result[$i]['E'] = 1;
                            else if ($hasil['var'] == "N") $result[$i]['N'] = 1;
                            else if ($hasil['var'] == "A") $result[$i]['A'] = 1;
                            else if ($hasil['var'] == "P") $result[$i]['P'] = 1;
                            else if ($hasil['var'] == "X") $result[$i]['X'] = 1;
                            else if ($hasil['var'] == "B") $result[$i]['B'] = 1;
                            else if ($hasil['var'] == "O") $result[$i]['O'] = 1;
                            else if ($hasil['var'] == "Z") $result[$i]['Z'] = 1;
                            else if ($hasil['var'] == "K") $result[$i]['K'] = 1;
                            else if ($hasil['var'] == "F") $result[$i]['F'] = 1;
                            else if ($hasil['var'] == "W") $result[$i]['W'] = 1;
                        }
                    }
                }
            }
            // if ($soal['var1'] == "G" || $soal['var1'] == "L" || $soal['var1'] == "I" || $soal['var1'] == "T" || $soal['var1'] == "V" || $soal['var1'] == "S" || $soal['var1'] == "R" || $soal['var1'] == "D" || $soal['var1'] == "C" || $soal['var1'] == "E") {
            //     echo "<sup>&larr;</sup><sub>&nearr;</sub>"
            // } else {
            //     echo "<sup>&rarr;</sup><sub>&swarr;</sub>"
            // }
        }
    }
    ?>
    <div class="container">
        <center>
            <h1>Laporan Hasil Tes - PAPI KOSTICK</h1>
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
        <?php
        $getWaktu = mysqli_query($db, "SELECT MIN(added_at) mulai, MAX(added_at) selesai FROM `jawaban_papi` WHERE id_user = '$_GET[id]'");
        $waktu = mysqli_fetch_array($getWaktu);
        $G = 0;
        $L = 0;
        $I = 0;
        $T = 0;
        $V = 0;
        $S = 0;
        $R = 0;
        $D = 0;
        $C = 0;
        $E = 0;
        $N = 0;
        $A = 0;
        $P = 0;
        $X = 0;
        $B = 0;
        $O = 0;
        $Z = 0;
        $K = 0;
        $F = 0;
        $W = 0;
        for ($i = 1; $i <= 90; $i++) {
            if ($result[$i]['G'] == 1) $G++;
            if ($result[$i]['L'] == 1) $L++;
            if ($result[$i]['I'] == 1) $I++;
            if ($result[$i]['T'] == 1) $T++;
            if ($result[$i]['V'] == 1) $V++;
            if ($result[$i]['S'] == 1) $S++;
            if ($result[$i]['R'] == 1) $R++;
            if ($result[$i]['D'] == 1) $D++;
            if ($result[$i]['C'] == 1) $C++;
            if ($result[$i]['E'] == 1) $E++;
            if ($result[$i]['N'] == 1) $N++;
            if ($result[$i]['A'] == 1) $A++;
            if ($result[$i]['P'] == 1) $P++;
            if ($result[$i]['X'] == 1) $X++;
            if ($result[$i]['B'] == 1) $B++;
            if ($result[$i]['O'] == 1) $O++;
            if ($result[$i]['Z'] == 1) $Z++;
            if ($result[$i]['K'] == 1) $K++;
            if ($result[$i]['F'] == 1) $F++;
            if ($result[$i]['W'] == 1) $W++;
        }
        $total1 = $G + $L + $I + $T + $V + $S + $R + $D + $C + $E;
        $total2 = $N + $A + $P + $X + $B + $O + $Z + $K + $F + $W;
        ?>
        <table border="0">
            <tr>
                <td>Waktu Mulai</td>
                <td>: <?= date("d M Y H:i:s", strtotime($waktu['mulai'])) ?></td>
            </tr>
            <tr>
                <td>Waktu Selesai</td>
                <td>: <?= date("d M Y H:i:s", strtotime($waktu['selesai'])) ?></td>
            </tr>
        </table>
        <table class="table table-bordered text-center">
            <tr>
                <td><b>Total</b></td>
                <td><b>G</b></td>
                <td><b>L</b></td>
                <td><b>I</b></td>
                <td><b>T</b></td>
                <td><b>V</b></td>
                <td><b>S</b></td>
                <td><b>R</b></td>
                <td><b>D</b></td>
                <td><b>C</b></td>
                <td><b>E</b></td>
            </tr>
            <tr>
                <td><?= $total1 ?></td>
                <td><?= $G ?></td>
                <td><?= $L ?></td>
                <td><?= $I ?></td>
                <td><?= $T ?></td>
                <td><?= $V ?></td>
                <td><?= $S ?></td>
                <td><?= $R ?></td>
                <td><?= $D ?></td>
                <td><?= $C ?></td>
                <td><?= $E ?></td>
            </tr>
        </table>
        <table class="table table-bordered">
            <?php
            $nomorAwal = 81; // nomor sblh kiri awal
            for ($i = 1; $i <= 10; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 90; $j += 10) {
            ?>
                    <td><?= $result[($nomorAwal - $j)]['id_soal'] . ". " ?>
                        <?php
                        if ($result[($nomorAwal - $j)]['var1'] == "G" || $result[($nomorAwal - $j)]['var1'] == "L" || $result[($nomorAwal - $j)]['var1'] == "I" || $result[($nomorAwal - $j)]['var1'] == "T" || $result[($nomorAwal - $j)]['var1'] == "V" || $result[($nomorAwal - $j)]['var1'] == "S" || $result[($nomorAwal - $j)]['var1'] == "R" || $result[($nomorAwal - $j)]['var1'] == "D" || $result[($nomorAwal - $j)]['var1'] == "C" || $result[($nomorAwal - $j)]['var1'] == "E") {
                            if ($result[($nomorAwal - $j)]['jawabanDipilih'] == "A") echo "<sup class='bg-danger text-white mr-1' style='padding:0.5px'>&larr;</sup><sub>&nearr;</sub>";
                            else if ($result[($nomorAwal - $j)]['jawabanDipilih'] == "B") echo "<sup>&larr;</sup><sub class='bg-danger text-white ml-1' style='padding:0.5px'>&nearr;</sub>";
                            else echo "<sup class='mr-1'>&larr;</sup><sub>&nearr;</sub>";
                        } else {
                            if ($result[($nomorAwal - $j)]['jawabanDipilih'] == "A") echo "<sup class='bg-danger text-white mr-1' style='padding:0.5px'>&rarr;</sup><sub>&swarr;</sub>";
                            else if ($result[($nomorAwal - $j)]['jawabanDipilih'] == "B") echo "<sup>&rarr;</sup><sub class='bg-danger text-white ml-1' style='padding:0.5px'>&swarr;</sub>";
                            else echo "<sup class='mr-1'>&rarr;</sup><sub>&swarr;</sub>";
                        }
                        ?>
                    </td>
            <?php
                }
                echo "</tr>";
                $nomorAwal++;
            }
            ?>
        </table>
        <table class="table table-bordered text-center">
            <tr>
                <td><?= $N ?></td>
                <td><?= $A ?></td>
                <td><?= $P ?></td>
                <td><?= $X ?></td>
                <td><?= $B ?></td>
                <td><?= $O ?></td>
                <td><?= $Z ?></td>
                <td><?= $K ?></td>
                <td><?= $F ?></td>
                <td><?= $W ?></td>
                <td><?= $total2 ?></td>
            </tr>
            <tr>
                <td><b>N</b></td>
                <td><b>A</b></td>
                <td><b>P</b></td>
                <td><b>X</b></td>
                <td><b>B</b></td>
                <td><b>O</b></td>
                <td><b>Z</b></td>
                <td><b>K</b></td>
                <td><b>F</b></td>
                <td><b>W</b></td>
                <td><b>Total</b></td>
            </tr>
        </table>
    </div>
</body>
<script>
    window.print();
</script>

</html>