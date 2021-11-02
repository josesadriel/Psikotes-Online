<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Edit Soal CFIT</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <?php
                if (isset($_GET['id']) && isset($_GET['tipe'])) {
                    if ($_GET['tipe'] == "soal") {
                        $getDataSoal = mysqli_query($db, "SELECT * FROM `tbl_soal` WHERE id_soal = '$_GET[id]'");
                    } else if ($_GET['tipe'] == "contoh") {
                        $getDataSoal = mysqli_query($db, "SELECT * FROM `tbl_contohsoal` WHERE id_soal = '$_GET[id]'");
                    }
                    if (mysqli_num_rows($getDataSoal) > 0) {
                        $dataSoal = mysqli_fetch_array($getDataSoal);
                ?>
                        <h1 class="mt-4">Edit Soal CFIT</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="kelola-soal.php">Kelola Soal</a></li>
                            <li class="breadcrumb-item active">Edit Soal CFIT</li>
                        </ol>
                        <div class="card mb-4 mt-2">
                            <div class="card-header">
                                Edit Soal CFIT
                            </div>
                            <div class="card-body">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    Jenis Tes:<br />
                                    <input type="text" name="jenis_tes" value="CFIT" class="form-control col-lg-6 col-md-12" readonly /><br />
                                    Subtes:<br />
                                    <input type="text" name="subtes" id="subtes" value="<?= $dataSoal['subtes'] ?>" class="form-control col-lg-6 col-md-6" readonly /><br />
                                    <div id="gambar">
                                        Gambar:<br />
                                        <img src="../image/<?= $dataSoal['gambar'] ?>" class="img-fluid" /><br />
                                        <div class="custom-file col-lg-6 col-md-12">
                                            <input type="file" class="custom-file-input" id="customFile" name="gambarSoal" accept="image/*">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div><br />
                                    <div id="tipe_soal"></div>
                                    <div id="jumlah_jawaban">
                                        Jumlah Pilihan:<br />
                                        <input type="number" name="jumlah_jawaban" value="<?= $dataSoal['jumlah_jawaban'] ?>" class="form-control col-lg-6 col-md-12" /><br />
                                    </div>
                                    Jumlah Jawaban Benar:<br />
                                    <input type="number" name="jumlah_benar" id="jmlh_benar" class="form-control col-lg-6 col-md-12" oninput="tambahField()" value="<?= $dataSoal['jumlah_benar'] ?>" /><br />
                                    <div id="more_fields"></div>
                                    <input type="submit" name="submit" class="btn btn-primary" />
                                </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            $sqlQuery = "";
                            if (is_uploaded_file($_FILES['gambarSoal']['tmp_name'])) {
                                $dirGambar = "../image/";
                                $temp = explode(".", $_FILES['gambarSoal']['name']);
                                $oldTemp = explode(".", $dataSoal['gambar']);
                                $newfilename = $oldTemp[0] . '.' . end($temp);
                                $moveGambar = move_uploaded_file($_FILES['gambarSoal']['tmp_name'], $dirGambar . $newfilename);
                                if ($moveGambar) {
                                    $jawabanBenar = implode("|", $_POST['pgBenar']);
                                    if ($_GET['tipe'] == "soal") {
                                        $sqlQuery = "UPDATE `tbl_soal` SET `subtes`='$_POST[subtes]',`gambar`='$newfilename',`jumlah_jawaban`='$_POST[jumlah_jawaban]',`jumlah_benar`='$_POST[jumlah_benar]', `jawaban_benar`='$jawabanBenar' WHERE id_soal = '$_GET[id]'";
                                    } else if ($_GET['tipe'] == "contoh") {
                                        $sqlQuery = "UPDATE `tbl_contohsoal` SET `subtes`='$_POST[subtes]',`gambar`='$newfilename',`jumlah_jawaban`='$_POST[jumlah_jawaban]',`jumlah_benar`='$_POST[jumlah_benar]', `jawaban_benar`='$jawabanBenar' WHERE id_soal = '$_GET[id]'";
                                    }
                                }
                            } else {
                                $jawabanBenar = implode("|", $_POST['pgBenar']);
                                if ($_GET['tipe'] == "soal") {
                                    $sqlQuery = "UPDATE `tbl_soal` SET `subtes`='$_POST[subtes]',`jumlah_jawaban`='$_POST[jumlah_jawaban]',`jumlah_benar`='$_POST[jumlah_benar]', `jawaban_benar`='$jawabanBenar' WHERE id_soal = '$_GET[id]'";
                                } else if ($_GET['tipe'] == "contoh") {
                                    $sqlQuery = "UPDATE `tbl_contohsoal` SET `subtes`='$_POST[subtes]',`jumlah_jawaban`='$_POST[jumlah_jawaban]',`jumlah_benar`='$_POST[jumlah_benar]', `jawaban_benar`='$jawabanBenar' WHERE id_soal = '$_GET[id]'";
                                }
                            }
                            echo $sqlQuery;
                            $inputSql = mysqli_query($db, $sqlQuery);
                            if ($inputSql) echo "<meta http-equiv='refresh' content='0; url=kelola-soal.php'>";
                        }
                    }
                }
                        ?>
                            </div>
                        </div>
            </div>
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Matahati Psikotes Online 2021</div>
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
            var jawaban = "<?= $dataSoal['jawaban_benar'] ?>";
            var dataJawaban = jawaban.split("|");
            for (i = 0; i < val; i++) {
                if (dataJawaban[i] != null) {
                    str += "Jawaban Benar [" + (i + 1) + "]:<br/><input type='text' name='pgBenar[]' value='" + dataJawaban[i] + "' class='form-control col-lg-6 col-md-12' style='text-transform:uppercase'/><br/>";
                } else {
                    str += "Jawaban Benar [" + (i + 1) + "]:<br/><input type='text' name='pgBenar[]' class='form-control col-lg-6 col-md-12' style='text-transform:uppercase'/><br/>";
                }
            }
            document.getElementById('more_fields').innerHTML = str;
        }
        $(document).ready(function() {
            tambahField();
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
        });
    </script>
</body>

</html>