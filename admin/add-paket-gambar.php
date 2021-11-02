<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Tambah Paket Gambar</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Tambah Paket Gambar</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="kelola-paket-gambar.php">Kelola Paket Gambar</a></li>
                    <li class="breadcrumb-item active">Tambah Paket Gambar</li>
                </ol>
                <div class="card mb-4 mt-2">
                    <div class="card-header">
                        Tambah Paket Gambar
                    </div>
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">
                            Nama Paket:<br />
                            <input type="text" name="nama_paket" class="form-control col-lg-6 col-md-12" required /><br />
                            Gambar:<br />
                            <div class="custom-file col-lg-6 col-md-12">
                                <input type="file" class="custom-file-input" id="customFile" name="gambarSoal[]" accept="image/*" multiple>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div><br /><br />
                            <input type="submit" name="submit" class="btn btn-primary" />
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            $sqlQuery = "";
                            if (isset($_FILES['gambarSoal']) && $_FILES['gambarSoal']['size'][0] > 0) {
                                $totalUploadBerhasil = 0;
                                $totalGambar = count($_FILES['gambarSoal']['name']);
                                $newfilename = "";
                                $dirGambar = "../image/";
                                for ($i = 0; $i < $totalGambar; $i++) {
                                    $temp = explode(".", $_FILES['gambarSoal']['name'][$i]);
                                    $newfilename = $_POST['nama_paket'] . '-' . ($i + 1) . '.' . end($temp);
                                    $moveGambar = move_uploaded_file($_FILES['gambarSoal']['tmp_name'][$i], $dirGambar . $newfilename);
                                    if ($moveGambar) $totalUploadBerhasil++;
                                }
                                if ($totalUploadBerhasil == $totalGambar) {
                                    $sqlQuery = "INSERT INTO `tbl_paketgambar` (nama_paket, gambar, jumlah_gambar) VALUES ('$_POST[nama_paket]', '$newfilename', '$totalUploadBerhasil')";
                                    $inputSql = mysqli_query($db, $sqlQuery);
                                    if ($inputSql) echo "<meta http-equiv='refresh' content='0; url=kelola-paket-gambar.php'>";
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

    <?php
    include("script.php");
    ?>
    <script>
        $(document).ready(function() {
            $('input[type="file"]').on("change", function() {
                let filenames = [];
                let files = this.files;
                if (files.length > 1) {
                    filenames.push("Total Files (" + files.length + ")");
                } else {
                    for (let i in files) {
                        if (files.hasOwnProperty(i)) {
                            filenames.push(files[i].name);
                        }
                    }
                }
                $(this)
                    .next(".custom-file-label")
                    .html(filenames.join(","));
            });
        });
    </script>
</body>

</html>