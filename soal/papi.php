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
if (isset($_SESSION['jenis_tes']) && $_SESSION['jenis_tes'] == "PAPI KOSTICK") {
?>

    <body>
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1 mx-auto"><?= $_SESSION['jenis_tes'] ?></span>
            </div>
        </nav>

        <div class="container-fluid mt-1">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="card my-auto">
                        <div class="card-header d-flex">
                            <div class="pr-2 flex-fill"><?= $_SESSION['jenis_tes']; ?></div>
                            <!-- <div class="pl-2 pr-2 flex-fill text-right" id="timer">00:00:00</div> -->
                        </div>
                        <form id="form-jawaban" method="post">
                            <div class="card-body" id="isi-soal">
                                <table class="table table-bordered">
                                    <?php
                                    $limit = 1;
                                    $hitungSoal = mysqli_query($db, "SELECT COUNT(soal_papi.id_papi) AS 'jumlah' FROM `soal_papi`");
                                    if (mysqli_num_rows($hitungSoal) > 0) {
                                        $getRow = mysqli_fetch_row($hitungSoal);
                                        $total_records = $getRow[0]; // ambil baris pertama dari hasil query
                                        $total_pages = ceil($total_records / $limit);
                                    }
                                    if (isset($_GET['p'])) {
                                        if ($_GET['p'] == 1) $page = 0;
                                        else if ($_GET['p'] > 1) $page = ($_GET['p'] - 1) * $limit;
                                    } else $page = 0;
                                    $getSoal = mysqli_query($db, "SELECT * FROM `soal_papi` LIMIT " . $page . ", $limit;");
                                    if (mysqli_num_rows($getSoal) > 0) {
                                        while ($list = mysqli_fetch_array($getSoal)) {
                                            $getJawaban = mysqli_query($db, "SELECT soal_papi.id_papi, jawaban_papi.id_user, jawaban_papi.jawaban, (CASE WHEN jawaban_papi.jawaban = 'A' THEN soal_papi.pernyataan1 WHEN jawaban_papi.jawaban = 'B' THEN soal_papi.pernyataan2 ELSE '-' END) AS 'pernyataan', (CASE WHEN jawaban_papi.jawaban = 'A' THEN soal_papi.var1 WHEN jawaban_papi.jawaban = 'B' THEN soal_papi.var2 ELSE '-' END) AS 'var' FROM `soal_papi` INNER JOIN `jawaban_papi` ON jawaban_papi.id_soal = soal_papi.id_papi WHERE soal_papi.id_papi = '$list[id_papi]' AND jawaban_papi.id_user = '$_SESSION[id_user]';");
                                            $jawabanUser = mysqli_fetch_array($getJawaban);
                                    ?>

                                            <input type="hidden" name="nomor" value="<?= $list['id_papi'] ?>">
                                            <tr>
                                                <td rowspan="2" width="2%"><?= $list['id_papi'] ?></td>
                                                <td width="4%"><input type="radio" name="soal" id="s_<?= $list['id_papi']; ?>_1" value="A" <?= (isset($jawabanUser['pernyataan']) && $jawabanUser['pernyataan'] == $list['pernyataan1']) ? "checked" : "c1"; ?> /></td>
                                                <td><label for="s_<?= $list['id_papi']; ?>_1"><?= $list['pernyataan1'] ?></label></td>
                                            </tr>
                                            <tr>
                                                <td><input type="radio" name="soal" id="s_<?= $list['id_papi']; ?>_2" value="B" <?= (isset($jawabanUser['pernyataan']) && $jawabanUser['pernyataan'] == $list['pernyataan2']) ? "checked" : "c2"; ?> /></td>
                                                <td><label for="s_<?= $list['id_papi']; ?>_2"><?= $list['pernyataan2'] ?></label></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </table>
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
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <center>Nomor Soal:</center>
                    <div class="row justify-content-center">
                        <?php
                        $sudahDijawab = array();
                        $getIdPapi = mysqli_query($db, "SELECT * FROM `soal_papi`");
                        $nomor = 1;
                        while ($papi = mysqli_fetch_array($getIdPapi)) {
                            $sudahDijawab[$nomor] = array(
                                "id_soal" => $papi['id_papi'],
                                "jawaban" => null
                            );
                            $nomor++;
                        }
                        $getIsi = mysqli_query($db, "SELECT * FROM `jawaban_papi` WHERE id_user = '$_SESSION[id_user]'");
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
                var id = $('input[type="hidden"][name="nomor"]').val();
                var jawabanText = $('input[type="radio"][name="soal"]:checked').val();
                $.ajax({
                    type: "POST",
                    url: "save_papi.php",
                    dataType: "json",
                    data: {
                        id_soal: id,
                        jawaban: jawabanText
                    },
                    success: function(data) {
                        if (data.statusCode == "200") {}
                    }
                });
                $.get("papi.php?p=" + (page + 1), function(data) {
                    // Display the returned data in browser
                    $("body").html(data);
                });
            });
            $("#kembali").on('click', function(e) {
                e.preventDefault();
                var id = $('input[type="hidden"][name="nomor"]').val();
                var jawabanText = $('input[type="radio"][name="soal"]:checked').val();
                if (page == 1) pageSebelumnya = 1;
                else pageSebelumnya = page - 1;
                $.ajax({
                    type: "POST",
                    url: "save_papi.php",
                    dataType: "json",
                    data: {
                        id_soal: id,
                        jawaban: jawabanText
                    },
                    success: function(data) {
                        if (data.statusCode == "200") {}
                    }
                });
                $.get("papi.php?p=" + pageSebelumnya, function(data) {
                    // Display the returned data in browser
                    $("body").html(data);
                });
            });
            $("#selesai").on('click', function(e) {
                e.preventDefault();
                var id = $('input[type="hidden"][name="nomor"]').val();
                var jawabanText = $('input[type="radio"][name="soal"]:checked').val();
                $.ajax({
                    type: "POST",
                    url: "save_papi.php",
                    dataType: "json",
                    data: {
                        id_soal: id,
                        jawaban: jawabanText
                    },
                    success: function(data) {
                        if (data.statusCode == "200") {}
                    }
                });
                window.location.href = "selesai.php?status=selesai";
            });
        });
    </script>
<?php
}
?>

</html>