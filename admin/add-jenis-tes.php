<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Tambah Jenis Tes</title>
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
                <h1 class="mt-4">Tambah Jenis Tes</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="kelola-jenis-tes.php">Kelola Jenis Tes</a></li>
                    <li class="breadcrumb-item active">Tambah Jenis Tes</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="#" method="post">
                            Nama Tes:<br />
                            <input type="text" class="form-control col-6" name="nama_tes" /><br />
                            <input type="submit" class="btn btn-primary" name="submit" />
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            $inputData = mysqli_query($db, "INSERT INTO `tbl_jenistes` (nama_tes) VALUES ('$_POST[nama_tes]')");
                            if ($inputData) {
                                echo "Berhasil";
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
        </script>
    </div>
    </div>
    <?php
    include("script.php");
    ?>
</body>

</html>