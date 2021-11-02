<?php
include("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Halaman Login</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="alert alert-warning alert-dismissible fade show position-relative" role="alert" id="alert" style="display:none">
                                <span id="text-alert"></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Masuk</h3>
                                </div>
                                <div class="card-body">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputKode">Kode</label>
                                            <input class="form-control py-4" id="inputKode" name="kode" type="text" placeholder="Masukkan Kode" minlength="5" maxlength="5" style="text-transform:uppercase" required />
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <input type="submit" name="login" class="btn btn-primary w-100" value="Masuk" />
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_POST['login']) && isset($_POST['kode'])) {
                                        session_start();
                                        $kode = md5(strtoupper($_POST['kode']));
                                        $cekUser = mysqli_query($db, "SELECT tbl_user.id_user, tbl_user.nama, tbl_user.email, tbl_user.password, tbl_user.acara, tbl_user.status, tbl_event.nama_event, tbl_event.tgl_mulai, tbl_event.tgl_akhir, tbl_event.waktu_mulai, tbl_event.waktu_akhir FROM `tbl_user`, `tbl_event` WHERE `password` = '$kode' AND tbl_user.acara = tbl_event.id_event");
                                        if (mysqli_num_rows($cekUser) > 0) {
                                            while ($data = mysqli_fetch_array($cekUser)) {
                                                $mulaiEvent = $data['tgl_mulai'] . " " . $data['waktu_mulai'];
                                                $selesaiEvent = $data['tgl_akhir'] . " " . $data['waktu_akhir'];
                                                if ($data['status'] == "Aktif") {
                                                    if (strtotime($mulaiEvent) < time() && strtotime($selesaiEvent) > time()) {
                                                        $_SESSION['id_user'] = $data['id_user'];
                                                        $_SESSION['nama'] = $data['nama'];
                                                        $_SESSION['email'] = $data['email'];
                                                        $_SESSION['acara'] = $data['acara'];
                                                        echo "<meta http-equiv='refresh' content='0; url=user/list-tes.php'>";
                                                    } else {
                                                        echo "<script>";
                                                        echo "document.getElementById('alert').style.display='block';";
                                                        echo "document.getElementById('text-alert').innerHTML = 'Tidak sesuai dengan jadwal acara / event!';</script>";
                                                    }
                                                } else if ($data['status'] == "Belum Aktif") {
                                                    echo "<meta http-equiv='refresh' content='0; url=berhasil-register.php?nama=" . $data['nama'] . "&p=" . base64_encode(strtoupper($_POST['kode'])) . "'>";
                                                }
                                            }
                                        } else echo '<div class="mt-1 alert alert-danger text-center">Kode tidak terdaftar!</div>';
                                    }
                                    ?>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="register.php">Daftar Sekarang!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
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
    <script src="js/scripts.js"></script>
</body>

</html>