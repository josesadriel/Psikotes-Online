<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Ganti Password</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Ganti Password</h1>
                <div class="card mb-4 mt-2">
                    <div class="card-header">
                        Ganti Password
                    </div>
                    <div class="card-body">
                        <form action="#" method="post">
                            Password Lama:<br />
                            <input type="password" name="last_pw" class="form-control col-lg-6 col-md-12" autofocus required><br />
                            Password Baru:<br />
                            <input type="password" name="new_pw" class="form-control col-lg-6 col-md-12" required /><br />
                            <input type="submit" name="ganti" class="btn btn-primary" value="Ganti" />
                        </form>
                        <?php
                        if (isset($_POST['ganti'])) {
                            $cekSql = mysqli_query($db, "SELECT * FROM `tbl_admin` WHERE id_admin = '1'");
                            if (mysqli_num_rows($cekSql) > 0) {
                                $data = mysqli_fetch_array($cekSql);

                                $lastPW = md5($_POST['last_pw']);
                                $newPW = md5($_POST['new_pw']);
                                if ($lastPW == $data['password']) {
                                    $updateSql = mysqli_query($db, "UPDATE `tbl_admin` SET `password` = '$newPW' WHERE id_admin = '1'");
                                    if ($updateSql) echo "Password berhasil diganti";
                                } else {
                                    echo "Password salah";
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