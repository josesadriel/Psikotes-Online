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
    </style>
</head>

<?php
if (isset($_SESSION['id_subtes']) && isset($_SESSION['jenis_tes'])) {
    $getDataSubtes = mysqli_query($db, "SELECT * FROM `tbl_soal` INNER JOIN `tbl_subtes` ON tbl_soal.subtes = tbl_subtes.nama_subtes WHERE tbl_subtes.id_subtes = '$_SESSION[id_subtes]' LIMIT 1");
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
                                <div class="card-body" id="isi-soal">Loading...</div>
                                <?php
                                //jika sudah klik submit jawaban
                                if (isset($_POST['submit_jawaban'])) {
                                    $idSoal = $_POST['id'];
                                    $event = $_SESSION['id_subtes'];
                                    if ($dataSubtes['jumlah_benar'] == 1 || $dataSubtes['jumlah_benar'] == 0) {
                                        if (isset($_POST['jawaban'])) {
                                            $jawaban = $_POST['jawaban'];
                                            echo "<meta http-equiv='refresh' content='0; url=saveJawaban.php?id_soal=" . $idSoal . "&event=" . $event . "&jawaban=" . $jawaban . "'>";
                                        }
                                    } else if ($dataSubtes['jumlah_benar'] > 1) {
                                        if (isset($_POST['jawaban_lebih'])) {
                                            $jawaban = $_POST['jawaban_lebih'];
                                            if (count($jawaban) > 2) echo "<script>alert('Hanya bisa memilih 2 option!');</script>";
                                            if (count($jawaban) == 2) {
                                                $jawaban = implode("|", $jawaban);
                                                echo "<meta http-equiv='refresh' content='0; url=saveJawaban.php?id_soal=" . $idSoal . "&event=" . $event . "&jawaban=" . $jawaban . "'>";
                                            }
                                        }
                                    }
                                    if ($dataSubtes['tipe_soal'] == "Aritmatika") {
                                        if (isset($_POST['jawaban_lebih'])) {
                                            $jawaban = $_POST['jawaban_lebih'];
                                            if (count($jawaban) > 2) echo "<script>alert('Hanya bisa memilih 2 option!');</script>";
                                            if (count($jawaban) == 2) {
                                                $jawaban = implode("|", $jawaban);
                                                echo "<meta http-equiv='refresh' content='0; url=saveJawaban.php?id_soal=" . $idSoal . "&event=" . $event . "&jawaban=" . $jawaban . "'>";
                                            }
                                        }
                                    }
                                }
                                ?>
                            <?php
                            }
                            ?>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="row justify-content-center">
                            <ul class="pagination justify-content-center" id="pagination">
                                <?php
                                if (!empty($total_pages)) {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == 1) {

                                ?>
                                            <li class='page-item active' id="<?php echo $i; ?>"><a href='ist.php?page=<?php echo $i; ?>' class='page-link'><?php echo $i; ?></a></li>
                                        <?php
                                        } else {
                                        ?>
                                            <li id="<?php echo $i; ?>" class='page-item'><a href='ist.php?page=<?php echo $i; ?>' class='page-link'><?php echo $i; ?></a></li>
                                    <?php
                                        }
                                        if (($i % 5) == 0) {
                                            echo '</ul><br/><ul class="pagination justify-content-center" id="pagination">';
                                        }
                                    }
                                }
                                $getLog = mysqli_query($db, "SELECT * FROM `tbl_log` WHERE id_user = '$_SESSION[id_user]' AND id_subtes = '$dataSubtes[id_subtes]' AND tipe = 'Soal'");
                                if (mysqli_num_rows($getLog) > 0) {
                                    $log = mysqli_fetch_array($getLog);
                                    $logTanggal = strtotime($log['tanggal']);
                                    if ($dataSubtes['jenis_jawaban'] == "Hafalan") {
                                        $targetWaktu = $logTanggal + (($dataSubtes['timer'] + $dataSubtes['timer_hafalan']) * 60);
                                    } else $targetWaktu = $logTanggal + ($dataSubtes['timer'] * 60);
                                    $jarakWaktu = $targetWaktu - strtotime(date("Y-m-d H:i:s"));

                                    header("Refresh:" . $jarakWaktu . "; url=selesai.php?status=selesai");
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
                                        var countDownDate = new Date(<?php echo "'" . date("M j, Y H:i:s", $logTanggal) . "'"; ?>).getTime() + (<?= (isset($dataSubtes['timer_hafalan'])) ? ($dataSubtes['timer'] + $dataSubtes['timer_hafalan']) : $dataSubtes['timer']; ?> * 60000);

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
                                            }
                                        }, 1000);
                                    </script>
                                <?php
                                }
                                ?>
                                <script>
                                    <?php
                                    $jwb = mysqli_query($db, "
                                    SET @urutan:=0;
                                    SELECT tbl_soal.id_soal, tbl_soal.jenis_tes, tbl_soal.subtes, b.id_user, b.jawaban, (@urutan:= @urutan + 1) AS rowNumber FROM `tbl_soal` 
                                    LEFT JOIN (SELECT * FROM `tbl_jwbuser` WHERE id_user = 1 ORDER BY added_at ASC) b ON tbl_soal.id_soal = b.id_soal 
                                    WHERE tbl_soal.jenis_tes = 'CFIT' AND tbl_soal.subtes = 'Subtes 1'
                                    ORDER BY tbl_soal.added_at ASC");
                                    if (mysqli_num_rows($jwb) > 0) {
                                        while ($dJawaban = mysqli_fetch_array($jwb)) {
                                    ?>
                                            $("a[href$='?page=<?= $dJawaban['rowNumber'] ?>']").addClass("bg-success");
                                    <?php
                                        }
                                    }
                                    ?>
                                </script>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        <script>
            $(document).ready(function() {
                $("#isi-soal").load("data_soal.php?page=1");
                $("#pagination li").on('click', function(e) {
                    e.preventDefault();
                    var id = $('input[type="number"][name="id"]').val();
                    var pageNum = this.id;
                    var event = <?php echo $_SESSION['id_subtes']; ?>;
                    <?php
                    if ($dataSubtes['jumlah_benar'] == 1 || $dataSubtes['jumlah_benar'] == 0) {
                    ?>
                        var jawaban = $('input[type="radio"][name="jawaban"]:checked').val();

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
                        console.log(id);
                        console.log(jawaban);
                        console.log(event);
                    <?php
                    } else if ($dataSubtes['jumlah_benar'] > 1) {
                    ?>
                        var jawaban = [];
                        $(':checkbox:checked').each(function(i) {
                            jawaban[i] = $(this).val();
                        });
                        var jawabanText = jawaban.join("|");
                        if (jawaban.length > 2) alert('Hanya bisa memilih 2 option!');
                        if (jawaban.length == 2) {
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
                        }
                    <?php
                    }
                    ?>
                    $("#isi-soal").html('loading...');
                    $("#pagination li").removeClass('active');
                    $(this).addClass('active');
                    $("#isi-soal").load("data_soal.php?page=" + pageNum);
                });
            });
        </script>
<?php
    }
}
?>

</html>