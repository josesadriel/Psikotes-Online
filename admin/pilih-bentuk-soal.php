<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("header.php");
    ?>
    <title>Pilih Bentuk Soal</title>
</head>

<body class="sb-nav-fixed">
    <?php
    include("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Pilih Bentuk Soal</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="kelola-soal.php">Kelola Soal</a></li>
                    <li class="breadcrumb-item active">Pilih Bentuk Soal</li>
                </ol>
                <div class="card mb-4 mt-2">
                    <div class="card-header">
                        Pilih Bentuk Soal
                    </div>
                    <div class="card-body">
                        <select name="bentuk_soal" class="form-control col-6" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                            <option value="" selected disabled>-</option>
                            <option value="add-soal-cfit.php">CFIT</option>
                            <option value="add-soal-ist.php">IST</option>
                            <option value="add-soal-papi.php">PAPI KOSTICK</option>
                        </select><br />
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