<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>EditTambah Jenis Tes</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Edit Jenis Tes</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="kelola-jenis-tes.php">Kelola Jenis Tes</a></li>
                    <li class="breadcrumb-item active">Edit Jenis Tes</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="#" method="post">
                            <?php
                            if (isset($_GET['id'])) {
                                $dataJenisTes = mysqli_query($db, "SELECT * FROM `tbl_jenistes` WHERE id_jenistes = '$_GET[id]'");
                                if (mysqli_num_rows($dataJenisTes) > 0) {
                                    while ($data = mysqli_fetch_array($dataJenisTes)) {
                            ?>
                                        Nama Tes:<br />
                                        <input type="text" class="form-control col-6" name="nama_tes" value="<?php echo $data['nama_tes']; ?>" /><br />
                                        <input type="submit" class="btn btn-primary" value="Edit" name="submit" />
                            <?php
                                    }
                                }
                            }
                            ?>
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            $updateData = mysqli_query($db, "UPDATE `tbl_jenistes` SET `nama_tes`='$_POST[nama_tes]' WHERE id_jenistes = '$_GET[id]'");
                            if ($updateData) {
                                echo "<meta http-equiv='refresh' content='0; url=kelola-jenis-tes.php'>";
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

</html>