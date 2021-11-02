<?php
include("../koneksi.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Laporan Hasil Test - MBTI</title>
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
            $getData = mysqli_query($db, "SELECT * FROM `tbl_soal` WHERE jenis_tes = 'MBTI' AND subtes = 'MBTI'");
            if (mysqli_num_rows($getData) > 0) {
                $i = 1;
                while ($data = mysqli_fetch_array($getData)) {
                    $result[$i] = array(
                        'id_soal' => $data['id_soal'],
                        'soal' => $data['soal'],
                        'jawaban1' => 0,
                        'jawaban2' => 0
                    );
                    $i++;
                }
            }

            $getJawaban = mysqli_query($db, "SELECT tbl_soal.id_soal, tbl_soal.subtes, tbl_jwbuser.jawaban FROM `tbl_soal` LEFT JOIN `tbl_jwbuser` ON tbl_soal.id_soal = tbl_jwbuser.id_soal WHERE tbl_soal.subtes = 'MBTI' AND tbl_jwbuser.id_user = '$_GET[id]'");
            if (mysqli_num_rows($getJawaban) > 0) {
                while ($hasil = mysqli_fetch_array($getJawaban)) {
                    for ($i = 1; $i <= count($result); $i++) {
                        if ($result[$i]['id_soal'] == $hasil['id_soal']) {
                            if ($hasil['jawaban'] == "A") $result[$i]['jawaban1'] = 1;
                            else if ($hasil['jawaban'] == "B") $result[$i]['jawaban2'] = 1;
                        }
                    }
                }
            }
            $col1A = $result[1]['jawaban1'] + $result[8]['jawaban1'] + $result[15]['jawaban1'] + $result[22]['jawaban1'] + $result[29]['jawaban1'] + $result[36]['jawaban1'] + $result[43]['jawaban1'] + $result[50]['jawaban1'] + $result[57]['jawaban1'] + $result[64]['jawaban1'];
            $col1B = $result[1]['jawaban2'] + $result[8]['jawaban2'] + $result[15]['jawaban2'] + $result[22]['jawaban2'] + $result[29]['jawaban2'] + $result[36]['jawaban2'] + $result[43]['jawaban2'] + $result[50]['jawaban2'] + $result[57]['jawaban2'] + $result[64]['jawaban2'];
            $col2A = $result[2]['jawaban1'] + $result[9]['jawaban1'] + $result[16]['jawaban1'] + $result[23]['jawaban1'] + $result[30]['jawaban1'] + $result[37]['jawaban1'] + $result[44]['jawaban1'] + $result[51]['jawaban1'] + $result[58]['jawaban1'] + $result[65]['jawaban1'];
            $col2B = $result[2]['jawaban2'] + $result[9]['jawaban2'] + $result[16]['jawaban2'] + $result[23]['jawaban2'] + $result[30]['jawaban2'] + $result[37]['jawaban2'] + $result[44]['jawaban2'] + $result[51]['jawaban2'] + $result[58]['jawaban2'] + $result[65]['jawaban2'];
            $col3A = $result[3]['jawaban1'] + $result[10]['jawaban1'] + $result[17]['jawaban1'] + $result[24]['jawaban1'] + $result[31]['jawaban1'] + $result[38]['jawaban1'] + $result[45]['jawaban1'] + $result[52]['jawaban1'] + $result[59]['jawaban1'] + $result[66]['jawaban1'];
            $col3B = $result[3]['jawaban2'] + $result[10]['jawaban2'] + $result[17]['jawaban2'] + $result[24]['jawaban2'] + $result[31]['jawaban2'] + $result[38]['jawaban2'] + $result[45]['jawaban2'] + $result[52]['jawaban2'] + $result[59]['jawaban2'] + $result[66]['jawaban2'];
            $col4A = $result[4]['jawaban1'] + $result[11]['jawaban1'] + $result[18]['jawaban1'] + $result[25]['jawaban1'] + $result[32]['jawaban1'] + $result[39]['jawaban1'] + $result[46]['jawaban1'] + $result[53]['jawaban1'] + $result[60]['jawaban1'] + $result[67]['jawaban1'];
            $col4B = $result[4]['jawaban2'] + $result[11]['jawaban2'] + $result[18]['jawaban2'] + $result[25]['jawaban2'] + $result[32]['jawaban2'] + $result[39]['jawaban2'] + $result[46]['jawaban2'] + $result[53]['jawaban2'] + $result[60]['jawaban2'] + $result[67]['jawaban2'];
            $col5A = $result[5]['jawaban1'] + $result[12]['jawaban1'] + $result[19]['jawaban1'] + $result[26]['jawaban1'] + $result[33]['jawaban1'] + $result[40]['jawaban1'] + $result[47]['jawaban1'] + $result[54]['jawaban1'] + $result[61]['jawaban1'] + $result[68]['jawaban1'];
            $col5B = $result[5]['jawaban2'] + $result[12]['jawaban2'] + $result[19]['jawaban2'] + $result[26]['jawaban2'] + $result[33]['jawaban2'] + $result[40]['jawaban2'] + $result[47]['jawaban2'] + $result[54]['jawaban2'] + $result[61]['jawaban2'] + $result[68]['jawaban2'];
            $col6A = $result[6]['jawaban1'] + $result[13]['jawaban1'] + $result[20]['jawaban1'] + $result[27]['jawaban1'] + $result[34]['jawaban1'] + $result[41]['jawaban1'] + $result[48]['jawaban1'] + $result[55]['jawaban1'] + $result[62]['jawaban1'] + $result[69]['jawaban1'];
            $col6B = $result[6]['jawaban2'] + $result[13]['jawaban2'] + $result[20]['jawaban2'] + $result[27]['jawaban2'] + $result[34]['jawaban2'] + $result[41]['jawaban2'] + $result[48]['jawaban2'] + $result[55]['jawaban2'] + $result[62]['jawaban2'] + $result[69]['jawaban2'];
            $col7A = $result[7]['jawaban1'] + $result[14]['jawaban1'] + $result[21]['jawaban1'] + $result[28]['jawaban1'] + $result[35]['jawaban1'] + $result[42]['jawaban1'] + $result[49]['jawaban1'] + $result[56]['jawaban1'] + $result[63]['jawaban1'] + $result[70]['jawaban1'];
            $col7B = $result[7]['jawaban2'] + $result[14]['jawaban2'] + $result[21]['jawaban2'] + $result[28]['jawaban2'] + $result[35]['jawaban2'] + $result[42]['jawaban2'] + $result[49]['jawaban2'] + $result[56]['jawaban2'] + $result[63]['jawaban2'] + $result[70]['jawaban2'];

            $E = $col1A;
            $I = $col1B;
            $S = $col2A + $col3A;
            $N = $col2B + $col3B;
            $T = $col4A + $col5A;
            $F = $col4B + $col5B;
            $J = $col6A + $col7A;
            $P = $col6B + $col7B;
    ?>
            <div class="container">
                <center>
                    <h1>Laporan Hasil Tes - MBTI</h1>
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
                        <td></td>
                        <td colspan="2">Col 1</td>
                        <td></td>
                        <td colspan="2">Col 2</td>
                        <td></td>
                        <td colspan="2">Col 3</td>
                        <td></td>
                        <td colspan="2">Col 4</td>
                        <td></td>
                        <td colspan="2">Col 5</td>
                        <td></td>
                        <td colspan="2">Col 6</td>
                        <td></td>
                        <td colspan="2">Col 7</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>A</td>
                        <td>B</td>
                        <td></td>
                        <td>A</td>
                        <td>B</td>
                        <td></td>
                        <td>A</td>
                        <td>B</td>
                        <td></td>
                        <td>A</td>
                        <td>B</td>
                        <td></td>
                        <td>A</td>
                        <td>B</td>
                        <td></td>
                        <td>A</td>
                        <td>B</td>
                        <td></td>
                        <td>A</td>
                        <td>B</td>
                    </tr>
                    <tr>
                        <?php
                        for ($i = 1; $i <= count($result); $i++) {
                            echo "<td>" . $i . "</td>";
                            if ($result[$i]['jawaban1'] == 1) echo "<td class='text-danger'>X</td>";
                            else echo "<td></td>";
                            if ($result[$i]['jawaban2'] == 1) echo "<td class='text-danger'>X</td>";
                            else echo "<td></td>";
                            if ($i % 7 == 0) echo "</tr><tr>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?= $col1A ?></td>
                        <td><?= $col1B ?></td>
                        <td></td>
                        <td><?= $col2A ?></td>
                        <td><?= $col2B ?></td>
                        <td></td>
                        <td><?= $col3A ?></td>
                        <td><?= $col3B ?></td>
                        <td></td>
                        <td><?= $col4A ?></td>
                        <td><?= $col4B ?></td>
                        <td></td>
                        <td><?= $col5A ?></td>
                        <td><?= $col5B ?></td>
                        <td></td>
                        <td><?= $col6A ?></td>
                        <td><?= $col6B ?></td>
                        <td></td>
                        <td><?= $col7A ?></td>
                        <td><?= $col7B ?></td>
                    </tr>
                    <tr>
                        <td colspan="7"></td>
                        <td><?= $col2A ?></td>
                        <td><?= $col2B ?></td>
                        <td colspan="4"></td>
                        <td><?= $col4A ?></td>
                        <td><?= $col4B ?></td>
                        <td colspan="4"></td>
                        <td><?= $col6A ?></td>
                        <td><?= $col6B ?></td>
                    </tr>
                    <tr>
                        <td colspan="21"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?= $E ?></td>
                        <td><?= $I ?></td>
                        <td colspan="4"></td>
                        <td><?= $S ?></td>
                        <td><?= $N ?></td>
                        <td colspan="4"></td>
                        <td><?= $T ?></td>
                        <td><?= $F ?></td>
                        <td colspan="4"></td>
                        <td><?= $J ?></td>
                        <td><?= $P ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?= ($E > $I) ? "<b>E</b>" : "E" ?></td>
                        <td><?= ($E < $I) ? "<b>I</b>" : "I" ?></td>
                        <td colspan="4"></td>
                        <td><?= ($S > $N) ? "<b>S</b>" : "S" ?></td>
                        <td><?= ($S < $N) ? "<b>N</b>" : "N" ?></td>
                        <td colspan="4"></td>
                        <td><?= ($T > $F) ? "<b>T</b>" : "T" ?></td>
                        <td><?= ($T < $F) ? "<b>F</b>" : "F" ?></td>
                        <td colspan="4"></td>
                        <td><?= ($J > $P) ? "<b>J</b>" : "J" ?></td>
                        <td><?= ($J < $P) ? "<b>P</b>" : "P" ?></td>
                    </tr>
                </table>
                <br />
                <b>Keterangan</b>:<br />
                <b>E</b>: Ekstrovert<br />
                <b>I</b>: Introvert<br />
                <b>S</b>: Sensing<br />
                <b>N</b>: Intuition<br />
                <b>T</b>: Thinking<br />
                <b>F</b>: Feeling<br />
                <b>J</b>: Judging<br />
                <b>P</b>: Perceiving<br />
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