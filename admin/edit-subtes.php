<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Edit Subtes</title>
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
            <?php
            if (isset($_GET['id'])) {
                $getDataSubtes = mysqli_query($db, "SELECT * FROM `tbl_subtes` WHERE id_subtes = '$_GET[id]'");
                if (mysqli_num_rows($getDataSubtes) > 0) {
                    $dataSubtes = mysqli_fetch_array($getDataSubtes);
            ?>
                    <div class="container-fluid">
                        <h1 class="mt-4">Edit Subtes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="kelola-subtes.php">Kelola Subtes</a></li>
                            <li class="breadcrumb-item active">Edit Subtes</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    Nama Subtes:<br />
                                    <input type="text" class="form-control col-lg-6 col-md-12" value="<?= $dataSubtes['nama_subtes'] ?>" name="nama_subtes" /><br />
                                    Intruksi:<br />
                                    <textarea name="intruksi" class="form-control" id="summernote"><?= $dataSubtes['intruksi'] ?></textarea><br />
                                    Jenis Tes:<br />
                                    <select name="jenis_tes" class="form-control col-lg-6 col-md-12">
                                        <?php
                                        $getJenisTes = mysqli_query($db, "SELECT * FROM `tbl_jenistes`");
                                        if (mysqli_num_rows($getJenisTes) > 0) {
                                            while ($list = mysqli_fetch_array($getJenisTes)) {
                                        ?>
                                                <option value="<?= $list['id_jenistes'] ?>" <?= ($dataSubtes['id_jenistes'] == $list['id_jenistes']) ? "selected" : "" ?>><?= $list['nama_tes'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select><br />
                                    Tipe Soal:<br />
                                    <input type="text" name="tipe_soal" value="<?= $dataSubtes['tipe_soal'] ?>" class="form-control col-lg-6 col-md-12" id="tipe_soal" readonly /><br />
                                    Timer:<br />
                                    <input type="number" class="form-control col-lg-6 col-md-12" value="<?= $dataSubtes['timer'] ?>" name="timer" step=".01" /><br />

                                    <div id="soalHafalan">
                                        Soal Hafalan:<br />
                                        <textarea name="hafalan" class="form-control" id="summernote2"><?= (isset($dataSubtes['soal_hafalan'])) ? $dataSubtes['soal_hafalan'] : "" ?></textarea><br />
                                        Timer Untuk soal Hafalan:<br />
                                        <input type="number" name="timer_hafalan" class="form-control col-6" value="<?= (isset($dataSubtes['soal_hafalan'])) ? $dataSubtes['timer_hafalan'] : "" ?>" /><br />
                                    </div>
                                    <input type="submit" class="btn btn-primary" name="submit" />
                                </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            $sql = "";
                            if ($_POST['tipe_soal'] == "Hafalan") {
                                $sql = "UPDATE `tbl_subtes` SET 
                                    `nama_subtes` = '$_POST[nama_subtes]', 
                                    `intruksi` = '$_POST[intruksi]',  
                                    `timer` = '$_POST[timer]', 
                                    `soal_hafalan` = '$_POST[hafalan]', 
                                    `timer_hafalan` = '$_POST[timer_hafalan]'
                                    WHERE id_subtes = '$_GET[id]';";
                            } else {
                                $sql = "UPDATE `tbl_subtes` SET `nama_subtes` = '$_POST[nama_subtes]', `intruksi` = '$_POST[intruksi]', `timer` = '$_POST[timer]' WHERE id_subtes = '$_GET[id]'";
                            }
                            $updateData = mysqli_query($db, $sql);
                            if ($updateData) {
                                echo "Berhasil";
                            }
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
        <script>
            $(document).ready(function() {
                $('#soalHafalan').hide();
                var tipe_soal = document.getElementById('tipe_soal').value;
                if (tipe_soal == "Hafalan") $('#soalHafalan').show();
            });
            $('#summernote').summernote({
                placeholder: 'Ketik...',
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
            $('#summernote2').summernote({
                placeholder: 'Ketik...',
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
    </div>
    </div>
    <?php
    include("script.php");
    ?>
</body>

</html>