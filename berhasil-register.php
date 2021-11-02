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
    <title>Berhasil Register</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Berhasil Register</h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (isset($_GET['nama']) && isset($_GET['p'])) {
                                    ?>
                                        <div class="p-3 mb-2">
                                            <center>
                                                <!-- <b>Akun berhasil dibuat!</b><br/><br/>
                                            Silahkan lakukan psikotes online pada tanggal<br/>
                                            <?php
                                            // $dataEvent = mysqli_query($db, "SELECT * FROM `tbl_event` WHERE id_event = '$_GET[event]'");
                                            // $data = mysqli_fetch_array($dataEvent);
                                            // $tglMulai = date_create($data['tgl_mulai']);
                                            ?>
                                            <b><?php echo date_format($tglMulai, "j F Y"); ?> Pukul <?php echo $data['waktu_mulai']; ?></b><br/>
                                            Berikut adalah password yang akan digunakan untuk login selanjutnya<br/>
                                            <b><?php echo base64_decode($_GET['pss']); ?></b><br/><br/>
                                            <b>Simpan password dengan aman agar tidak terjadi kehilangan!</b> -->
                                                Kode milik Anda<br />
                                                <p class="text-white bg-info p-2 m-2 d-inline-block"><?= base64_decode($_GET['p']); ?></p><br />
                                                Akun berhasil didaftarkan, silahkan kirim bukti pembayaran melalui whatsapp berikut agar akun dapat segera diaktifkan:<br /><br />
                                                <?php
                                                // $dataAdmin = mysqli_query($db, "SELECT * FROM `tbl_admin` WHERE id_admin = 1");
                                                // $data = mysqli_fetch_array($dataAdmin);
                                                // $teks = str_replace("nama_peserta", $_GET['nama'], $data['text_wa']);
                                                ?>
                                                <a href="https://api.whatsapp.com/send?phone=089625769346&text=Halo, saya sudah melakukan pendaftaran di situs psikotes online milik Matahati dengan nama <?= $_GET['nama'] ?>." class="btn btn-success">
                                                    <i class="fab fa-whatsapp"></i> Kirim ke WhatsApp
                                                </a>
                                            </center>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="index.php" class="btn btn-primary">Kembali</a></div>
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