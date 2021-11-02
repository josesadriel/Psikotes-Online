<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Mulai Tes</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/sticky-navbar-footer.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 mx-auto">Tes DISC</span>
        </div>
    </nav>
    <div class="container-fluid mt-3">
        <form action="#" method="post" onsubmit="cekInputRadio()">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <table class="table table-bordered">
                        <tr align="center">
                            <th>No</th>
                            <th width="10%">S</th>
                            <th width="10%">TS</th>
                            <th>Pernyataan</th>
                        </tr>
                        <?php
                        $getSoal = mysqli_query($db, "SELECT * FROM `soal_disc` LIMIT 0, 8");
                        if (mysqli_num_rows($getSoal) > 0) {
                            while ($data = mysqli_fetch_array($getSoal)) {
                        ?>
                                <tr>
                                    <td rowspan="4" class="align-middle text-center fs-3"><b><?= $data['id_soal'] ?></b></td>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="s_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_1'] ?>" />
                                    </td>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="ts_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_1'] ?>" />
                                    </td>
                                    <td class="p-2"><?= $data['pernyataan_1'] ?></td>
                                </tr>
                                <tr>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="s_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_2'] ?>" />
                                    </td>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="ts_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_2'] ?>" />
                                    </td>
                                    <td class="p-2"><?= $data['pernyataan_2'] ?></td>
                                </tr>
                                <tr>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="s_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_3'] ?>" />
                                    </td>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="ts_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_3'] ?>" />
                                    </td>
                                    <td class="p-2"><?= $data['pernyataan_3'] ?></td>
                                </tr>
                                <tr>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="s_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_4'] ?>" />
                                    </td>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="ts_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_4'] ?>" />
                                    </td>
                                    <td class="p-2"><?= $data['pernyataan_4'] ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding:15px"></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                </div>
                <div class="col-md-4 mb-3">
                    <table class="table table-bordered">
                        <tr align="center">
                            <th>No</th>
                            <th width="10%">S</th>
                            <th width="10%">TS</th>
                            <th>Pernyataan</th>
                        </tr>
                        <?php
                        $getSoal = mysqli_query($db, "SELECT * FROM `soal_disc` LIMIT 8, 8");
                        if (mysqli_num_rows($getSoal) > 0) {
                            while ($data = mysqli_fetch_array($getSoal)) {
                        ?>
                                <tr>
                                    <td rowspan="4" class="align-middle text-center fs-3"><b><?= $data['id_soal'] ?></b></td>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="s_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_1']; ?>" />
                                    </td>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="ts_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_1']; ?>" />
                                    </td>
                                    <td class="p-2"><?= $data['pernyataan_1'] ?></td>
                                </tr>
                                <tr>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="s_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_2']; ?>" />
                                    </td>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="ts_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_2']; ?>" />
                                    </td>
                                    <td class="p-2"><?= $data['pernyataan_2'] ?></td>
                                </tr>
                                <tr>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="s_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_3']; ?>" />
                                    </td>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="ts_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_3']; ?>" />
                                    </td>
                                    <td class="p-2"><?= $data['pernyataan_3'] ?></td>
                                </tr>
                                <tr>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="s_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_4']; ?>" />
                                    </td>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="ts_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_4']; ?>" />
                                    </td>
                                    <td class="p-2"><?= $data['pernyataan_4'] ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding:15px"></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                </div>
                <div class="col-md-4 mb-3">
                    <table class="table table-bordered">
                        <tr align="center">
                            <th>No</th>
                            <th width="10%">S</th>
                            <th width="10%">TS</th>
                            <th>Pernyataan</th>
                        </tr>
                        <?php
                        $getSoal = mysqli_query($db, "SELECT * FROM `soal_disc` LIMIT 16, 8");
                        if (mysqli_num_rows($getSoal) > 0) {
                            while ($data = mysqli_fetch_array($getSoal)) {
                        ?>
                                <tr>
                                    <td rowspan="4" class="align-middle text-center fs-3"><b><?= $data['id_soal'] ?></b></td>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="s_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_1']; ?>" />
                                    </td>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="ts_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_1']; ?>" />
                                    </td>
                                    <td class="p-2"><?= $data['pernyataan_1'] ?></td>
                                </tr>
                                <tr>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="s_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_2']; ?>" />
                                    </td>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="ts_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_2']; ?>" />
                                    </td>
                                    <td class="p-2"><?= $data['pernyataan_2'] ?></td>
                                </tr>
                                <tr>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="s_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_3']; ?>" />
                                    </td>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="ts_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_3']; ?>" />
                                    </td>
                                    <td class="p-2"><?= $data['pernyataan_3'] ?></td>
                                </tr>
                                <tr>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="s_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_4']; ?>" />
                                    </td>
                                    <td class="p-2" align="center">
                                        <input type="radio" name="ts_<?= $data['id_soal'] ?>" value="<?= $data['pernyataan_4']; ?>" />
                                    </td>
                                    <td class="p-2"><?= $data['pernyataan_4'] ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding:15px"></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div class="position-relative">
                <input type="submit" name="submit" value="Selesai" class="btn btn-lg btn-block btn-primary" />
            </div>
            <br />
        </form>
        <?php
        if (isset($_POST['submit'])) {
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

            $getJawaban = mysqli_query($db, "SELECT * FROM `soal_disc`");
            while ($data = mysqli_fetch_array($getJawaban)) {
                // seleksi jawaban untuk kolom setuju
                if ($_POST['s_' . $data['id_soal']] == $data['pernyataan_1']) {
                    if ($data['s_1'] == 'S') $sS++;
                    else if ($data['s_1'] == 'D') $sD++;
                    else if ($data['s_1'] == 'I') $sI++;
                    else if ($data['s_1'] == 'C') $sC++;
                    else if ($data['s_1'] == '#') $sSimbol++;
                } else if ($_POST['s_' . $data['id_soal']] == $data['pernyataan_2']) {
                    if ($data['s_2'] == 'S') $sS++;
                    else if ($data['s_2'] == 'D') $sD++;
                    else if ($data['s_2'] == 'I') $sI++;
                    else if ($data['s_2'] == 'C') $sC++;
                    else if ($data['s_2'] == '#') $sSimbol++;
                } else if ($_POST['s_' . $data['id_soal']] == $data['pernyataan_3']) {
                    if ($data['s_3'] == 'S') $sS++;
                    else if ($data['s_3'] == 'D') $sD++;
                    else if ($data['s_3'] == 'I') $sI++;
                    else if ($data['s_3'] == 'C') $sC++;
                    else if ($data['s_3'] == '#') $sSimbol++;
                } else if ($_POST['s_' . $data['id_soal']] == $data['pernyataan_4']) {
                    if ($data['s_4'] == 'S') $sS++;
                    else if ($data['s_4'] == 'D') $sD++;
                    else if ($data['s_4'] == 'I') $sI++;
                    else if ($data['s_4'] == 'C') $sC++;
                    else if ($data['s_4'] == '#') $sSimbol++;
                }
                //selesai seleksi kolom setuju

                //seleksi jawaban kolom tidak setuju
                if ($_POST['ts_' . $data['id_soal']] == $data['pernyataan_1']) {
                    if ($data['ts_1'] == 'S') $tsS++;
                    else if ($data['ts_1'] == 'D') $tsD++;
                    else if ($data['ts_1'] == 'I') $tsI++;
                    else if ($data['ts_1'] == 'C') $tsC++;
                    else if ($data['ts_1'] == '#') $tsSimbol++;
                } else if ($_POST['ts_' . $data['id_soal']] == $data['pernyataan_2']) {
                    if ($data['ts_2'] == 'S') $tsS++;
                    else if ($data['ts_2'] == 'D') $tsD++;
                    else if ($data['ts_2'] == 'I') $tsI++;
                    else if ($data['ts_2'] == 'C') $tsC++;
                    else if ($data['ts_2'] == '#') $tsSimbol++;
                } else if ($_POST['ts_' . $data['id_soal']] == $data['pernyataan_3']) {
                    if ($data['ts_3'] == 'S') $tsS++;
                    else if ($data['ts_3'] == 'D') $tsD++;
                    else if ($data['ts_3'] == 'I') $tsI++;
                    else if ($data['ts_3'] == 'C') $tsC++;
                    else if ($data['ts_3'] == '#') $tsSimbol++;
                } else if ($_POST['ts_' . $data['id_soal']] == $data['pernyataan_4']) {
                    if ($data['ts_4'] == 'S') $tsS++;
                    else if ($data['ts_4'] == 'D') $tsD++;
                    else if ($data['ts_4'] == 'I') $tsI++;
                    else if ($data['ts_4'] == 'C') $tsC++;
                    else if ($data['ts_4'] == '#') $tsSimbol++;
                }
                //selesai seleksi kolom tidak setuju
            }
            $jumlahJawaban = (count($_POST) - 1);
            $sql = "INSERT INTO `jawaban_disc` (`id_soal`, `id_user`, `setuju`, `tidak_setuju`) VALUES ";
            if ($jumlahJawaban % 2 == 0) {
                for ($i = 1; $i <= ($jumlahJawaban / 2); $i++) {
                    $sql .= "('" . $i . "', '1', '" . $_POST['s_' . $i] . "', '" . $_POST['ts_' . $i] . "'), ";
                }
                $sql = substr($sql, 0, -2) . ";"; // potong 2 huruf dari belakang

                $cekDataUser = mysqli_query($db, "SELECT * FROM `jawaban_disc` WHERE id_user = '1'");
                if (mysqli_num_rows($cekDataUser) > 0) {
                } else {
                    $insertSql = mysqli_query($db, $sql);
                    if ($insertSql) echo "Berhasil";
                }
            }

            echo "Setuju: " . $sD . "(D), " . $sI . "(I), " . $sS . "(S), " . $sC . "(C), " . $sSimbol . "(*)<br/>";
            echo "Tidak Setuju: " . $tsD . "(D), " . $tsI . "(I), " . $tsS . "(S), " . $tsC . "(C), " . $tsSimbol . "(*)<br/>";
        }
        ?>
    </div>
    <script>
        function cekInputRadio() {
            var formValid = false;
            <?php
            $dataSoal = mysqli_query($db, "SELECT * FROM `soal_disc`");
            if (mysqli_num_rows($dataSoal) > 0) {
                while ($data = mysqli_fetch_array($dataSoal)) {
            ?>
                    if (!$('input[name="s_<?= $data['id_soal']; ?>"]:checked').length) {
                        alert("Pilih yang menurut Anda setuju pada nomor <?= $data['id_soal']; ?>!");
                        event.preventDefault();
                        return false;
                    }
                    if (!$('input[name="ts_<?= $data['id_soal']; ?>"]:checked').length) {
                        alert("Pilih yang menurut Anda tidak setuju pada nomor <?= $data['id_soal']; ?>!");
                        event.preventDefault();
                        return false;
                    }
            <?php
                }
            }
            ?>
        }
        $("td").click(function() {
            $(this).find('input:radio').prop('checked', true);
        });
    </script>
</body>

</html>