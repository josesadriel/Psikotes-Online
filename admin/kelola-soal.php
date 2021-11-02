<?php
include("../koneksi.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Kelola Soal</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    if (isset($_GET['jenis_tes']) && isset($_GET['tipe'])) {
        $_SESSION['jt_admin'] = $_GET['jenis_tes'];
        $_SESSION['t_admin'] = $_GET['tipe'];
    }
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Kelola Soal</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kelola Soal</li>
                </ol>
                <div class="d-flex justify-content-between">
                    <a class="mr-auto p-2 btn btn-primary" href="pilih-bentuk-soal.php"><i class="fa fa-plus"></i> Tambah Soal</a>
                    <span class="p-2">Jenis Tes:</span>
                    <span>
                        <select class="form-control" id="jenis_tes">
                            <option value="-" disabled selected>-</option>
                            <?php
                            $dataJenisTes = mysqli_query($db, "SELECT * FROM `tbl_jenistes`");
                            if (mysqli_num_rows($dataJenisTes) > 0) {
                                while ($jenisTes = mysqli_fetch_array($dataJenisTes)) {
                            ?>
                                    <option value="<?php echo $jenisTes['nama_tes']; ?>" <?= ((isset($_GET['jenis_tes']) && $_GET['jenis_tes'] == $jenisTes['nama_tes'])) || (isset($_SESSION['jt_admin']) && $_SESSION['jt_admin'] == $jenisTes['nama_tes']) ? "selected" : "" ?>><?php echo $jenisTes['nama_tes']; ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </span>
                    <span>
                        <select class="form-control ml-1" id="tipe">
                            <option value="Soal" <?= ((isset($_GET['tipe']) && $_GET['tipe'] == "Soal") || (isset($_SESSION['t_admin']) && $_SESSION['t_admin'] == "Soal")) ? "selected" : "" ?>>Soal</option>
                            <option value="Contoh" <?= ((isset($_GET['tipe']) && $_GET['tipe'] == "Contoh") || (isset($_SESSION['t_admin']) && $_SESSION['t_admin'] == "Contoh")) ? "selected" : "" ?>>Contoh</option>
                        </select>
                    </span>
                </div>
                <div class="card mb-4 mt-2">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Soal
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="tabel-soal" width="100%" cellspacing="0">
                                <thead>
                                    <td width="5%">No</td>
                                    <td width="40%">Soal</td>
                                    <td>Subtes</td>
                                    <td>Aksi</td>
                                </thead>
                                <?php
                                if (isset($_SESSION['jt_admin']) && isset($_SESSION['t_admin'])) {
                                    if ($_SESSION['jt_admin'] == "PAPI KOSTICK") {
                                        if ($_SESSION['t_admin'] == "Soal") {
                                            $sql = "SELECT id_papi as 'no', CONCAT(pernyataan1, ', ', pernyataan2) soal, 'PAPI KOSTICK' subtes FROM `soal_papi`";
                                        } else if ($_SESSION['t_admin'] == "Contoh") {
                                            $sql = "SELECT (@nomor := @nomor + 1) 'no', tbl_contohsoal.* FROM `tbl_contohsoal` CROSS JOIN (SELECT @nomor := 0) nomor WHERE tbl_contohsoal.jenis_tes = '$_SESSION[jt_admin]' ORDER BY tbl_contohsoal.id_soal ASC";
                                        }
                                    } else if ($_SESSION['jt_admin'] == "DISC") {
                                        if ($_SESSION['t_admin'] == "Soal") {
                                            $sql = "SELECT id_soal as 'no', CONCAT(pernyataan_1, ', ', pernyataan_2, ', ', pernyataan_3, ', ', pernyataan_4) soal, 'DISC' subtes FROM `soal_disc`";
                                        } else {
                                        }
                                    } else {
                                        if ($_SESSION['t_admin'] == "Soal") {
                                            $sql = "SELECT (@nomor := @nomor + 1) 'no', tbl_soal.* FROM `tbl_soal` CROSS JOIN (SELECT @nomor := 0) nomor WHERE tbl_soal.jenis_tes = '$_SESSION[jt_admin]' ORDER BY tbl_soal.id_soal ASC";
                                        } else if ($_SESSION['t_admin'] == "Contoh") {
                                            $sql = "SELECT (@nomor := @nomor + 1) 'no', tbl_contohsoal.* FROM `tbl_contohsoal` CROSS JOIN (SELECT @nomor := 0) nomor WHERE tbl_contohsoal.jenis_tes = '$_SESSION[jt_admin]' ORDER BY tbl_contohsoal.id_soal ASC";
                                        }
                                    }
                                    if (isset($sql)) {
                                        $getSoal = mysqli_query($db, $sql);
                                        if (mysqli_num_rows($getSoal) > 0) {
                                            while ($soal = mysqli_fetch_array($getSoal)) {
                                ?>
                                                <tr>
                                                    <td><?= $soal['no'] ?></td>
                                                    <td><?php
                                                        if (isset($soal['gambar']) && $soal['gambar'] != "") echo '<img src="../image/' . $soal['gambar'] . '" class="img-fluid" />';
                                                        else if (empty($soal['soal']) && empty($soal['gambar'])) echo str_replace("#", ", ", $soal['pilihan']);
                                                        else if (empty($soal['pilihan']) && empty($soal['gambar'])) echo $soal['soal'];
                                                        else echo $soal['soal'];
                                                        ?></td>
                                                    <td><?= $soal['subtes'] ?></td>
                                                    <td>
                                                        <?php
                                                        if ($_SESSION['jt_admin'] == "DISC") {
                                                            if ($_SESSION['t_admin'] == "Soal") {
                                                                echo '<a href="edit-soal-disc.php?id=' . $soal['no'] . '" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-sm"></i></a>';
                                                            }
                                                        } else if ($_SESSION['jt_admin'] == "PAPI KOSTICK") {
                                                            if ($_SESSION['t_admin'] == "Soal") {
                                                                echo '<a href="edit-soal-papi.php?id=' . $soal['no'] . '&t=s" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-sm"></i></a>';
                                                            } else if ($_SESSION['t_admin'] == "Contoh") {
                                                                echo '<a href="edit-soal-papi.php?id=' . $soal['id_soal'] . '&t=c" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-sm"></i></a>';
                                                                echo '<a href="hapus-soal.php?id=' . $soal['id_soal'] . '&tipe=contoh" class="ml-2 btn btn-danger btn-sm"><i class="fa fa-trash fa-sm"></i></a>';
                                                            }
                                                        } else if ($_SESSION['jt_admin'] == "MBTI") {
                                                            echo '<a href="edit-soal.php?id=' . $soal['id_soal'] . '&tipe=soal" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-sm"></i></a>';
                                                        } else if ($_SESSION['jt_admin'] == "MSDT") {
                                                            echo '<a href="edit-soal.php?id=' . $soal['id_soal'] . '&tipe=soal" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-sm"></i></a>';
                                                        } else if ($_SESSION['jt_admin'] == "CFIT") {
                                                            if ($_SESSION['t_admin'] == "Soal") {
                                                                echo '<a href="edit-soal-cfit.php?id=' . $soal['id_soal'] . '&tipe=soal" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-sm"></i></a>';
                                                                echo '<a href="hapus-soal.php?id=' . $soal['id_soal'] . '&tipe=soal" class="ml-2 btn btn-danger btn-sm"><i class="fa fa-trash fa-sm"></i></a>';
                                                            } else if ($_SESSION['t_admin'] == "Contoh") {
                                                                echo '<a href="edit-soal-cfit.php?id=' . $soal['id_soal'] . '&tipe=contoh" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-sm"></i></a>';
                                                                echo '<a href="hapus-soal.php?id=' . $soal['id_soal'] . '&tipe=contoh" class="ml-2 btn btn-danger btn-sm"><i class="fa fa-trash fa-sm"></i></a>';
                                                            }
                                                        } else {
                                                            if ($_SESSION['t_admin'] == "Soal") {
                                                                echo '<a href="edit-soal.php?id=' . $soal['id_soal'] . '&tipe=soal" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-sm"></i></a>';
                                                                echo '<a href="hapus-soal.php?id=' . $soal['id_soal'] . '&tipe=soal" class="ml-2 btn btn-danger btn-sm"><i class="fa fa-trash fa-sm"></i></a>';
                                                            } else if ($_SESSION['t_admin'] == "Contoh") {
                                                                echo '<a href="edit-soal.php?id=' . $soal['id_soal'] . '&tipe=contoh" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-sm"></i></a>';
                                                                echo '<a href="hapus-soal.php?id=' . $soal['id_soal'] . '&tipe=contoh" class="ml-2 btn btn-danger btn-sm"><i class="fa fa-trash fa-sm"></i></a>';
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                            </table>
                        </div>
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
    $(document).ready(function() {
        $('#tabel-soal').DataTable({
            "order": [
                [0, "asc"]
            ]
        });
        $("#jenis_tes").on('change', function(e) {
            e.preventDefault();
            var tipe = document.getElementById('tipe').value;
            $.get("kelola-soal.php?jenis_tes=" + this.value + "&tipe=" + tipe, function(data) {
                // Display the returned data in browser
                $("body").html(data);
            });
        });
        $("#tipe").on('change', function(e) {
            e.preventDefault();
            var jenis_tes = document.getElementById('jenis_tes').value;
            $.get("kelola-soal.php?jenis_tes=" + jenis_tes + "&tipe=" + this.value, function(data) {
                // Display the returned data in browser
                $("body").html(data);
            });
        });
    });
</script>

</html>