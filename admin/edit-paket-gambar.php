<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Edit Paket Gambar</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    if (isset($_GET['id'])) {
        $getData = mysqli_query($db, "SELECT * FROM `tbl_paketgambar` WHERE id_paket = '$_GET[id]'");
        if (mysqli_num_rows($getData) > 0) {
            $data = mysqli_fetch_array($getData);
    ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Edit Paket Gambar</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="kelola-paket-gambar.php">Kelola Paket Gambar</a></li>
                            <li class="breadcrumb-item active">Edit Paket Gambar</li>
                        </ol>
                        <div class="card mb-4 mt-2">
                            <div class="card-header">
                                Edit Paket Gambar
                            </div>
                            <div class="card-body">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    Nama Paket:<br />
                                    <input type="text" name="nama_paket" class="form-control col-lg-6 col-md-12" value="<?= $data['nama_paket'] ?>" required /><br />
                                    Gambar:<br />
                                    <?php
                                    for ($i = 1; $i <= $data['jumlah_gambar']; $i++) {
                                        echo '<img src="../image/' . $data['nama_paket'] . '-' . $i . '.png" class="m-1"/>';
                                    }
                                    ?>
                                    <br />
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
                                        for ($i = 1; $i <= $data['jumlah_gambar']; $i++) {
                                            unlink('../image/' .  $data['nama_paket'] . '-' . $i . '.png');
                                        }
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
                                            $updateSoal = mysqli_query($db, "UPDATE `tbl_soal` SET `paket_gambar`='$_POST[nama_paket]' WHERE paket_gambar = '$data[nama_paket]'");
                                            $sqlQuery = "UPDATE `tbl_paketgambar` SET `nama_paket` = '$_POST[nama_paket]', `gambar` = '$newfilename', `jumlah_gambar` = '$totalUploadBerhasil' WHERE id_paket = '$_GET[id]'";
                                            $updateSql = mysqli_query($db, $sqlQuery);
                                            if ($updateSql && $updateSoal) echo "<meta http-equiv='refresh' content='0; url=kelola-paket-gambar.php'>";
                                        }
                                    } else {
                                        chdir("../image/");
                                        $fileBaru = "";
                                        for ($i = 1; $i <= $data['jumlah_gambar']; $i++) {
                                            $fileAwal = $data['nama_paket'] . '-' . $i . '.png';
                                            $fileBaru = $_POST['nama_paket'] . '-' . $i . '.png';
                                            rename($fileAwal, $fileBaru);
                                        }
                                        $updateSoal = mysqli_query($db, "UPDATE `tbl_soal` SET `paket_gambar`='$_POST[nama_paket]' WHERE paket_gambar = '$data[nama_paket]'");
                                        $sqlQuery = "UPDATE `tbl_paketgambar` SET `nama_paket` = '$_POST[nama_paket]', `gambar` = '$fileBaru' WHERE id_paket = '$_GET[id]'";
                                        $updateSql = mysqli_query($db, $sqlQuery);
                                        if ($updateSql && $updateSoal) echo "<meta http-equiv='refresh' content='0; url=kelola-paket-gambar.php'>";
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
    <?php
        }
    }
    ?>
</body>

</html>