<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Edit Intruksi Tes</title>
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
                $getDataTes = mysqli_query($db, "SELECT * FROM `tbl_jenistes` WHERE id_jenistes = '$_GET[id]'");
                if (mysqli_num_rows($getDataTes) > 0) {
                    $dataTes = mysqli_fetch_array($getDataTes);
            ?>
                    <div class="container-fluid">
                        <h1 class="mt-4">Edit Intruksi Tes - <?= $dataTes['nama_tes'] ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="intruksi-jenis-tes.php">Intruksi Tes</a></li>
                            <li class="breadcrumb-item active">Edit Intruksi</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    Intruksi:<br />
                                    <textarea name="intruksi" class="form-control" id="summernote" required><?= $dataTes['intruksi_tes'] ?></textarea><br />

                                    <input type="submit" class="btn btn-primary" name="submit" />
                                </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            $updateSql = mysqli_query($db, "UPDATE `tbl_jenistes` SET `intruksi_tes` = '$_POST[intruksi]' WHERE id_jenistes = '$_GET[id]'");
                            if ($updateSql) echo "<meta http-equiv='refresh' content='0; url=intruksi-jenis-tes.php'>";
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