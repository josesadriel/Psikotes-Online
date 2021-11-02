<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include("header.php");
        ?>
        <title>Tambah Soal</title>
        
        <!-- Summernote JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
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
                        <h1 class="mt-4">Tambah Soal</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="kelola-soal.php">Kelola Soal</a></li>
                            <li class="breadcrumb-item active">Tambah Soal</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <textarea id="summernote" name="soal"></textarea><br/>
                                    Gambar (optional):<br/>
                                    <input type="file" name="gambarSoal" accept="image/*"/><br/>
                                    <script>
                                    $('#summernote').summernote({
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
                                        ]
                                    });
                                    </script>
                                    <br/>
                                    Pilihan Ganda:<br/>
                                    <div class="d-flex justify-between-content mb-1">
                                        <div class="mt-1 mr-4">A</div>
                                        <input type="text" name="pilihan[]" class="form-control col-5"/>
                                        <input type="radio" name="pilihanBenar" value="A" class="mt-2 ml-2"/>
                                    </div>
                                    <div class="d-flex justify-between-content mb-1">
                                        <div class="mt-1 mr-4">B</div>
                                        <input type="text" name="pilihan[]" class="form-control col-5"/>
                                        <input type="radio" name="pilihanBenar" value="B" class="mt-2 ml-2"/>
                                    </div>
                                    <div class="d-flex justify-between-content mb-1">
                                        <div class="mt-1 mr-4">C</div>
                                        <input type="text" name="pilihan[]" class="form-control col-5"/>
                                        <input type="radio" name="pilihanBenar" value="C" class="mt-2 ml-2"/>
                                    </div>
                                    <div class="d-flex justify-between-content mb-1">
                                        <div class="mt-1 mr-4">D</div>
                                        <input type="text" name="pilihan[]" class="form-control col-5"/>
                                        <input type="radio" name="pilihanBenar" value="D" class="mt-2 ml-2"/>
                                    </div>
                                    <br/>
                                    Jenis Tes:<br/>
                                    <select name="jenis_tes" class="form-control col-5">
                                        <?php
                                        $dataJenisTes = mysqli_query($db, "SELECT * FROM `tbl_jenistes`");
                                        if (mysqli_num_rows($dataJenisTes) > 0) {
                                            while ($jenisTes = mysqli_fetch_array($dataJenisTes)) {
                                        ?>
                                        <option value="<?php echo $jenisTes['nama_tes'];?>"><?php echo $jenisTes['nama_tes'];?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select><br/>
                                    <input type="submit" name="tambah" value="Tambah Soal"/>
                                </form>
                                <?php
                                if (isset($_POST['tambah']) && isset($_POST['soal'])) {
                                    $pilihan = implode("#", $_POST['pilihan']);                             
                                    if (is_uploaded_file($_FILES['gambarSoal']['tmp_name'])) {
                                        $dirGambar = "image/";
                                        $namaFile = $_FILES['gambarSoal']['name'];
                                        $moveGambar = move_uploaded_file($_FILES['gambarSoal']['tmp_name'], $dirGambar . $_FILES['gambarSoal']['name']);
                                        if ($moveGambar) {
                                            $inputSql = mysqli_query($db, "INSERT INTO `tbl_soal` (soal, jenis_tes, gambar, pilihan, pilihan_benar) VALUES ('$_POST[soal]', '$_POST[jenis_tes]', '$namaFile', '$pilihan', '$_POST[pilihanBenar]')");
                                            if ($inputSql) {
                                                echo "Berhasil";
                                            }
                                        }
                                    }
                                    else {
                                        $inputSql = mysqli_query($db, "INSERT INTO `tbl_soal` (soal, jenis_tes, pilihan, pilihan_benar) VALUES ('$_POST[soal]', '$_POST[jenis_tes]', '$pilihan', '$_POST[pilihanBenar]')");
                                        if ($inputSql) {
                                            echo "Berhasil";
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
                            <div class="text-muted">Copyright &copy; Psikotes Online 2021</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <?php
        include("script.php");
        ?>
    </body>
</html>
