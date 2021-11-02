<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Edit Event</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <?php
            if (isset($_GET['id'])) {
                $getDataEvent = mysqli_query($db, "SELECT * FROM `tbl_event` WHERE id_event = '$_GET[id]'");
                if (mysqli_num_rows($getDataEvent) > 0) {
                    $dataEvent = mysqli_fetch_array($getDataEvent);
            ?>
                    <div class="container-fluid">
                        <h1 class="mt-4">Edit Event</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="kelola-event.php">Kelola Event</a></li>
                            <li class="breadcrumb-item active">Edit Event</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="#" method="post" class="form-check">
                                    <label for="namaEvent" class="col-sm-2 col-form-label pl-0">Nama Event</label><br />
                                    <input type="text" name="nama_event" class="form-control col-lg-5" id="namaEvent" value="<?= $dataEvent['nama_event'] ?>" required><br />

                                    <div class="form-row">
                                        <div class="col-lg-4">
                                            <label for="mulaiEvent" class="col-sm-3 pl-0 col-form-label">Mulai</label>
                                            <input type="date" name="mulai_event" id="mulaiEvent" class="form-control" value="<?= $dataEvent['tgl_mulai'] ?>" required />
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="selesaiEvent" class="col-sm-3 pl-0 col-form-label">Selesai</label>
                                            <input type="date" name="selesai_event" id="selesaiEvent" class="form-control" value="<?= $dataEvent['tgl_akhir'] ?>" required />
                                        </div>
                                    </div><br />

                                    <div class="form-row">
                                        <div class="col-lg-4">
                                            <label for="jamMulai" class="col-sm-4 pl-0 col-form-label">Jam Mulai</label>
                                            <input type="time" name="jam_mulai" id="jamMulai" class="form-control" value="<?= $dataEvent['waktu_mulai'] ?>" required />
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="jamSelesai" class="col-sm-4 pl-0 col-form-label">Jam Selesai</label>
                                            <input type="time" name="jam_selesai" id="jamSelesai" class="form-control" value="<?= $dataEvent['waktu_akhir'] ?>" required />
                                        </div>
                                    </div><br />

                                    <label for="targetGrup" class="col-sm-2 col-form-label pl-0">Target Grup</label>
                                    <select name="grup" id="targetGrup" class="form-control col-lg-5">
                                        <?php
                                        $dataGrup = mysqli_query($db, "SELECT * FROM `tbl_grup`");
                                        if (mysqli_num_rows($dataGrup) > 0) {
                                            while ($data = mysqli_fetch_array($dataGrup)) {
                                        ?>
                                                <option value="<?php echo $data['nama_grup']; ?>"><?php echo $data['nama_grup']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select><br />
                                    <input type="submit" value="Update" name="update" class="btn btn-primary" />
                                </form>
                                <?php
                                if (isset($_POST['update'])) {
                                    $updateSql = mysqli_query($db, "UPDATE `tbl_event` SET `nama_event`='$_POST[nama_event]',`tgl_mulai`='$_POST[mulai_event]',`tgl_akhir`='$_POST[selesai_event]',`waktu_mulai`='$_POST[jam_mulai]',`waktu_akhir`='$_POST[jam_selesai]',`grup`='$_POST[grup]' WHERE id_event = '$_GET[id]'");
                                    if ($updateSql) {
                                        echo "<meta http-equiv='refresh' content='0; url=kelola-event.php'>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
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