<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Tambah Peserta Perusahaan</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Peserta Perusahaan</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="daftar-peserta.php">Daftar Peserta</a></li>
                    <li class="breadcrumb-item active">Peserta Perusahaan</li>
                </ol>
                <div class="card mb-4 mt-2">
                    <div class="card-header">
                        Peserta Perusahaan
                    </div>
                    <div class="card-body">
                        <form action="#" method="post">
                            Nama Perusahaan:<br />
                            <input type="text" name="perusahaan" class="form-control col-lg-6 col-md-12" autofocus required><br />
                            Kode Perusahaan:<br />
                            <input type="text" name="kode" class="form-control col-lg-2 col-md-6" maxlength="3" style="text-transform: uppercase;" required /><br />
                            Acara:<br />
                            <select class="form-control col-lg-6 col-md-12" id="inputAcara" name="acara">
                                <option value="" disabled selected>-</option>
                                <?php
                                $dataEvent = mysqli_query($db, "SELECT id_event, nama_event, tgl_mulai FROM `tbl_event` WHERE tgl_mulai >= DATE(NOW()) OR tgl_akhir >= DATE(NOW())");
                                if (mysqli_num_rows($dataEvent) > 0) {
                                    while ($data = mysqli_fetch_array($dataEvent)) {
                                ?>
                                        <option value="<?php echo $data['id_event']; ?>"><?php echo $data['nama_event']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select><br />
                            Jumlah Peserta:<br />
                            <input type="number" name="jumlah_peserta" id="jumlah_peserta" oninput="tambahField()" class="form-control col-2" /><br />
                            <div id="more_fields"></div>
                            <input type="submit" name="tambah" class="btn btn-primary" value="Tambah" />
                        </form>
                        <?php
                        if (isset($_POST['tambah'])) {
                            $listPeserta = array();
                            $sql = "INSERT INTO `tbl_user` (`nama`, `email`, `noHP`, `password`, `acara`, `keperluan`, `perusahaan`, `gender`, `status`) VALUES ";
                            $cekUrutan = mysqli_query($db, "SELECT max(`id_user`) as urutan FROM `tbl_user`");
                            $getUrutan = mysqli_fetch_array($cekUrutan);
                            $urutan = $getUrutan['urutan']; //ambil hanya 3 angka dari kode
                            for ($i = 0; $i < count($_POST['nama_peserta']); $i++) {
                                // buat password
                                $urutan++;
                                $kode = strtoupper($_POST['kode']) . sprintf("%03s", $urutan); // buat 3 digit untuk urutan 001
                                $password = md5($kode);
                                //selesai buat password

                                $listPeserta['nama'][$i] = $_POST['nama_peserta'][$i];
                                $listPeserta['password'][$i] = $kode;
                                $sql .= "('" . $_POST['nama_peserta'][$i] . "', '" . $_POST['email'][$i] . "', '" . $_POST['noHP'][$i] . "', '" . $password . "', '" . $_POST['acara'] . "', 'Perusahaan', '" . $_POST['perusahaan'] . "', '" . $_POST['gender'][$i] . "', 'Aktif'),";
                            }
                            $sql = substr($sql, 0, -1);
                            $inputSql = mysqli_query($db, $sql);
                            if ($inputSql) {
                                for ($j = 0; $j < count($listPeserta['nama']); $j++) {
                                    echo '<div class="alert alert-success">Berhasil mendaftarkan peserta <b>';
                                    echo $listPeserta['nama'][$j] . "</b> dengan kode akses yaitu <b>";
                                    echo $listPeserta['password'][$j] . "</b>!</div>";
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
    </div>
    <?php
    include("script.php");
    ?>
</body>
<script>
    function tambahField() {
        var val = document.getElementById('jumlah_peserta').value;
        var str = "";
        for (i = 0; i < val; i++) {
            str += "Nama Peserta [" + (i + 1) + "]:<br/><input type='text' name='nama_peserta[]' class='form-control col-lg-6 col-md-12'/><br/>E-Mail Peserta[" + (i + 1) + "]:<br/><input type='email' name='email[]' class='form-control col-lg-6 col-md-12'/><br/>No.HP Peserta [" + (i + 1) + "]:<br/><input type='number' name='noHP[]' class='form-control col-lg-6 col-md-12'/><br/>Jenis Kelamin Peserta [" + (i + 1) + "]:<br/><select name='gender[]' class='form-control col-lg-6 col-md-12'><option value='Laki-Laki'>Laki-Laki</option><option value='Perempuan'>Perempuan</option></select><hr/>";
        }
        document.getElementById('more_fields').innerHTML = str;
    }
</script>

</html>