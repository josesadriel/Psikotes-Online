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
    <title>Hasil Tes IST</title>
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
                <h1 class="mt-4">Hasil Tes IST</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Hasil Tes IST</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Hasil Tes IST
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <td>Nama</td>
                                    <td>SE</td>
                                    <td>WA</td>
                                    <td>AN</td>
                                    <td>GE</td>
                                    <td>RA</td>
                                    <td>ZR</td>
                                    <td>FA</td>
                                    <td>WU</td>
                                    <td>ME</td>
                                </thead>
                                <?php
                                $norma = file_get_contents('../norma-ist.json');
                                $json = json_decode($norma, true);

                                $getData = mysqli_query($db, "SELECT tbl_jwbuser.id_user, tbl_user.nama, tbl_user.tgl_lahir, SUM(IF((tbl_soal.subtes = 'SE') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'SE', SUM(IF((tbl_soal.subtes = 'WA') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'WA', SUM(IF((tbl_soal.subtes = 'AN') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'AN', SUM(IF((tbl_soal.subtes = 'GE') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'GE', SUM(IF((tbl_soal.subtes = 'RA') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'RA', SUM(IF((tbl_soal.subtes = 'ZR') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'ZR', SUM(IF((tbl_soal.subtes = 'FA') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'FA', SUM(IF((tbl_soal.subtes = 'WU') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'WU', SUM(IF((tbl_soal.subtes = 'ME') && (tbl_jwbuser.keterangan = 'Benar'), 1, 0)) AS 'ME' FROM `tbl_jwbuser` INNER JOIN `tbl_soal` ON tbl_soal.id_soal = tbl_jwbuser.id_soal INNER JOIN `tbl_user` ON tbl_user.id_user = tbl_jwbuser.id_user WHERE tbl_soal.jenis_tes = 'IST' GROUP BY tbl_jwbuser.id_user");
                                if (mysqli_num_rows($getData) > 0) {
                                    while ($data = mysqli_fetch_array($getData)) {
                                        $bday = new DateTime($data['tgl_lahir']);
                                        $today = new Datetime(date('Y-m-d'));
                                        $diff = $today->diff($bday);
                                        $usia = floatval($diff->y);
                                        $keterangan = "";
                                        if ($usia == 17) {
                                            $kelompokUsia = "17";
                                        } else if ($usia == 18) {
                                            $kelompokUsia = "18";
                                        } else if ($usia >= 19 && $usia <= 20) {
                                            $kelompokUsia = "19-20";
                                        } else if ($usia >= 31 && $usia <= 35) {
                                            $kelompokUsia = "31-35";
                                        } else if ($usia >= 41 && $usia <= 45) {
                                            $kelompokUsia = "41-45";
                                        }
                                ?>
                                        <tr>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $data['SE'] . "(" . $json['umur'][$kelompokUsia]['SE'][$data['SE']] . ")"; ?></td>
                                            <td><?= $data['WA'] . "(" . $json['umur'][$kelompokUsia]['WA'][$data['WA']] . ")"; ?></td>
                                            <td><?= $data['AN'] . "(" . $json['umur'][$kelompokUsia]['AN'][$data['AN']] . ")"; ?></td>
                                            <td><?= $data['GE'] . "(" . $json['umur'][$kelompokUsia]['GE'][$data['GE']] . ")"; ?></td>
                                            <td><?= $data['RA'] . "(" . $json['umur'][$kelompokUsia]['RA'][$data['RA']] . ")"; ?></td>
                                            <td><?= $data['ZR'] . "(" . $json['umur'][$kelompokUsia]['ZR'][$data['ZR']] . ")"; ?></td>
                                            <td><?= $data['FA'] . "(" . $json['umur'][$kelompokUsia]['FA'][$data['FA']] . ")"; ?></td>
                                            <td><?= $data['WU'] . "(" . $json['umur'][$kelompokUsia]['WU'][$data['WU']] . ")"; ?></td>
                                            <td><?= $data['ME'] . "(" . $json['umur'][$kelompokUsia]['ME'][$data['ME']] . ")"; ?></td>
                                            <?php
                                            // for ($i = 0; $i < count($json); $i++) {
                                            //     if ($json[$i]['RS'] == $data['Benar']) {
                                            //         if ($json[$i][$kelompokUsia] <= 19) $keterangan = "Profound Mental Retardation";
                                            //         else if ($json[$i][$kelompokUsia] >= 30 && $json[$i][$kelompokUsia] <= 69) $keterangan = "Mentally Defective";
                                            //         else if ($json[$i][$kelompokUsia] >= 70 && $json[$i][$kelompokUsia] <= 79) $keterangan = "Borderline";
                                            //         else if ($json[$i][$kelompokUsia] >= 80 && $json[$i][$kelompokUsia] <= 89) $keterangan = "Low Average (LA)";
                                            //         else if ($json[$i][$kelompokUsia] >= 90 && $json[$i][$kelompokUsia] <= 109) $keterangan = "Average (A)";
                                            //         else if ($json[$i][$kelompokUsia] >= 110 && $json[$i][$kelompokUsia] <= 119) $keterangan = "High Average (HA)";
                                            //         else if ($json[$i][$kelompokUsia] >= 120 && $json[$i][$kelompokUsia] <= 139) $keterangan = "Superior (S)";
                                            //         else if ($json[$i][$kelompokUsia] >= 140 && $json[$i][$kelompokUsia] <= 169) $keterangan = "Very Superior (VS)";
                                            //         else if ($json[$i][$kelompokUsia] >= 170) $keterangan = "Genius (G)";
                                            // 
                                            ?>
                                            <!-- <td><?= $json[$i][$kelompokUsia] ?></td>
                                            <td><?= $keterangan ?></td> -->
                                            <?php
                                            //     }
                                            // }
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