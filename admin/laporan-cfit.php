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
        $norma = file_get_contents('../norma-cfit.json');
        $json = json_decode($norma, true);
        $getData = mysqli_query($db, "SELECT tbl_jwbuser.id_user, tbl_user.nama, tbl_user.gender, tbl_user.email, tbl_user.noHp, tbl_user.profesi, tbl_user.jabatan, tbl_user.tgl_lahir, SUM(IF((tbl_subtes.id_subtes = '1') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) subtest1, SUM(IF((tbl_subtes.id_subtes = '2') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) subtest2, SUM(IF((tbl_subtes.id_subtes = '3') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) subtest3, SUM(IF((tbl_subtes.id_subtes = '4') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) subtest4, SUM( IF( tbl_jwbuser.keterangan = 'Benar', 1, 0 ) ) totalBenar FROM tbl_jwbuser INNER JOIN `tbl_soal` ON tbl_soal.id_soal = tbl_jwbuser.id_soal INNER JOIN `tbl_user` ON tbl_user.id_user = tbl_jwbuser.id_user INNER JOIN `tbl_subtes` ON tbl_subtes.id_subtes = tbl_jwbuser.id_event WHERE tbl_soal.jenis_tes = 'CFIT' AND tbl_user.id_user = '$_GET[id]' GROUP BY tbl_jwbuser.id_user");
        if (mysqli_num_rows($getData) > 0) {
            $iq = null;
            $data = mysqli_fetch_array($getData);
            $bday = new DateTime($data['tgl_lahir']);
            $today = new Datetime(date('Y-m-d'));
            $diff = $today->diff($bday);
            $usia = floatval($diff->y . "." . $diff->m);
            $keterangan = "";
            if ($usia >= 13 && $usia <= 13.4) {
                $kelompokUsia = "umur1";
            } else if ($usia >= 13.5 && $usia <= 13.11) {
                $kelompokUsia = "umur2";
            } else if ($usia >= 14 && $usia <= 14.11) {
                $kelompokUsia = "umur3";
            } else if ($usia >= 15 && $usia <= 15.11) {
                $kelompokUsia = "umur4";
            } else if ($usia >= 16 && $usia <= 16.11) {
                $kelompokUsia = "umur5";
            } else if ($usia >= 17) {
                $kelompokUsia = "umur6";
            }

            for ($i = 0; $i < count($json); $i++) {
                if ($json[$i]['RS'] == $data['totalBenar']) {
                    $iq = $json[$i][$kelompokUsia];
                }
                if ($iq <= 19) $keterangan = "Profound Mental Retardation";
                else if ($iq >= 30 && $iq <= 69) $keterangan = "Mentally Defective";
                else if ($iq >= 70 && $iq <= 79) $keterangan = "Borderline";
                else if ($iq >= 80 && $iq <= 89) $keterangan = "Low Average (LA)";
                else if ($iq >= 90 && $iq <= 109) $keterangan = "Average (A)";
                else if ($iq >= 110 && $iq <= 119) $keterangan = "High Average (HA)";
                else if ($iq >= 120 && $iq <= 139) $keterangan = "Superior (S)";
                else if ($iq >= 140 && $iq <= 169) $keterangan = "Very Superior (VS)";
                else if ($iq >= 170) $keterangan = "Genius (G)";
            }
    ?>
            <div id="laporan">
                <center>
                    <h1>Laporan Hasil Tes - CFIT</h1>
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
                    <table border="1" cellspacing="2" width="60%" style="text-align: center;">
                        <thead>
                            <td></td>
                            <th>Subtest 1</th>
                            <th>Subtest 2</th>
                            <th>Subtest 3</th>
                            <th>Subtest 4</th>
                        </thead>
                        <tr>
                            <td><b>Jumlah Benar</b></td>
                            <td><?= $data['subtest1'] ?></td>
                            <td><?= $data['subtest2'] ?></td>
                            <td><?= $data['subtest3'] ?></td>
                            <td><?= $data['subtest4'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <b>Total Benar:</b> <?= $data['totalBenar'] ?>
                            </td>
                        </tr>
                    </table>
                </center><br />
                <h3>C. INTERPRETASI</h3>
                <table>
                    <tr>
                        <td>Skor IQ total</td>
                        <td>: <?= $iq ?></td>
                    </tr>
                    <tr>
                        <td>Klasifikasi</td>
                        <td>: <i><?= $keterangan ?></i></td>
                    </tr>
                </table>
            </div>
    <?php
        }
    }
    ?>
</body>
<script>
    window.print();
</script>

</html>