<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Tambah Soal IST</title>
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
                <h1 class="mt-4">Tambah Soal IST</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="kelola-soal.php">Kelola Soal</a></li>
                    <li class="breadcrumb-item active">Tambah Soal IST</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">
                            Jenis Tes:<br />
                            <input type="text" name="jenis_tes" class="form-control col-lg-6 col-md-12" value="IST" readonly /><br />
                            Subtes:<br />
                            <select name="subtes" id="subtes" class="form-control col-lg-6 col-md-12" required>
                                <option value="" disabled selected>-</option>
                                <?php
                                $getSubtes = mysqli_query($db, "SELECT tbl_subtes.id_subtes, tbl_jenistes.nama_tes, tbl_subtes.nama_subtes FROM `tbl_subtes` INNER JOIN `tbl_jenistes` ON tbl_subtes.id_jenistes = tbl_jenistes.id_jenistes WHERE tbl_jenistes.nama_tes = 'IST'");
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
                            <div id="soal">
                                Soal:<br />
                                <textarea id="summernote1" name="soal"></textarea><br />
                            </div>
                            <div id="gambar">
                                Gambar:<br />
                                <div class="custom-file col-lg-6 col-md-12">
                                    <input type="file" class="custom-file-input" id="customFile" name="gambarSoal" accept="image/*">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div><br />
                            <div id="pilihan_ganda">
                                Pilihan Ganda:<br />
                                <div class="d-flex justify-between-content mb-1">
                                    <div class="mt-1 mr-4">A</div>
                                    <input type="text" name="pilihan[]" class="form-control col-lg-5 col-md-10" tabindex="1" />
                                    <input type="radio" id="benar1" name="pilihanBenar" value="A" class="mt-2 ml-2" title='Pilih jika "A" adalah jawaban yang benar' />
                                </div>
                                <div class="d-flex justify-between-content mb-1">
                                    <div class="mt-1 mr-4">B</div>
                                    <input type="text" name="pilihan[]" class="form-control col-lg-5 col-md-10" tabindex="2" />
                                    <input type="radio" name="pilihanBenar" value="B" class="mt-2 ml-2" title='Pilih jika "B" adalah jawaban yang benar' />
                                </div>
                                <div class="d-flex justify-between-content mb-1">
                                    <div class="mt-1 mr-4">C</div>
                                    <input type="text" name="pilihan[]" class="form-control col-lg-5 col-md-10" tabindex="3" />
                                    <input type="radio" name="pilihanBenar" value="C" class="mt-2 ml-2" title='Pilih jika "C" adalah jawaban yang benar' />
                                </div>
                                <div class="d-flex justify-between-content mb-1">
                                    <div class="mt-1 mr-4">D</div>
                                    <input type="text" name="pilihan[]" class="form-control col-lg-5 col-md-10" tabindex="4" />
                                    <input type="radio" name="pilihanBenar" value="D" class="mt-2 ml-2" title='Pilih jika "D" adalah jawaban yang benar' />
                                </div>
                                <div class="d-flex justify-between-content mb-1">
                                    <div class="mt-1 mr-4">E</div>
                                    <input type="text" name="pilihan[]" class="form-control col-lg-5 col-md-10" tabindex="5" />
                                    <input type="radio" name="pilihanBenar" value="E" class="mt-2 ml-2" title='Pilih jika "E" adalah jawaban yang benar' />
                                </div><br />
                            </div>
                            <div id="paketGambar">
                                Paket Gambar:<br />
                                <select name="paket_gambar" class="form-control col-lg-6 col-md-12">
                                    <option value="" disabled selected>-</option>
                                    <?php
                                    $getListPaketGambar = mysqli_query($db, "SELECT * FROM `tbl_paketgambar`");
                                    if (mysqli_num_rows($getListPaketGambar) > 0) {
                                        while ($paketGambar = mysqli_fetch_array($getListPaketGambar)) {
                                    ?>
                                            <option value="<?= $paketGambar['nama_paket'] ?>"><?= $paketGambar['nama_paket'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select><br />
                            </div>
                            <div id="isianBenar">
                                Jawaban Benar:<br />
                                <input type="text" id="jawaban_benar" name="jawaban_benar" class="form-control col-lg-6 col-md-12" /><br />
                            </div>
                            <div id="poinBenar">
                                Jumlah jawaban yang bernilai <b>2 poin</b>:<br />
                                <input type="number" name="2poin" id="2poin" oninput="tambahField('2poin')" class="form-control col-lg-6 col-md-12"><br />
                                <div id="field_2poin"></div><br />
                                Jumlah jawaban yang bernilai <b>1 poin</b>:<br />
                                <input type="number" name="1poin" id="1poin" oninput="tambahField('1poin')" class="form-control col-lg-6 col-md-12"><br />
                                <div id="field_1poin"></div><br />
                                Jumlah jawaban yang bernilai <b>0 poin</b>:<br />
                                <input type="number" name="0poin" id="0poin" oninput="tambahField('0poin')" class="form-control col-lg-6 col-md-12"><br />
                                <div id="field_0poin"></div><br />
                            </div>
                            <div id="intruksiContoh">
                                Penjelasan jika jawaban salah:<br />
                                <textarea id="summernote2" name="penjelasan"></textarea><br />
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" />
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            $tipeSoal = $_POST['tipe_soal'];
                            $sql = "";
                            if ($_POST['subtes'] == "GE") {
                                $point2 = implode("#", $_POST['pgBenar2poin']);
                                $point1 = implode("#", $_POST['pgBenar1poin']);
                                $point0 = implode("#", $_POST['pgBenar0poin']);
                                $penilaian = $point2 . "|" . $point1 . "|" . $point0;
                            }
                            if (is_uploaded_file($_FILES['gambarSoal']['tmp_name'])) {
                                if ($_POST['definisi'] == "Soal") {
                                    $cekUrutan = mysqli_query($db, "SELECT COUNT(*) AS 'terakhir' FROM `tbl_soal` WHERE jenis_tes = 'IST' AND subtes = '$_POST[subtes]'");
                                } else if ($_POST['definisi'] == "Contoh") {
                                    $cekUrutan = mysqli_query($db, "SELECT COUNT(*) AS 'terakhir' FROM `tbl_contohsoal` WHERE jenis_tes = 'IST' AND subtes = '$_POST[subtes]'");
                                }
                                $urutan = mysqli_fetch_array($cekUrutan);
                                $dirGambar = "../image/";
                                $temp = explode(".", $_FILES['gambarSoal']['name']);
                                if ($_POST['definisi'] == "Soal") {
                                    $newfilename = "IST-" . $_POST['subtes'] . "-" . ($urutan['terakhir'] + 1) . '.' . end($temp);
                                } else if ($_POST['definisi'] == "Contoh") {
                                    $newfilename = "Contoh-IST-" . $_POST['subtes'] . "-" . ($urutan['terakhir'] + 1) . '.' . end($temp);
                                }
                                $moveGambar = move_uploaded_file($_FILES['gambarSoal']['tmp_name'], $dirGambar . $newfilename);
                                if ($moveGambar) {
                                    if ($tipeSoal == "Pilihan Ganda" || $tipeSoal == "Hafalan") {
                                        $pilihan = implode("#", $_POST['pilihan']);
                                        if (isset($_POST['soal']) && $_POST['soal'] != "") {
                                            if ($_POST['definisi'] == "Soal") {
                                                $sql = "INSERT INTO `tbl_soal` (jenis_tes, subtes, soal, gambar, jenis_jawaban, pilihan, jawaban_benar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$newfilename', '$_POST[tipe_soal]', '$pilihan', '$_POST[pilihanBenar]')";
                                            } else $sql = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, soal, gambar, jenis_jawaban, pilihan, jawaban_benar, penjelasan) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$newfilename', '$_POST[tipe_soal]', '$pilihan', '$_POST[pilihanBenar]', '$_POST[penjelasan]')";
                                        } else {
                                            if ($_POST['definisi'] == "Soal") {
                                                $sql = "INSERT INTO `tbl_soal` (jenis_tes, subtes, gambar, jenis_jawaban, pilihan, jawaban_benar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$newfilename', '$_POST[tipe_soal]', '$pilihan', '$_POST[pilihanBenar]')";
                                            } else $sql = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, gambar, jenis_jawaban, pilihan, jawaban_benar, penjelasan) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$newfilename', '$_POST[tipe_soal]', '$pilihan', '$_POST[pilihanBenar]', '$_POST[penjelasan]')";
                                        }
                                    } else if ($tipeSoal == "Isian" || $tipeSoal == "Aritmatika") {
                                        if (isset($_POST['soal']) && $_POST['soal'] != "") {
                                            if ($_POST['definisi'] == "Soal") {
                                                if ($_POST['subtes'] == "GE") {
                                                    $sql = "INSERT INTO `tbl_soal` (jenis_tes, subtes, gambar, jenis_jawaban, jawaban_benar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$newfilename', '$_POST[tipe_soal]', '$penilaian')";
                                                } else {
                                                    $sql = "INSERT INTO `tbl_soal` (jenis_tes, subtes, gambar, jenis_jawaban, jawaban_benar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$newfilename', '$_POST[tipe_soal]', '$_POST[jawaban_benar]')";
                                                }
                                            } else {
                                                if ($_POST['subtes'] == "GE") {
                                                    $sql = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, gambar, jenis_jawaban, jawaban_benar, penjelasan) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$newfilename', '$_POST[tipe_soal]', '$penilaian', '$_POST[penjelasan]')";
                                                } else {
                                                    $sql = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, gambar, jenis_jawaban, jawaban_benar, penjelasan) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$newfilename', '$_POST[tipe_soal]', '$_POST[jawaban_benar]', '$_POST[penjelasan]')";
                                                }
                                            }
                                        } else {
                                            if ($_POST['definisi'] == "Soal") {
                                                $sql = "INSERT INTO `tbl_soal` (jenis_tes, subtes, gambar, jenis_jawaban, jawaban_benar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$newfilename', '$_POST[tipe_soal]', '$_POST[jawaban_benar]')";
                                            } else $sql = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, gambar, jenis_jawaban, jawaban_benar, penjelasan) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$newfilename', '$_POST[tipe_soal]', '$_POST[jawaban_benar]', '$_POST[penjelasan]')";
                                        }
                                    } else if ($tipeSoal == "Gambar") {
                                        if (isset($_POST['soal']) && $_POST['soal'] != "") {
                                            if ($_POST['definisi'] == "Soal") {
                                                $sql = "INSERT INTO `tbl_soal` (jenis_tes, subtes, soal, gambar, jenis_jawaban, jawaban_benar, paket_gambar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$newfilename', '$_POST[tipe_soal]', '$_POST[jawaban_benar]', '$_POST[paket_gambar]')";
                                            } else $sql = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, soal, gambar, jenis_jawaban, jawaban_benar, penjelasan, paket_gambar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$newfilename', '$_POST[tipe_soal]', '$_POST[jawaban_benar]', '$_POST[penjelasan]', '$_POST[paket_gambar]')";
                                        } else {
                                            if ($_POST['definisi'] == "Soal") {
                                                $sql = "INSERT INTO `tbl_soal` (jenis_tes, subtes, gambar, jenis_jawaban, jawaban_benar, paket_gambar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$newfilename', '$_POST[tipe_soal]', '$_POST[jawaban_benar]', '$_POST[paket_gambar]')";
                                            } else $sql = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, gambar, jenis_jawaban, jawaban_benar, penjelasan, paket_gambar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$newfilename', '$_POST[tipe_soal]', '$_POST[jawaban_benar]', '$_POST[penjelasan]', '$_POST[paket_gambar]')";
                                        }
                                    }
                                }
                            } else {
                                if ($tipeSoal == "Pilihan Ganda" || $tipeSoal == "Hafalan") {
                                    $pilihan = implode("#", $_POST['pilihan']);
                                    if (isset($_POST['soal']) && $_POST['soal'] != "") {
                                        if ($_POST['definisi'] == "Soal") {
                                            $sql = "INSERT INTO `tbl_soal` (jenis_tes, subtes, soal, jenis_jawaban, pilihan, jawaban_benar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$_POST[tipe_soal]', '$pilihan', '$_POST[pilihanBenar]')";
                                        } else $sql = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, soal, jenis_jawaban, pilihan, jawaban_benar, penjelasan) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$_POST[tipe_soal]', '$pilihan', '$_POST[pilihanBenar]', '$_POST[penjelasan]')";
                                    } else {
                                        if ($_POST['definisi'] == "Soal") {
                                            $sql = "INSERT INTO `tbl_soal` (jenis_tes, subtes, jenis_jawaban, pilihan, jawaban_benar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[tipe_soal]', '$pilihan', '$_POST[pilihanBenar]')";
                                        } else $sql = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, jenis_jawaban, pilihan, jawaban_benar, penjelasan) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[tipe_soal]', '$pilihan', '$_POST[pilihanBenar]', '$_POST[penjelasan]')";
                                    }
                                } else if ($tipeSoal == "Isian" || $tipeSoal == "Aritmatika") {
                                    if (isset($_POST['soal']) && $_POST['soal'] != "") {
                                        if ($_POST['definisi'] == "Soal") {
                                            if ($_POST['subtes'] == "GE") {
                                                $sql = "INSERT INTO `tbl_soal` (jenis_tes, subtes, soal, jenis_jawaban, jawaban_benar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$_POST[tipe_soal]', '$penilaian')";
                                            } else {
                                                $sql = "INSERT INTO `tbl_soal` (jenis_tes, subtes, soal, jenis_jawaban, jawaban_benar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$_POST[tipe_soal]', '$_POST[jawaban_benar]')";
                                            }
                                        } else {
                                            if ($_POST['subtes'] == "GE") {
                                                $sql = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, soal, jenis_jawaban, jawaban_benar, penjelasan) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$_POST[tipe_soal]', '$penilaian', '$_POST[penjelasan]')";
                                            } else {
                                                $sql = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, soal, jenis_jawaban, jawaban_benar, penjelasan) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$_POST[tipe_soal]', '$_POST[jawaban_benar]', '$_POST[penjelasan]')";
                                            }
                                        }
                                    } else {
                                        if ($_POST['definisi'] == "Soal") {
                                            $sql = "INSERT INTO `tbl_soal` (jenis_tes, subtes, jenis_jawaban, jawaban_benar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[tipe_soal]', '$_POST[jawaban_benar]')";
                                        } else $sql = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, jenis_jawaban, jawaban_benar, penjelasan) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[tipe_soal]', '$_POST[jawaban_benar]', '$_POST[penjelasan]')";
                                    }
                                } else if ($tipeSoal == "Gambar") {
                                    if (isset($_POST['soal']) && $_POST['soal'] != "") {
                                        if ($_POST['definisi'] == "Soal") {
                                            $sql = "INSERT INTO `tbl_soal` (jenis_tes, subtes, soal, jenis_jawaban, jawaban_benar, paket_gambar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$_POST[tipe_soal]', '$_POST[jawaban_benar]', '$_POST[paket_gambar]')";
                                        } else $sql = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, soal, jenis_jawaban, jawaban_benar, penjelasan, paket_gambar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[soal]', '$_POST[tipe_soal]', '$_POST[jawaban_benar]', '$_POST[penjelasan]', '$_POST[paket_gambar]')";
                                    } else {
                                        if ($_POST['definisi'] == "Soal") {
                                            $sql = "INSERT INTO `tbl_soal` (jenis_tes, subtes, jenis_jawaban, jawaban_benar, paket_gambar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[tipe_soal]', '$_POST[jawaban_benar]', '$_POST[paket_gambar]')";
                                        } else $sql = "INSERT INTO `tbl_contohsoal` (jenis_tes, subtes, jenis_jawaban, jawaban_benar, penjelasan, paket_gambar) VALUES ('$_POST[jenis_tes]', '$_POST[subtes]', '$_POST[tipe_soal]', '$_POST[jawaban_benar]', '$_POST[penjelasan]', '$_POST[paket_gambar]')";
                                    }
                                }
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
        function tambahField(namaId) {
            var val = document.getElementById(namaId).value;
            var str = "";
            for (i = 0; i < val; i++) {
                str += "Jawaban [" + (i + 1) + "]:<br/><input type='text' name='pgBenar" + namaId + "[]' class='form-control col-lg-6 col-md-12'/><br/>";
            }
            if (namaId == "2poin") document.getElementById('field_2poin').innerHTML = str;
            else if (namaId == "1poin") document.getElementById('field_1poin').innerHTML = str;
            if (namaId == "0poin") document.getElementById('field_0poin').innerHTML = str;
        }
        $(document).ready(function() {
            $("#pilihan_ganda").hide();
            $("#isianBenar").hide();
            $("#paketGambar").hide();
            $("#intruksiContoh").hide();
            $("#poinBenar").hide();
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
                        var subTes = document.getElementById('subtes').value;
                        if (ts == "Isian" || ts == "Aritmatika" || ts == "Gambar") {
                            if (ts == "Isian" && subTes == "GE") {
                                $("#pilihan_ganda").hide();
                                $("#isianBenar").hide();
                                $('#benar1').attr('required', false);
                                $('#jawaban_benar').attr('required', false);
                                $("#poinBenar").show();
                            } else {
                                $("#poinBenar").hide();
                                $("#isianBenar").show();
                                $("#pilihan_ganda").hide();
                                $('#jawaban_benar').attr('required', true);
                                $('#benar1').attr('required', false);
                            }
                        } else if (ts == "Pilihan Ganda" || ts == "Hafalan") {
                            $("#pilihan_ganda").show();
                            $('#benar1').attr('required', true);
                            $("#isianBenar").hide();
                            $("#poinBenar").hide();
                            $('#jawaban_benar').attr('required', false);
                        }
                        if (ts == "Gambar") $("#paketGambar").show();
                        else $("#paketGambar").hide();
                        // if (subTes == "GE")
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
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        });
    </script>
    <script>
        $('#summernote1').summernote({
            placeholder: 'Ketik Soal...',
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