<?php
include("../koneksi.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Laporan Hasil Tes - MSDT</title>
    <style>
        @page {
            margin-left: 0mm;
            margin-right: 0mm;
            margin-bottom: 0mm;
            /* this affects the margin in the printer settings */
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
            $getData = mysqli_query($db, "SELECT * FROM `tbl_soal` WHERE jenis_tes = 'MSDT' AND subtes = 'MSDT'");
            if (mysqli_num_rows($getData) > 0) {
                $i = 1;
                while ($data = mysqli_fetch_array($getData)) {
                    $result[$i] = array(
                        'id_soal' => $data['id_soal'],
                        'soal' => $data['soal'],
                        'jawabanDipilih' => "",
                        'jawaban1' => 0,
                        'jawaban2' => 0
                    );
                    $i++;
                }
            }

            $getJawaban = mysqli_query($db, "SELECT tbl_soal.id_soal, tbl_soal.subtes, tbl_jwbuser.jawaban FROM `tbl_soal` LEFT JOIN `tbl_jwbuser` ON tbl_soal.id_soal = tbl_jwbuser.id_soal WHERE tbl_soal.subtes = 'MSDT' AND tbl_jwbuser.id_user = '$_GET[id]'");
            if (mysqli_num_rows($getJawaban) > 0) {
                while ($hasil = mysqli_fetch_array($getJawaban)) {
                    for ($i = 1; $i <= count($result); $i++) {
                        if ($result[$i]['id_soal'] == $hasil['id_soal']) {
                            $result[$i]['jawabanDipilih'] = $hasil['jawaban'];
                            if ($hasil['jawaban'] == "A") $result[$i]['jawaban1'] = 1;
                            else if ($hasil['jawaban'] == "B") $result[$i]['jawaban2'] = 1;
                        }
                    }
                }
            }

            $col1A = $result[1]['jawaban1'] + $result[9]['jawaban1'] + $result[17]['jawaban1'] + $result[25]['jawaban1'] + $result[33]['jawaban1'] + $result[41]['jawaban1'] + $result[49]['jawaban1'] + $result[57]['jawaban1'];
            $col1B = $result[1]['jawaban2'] + $result[9]['jawaban2'] + $result[17]['jawaban2'] + $result[25]['jawaban2'] + $result[33]['jawaban2'] + $result[41]['jawaban2'] + $result[49]['jawaban2'] + $result[57]['jawaban2'];
            $col2A = $result[2]['jawaban1'] + $result[10]['jawaban1'] + $result[18]['jawaban1'] + $result[26]['jawaban1'] + $result[34]['jawaban1'] + $result[42]['jawaban1'] + $result[50]['jawaban1'] + $result[58]['jawaban1'];
            $col2B = $result[2]['jawaban2'] + $result[10]['jawaban2'] + $result[18]['jawaban2'] + $result[26]['jawaban2'] + $result[34]['jawaban2'] + $result[42]['jawaban2'] + $result[50]['jawaban2'] + $result[58]['jawaban2'];
            $col3A = $result[3]['jawaban1'] + $result[11]['jawaban1'] + $result[19]['jawaban1'] + $result[27]['jawaban1'] + $result[35]['jawaban1'] + $result[43]['jawaban1'] + $result[51]['jawaban1'] + $result[59]['jawaban1'];
            $col3B = $result[3]['jawaban2'] + $result[11]['jawaban2'] + $result[19]['jawaban2'] + $result[27]['jawaban2'] + $result[35]['jawaban2'] + $result[43]['jawaban2'] + $result[51]['jawaban2'] + $result[59]['jawaban2'];
            $col4A = $result[4]['jawaban1'] + $result[12]['jawaban1'] + $result[20]['jawaban1'] + $result[28]['jawaban1'] + $result[36]['jawaban1'] + $result[44]['jawaban1'] + $result[52]['jawaban1'] + $result[60]['jawaban1'];
            $col4B = $result[4]['jawaban2'] + $result[12]['jawaban2'] + $result[20]['jawaban2'] + $result[28]['jawaban2'] + $result[36]['jawaban2'] + $result[44]['jawaban2'] + $result[52]['jawaban2'] + $result[60]['jawaban2'];
            $col5A = $result[5]['jawaban1'] + $result[13]['jawaban1'] + $result[21]['jawaban1'] + $result[29]['jawaban1'] + $result[37]['jawaban1'] + $result[45]['jawaban1'] + $result[53]['jawaban1'] + $result[61]['jawaban1'];
            $col5B = $result[5]['jawaban2'] + $result[13]['jawaban2'] + $result[21]['jawaban2'] + $result[29]['jawaban2'] + $result[37]['jawaban2'] + $result[45]['jawaban2'] + $result[53]['jawaban2'] + $result[61]['jawaban2'];
            $col6A = $result[6]['jawaban1'] + $result[14]['jawaban1'] + $result[22]['jawaban1'] + $result[30]['jawaban1'] + $result[38]['jawaban1'] + $result[46]['jawaban1'] + $result[54]['jawaban1'] + $result[62]['jawaban1'];
            $col6B = $result[6]['jawaban2'] + $result[14]['jawaban2'] + $result[22]['jawaban2'] + $result[30]['jawaban2'] + $result[38]['jawaban2'] + $result[46]['jawaban2'] + $result[54]['jawaban2'] + $result[62]['jawaban2'];
            $col7A = $result[7]['jawaban1'] + $result[15]['jawaban1'] + $result[23]['jawaban1'] + $result[31]['jawaban1'] + $result[39]['jawaban1'] + $result[47]['jawaban1'] + $result[55]['jawaban1'] + $result[63]['jawaban1'];
            $col7B = $result[7]['jawaban2'] + $result[15]['jawaban2'] + $result[23]['jawaban2'] + $result[31]['jawaban2'] + $result[39]['jawaban2'] + $result[47]['jawaban2'] + $result[55]['jawaban2'] + $result[63]['jawaban2'];
            $col8A = $result[8]['jawaban1'] + $result[16]['jawaban1'] + $result[24]['jawaban1'] + $result[32]['jawaban1'] + $result[40]['jawaban1'] + $result[48]['jawaban1'] + $result[56]['jawaban1'] + $result[64]['jawaban1'];
            $col8B = $result[8]['jawaban2'] + $result[16]['jawaban2'] + $result[24]['jawaban2'] + $result[32]['jawaban2'] + $result[40]['jawaban2'] + $result[48]['jawaban2'] + $result[56]['jawaban2'] + $result[64]['jawaban2'];

            $j1 = $col1A + $col1B + 1;
            $j2 = $col2A + $col2B + 2;
            $j3 = $col3A + $col3B + 1;
            $j4 = $col4A + $col4B + 0;
            $j5 = $col5A + $col5B + 3;
            $j6 = $col6A + $col6B - 1;
            $j7 = $col7A + $col7B + 0;
            $j8 = $col8A + $col8B - 4;
    ?>
            <div class="container">
                <center>
                    <h1>Laporan Hasil Tes - MSDT</h1>
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
                <table class="table table-bordered text-center">
                    <tr>
                        <td rowspan="8"></td>
                        <?php
                        for ($i = 1; $i <= 64; $i++) {
                            echo "<td>" . $i . ". " . $result[$i]['jawabanDipilih'] . "</td>";
                            if ($i % 8 == 0) echo "</tr><tr>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>A</td>
                        <td><?= $col1A ?></td>
                        <td><?= $col2A ?></td>
                        <td><?= $col3A ?></td>
                        <td><?= $col4A ?></td>
                        <td><?= $col5A ?></td>
                        <td><?= $col6A ?></td>
                        <td><?= $col7A ?></td>
                        <td><?= $col8A ?></td>
                    </tr>
                    <tr>
                        <td>B</td>
                        <td><?= $col1B ?></td>
                        <td><?= $col2B ?></td>
                        <td><?= $col3B ?></td>
                        <td><?= $col4B ?></td>
                        <td><?= $col5B ?></td>
                        <td><?= $col6B ?></td>
                        <td><?= $col7B ?></td>
                        <td><?= $col8B ?></td>
                    </tr>
                    <tr>
                        <td>KOREKSI</td>
                        <td>+1</td>
                        <td>+2</td>
                        <td>+1</td>
                        <td>0</td>
                        <td>+3</td>
                        <td>-1</td>
                        <td>0</td>
                        <td>-4</td>
                    </tr>
                    <tr>
                        <td>JUMLAH</td>
                        <td><?= $j1 ?></td>
                        <td><?= $j2 ?></td>
                        <td><?= $j3 ?></td>
                        <td><?= $j4 ?></td>
                        <td><?= $j5 ?></td>
                        <td><?= $j6 ?></td>
                        <td><?= $j7 ?></td>
                        <td><?= $j8 ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>TO</td>
                        <td></td>
                        <td>RO</td>
                        <td></td>
                        <td>E</td>
                        <td></td>
                        <td>O</td>
                    </tr>
                    <tr>
                        <td colspan="9"></td>
                    </tr>
                    <tr>
                        <td>DS ....... A</td>
                        <td colspan="7"></td>
                        <td><?= $j1 ?></td>
                    </tr>
                    <tr>
                        <td>Mi ....... B</td>
                        <td colspan="3"></td>
                        <td><?= $j2 ?></td>
                    </tr>
                    <tr>
                        <td>Au ....... C</td>
                        <td></td>
                        <td><?= $j3 ?></td>
                    </tr>
                    <tr>
                        <td>Co ....... D</td>
                        <td></td>
                        <td><?= $j4 ?></td>
                        <td></td>
                        <td><?= $j4 ?></td>
                    </tr>
                    <tr>
                        <td>Bu ....... E</td>
                        <td colspan="5"></td>
                        <td><?= $j5 ?></td>
                    </tr>
                    <tr>
                        <td>Dv ....... F</td>
                        <td colspan="3"></td>
                        <td><?= $j6 ?></td>
                        <td></td>
                        <td><?= $j6 ?></td>
                    </tr>
                    <tr>
                        <td>BA ....... G</td>
                        <td></td>
                        <td><?= $j7 ?></td>
                        <td colspan="3"></td>
                        <td><?= $j7 ?></td>
                    </tr>
                    <tr>
                        <td>E ....... H</td>
                        <td></td>
                        <td><?= $j8 ?></td>
                        <td></td>
                        <td><?= $j8 ?></td>
                        <td></td>
                        <td><?= $j8 ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td><?= $j3 + $j4 + $j7 + $j8 ?></td>
                        <td></td>
                        <td><?= $j2 + $j4 + $j6 + $j8 ?></td>
                        <td></td>
                        <td><?= $j5 + $j6 + $j7 + $j8 ?></td>
                        <td></td>
                        <td><?= $j1 ?></td>
                    </tr>
                </table>
                <br />
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