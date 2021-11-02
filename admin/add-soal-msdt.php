<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Tambah Soal MSDT</title>
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
                <h1 class="mt-4">Tambah Soal MSDT</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="kelola-soal.php">Kelola Soal</a></li>
                    <li class="breadcrumb-item active">Tambah Soal MSDT</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">
                            Jenis Tes:<br />
                            <input type="text" name="jenis_tes" class="form-control col-lg-6 col-md-12" value="MSDT" readonly /><br />
                            Subtes:<br />
                            <select name="subtes" id="subtes" class="form-control col-lg-6 col-md-12" required>
                                <option value="" disabled selected>-</option>
                                <?php
                                $getSubtes = mysqli_query($db, "SELECT tbl_subtes.id_subtes, tbl_jenistes.nama_tes, tbl_subtes.nama_subtes FROM `tbl_subtes` INNER JOIN `tbl_jenistes` ON tbl_subtes.id_jenistes = tbl_jenistes.id_jenistes WHERE tbl_jenistes.nama_tes = 'MSDT'");
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
                            <div id="tipe_soal"></div>
                            <div id="pilihan_ganda">
                                Pilihan Ganda:<br />
                                <div class="d-flex justify-between-content mb-1">
                                    <div class="mt-1 mr-4">A</div>
                                    <textarea name="pilihan[]" class="form-control col-lg-6 col-md-12"></textarea>
                                </div>
                                <div class="d-flex justify-between-content mb-1">
                                    <div class="mt-1 mr-4">B</div>
                                    <textarea name="pilihan[]" class="form-control col-lg-6 col-md-12"></textarea>
                                </div><br />
                            </div>
                            <div id="intruksiContoh">
                                Penjelasan jika jawaban benar:<br />
                                <textarea id="summernote2" name="penjelasan"></textarea><br />
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" />
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            $tipeSoal = $_POST['tipe_soal'];
                            $sql = "";
                            if ($tipeSoal == "Pilihan Ganda" || $tipeSoal == "Hafalan") {
                                $pilihan = implode("#", $_POST['pilihan']);
                                if ($_POST['definisi'] == "Soal") {
                                    $sql = "INSERT INTO `tbl_soal` (jenis_tes, subtes, jenis_jawaban, pilihan) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[tipe_soal]', '$pilihan')";
                                } else $sql = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, jenis_jawaban, pilihan, penjelasan) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[tipe_soal]', '$pilihan', '$_POST[penjelasan]')";
                            }
                            $inputSoal = mysqli_query($db, $sql);
                            if ($inputSoal) echo "Berhasil";
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
        $(document).ready(function() {
            $("#pilihan_ganda").hide();
            $("#intruksiContoh").hide();
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
                        var ts = document.getElementById('ts').value;
                        if (ts == "Pilihan Ganda" || ts == "Hafalan") {
                            $("#pilihan_ganda").show();
                            $('#benar1').attr('required', true);
                        }
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