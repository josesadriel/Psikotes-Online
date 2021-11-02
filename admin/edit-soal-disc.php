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
                            if (isset($_GET['id'])) {
                                $dataSoal = mysqli_query($db, "SELECT * FROM `soal_disc` WHERE id_soal = '$_GET[id]'");
                                if (mysqli_num_rows($dataSoal) > 0) {
                                    $data = mysqli_fetch_array($dataSoal);
                            ?>
                                    <div class="form-group">
                                        Pernyataan 1:
                                        <textarea class="form-control" name="pernyataan1"><?= $data['pernyataan_1'] ?></textarea>
                                        Setuju:
                                        <select name="s_1" class="form-control col-3">
                                            <option value="D" <?= ($data['s_1'] == "D") ? "selected" : "" ?>>D</option>
                                            <option value="I" <?= ($data['s_1'] == "I") ? "selected" : "" ?>>I</option>
                                            <option value="S" <?= ($data['s_1'] == "S") ? "selected" : "" ?>>S</option>
                                            <option value="C" <?= ($data['s_1'] == "C") ? "selected" : "" ?>>C</option>
                                            <option value="#" <?= ($data['s_1'] == "#") ? "selected" : "" ?>>*</option>
                                        </select>
                                        Tidak Setuju:
                                        <select name="ts_1" class="form-control col-3">
                                            <option value="D" <?= ($data['ts_1'] == "D") ? "selected" : "" ?>>D</option>
                                            <option value="I" <?= ($data['ts_1'] == "I") ? "selected" : "" ?>>I</option>
                                            <option value="S" <?= ($data['ts_1'] == "S") ? "selected" : "" ?>>S</option>
                                            <option value="C" <?= ($data['ts_1'] == "C") ? "selected" : "" ?>>C</option>
                                            <option value="#" <?= ($data['ts_1'] == "#") ? "selected" : "" ?>>*</option>
                                        </select><br />
                                    </div>
                                    <div class="form-group">
                                        Pernyataan 2:
                                        <textarea class="form-control" name="pernyataan2"><?= $data['pernyataan_2'] ?></textarea>
                                        Setuju:
                                        <select name="s_2" class="form-control col-3">
                                            <option value="D" <?= ($data['s_2'] == "D") ? "selected" : "" ?>>D</option>
                                            <option value="I" <?= ($data['s_2'] == "I") ? "selected" : "" ?>>I</option>
                                            <option value="S" <?= ($data['s_2'] == "S") ? "selected" : "" ?>>S</option>
                                            <option value="C" <?= ($data['s_2'] == "C") ? "selected" : "" ?>>C</option>
                                            <option value="#" <?= ($data['s_2'] == "#") ? "selected" : "" ?>>*</option>
                                        </select>
                                        Tidak Setuju:
                                        <select name="ts_2" class="form-control col-3">
                                            <option value="D" <?= ($data['ts_2'] == "D") ? "selected" : "" ?>>D</option>
                                            <option value="I" <?= ($data['ts_2'] == "I") ? "selected" : "" ?>>I</option>
                                            <option value="S" <?= ($data['ts_2'] == "S") ? "selected" : "" ?>>S</option>
                                            <option value="C" <?= ($data['ts_2'] == "C") ? "selected" : "" ?>>C</option>
                                            <option value="#" <?= ($data['ts_2'] == "#") ? "selected" : "" ?>>*</option>
                                        </select><br />
                                    </div>
                                    <div class="form-group">
                                        Pernyataan 3:
                                        <textarea class="form-control" name="pernyataan3"><?= $data['pernyataan_3'] ?></textarea>
                                        Setuju:
                                        <select name="s_3" class="form-control col-3">
                                            <option value="D" <?= ($data['s_3'] == "D") ? "selected" : "" ?>>D</option>
                                            <option value="I" <?= ($data['s_3'] == "I") ? "selected" : "" ?>>I</option>
                                            <option value="S" <?= ($data['s_3'] == "S") ? "selected" : "" ?>>S</option>
                                            <option value="C" <?= ($data['s_3'] == "C") ? "selected" : "" ?>>C</option>
                                            <option value="#" <?= ($data['s_3'] == "#") ? "selected" : "" ?>>*</option>
                                        </select>
                                        Tidak Setuju:
                                        <select name="ts_3" class="form-control col-3">
                                            <option value="D" <?= ($data['ts_3'] == "D") ? "selected" : "" ?>>D</option>
                                            <option value="I" <?= ($data['ts_3'] == "I") ? "selected" : "" ?>>I</option>
                                            <option value="S" <?= ($data['ts_3'] == "S") ? "selected" : "" ?>>S</option>
                                            <option value="C" <?= ($data['ts_3'] == "C") ? "selected" : "" ?>>C</option>
                                            <option value="#" <?= ($data['ts_3'] == "#") ? "selected" : "" ?>>*</option>
                                        </select><br />
                                    </div>
                                    <div class="form-group">
                                        Pernyataan 4:
                                        <textarea class="form-control" name="pernyataan4"><?= $data['pernyataan_4'] ?></textarea>
                                        Setuju:
                                        <select name="s_4" class="form-control col-4">
                                            <option value="D" <?= ($data['s_4'] == "D") ? "selected" : "" ?>>D</option>
                                            <option value="I" <?= ($data['s_4'] == "I") ? "selected" : "" ?>>I</option>
                                            <option value="S" <?= ($data['s_4'] == "S") ? "selected" : "" ?>>S</option>
                                            <option value="C" <?= ($data['s_4'] == "C") ? "selected" : "" ?>>C</option>
                                            <option value="#" <?= ($data['s_4'] == "#") ? "selected" : "" ?>>*</option>
                                        </select>
                                        Tidak Setuju:
                                        <select name="ts_4" class="form-control col-4">
                                            <option value="D" <?= ($data['ts_4'] == "D") ? "selected" : "" ?>>D</option>
                                            <option value="I" <?= ($data['ts_4'] == "I") ? "selected" : "" ?>>I</option>
                                            <option value="S" <?= ($data['ts_4'] == "S") ? "selected" : "" ?>>S</option>
                                            <option value="C" <?= ($data['ts_4'] == "C") ? "selected" : "" ?>>C</option>
                                            <option value="#" <?= ($data['ts_4'] == "#") ? "selected" : "" ?>>*</option>
                                        </select><br />
                                    </div>

                                    <input type="submit" name="edit" class="btn bg-primary text-white" value="Edit Soal" />
                            <?php
                                }
                            }
                            ?>
                        </form>
                        <?php
                        if (isset($_POST['edit'])) {
                            $sql = "UPDATE `soal_disc` SET `pernyataan_1`='$_POST[pernyataan1]', `s_1` = '$_POST[s_1]', `ts_1` = '$_POST[ts_1]', `pernyataan_2`='$_POST[pernyataan2]', `s_2` = '$_POST[s_2]', `ts_2` = '$_POST[ts_2]', `pernyataan_3`='$_POST[pernyataan3]', `s_3` = '$_POST[s_3]', `ts_3` = '$_POST[ts_3]', `pernyataan_4`='$_POST[pernyataan4]', `s_4` = '$_POST[s_4]', `ts_4` = '$_POST[ts_4]' WHERE id_soal = '$_GET[id]';";
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
    <?php
    include("script.php");
    ?>
</body>
<script>
    $('.summernote').summernote({
        placeholder: 'Ketik Pernyataan',
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