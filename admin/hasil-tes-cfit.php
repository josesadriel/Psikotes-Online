<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Hasil Tes</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Hasil Tes</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Hasil Tes</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Hasil Tes
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <td>Nama</td>
                                    <td>Total Benar</td>
                                    <td>IQ</td>
                                    <td>Keterangan</td>
                                </thead>
                                <?php
                                $norma = file_get_contents('../norma-cfit.json');
                                $json = json_decode($norma, true);

                                $getData = mysqli_query($db, "SELECT tbl_jwbuser.id_user, tbl_user.nama, tbl_user.tgl_lahir, SUM( IF( tbl_jwbuser.keterangan = 'Benar', 1, 0 ) ) Benar, SUM( IF( tbl_jwbuser.keterangan = 'Salah', 1, 0 ) ) Salah
                                FROM tbl_jwbuser
                                INNER JOIN `tbl_soal`
                                ON tbl_soal.id_soal = tbl_jwbuser.id_soal
                                INNER JOIN `tbl_user`
                                ON tbl_user.id_user = tbl_jwbuser.id_user
                                WHERE tbl_soal.jenis_tes = 'CFIT'
                                GROUP BY tbl_jwbuser.id_user");
                                if (mysqli_num_rows($getData) > 0) {
                                    while ($data = mysqli_fetch_array($getData)) {
                                        $bday = new DateTime($data['tgl_lahir']);
                                        $today = new Datetime(date('Y-m-d'));
                                        $diff = $today->diff($bday);
                                        $usia = floatval($diff->y . "." . $diff->m);
                                        $keterangan = "";
                                        if ($usia >= 13 && $usia <= 13.4) {
                                            $kelompokUsia = "umur1";
                                        } else if ($usia >= 13.5 && $usia <= 13.11) {
                                            $kelompokUsia = "umur2";
                                        } else if ($usia >= 14 && $usia <= 14.11) {
                                            $kelompokUsia = "umur3";
                                        } else if ($usia >= 15 && $usia <= 15.11) {
                                            $kelompokUsia = "umur4";
                                        } else if ($usia >= 16 && $usia <= 16.11) {
                                            $kelompokUsia = "umur5";
                                        } else if ($usia >= 17) {
                                            $kelompokUsia = "umur6";
                                        }
                                ?>
                                        <tr>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $data['Benar'] ?></td>
                                            <?php
                                            for ($i = 0; $i < count($json); $i++) {
                                                if ($json[$i]['RS'] == $data['Benar']) {
                                                    if ($json[$i][$kelompokUsia] <= 19) $keterangan = "Profound Mental Retardation";
                                                    else if ($json[$i][$kelompokUsia] >= 30 && $json[$i][$kelompokUsia] <= 69) $keterangan = "Mentally Defective";
                                                    else if ($json[$i][$kelompokUsia] >= 70 && $json[$i][$kelompokUsia] <= 79) $keterangan = "Borderline";
                                                    else if ($json[$i][$kelompokUsia] >= 80 && $json[$i][$kelompokUsia] <= 89) $keterangan = "Low Average (LA)";
                                                    else if ($json[$i][$kelompokUsia] >= 90 && $json[$i][$kelompokUsia] <= 109) $keterangan = "Average (A)";
                                                    else if ($json[$i][$kelompokUsia] >= 110 && $json[$i][$kelompokUsia] <= 119) $keterangan = "High Average (HA)";
                                                    else if ($json[$i][$kelompokUsia] >= 120 && $json[$i][$kelompokUsia] <= 139) $keterangan = "Superior (S)";
                                                    else if ($json[$i][$kelompokUsia] >= 140 && $json[$i][$kelompokUsia] <= 169) $keterangan = "Very Superior (VS)";
                                                    else if ($json[$i][$kelompokUsia] >= 170) $keterangan = "Genius (G)";
                                            ?>
                                                    <td><?= $json[$i][$kelompokUsia] ?></td>
                                                    <td><?= $keterangan ?></td>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                <?php
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/datatables-demo.js"></script>
</body>

</html>