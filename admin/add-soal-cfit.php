<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Tambah Soal CFIT</title>

    <!-- Summernote JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Tambah Soal CFIT</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="kelola-soal.php">Kelola Soal</a></li>
                    <li class="breadcrumb-item active">Tambah Soal CFIT</li>
                </ol>
                <div class="card mb-4 mt-2">
                    <div class="card-header">
                        Tambah Soal CFIT
                    </div>
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">
                            Jenis Tes:<br />
                            <input type="text" name="jenis_tes" value="CFIT" class="form-control col-lg-6 col-md-12" readonly /><br />
                            Subtes:<br />
                            <select name="subtes" id="subtes" class="form-control col-lg-6 col-md-6">
                                <option value="" disabled selected>-</option>
                                <?php
                                $getSubtes = mysqli_query($db, "SELECT tbl_subtes.id_subtes, tbl_jenistes.nama_tes, tbl_subtes.nama_subtes FROM `tbl_subtes` INNER JOIN `tbl_jenistes` ON tbl_subtes.id_jenistes = tbl_jenistes.id_jenistes WHERE tbl_jenistes.nama_tes = 'CFIT'");
                                if (mysqli_num_rows($getSubtes) > 0) {
                                    while ($data = mysqli_fetch_array($getSubtes)) {
                                ?>
                                        <option value="<?= $data['nama_subtes'] ?>"><?= $data['nama_subtes'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select><br />
                            Merupakan:<br />
                            <select name="definisi" id="definisi" class="form-control col-lg-6 col-md-12">
                                <option value="Soal">Soal</option>
                                <option value="Contoh">Contoh Soal</option>
                            </select><br />
                            <div id="gambar">
                                Gambar:<br />
                                <div class="custom-file col-lg-6 col-md-12">
                                    <input type="file" class="custom-file-input" id="customFile" name="gambarSoal" accept="image/*">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div><br />
                            <div id="tipe_soal"></div>
                            <div id="jumlah_jawaban">
                                Jumlah Pilihan:<br />
                                <input type="number" name="jumlah_jawaban" class="form-control col-lg-6 col-md-12" /><br />
                            </div>
                            Jumlah Jawaban Benar:<br />
                            <input type="number" name="jumlah_benar" id="jmlh_benar" class="form-control col-lg-6 col-md-12" oninput="tambahField()" /><br />
                            <div id="more_fields"></div>
                            <div id="intruksiContoh">
                                Penjelasan jika jawaban salah:<br />
                                <textarea id="summernote2" name="penjelasan"></textarea><br />
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" />
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            $sqlQuery = "";
                            if (is_uploaded_file($_FILES['gambarSoal']['tmp_name'])) {
                                if ($_POST['definisi'] == "Contoh") {
                                    $cekUrutan = mysqli_query($db, "SELECT (MAX(id_soal)+1) AS 'terakhir' FROM `tbl_contohsoal`");
                                    $urutan = mysqli_fetch_array($cekUrutan);
                                    if ($urutan['terakhir'] != null) {
                                        $dirGambar = "../image/";
                                        $temp = explode(".", $_FILES['gambarSoal']['name']);
                                        $newfilename = "Contoh-CFIT-" . $_POST['subtes'] . "-" . $urutan['terakhir'] . '.' . end($temp);
                                        $moveGambar = move_uploaded_file($_FILES['gambarSoal']['tmp_name'], $dirGambar . $newfilename);
                                        if ($moveGambar) {
                                            $jawabanBenar = implode("|", $_POST['pgBenar']);
                                            $sqlQuery = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, gambar, jenis_jawaban, jumlah_jawaban, jumlah_benar, jawaban_benar, penjelasan) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$newfilename', '$_POST[tipe_soal]', '$_POST[jumlah_jawaban]', '$_POST[jumlah_benar]', '$jawabanBenar', '$_POST[penjelasan]')";
                                        }
                                    } else if ($urutan['terakhir'] == null) {
                                        $urutan = mysqli_fetch_array($cekUrutan);
                                        $dirGambar = "../image/";
                                        $temp = explode(".", $_FILES['gambarSoal']['name']);
                                        $newfilename = "Contoh-CFIT-" . $_POST['subtes'] . "-1." . end($temp);
                                        $moveGambar = move_uploaded_file($_FILES['gambarSoal']['tmp_name'], $dirGambar . $newfilename);
                                        if ($moveGambar) {
                                            $jawabanBenar = implode("|", $_POST['pgBenar']);
                                            $sqlQuery = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, gambar, jenis_jawaban, jumlah_jawaban, jumlah_benar, jawaban_benar, penjelasan) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$newfilename', '$_POST[tipe_soal]', '$_POST[jumlah_jawaban]', '$_POST[jumlah_benar]', '$jawabanBenar', '$_POST[penjelasan]')";
                                        }
                                    }
                                } else if ($_POST['definisi'] == "Soal") {
                                    $cekUrutan = mysqli_query($db, "SELECT (MAX(id_soal)+1) AS 'terakhir' FROM `tbl_soal`");
                                    $urutan = mysqli_fetch_array($cekUrutan);
                                    if ($urutan['terakhir'] != null) {
                                        $dirGambar = "../image/";
                                        $temp = explode(".", $_FILES['gambarSoal']['name']);
                                        $newfilename = "CFIT-" . $_POST['subtes'] . "-" . $urutan['terakhir'] . '.' . end($temp);
                                        $moveGambar = move_uploaded_file($_FILES['gambarSoal']['tmp_name'], $dirGambar . $newfilename);
                                        if ($moveGambar) {
                                            $jawabanBenar = implode("|", $_POST['pgBenar']);
                                            $sqlQuery = "INSERT INTO `tbl_soal` (jenis_tes, subtes, gambar, jenis_jawaban, jumlah_jawaban, jumlah_benar, jawaban_benar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$newfilename', '$_POST[tipe_soal]', '$_POST[jumlah_jawaban]', '$_POST[jumlah_benar]', '$jawabanBenar')";
                                        }
                                    } else if ($urutan['terakhir'] == null) {
                                        $urutan = mysqli_fetch_array($cekUrutan);
                                        $dirGambar = "../image/";
                                        $temp = explode(".", $_FILES['gambarSoal']['name']);
                                        $newfilename = "CFIT-" . $_POST['subtes'] . "-1." . end($temp);
                                        $moveGambar = move_uploaded_file($_FILES['gambarSoal']['tmp_name'], $dirGambar . $newfilename);
                                        if ($moveGambar) {
                                            $jawabanBenar = implode("|", $_POST['pgBenar']);
                                            $sqlQuery = "INSERT INTO `tbl_soal` (jenis_tes, subtes, gambar, jenis_jawaban, jumlah_jawaban, jumlah_benar, jawaban_benar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$newfilename', '$_POST[tipe_soal]', '$_POST[jumlah_jawaban]', '$_POST[jumlah_benar]', '$jawabanBenar')";
                                        }
                                    }
                                }
                            }
                            $inputSql = mysqli_query($db, $sqlQuery);
                            if ($inputSql) echo "<meta http-equiv='refresh' content='0; url=kelola-soal.php'>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Psikotes Online 2021</div>
                </div>
            </div>
        </footer>
    </div>

    <?php
    include("script.php");
    ?>
    <script>
        function tambahField() {
            var val = document.getElementById('jmlh_benar').value;
            var str = "";
            for (i = 0; i < val; i++) {
                str += "Jawaban Benar [" + (i + 1) + "]:<br/><input type='text' name='pgBenar[]' class='form-control col-lg-6 col-md-12' style='text-transform:uppercase'/><br/>";
            }
            document.getElementById('more_fields').innerHTML = str;
        }
        $(document).ready(function() {
            $("#intruksiContoh").hide();
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
            $("#subtes").on('change', function() {
                $.ajax({
                    type: "GET",
                    url: "tampilkan-subtes.php",
                    data: {
                        subtes: this.value
                    },
                    dataType: "html", //expect html to be returned                
                    success: function(response) {
                        $("#tipe_soal").html(response);
                        //alert(response);
                    }
                });
            });
            $("#definisi").on('change', function() {
                if (this.value == "Contoh") {
                    $("#intruksiContoh").show();
                    $("#summernote2").prop('required', true);
                } else {
                    $("#intruksiContoh").hide();
                    $("#summernote2").prop('required', false);
                }
            });
        });
    </script>
    <script>
        $('#summernote2').summernote({
            placeholder: 'Ketik Intruksi...',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['view', ['fullscreen', 'help']]
            ],
            tabDisable: true
        });
    </script>
</body>

</html>