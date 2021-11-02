<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Edit Grup</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    if (isset($_GET['id'])) {
        $getDataGrup = mysqli_query($db, "SELECT * FROM `tbl_grup` WHERE id_grup = '$_GET[id]'");
        if (mysqli_num_rows($getDataGrup) > 0) {
            $row = mysqli_fetch_array($getDataGrup);
    ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Edit Grup</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="kelola-grup.php">Kelola Grup</a></li>
                            <li class="breadcrumb-item active">Edit Grup</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="#" method="post" class="form-check">
                                    Nama Grup:<br />
                                    <input type="text" class="form-control col-6" name="nama_grup" value="<?= $row['nama_grup'] ?>" /><br />
                                    Jenis Tes:<br />
                                    <div class="form-check">
                                        <?php
                                        $listJenisTes = explode(", ", $row['jenis_tes']);
                                        $urutan = 0;

                                        $dataJenisTes = mysqli_query($db, "SELECT * FROM `tbl_jenistes`");
                                        if (mysqli_num_rows($dataJenisTes) > 0) {
                                            while ($jenisTes = mysqli_fetch_array($dataJenisTes)) {
                                        ?>
                                                <input type="checkbox" name="jenistes[]" class="form-check-input" value="<?php echo $jenisTes['nama_tes']; ?>" id="jenistes<?php echo $jenisTes['id_jenistes']; ?>" <?= (isset($listJenisTes[$urutan]) == $jenisTes['nama_tes']) ? "checked" : "" ?> />
                                                <label class="form-check-label" for="jenistes<?php echo $jenisTes['id_jenistes']; ?>">
                                                    <?php echo $jenisTes['nama_tes']; ?>
                                                </label><br />
                                        <?php
                                                $urutan++;
                                            }
                                        }
                                        ?>
                                    </div>
                                    <br />
                                    <input type="submit" name="edit" class="btn btn-primary" value="Edit" />
                                    <?php
                                    if (isset($_POST['edit']) && isset($_POST['jenistes'])) {
                                        $pilihanJenisTes = implode(", ", $_POST['jenistes']);
                                    }
                                    ?>
                                </form>
                                <?php
                                if (isset($_POST['edit'])) {
                                    $updateData = mysqli_query($db, "UPDATE `tbl_grup` SET nama_grup = '$_POST[nama_grup]', jenis_tes = '$pilihanJenisTes' WHERE id_grup = '$_GET[id]'");
                                    if ($updateData) echo "<meta http-equiv='refresh' content='0; url=kelola-grup.php'>";
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
        }
    }
    ?>
</body>

</html>