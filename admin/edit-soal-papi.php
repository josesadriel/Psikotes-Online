<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Edit Soal</title>

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
                <h1 class="mt-4">Edit Soal</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="kelola-soal.php">Kelola Soal</a></li>
                    <li class="breadcrumb-item active">Edit Soal</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="#" method="post">
                            <?php
                            if (isset($_GET['id']) && isset($_GET['t'])) {
                                $sql = "";
                                if ($_GET['t'] == 's') {
                                    $sql = "SELECT * FROM `soal_papi` WHERE id_papi = '$_GET[id]'";
                                } else if ($_GET['t'] == 'c') {
                                    $sql = "SELECT * FROM `tbl_contohsoal` WHERE id_soal = '$_GET[id]'";
                                }
                                $dataSoal = mysqli_query($db, $sql);
                                if (mysqli_num_rows($dataSoal) > 0) {
                                    $data = mysqli_fetch_array($dataSoal);
                                    if ($_GET['t'] == 'c') {
                                        $ekstrak = explode('#', $data['pilihan']);
                                    }
                            ?>
                                    Pernyataan 1:<br />
                                    <textarea id="summernote1" name="pernyataan[]">
                                        <?php
                                        if ($_GET['t'] == 's') echo $data['pernyataan1'];
                                        else if ($_GET['t'] == 'c') echo $ekstrak[0];
                                        ?>
                                    </textarea><br />
                                    Pernyataan 2:<br />
                                    <textarea id="summernote2" name="pernyataan[]">
                                        <?php
                                        if ($_GET['t'] == 's') echo $data['pernyataan2'];
                                        else if ($_GET['t'] == 'c') echo $ekstrak[1];
                                        ?>
                                    </textarea><br />
                                    <div id="penjelasan">
                                        Penjelasan:<br />
                                        <textarea id="summernote3" name="penjelasan">
                                        <?php
                                        if (isset($data['penjelasan'])) {
                                            echo $data['penjelasan'];
                                        }
                                        ?>
                                        </textarea><br />
                                    </div>
                                    <input type="submit" name="edit" class="btn bg-primary" value="Edit Soal" />
                            <?php
                                }
                            }
                            ?>
                        </form>
                        <?php
                        if (isset($_POST['edit'])) {
                            $sql = "";
                            $pernyataan1 = $_POST['pernyataan'][0];
                            $pernyataan2 = $_POST['pernyataan'][1];
                            if ($_GET['t'] == 's') $sql = "UPDATE `soal_papi` SET `pernyataan1`='$pernyataan1',`pernyataan2`='$pernyataan2' WHERE id_papi = '$_GET[id]';";
                            else if ($_GET['t'] == 'c') {
                                $pilihan = implode("#", $_POST['pernyataan']);
                                $sql = "UPDATE `tbl_contohsoal` SET `penjelasan` = '$_POST[penjelasan]', `pilihan` = '$pilihan' WHERE id_soal = '$_GET[id]';";
                            }
                            echo $sql;
                            if (isset($sql)) {
                                $updateSql = mysqli_query($db, $sql);
                                if ($updateSql) echo "<meta http-equiv='refresh' content='0; url=kelola-soal.php'>";
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
</body>
<script>
    $(document).ready(function() {
        var t = <?= "'" . $_GET['t'] . "'"; ?>;
        if (t == 's') {
            $("#penjelasan").hide();
        } else $("#penjelasan").show();
    });
    $('#summernote1').summernote({
        placeholder: 'Ketik Pernyataan 1',
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
        placeholder: 'Ketik Pernyataan 2',
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
    $('#summernote3').summernote({
        placeholder: 'Ketik Penjelasan',
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

</html>