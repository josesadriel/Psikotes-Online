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
    <title>Halaman Login Admin</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="../css/styles.css" rel="stylesheet" />
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
                                            <label class="small mb-1" for="username">Username</label>
                                            <input class="form-control py-4" id="username" name="username" type="text" placeholder="Masukkan Username" minlength="5" maxlength="5" autofocus required oninvalid="this.setCustomValidity('Minimal terdiri dari 5 huruf')" oninput="this.setCustomValidity('')" onkeypress="return /[A-Za-z- ]/i.test(event.key)" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="pass">Password</label>
                                            <input class="form-control py-4" id="pass" name="password" type="password" minlength="5" maxlength="10" placeholder="Masukkan Password" required />
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <input type="submit" name="login" class="btn btn-primary w-100" value="Masuk" />
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_POST['login'])) {
                                        session_start();
                                        $password = md5($_POST['password']);
                                        $cekAkun = mysqli_query($db, "SELECT * FROM `tbl_admin` WHERE `username` = '$_POST[username]' AND `password` = '$password'");
                                        if (mysqli_num_rows($cekAkun) > 0) {
                                            $data = mysqli_fetch_array($cekAkun);
                                            $_SESSION['role'] = 'Admin';
                                            echo "<meta http-equiv='refresh' content='0; url=dashboard.php'>";
                                        }
                                    }
                                    ?>
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
    <script src="../js/scripts.js"></script>
</body>

</html>