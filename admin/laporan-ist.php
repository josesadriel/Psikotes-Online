<?php
include("../koneksi.php");
?>
<html>

<head>
    <title>Laporan</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        @media print {
            canvas#myChart {
                min-height: 100%;
                max-width: 100%;
                max-height: 100%;
                height: auto !important;
                width: auto !important;
            }
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET['id'])) {
        $norma = file_get_contents('../norma-ist.json');
        $json = json_decode($norma, true);
        $getData = mysqli_query($db, "SELECT tbl_jwbuser.id_user, tbl_user.nama, tbl_user.gender, tbl_user.email, tbl_user.noHp, tbl_user.profesi, tbl_user.jabatan, tbl_user.tgl_lahir, SUM(IF((tbl_subtes.id_subtes = '5') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'SE', SUM(IF((tbl_subtes.id_subtes = '6') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'WA', SUM(IF((tbl_subtes.id_subtes = '7') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'AN', SUM(IF((tbl_subtes.id_subtes = '8') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'GE', SUM(IF((tbl_subtes.id_subtes = '9') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'RA', SUM(IF((tbl_subtes.id_subtes = '10') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'ZR', SUM(IF((tbl_subtes.id_subtes = '11') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'FA', SUM(IF((tbl_subtes.id_subtes = '12') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'WU', SUM(IF((tbl_subtes.id_subtes = '13') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'ME' FROM `tbl_jwbuser` INNER JOIN `tbl_soal` ON tbl_soal.id_soal = tbl_jwbuser.id_soal INNER JOIN `tbl_user` ON tbl_user.id_user = tbl_jwbuser.id_user INNER JOIN `tbl_subtes` ON tbl_soal.subtes = tbl_subtes.nama_subtes WHERE tbl_soal.jenis_tes = 'IST' AND tbl_user.id_user = '$_GET[id]' GROUP BY tbl_jwbuser.id_user");
        // echo "SELECT tbl_jwbuser.id_user, tbl_user.nama, tbl_user.gender, tbl_user.email, tbl_user.noHp, tbl_user.profesi, tbl_user.jabatan, tbl_user.tgl_lahir, SUM(IF((tbl_subtes.id_subtes = '5') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'SE', SUM(IF((tbl_subtes.id_subtes = '6') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'WA', SUM(IF((tbl_subtes.id_subtes = '7') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'AN', SUM(IF((tbl_subtes.id_subtes = '8') && (tbl_jwbuser.keterangan = 'Benar'), tbl_jwbuser.point, 0)) AS 'GE', SUM(IF((tbl_subtes.id_subtes = '9') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'RA', SUM(IF((tbl_subtes.id_subtes = '10') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'ZR', SUM(IF((tbl_subtes.id_subtes = '11') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'FA', SUM(IF((tbl_subtes.id_subtes = '12') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'WU', SUM(IF((tbl_subtes.id_subtes = '13') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'ME' FROM `tbl_jwbuser` INNER JOIN `tbl_soal` ON tbl_soal.id_soal = tbl_jwbuser.id_soal INNER JOIN `tbl_user` ON tbl_user.id_user = tbl_jwbuser.id_user INNER JOIN `tbl_subtes` ON tbl_soal.subtes = tbl_subtes.nama_subtes WHERE tbl_soal.jenis_tes = 'IST' AND tbl_user.id_user = '$_GET[id]' GROUP BY tbl_jwbuser.id_user";
        $data = mysqli_fetch_array($getData);
        // kelompok usia
        $bday = new DateTime($data['tgl_lahir']);
        $today = new Datetime(date('Y-m-d'));
        $diff = $today->diff($bday);
        $usia = floatval($diff->y);
        $keterangan = "";
        if ($usia == 17) {
            $kelompokUsia = "17";
        } else if ($usia == 18) {
            $kelompokUsia = "18";
        } else if ($usia >= 19 && $usia <= 20) {
            $kelompokUsia = "19-20";
        } else if ($usia >= 21 && $usia <= 25) {
            $kelompokUsia = "21-25";
        } else if ($usia >= 26 && $usia <= 30) {
            $kelompokUsia = "26-30";
        } else if ($usia >= 31 && $usia <= 35) {
            $kelompokUsia = "31-35";
        } else if ($usia >= 36 && $usia <= 40) {
            $kelompokUsia = "36-40";
        } else if ($usia >= 41 && $usia <= 45) {
            $kelompokUsia = "41-45";
        } else if ($usia >= 46 && $usia <= 50) {
            $kelompokUsia = "46-50";
        }
        //hitung jumlah RW
        $jumlah = $data['SE'] + $data['WA'] + $data['AN'] + $data['GE'] + $data['RA'] + $data['ZR'] + $data['FA'] + $data['WU'] + $data['ME'];

        //hitung jumlah SW
        $jumlahSW = $json['umur'][$kelompokUsia]['SE'][$data['SE']] + $json['umur'][$kelompokUsia]['WA'][$data['WA']] + $json['umur'][$kelompokUsia]['AN'][$data['AN']] + $json['umur'][$kelompokUsia]['GE'][$data['GE']] + $json['umur'][$kelompokUsia]['RA'][$data['RA']] + $json['umur'][$kelompokUsia]['ZR'][$data['ZR']] + $json['umur'][$kelompokUsia]['FA'][$data['FA']] + $json['umur'][$kelompokUsia]['WU'][$data['WU']] + $json['umur'][$kelompokUsia]['ME'][$data['ME']];
        if ($jumlah >= 1 && $jumlah <= 10) $gesamt = "1-10";
        else if ($jumlah >= 11 && $jumlah <= 20) $gesamt = "11-20";
        else if ($jumlah >= 21 && $jumlah <= 30) $gesamt = "21-30";
        else if ($jumlah >= 31 && $jumlah <= 40) $gesamt = "31-40";
        else if ($jumlah >= 41 && $jumlah <= 50) $gesamt = "41-50";
        else if ($jumlah >= 51 && $jumlah <= 60) $gesamt = "51-60";
        else if ($jumlah >= 61 && $jumlah <= 70) $gesamt = "61-70";
        else if ($jumlah >= 71 && $jumlah <= 80) $gesamt = "71-80";
        else if ($jumlah >= 81 && $jumlah <= 90) $gesamt = "81-90";
        else if ($jumlah >= 91 && $jumlah <= 100) $gesamt = "91-100";
        else if ($jumlah >= 101 && $jumlah <= 110) $gesamt = "101-110";
        else if ($jumlah >= 111 && $jumlah <= 120) $gesamt = "111-120";
        else if ($jumlah >= 121 && $jumlah <= 130) $gesamt = "121-130";
        else if ($jumlah >= 131 && $jumlah <= 140) $gesamt = "131-140";
        else if ($jumlah >= 141 && $jumlah <= 150) $gesamt = "141-150";
        else if ($jumlah >= 151 && $jumlah <= 160) $gesamt = "151-160";
        else if ($jumlah >= 161 && $jumlah <= 170) $gesamt = "161-170";
        else if ($jumlah >= 171 && $jumlah <= 180) $gesamt = "171-180";
    ?>
        <div id="laporan">
            <center>
                <h1>Laporan Hasil Tes - IST</h1>
            </center>
            <br />
            <h3>A. IDENTITAS SUBJEK</h3>
            <table border="0">
                <tr>
                    <td>Nama</td>
                    <td>: <?= $data['nama'] ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: <?= $data['gender'] ?></td>
                </tr>
                <tr>
                    <td>E-Mail</td>
                    <td>: <?= $data['email'] ?></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>: <?= date("d M Y", strtotime($data['tgl_lahir'])) . " (" . $diff->y . " tahun " . $diff->m . " bulan" . ")" ?></td>
                </tr>
                <tr>
                    <td>No. HP</td>
                    <td>: <?= $data['noHp'] ?></td>
                </tr>
                <tr>
                    <td>Profesi</td>
                    <td>: <?= $data['profesi'] ?></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>: <?= $data['jabatan'] ?></td>
                </tr>
            </table><br />
            <br />
            <h3>B. PROFIL TES</h3>
            <center>
                <table border="1" cellspacing="2" width="70%" style="text-align: center;">
                    <thead>
                        <td></td>
                        <th>SE</th>
                        <th>WA</th>
                        <th>AN</th>
                        <th>GE</th>
                        <th>RA</th>
                        <th>ZR</th>
                        <th>FA</th>
                        <th>WU</th>
                        <th>ME</th>
                        <th>Jumlah</th>
                    </thead>
                    <tr>
                        <td><b>RW</b></td>
                        <td><?= $data['SE'] ?></td>
                        <td><?= $data['WA'] ?></td>
                        <td><?= $data['AN'] ?></td>
                        <td><?= $data['GE'] ?></td>
                        <td><?= $data['RA'] ?></td>
                        <td><?= $data['ZR'] ?></td>
                        <td><?= $data['FA'] ?></td>
                        <td><?= $data['WU'] ?></td>
                        <td><?= $data['ME'] ?></td>
                        <td><?= $jumlah ?></td>
                    </tr>
                    <tr>
                        <td><b>SW</b></td>
                        <td><?= $json['umur'][$kelompokUsia]['SE'][$data['SE']] ?></td>
                        <td><?= $json['umur'][$kelompokUsia]['WA'][$data['WA']] ?></td>
                        <td><?= $json['umur'][$kelompokUsia]['AN'][$data['AN']] ?></td>
                        <td><?= $json['umur'][$kelompokUsia]['GE'][$data['GE']] ?></td>
                        <td><?= $json['umur'][$kelompokUsia]['RA'][$data['RA']] ?></td>
                        <td><?= $json['umur'][$kelompokUsia]['ZR'][$data['ZR']] ?></td>
                        <td><?= $json['umur'][$kelompokUsia]['FA'][$data['FA']] ?></td>
                        <td><?= $json['umur'][$kelompokUsia]['WU'][$data['WU']] ?></td>
                        <td><?= $json['umur'][$kelompokUsia]['ME'][$data['ME']] ?></td>
                        <td><?= $json['umur'][$kelompokUsia]['GESAMT'][$gesamt] ?></td>
                    </tr>
                </table>
                <i>* menggunakan norma usia <?= $kelompokUsia ?> tahun berdasarkan rata-rata kelompok</i><br /><br />
                <canvas id="myChart" style="width:29vw; height:31vh"></canvas>
            </center><br />
            <h3>C. INTERPRETASI</h3>
            <table>
                <tr>
                    <td>Skor IQ total</td>
                    <td>: <?= $json['IQ'][$json['umur'][$kelompokUsia]['GESAMT'][$gesamt]]['IQ'] ?></td>
                </tr>
            </table>
        </div>
    <?php
    }
    ?>
</body>
<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var data = {
        labels: ["SE", "WA", "AN", "GE", "RA", "ZR", "FA", "WU", "ME"],
        datasets: [{
            data: [<?= $json['umur'][$kelompokUsia]['SE'][$data['SE']] . ", " . $json['umur'][$kelompokUsia]['WA'][$data['WA']] . ", " . $json['umur'][$kelompokUsia]['AN'][$data['AN']] . ", " . $json['umur'][$kelompokUsia]['GE'][$data['GE']] . ", " . $json['umur'][$kelompokUsia]['RA'][$data['RA']] . ", " . $json['umur'][$kelompokUsia]['ZR'][$data['ZR']] . ", " . $json['umur'][$kelompokUsia]['FA'][$data['FA']] . ", " . $json['umur'][$kelompokUsia]['WU'][$data['WU']] . ", " . $json['umur'][$kelompokUsia]['ME'][$data['ME']] ?>],
            lineTension: 0,
            backgroundColor: 'Transparent',
            fill: false,
            borderColor: 'black'
        }]
    };
    var stackedLine = new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            responsive: false,
            animation: false,
            legend: {
                display: false,
                labels: {
                    display: false
                }
            },
            scales: {
                y: {
                    min: 70,
                    max: 140
                }
            }
        }
    });
    window.print();
</script>

</html>