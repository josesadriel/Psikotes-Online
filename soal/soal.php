<?php
include("../koneksi.php");
session_start();
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
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/sticky-navbar-footer.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .form-control:focus {
            border-color: #ff0000;
            box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset, 0px 0px 8px rgba(255, 100, 255, 0.5);
        }

        #pagination li a {
            width: 40px;
            max-width: 40px;
            text-align: center;
        }
    </style>
</head>

<?php
$getDataUser = mysqli_query($db, "SELECT * FROM `tbl_user` INNER JOIN `tbl_event` ON tbl_user.acara = tbl_event.id_event WHERE id_user = '$_SESSION[id_user]'");
$dataUser = mysqli_fetch_array($getDataUser);
if (strtotime($dataUser['tgl_akhir'] . $dataUser['waktu_akhir']) <= time()) {
    echo "<meta http-equiv='refresh' content='0; url=../logout.php'>";
}
if (isset($_SESSION['id_subtes']) && isset($_SESSION['jenis_tes'])) {
    $getDataSubtes = mysqli_query($db, "SELECT * FROM `tbl_soal` INNER JOIN `tbl_subtes` ON tbl_soal.subtes = tbl_subtes.nama_subtes WHERE tbl_subtes.id_subtes = '$_SESSION[id_subtes]' ORDER BY tbl_soal.id_soal ASC LIMIT 1");
    if (mysqli_num_rows($getDataSubtes) > 0) {
        $dataSubtes = mysqli_fetch_array($getDataSubtes);
?>

        <body>
            <nav class="navbar navbar-dark bg-dark">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1 mx-auto"><?= $_SESSION['jenis_tes'] . '-' . $dataSubtes['nama_subtes'] ?></span>
                </div>
            </nav>

            <div class="container-fluid mt-1">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="card my-auto">
                            <div class="card-header d-flex">
                                <div class="pr-2 flex-fill"><?= $_SESSION['jenis_tes'] . '-' . $dataSubtes['nama_subtes'] ?></div>
                                <div class="pl-2 pr-2 flex-fill text-right" id="timer">00:00:00</div>
                            </div>
                            <?php
                            if (isset($_SESSION['id_subtes'])) {
                                // paging
                                $limit = 1; // berapa banyak soal yang akan ditampilkan
                                $hitungSoal = mysqli_query($db, "SELECT COUNT(tbl_soal.id_soal) AS 'jumlah' FROM `tbl_soal` INNER JOIN `tbl_jenistes` ON tbl_soal.jenis_tes = tbl_jenistes.nama_tes INNER JOIN `tbl_subtes` ON tbl_subtes.nama_subtes = tbl_soal.subtes WHERE tbl_jenistes.nama_tes = '$_SESSION[jenis_tes]' AND tbl_subtes.id_subtes = '$_SESSION[id_subtes]'");
                                if (mysqli_num_rows($hitungSoal) > 0) {
                                    $getRow = mysqli_fetch_row($hitungSoal);
                                    $total_records = $getRow[0]; // ambil baris pertama dari hasil query
                                    $total_pages = ceil($total_records / $limit);
                                }
                                // selesai paging
                            ?>
                                <form id="form-jawaban" method="post">
                                    <div class="card-body" id="isi-soal">
                                        <?php
                                        if (isset($_GET['p'])) {
                                            if ($_GET['p'] == 1) $page = 0;
                                            else if ($_GET['p'] > 1) $page = ($_GET['p'] - 1) * $limit;
                                        } else $page = 0;
                                        $alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X ', 'Y', 'Z');
                                        $getSoal = mysqli_query($db, "SELECT tbl_soal.* FROM `tbl_soal` INNER JOIN `tbl_jenistes` ON tbl_soal.jenis_tes = tbl_jenistes.nama_tes INNER JOIN `tbl_subtes` ON tbl_subtes.nama_subtes = tbl_soal.subtes WHERE tbl_jenistes.nama_tes = '$_SESSION[jenis_tes]' AND tbl_subtes.id_subtes = '$_SESSION[id_subtes]' ORDER BY tbl_soal.id_soal ASC LIMIT $page, $limit");
                                        if (mysqli_num_rows($getSoal) > 0) {
                                            $nomor = 1;
                                            while ($list = mysqli_fetch_array($getSoal)) {
                                                $getJawaban = mysqli_query($db, "SELECT * FROM `tbl_jwbuser` WHERE id_soal = '$list[id_soal]' AND id_user = '$_SESSION[id_user]'");
                                                $jawabanUser = mysqli_fetch_array($getJawaban);
                                        ?>
                                                <input type="number" value="<?php echo $list['id_soal']; ?>" name="id" style="display:none" />
                                                <?= (isset($list['soal'])) ? $list['soal'] : ""; ?>
                                                <?php
                                                if (isset($list['gambar']) && $list['gambar'] != "") { //cek apakah ada gambar pada soal
                                                    echo "<img src='../image/" . $list['gambar'] . "' class='img-fluid'/><br/>";
                                                }
                                                ?>
                                                <div class="mt-3 mb-2">Jawab:</div>
                                                <?php
                                                if ($list['jenis_jawaban'] == "Pilihan Ganda" || $list['jenis_jawaban'] == "Hafalan") {
                                                    if (isset($list['pilihan']) && $list['pilihan'] != "") {
                                                        $pilihan = explode("#", $list['pilihan']);
                                                        for ($i = 0; $i < count($pilihan); $i++) {
                                                            if (isset($jawabanUser['jawaban']) && $jawabanUser['jawaban'] == $alpha[$i]) {
                                                ?>
                                                                <input type="radio" id="jawaban<?php echo $nomor . $i ?>" name="jawaban" value="<?= $alpha[$i] ?>" checked />
                                                                <label for="jawaban<?php echo $nomor . $i ?>" class="mt-2 mr-2 mb-2"><?= $pilihan[$i]; ?></label><br />
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <input type="radio" id="jawaban<?php echo $nomor . $i ?>" name="jawaban" value="<?= $alpha[$i] ?>" />
                                                                <label for="jawaban<?php echo $nomor . $i ?>" class="mt-2 mr-2 mb-2"><?= $pilihan[$i]; ?></label><br />
                                                                <?php
                                                            }
                                                        }
                                                    } else {
                                                        if ($list['jumlah_benar'] == 1) {
                                                            for ($ulang = 0; $ulang < $list['jumlah_jawaban']; $ulang++) {
                                                                if (isset($jawabanUser['jawaban']) && $jawabanUser['jawaban'] == $alpha[$ulang]) {
                                                                ?>
                                                                    <input type="radio" id="jawaban<?php echo $nomor . $ulang; ?>" name="jawaban" value="<?php echo $alpha[$ulang]; ?>" checked />
                                                                    <label for="jawaban<?php echo $nomor . $ulang; ?>" class="mt-2 mr-2 mb-2"><?php echo $alpha[$ulang]; ?></label><br />
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <input type="radio" id="jawaban<?php echo $nomor . $ulang; ?>" name="jawaban" value="<?php echo $alpha[$ulang]; ?>" />
                                                                    <label for="jawaban<?php echo $nomor . $ulang; ?>" class="mt-2 mr-2 mb-2"><?php echo $alpha[$ulang]; ?></label><br />
                                                                    <?php
                                                                }
                                                            }
                                                        } else if ($list['jumlah_benar'] > 1) {
                                                            for ($ulang = 0; $ulang < $list['jumlah_jawaban']; $ulang++) {
                                                                if (isset($jawabanUser['jawaban'])) {
                                                                    $jawaban = $jawabanUser['jawaban'];
                                                                    if (strpos($jawaban, $alpha[$ulang]) !== false) {
                                                                    ?>

                                                                        <input type="checkbox" id="jawaban<?php echo $nomor . $ulang; ?>" name="jawaban_lebih[]" value="<?php echo $alpha[$ulang]; ?>" checked />
                                                                        <label for="jawaban<?php echo $nomor . $ulang; ?>" class="mt-2 mr-2 mb-2"><?php echo $alpha[$ulang]; ?></label><br />
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <input type="checkbox" id="jawaban<?php echo $nomor . $ulang; ?>" name="jawaban_lebih[]" value="<?php echo $alpha[$ulang]; ?>" />
                                                                        <label for="jawaban<?php echo $nomor . $ulang; ?>" class="mt-2 mr-2 mb-2"><?php echo $alpha[$ulang]; ?></label><br />
                                                                    <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <input type="checkbox" id="jawaban<?php echo $nomor . $ulang; ?>" name="jawaban_lebih[]" value="<?php echo $alpha[$ulang]; ?>" />
                                                                    <label for="jawaban<?php echo $nomor . $ulang; ?>" class="mt-2 mr-2 mb-2"><?php echo $alpha[$ulang]; ?></label><br />
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                } else if ($list['jenis_jawaban'] == "Isian") {
                                                    ?>
                                                    <input type="text" name="jawaban" class="form-control col-lg-6 col-md-12" value="<?= (isset($jawabanUser['jawaban'])) ? $jawabanUser['jawaban'] : "" ?>" autofocus /><br />
                                                    <?php
                                                } else if ($list['jenis_jawaban'] == "Aritmatika") {
                                                    for ($i = 0; $i < 10; $i++) {
                                                    ?>
                                                        <input type="checkbox" id="jawaban<?php echo $nomor . $i; ?>" name="jawaban_lebih[]" value="<?php echo $i; ?>" />
                                                        <label for="jawaban<?php echo $nomor . $i; ?>" class="mt-2 mr-2 mb-2"><?php echo $i; ?></label><br />
                                                        <?php
                                                    }
                                                    if (isset($jawabanUser['jawaban'])) {
                                                        $jawaban = $jawabanUser['jawaban'];
                                                        echo "<script>";
                                                        for ($j = 0; $j < strlen((string)$jawaban); $j++) {
                                                            // if (strpos($jawaban, $list['jawaban_benar'][$j]) !== false) {
                                                            echo "$('#jawaban" . $nomor . $jawaban[$j] . "').prop('checked',true);";
                                                            // }
                                                        }
                                                        echo "</script>";
                                                    }
                                                } else if ($list['jenis_jawaban'] == "Gambar") {
                                                    echo '<div class="d-flex flex-row">';
                                                    if (isset($list['paket_gambar'])) {
                                                        $paketGambar = mysqli_query($db, "SELECT * FROM `tbl_paketgambar` WHERE nama_paket = '$list[paket_gambar]'");
                                                        if (mysqli_num_rows($paketGambar) > 0) {
                                                            $row = mysqli_fetch_array($paketGambar);
                                                            $format = explode('.', $row['gambar']);
                                                            for ($i = 0; $i < $row['jumlah_gambar']; $i++) {
                                                                if (isset($jawabanUser['jawaban']) && $jawabanUser['jawaban'] == $alpha[$i]) {
                                                        ?>

                                                                    <!-- <input type="radio" id="jawaban<?php echo $nomor . $i ?>" name="jawaban" value="<?= $alpha[$i] ?>" checked />
                                                                        <label for="jawaban<?php echo $nomor . $i ?>" class="mt-2 mr-2 mb-2"><img src="../image/<?= $row['nama_paket'] . '-' . ($i + 1) . "." . end($format) ?>" style="max-width:35%" /></label><br /> -->
                                                                    <div class="p-2" align="center">
                                                                        <label for="jawaban<?php echo $nomor . $i ?>" class="mt-2 mr-2 mb-2"><img src="../image/<?= $row['nama_paket'] . '-' . ($i + 1) . "." . end($format) ?>" style="max-width:65%" /></label><br />
                                                                        <input type="radio" id="jawaban<?php echo $nomor . $i ?>" name="jawaban" value="<?= $alpha[$i] ?>" checked />
                                                                    </div>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <!-- <input type="radio" id="jawaban<?php echo $nomor . $i ?>" name="jawaban" value="<?= $alpha[$i] ?>" />
                                                                    <label for="jawaban<?php echo $nomor . $i ?>" class="mt-2 mr-2 mb-2"><img src="../image/<?= $row['nama_paket'] . '-' . ($i + 1) . "." . end($format) ?>" style="max-width:35%" /></label><br /> -->

                                                                    <div class="p-2" align="center">
                                                                        <label for="jawaban<?php echo $nomor . $i ?>" class="mt-2 mr-2 mb-2"><img src="../image/<?= $row['nama_paket'] . '-' . ($i + 1) . "." . end($format) ?>" style="max-width:65%" /></label><br />
                                                                        <input type="radio" id="jawaban<?php echo $nomor . $i ?>" name="jawaban" value="<?= $alpha[$i] ?>" /><br />
                                                                    </div>
                                        <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    echo '</div>';
                                                }
                                                $nomor++;
                                            }
                                        }
                                        ?>
                                    </div>

                                    <div class="card-footer d-flex">
                                        <div class="p-2 bd-highlight">
                                            <button class="btn btn-primary" id="kembali">
                                                <i class="fas fa-angle-left"></i> Kembali
                                            </button>
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <button class="btn btn-primary" id="berikutnya">
                                                Berikutnya <i class="fas fa-angle-right"></i>
                                            </button>
                                        </div>
                                        <div class="ml-auto p-2 bd-highlight">
                                            <button class="btn btn-primary" id="selesai" style="display:none">
                                                Selesai
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <center>Nomor Soal:</center>
                        <div class="row justify-content-center">
                            <?php
                            $sudahDijawab = array();
                            $getIdSoal = mysqli_query($db, "SELECT * FROM `tbl_soal` INNER JOIN `tbl_subtes` ON tbl_subtes.nama_subtes = tbl_soal.subtes WHERE tbl_subtes.id_subtes = '$_SESSION[id_subtes]' AND tbl_soal.jenis_tes = '$_SESSION[jenis_tes]' ORDER BY tbl_soal.id_soal ASC");
                            $nomor = 1;
                            while ($soal = mysqli_fetch_array($getIdSoal)) {
                                $sudahDijawab[$nomor] = array(
                                    "id_soal" => $soal['id_soal'],
                                    "jawaban" => null
                                );
                                $nomor++;
                            }
                            $getIsi = mysqli_query($db, "SELECT * FROM `tbl_jwbuser` WHERE id_user = '$_SESSION[id_user]'");
                            while ($isi = mysqli_fetch_array($getIsi)) {
                                for ($i = 1; $i <= count($sudahDijawab); $i++) {
                                    if ($sudahDijawab[$i]['id_soal'] == $isi['id_soal']) {
                                        $sudahDijawab[$i]['jawaban'] = $isi['jawaban'];
                                    }
                                }
                            }
                            ?>
                            <ul class="pagination justify-content-center flex-wrap" id="pagination">
                                <?php
                                for ($i = 1; $i <= $total_pages; $i++) {
                                ?>
                                    <li class="page-item">
                                        <a href="?p=<?= $i; ?>" class="page-link <?= (isset($sudahDijawab[$i]['jawaban'])) ? 'bg-success text-dark' : '' ?>"><?= $i ?></a>
                                    </li>
                                <?php
                                    if (($i % 10) == 0) {
                                        echo '</ul><br/><ul class="pagination justify-content-center flex-wrap" id="pagination">';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($dataSubtes['timer'] > 0) {
                $getLog = mysqli_query($db, "SELECT * FROM `tbl_log` WHERE id_user = '$_SESSION[id_user]' AND id_subtes = '$dataSubtes[id_subtes]' AND tipe = 'Soal'");
                if (mysqli_num_rows($getLog) > 0) {
                    $log = mysqli_fetch_array($getLog);
                    $logTanggal = strtotime($log['tanggal']);
                    if ($dataSubtes['jenis_jawaban'] == "Hafalan") {
                        $targetWaktu = $logTanggal + (($dataSubtes['timer'] + $dataSubtes['timer_hafalan']) * 60);
                    } else $targetWaktu = $logTanggal + ($dataSubtes['timer'] * 60);
                    $jarakWaktu = $targetWaktu - strtotime(date("Y-m-d H:i:s"));

                    // header("Refresh:" . $jarakWaktu . "; url=selesai.php?status=selesai");
                    if ($log['status'] == "Selesai") {
                        echo "<meta http-equiv='refresh' content='0; url=../user/list-tes.php'>";
                    }
            ?>
                    <!-- TIMER -->
                    <script>
                        function numberTwoLength(j) {
                            return ('0' + j).slice(-2);
                        }
                        // set jadwal event
                        var countDownDate = new Date(<?php echo "'" . date("M j, Y H:i:s", $logTanggal) . "'"; ?>).getTime() + (<?= $dataSubtes['timer'] ?> * 60000);

                        var x = setInterval(function() {

                            // tanggal sekarang
                            var now = new Date().getTime();

                            // hitung perbedaan jarak waktu
                            var distance = countDownDate - now;

                            // hitungan waktu untuk jam, menit, dan detik
                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                            document.getElementById("timer").innerHTML = numberTwoLength(hours) + ":" +
                                numberTwoLength(minutes) + ":" + numberTwoLength(seconds);

                            // If the count down is over, write some text 
                            if (distance < 0) {
                                clearInterval(x);
                                document.getElementById('timer').innerHTML = "EXPIRED";
                                window.location.href = "selesai.php?status=selesai";
                            }
                        }, 1000);
                    </script>
            <?php
                }
            }
            ?>
        </body>
        <script>
            $(document).ready(function() {
                <?php
                if (isset($_GET['p'])) echo 'var page = ' . $_GET['p'] . ';';
                else echo 'var page = 1;';

                echo 'var total = ' . $total_pages . ';';
                ?>
                if (page == 1) $('#kembali').prop('disabled', true);
                if (page == total) {
                    $('#berikutnya').prop('disabled', true);
                    $('#selesai').show();
                }
                $("#berikutnya").on('click', function(e) {
                    e.preventDefault();
                    var id = $('input[type="number"][name="id"]').val();
                    var event = <?php echo $_SESSION['id_subtes']; ?>;
                    <?php
                    if ($dataSubtes['jumlah_benar'] == 1 || $dataSubtes['jumlah_benar'] == 0) {
                    ?>
                        <?php
                        if ($dataSubtes['jenis_jawaban'] == "Isian") {
                        ?>
                            var jawaban = $('input[type="text"][name="jawaban"]').val();
                        <?php
                        } else if ($dataSubtes['jenis_jawaban'] == "Aritmatika") {
                        ?>
                            var jawabanAritmatika = [];
                            $(':checkbox:checked').each(function(i) {
                                jawabanAritmatika[i] = $(this).val();
                            });
                            var jawaban = jawabanAritmatika.join("");
                        <?php
                        } else {
                        ?>
                            var jawaban = $('input[type="radio"][name="jawaban"]:checked').val();
                        <?php
                        }
                        ?>
                        console.log(id, jawaban, event);
                        $.ajax({
                            type: "POST",
                            url: "saveJawaban.php",
                            dataType: "json",
                            data: {
                                id_soal: id,
                                jawaban: jawaban,
                                event: event
                            },
                            success: function(data) {
                                if (data.statusCode == "200") {}
                            }
                        });
                        $.get("soal.php?p=" + (page + 1), function(data) {
                            // Display the returned data in browser
                            $("body").html(data);
                        });
                    <?php
                    } else if ($dataSubtes['jumlah_benar'] > 1) {
                    ?>
                        var jawaban = [];
                        $(':checkbox:checked').each(function(i) {
                            jawaban[i] = $(this).val();
                        });
                        var jawabanText = jawaban.join("|");
                        if (jawaban.length > 2) alert('Hanya bisa memilih 2 option!');
                        else if (jawaban.length == 2) {
                            $.ajax({
                                type: "POST",
                                url: "saveJawaban.php",
                                dataType: "json",
                                data: {
                                    id_soal: id,
                                    jawaban: jawabanText,
                                    event: event
                                },
                                success: function(data) {
                                    if (data.statusCode == "200") {}
                                }
                            });
                            $.get("soal.php?p=" + (page + 1), function(data) {
                                // Display the returned data in browser
                                $("body").html(data);
                            });
                        }
                    <?php
                    }
                    ?>
                });
                $("#kembali").on('click', function(e) {
                    e.preventDefault();
                    var id = $('input[type="number"][name="id"]').val();
                    var event = <?php echo $_SESSION['id_subtes']; ?>;
                    if (page == 1) pageSebelumnya = 1;
                    else pageSebelumnya = page - 1;
                    <?php
                    if ($dataSubtes['jumlah_benar'] == 1 || $dataSubtes['jumlah_benar'] == 0) {
                    ?>
                        <?php
                        if ($dataSubtes['jenis_jawaban'] == "Isian") {
                        ?>
                            var jawaban = $('input[type="text"][name="jawaban"]').val();
                        <?php
                        } else {
                        ?>
                            var jawaban = $('input[type="radio"][name="jawaban"]:checked').val();
                        <?php
                        }
                        ?>

                        $.ajax({
                            type: "POST",
                            url: "saveJawaban.php",
                            dataType: "json",
                            data: {
                                id_soal: id,
                                jawaban: jawaban,
                                event: event
                            },
                            success: function(data) {
                                if (data.statusCode == "200") {}
                            }
                        });
                        $.get("soal.php?p=" + pageSebelumnya, function(data) {
                            // Display the returned data in browser
                            $("body").html(data);
                        });
                    <?php
                    } else if ($dataSubtes['jumlah_benar'] > 1) {
                    ?>
                        var jawaban = [];
                        $(':checkbox:checked').each(function(i) {
                            jawaban[i] = $(this).val();
                        });
                        var jawabanText = jawaban.join("|");
                        if (jawaban.length > 2) alert('Hanya bisa memilih 2 option!');
                        else if (jawaban.length == 2) {
                            $.ajax({
                                type: "POST",
                                url: "saveJawaban.php",
                                dataType: "json",
                                data: {
                                    id_soal: id,
                                    jawaban: jawabanText,
                                    event: event
                                },
                                success: function(data) {
                                    if (data.statusCode == "200") {}
                                }
                            });
                            $.get("soal.php?p=" + pageSebelumnya, function(data) {
                                // Display the returned data in browser
                                $("body").html(data);
                            });
                        }
                    <?php
                    }
                    ?>
                });
                $("#selesai").on('click', function(e) {
                    e.preventDefault();
                    var id = $('input[type="number"][name="id"]').val();
                    var event = <?php echo $_SESSION['id_subtes']; ?>;
                    <?php
                    if ($dataSubtes['jumlah_benar'] == 1 || $dataSubtes['jumlah_benar'] == 0) {
                    ?>
                        <?php
                        if ($dataSubtes['jenis_jawaban'] == "Isian") {
                        ?>
                            var jawaban = $('input[type="text"][name="jawaban"]').val();
                        <?php
                        } else {
                        ?>
                            var jawaban = $('input[type="radio"][name="jawaban"]:checked').val();
                        <?php
                        }
                        ?>

                        $.ajax({
                            type: "POST",
                            url: "saveJawaban.php",
                            dataType: "json",
                            data: {
                                id_soal: id,
                                jawaban: jawaban,
                                event: event
                            },
                            success: function(data) {
                                if (data.statusCode == "200") {}
                            }
                        });
                        window.location.href = "selesai.php?status=selesai";
                    <?php
                    } else if ($dataSubtes['jumlah_benar'] > 1) {
                    ?>
                        var jawaban = [];
                        $(':checkbox:checked').each(function(i) {
                            jawaban[i] = $(this).val();
                        });
                        var jawabanText = jawaban.join("|");
                        if (jawaban.length > 2) alert('Hanya bisa memilih 2 option!');
                        else if (jawaban.length == 2) {
                            $.ajax({
                                type: "POST",
                                url: "saveJawaban.php",
                                dataType: "json",
                                data: {
                                    id_soal: id,
                                    jawaban: jawabanText,
                                    event: event
                                },
                                success: function(data) {
                                    if (data.statusCode == "200") {}
                                }
                            });
                            window.location.href = "selesai.php?status=selesai";
                        }
                    <?php
                    }
                    ?>
                });
            });
        </script>
<?php
    }
}
?>

</html>