<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include("header.php");
        ?>
        <title>Tambah Grup</title>
    </head>
    <body class="sb-nav-fixed">
        <?php
        include("sidebar.php");
        ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Tambah Grup</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="kelola-grup.php">Kelola Grup</a></li>
                            <li class="breadcrumb-item active">Tambah Grup</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="#" method="post" class="form-check">
                                    Nama Grup:<br/>
                                    <input type="text" class="form-control col-6" name="nama_grup"/><br/>
                                    Jenis Tes:<br/>
                                    <div class="form-check">
                                        <?php
                                        $dataJenisTes = mysqli_query($db, "SELECT * FROM `tbl_jenistes`");
                                        if (mysqli_num_rows($dataJenisTes) > 0) {
                                            while ($jenisTes = mysqli_fetch_array($dataJenisTes)) {
                                        ?>
                                        <input type="checkbox" name="jenistes[]" class="form-check-input" value="<?php echo $jenisTes['nama_tes'];?>" id="jenistes<?php echo $jenisTes['id_jenistes'];?>"/>
                                        <label class="form-check-label" for="jenistes<?php echo $jenisTes['id_jenistes'];?>">
                                            <?php echo $jenisTes['nama_tes'];?>
                                        </label><br/>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <br/>
                                    <input type="submit" name="tambah" class="btn btn-primary"/>
                                    <?php
                                        if (isset($_POST['tambah']) && isset($_POST['jenistes'])) {
                                            $pilihanJenisTes = implode(", ", $_POST['jenistes']);
                                        }
                                    ?>
                                </form>
                                <?php
                                    if (isset($_POST['tambah'])) {
                                        $inputData = mysqli_query($db, "INSERT INTO `tbl_grup` (nama_grup, jenis_tes) VALUES ('$_POST[nama_grup]', '$pilihanJenisTes')");
                                        if ($inputData) echo "Berhasil";
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
