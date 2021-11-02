<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Tambah Contoh Soal</title>

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
                <h1 class="mt-4">Tambah Contoh Soal</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="kelola-soal.php">Kelola Soal</a></li>
                    <li class="breadcrumb-item active">Tambah Contoh Soal</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="#" method="post">
                            Pernyataan 1:<br />
                            <textarea id="summernote1" name="pernyataan[]" required></textarea><br />
                            Pernyataan 2:<br />
                            <textarea id="summernote2" name="pernyataan[]" required></textarea><br />
                            Penjelasan:<br />
                            <textarea id="summernote3" name="penjelasan" required></textarea><br />
                            <input type="submit" name="tambah" class="btn bg-primary" value="Tambah Contoh Soal" />
                        </form>
                        <?php
                        if (isset($_POST['tambah'])) {
                            $pilihan = implode("#", $_POST['pernyataan']);
                            $sql = "INSERT INTO `tbl_contohsoal`(`jenis_tes`, `subtes`, `penjelasan`, `jenis_jawaban`, `pilihan`) VALUES ('PAPI KOSTICK', 'PAPI KOSTICK', '$_POST[penjelasan]', 'Pilihan Ganda', '$pilihan')";
                            if (isset($sql)) {
                                $insertSql = mysqli_query($db, $sql);
                                if ($insertSql) echo "<meta http-equiv='refresh' content='0; url=kelola-soal.php'>";
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