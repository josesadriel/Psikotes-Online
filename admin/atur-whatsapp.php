<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Atur WhatsApp</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Atur WhatsApp</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Atur WhatsApp</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <?php
                        $dataAdmin = mysqli_query($db, "SELECT * FROM `tbl_admin` WHERE id_admin = 1");
                        $data = mysqli_fetch_array($dataAdmin);
                        ?>
                        <form action="#" method="post" class="form-check">
                            Nomor WhatsApp:<br />
                            <input type="number" name="no_wa" value="<?= intval($data['noHp']) ?>" class="form-control col-6">
                            <small id="emailHelp" class="form-text text-muted">Nomor Whatsapp harus diawali dengan angka 62 untuk mengganti angka 0!</small><br />
                            Text WhatsApp:<br />
                            <textarea class="form-control col-6" name="text_wa"><?= $data['text_wa'] ?></textarea>
                            <small id="emailHelp" class="form-text text-muted">Tambahkan <b>nama_peserta</b> untuk menampilkan nama peserta yang baru mendaftar!</small><br />
                            <input type="submit" value="Submit" name="ubah" class="btn btn-primary" />
                        </form>
                        <?php
                        if (isset($_POST['ubah'])) {
                            $ubahData = mysqli_query($db, "UPDATE `tbl_admin` SET `noHp`= '$_POST[no_wa]',`text_wa`= '$_POST[text_wa]' WHERE `id_admin` = 1;");
                            if ($ubahData) {
                                echo "<meta http-equiv='refresh' content='0; url=atur-whatsapp.php'>";
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