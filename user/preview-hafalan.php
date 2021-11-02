<?php
include("../koneksi.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Mulai Tes</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/sticky-navbar-footer.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .form-control:focus {
            border-color: #ff0000;
            box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset, 0px 0px 8px rgba(255, 100, 255, 0.5);
        }
    </style>
</head>

<body>
    <?php
    $getDataSubtes = mysqli_query($db, "SELECT * FROM `tbl_subtes` WHERE `id_subtes` = '13'");
    if (mysqli_num_rows($getDataSubtes) > 0) {
        $dataSubtes = mysqli_fetch_array($getDataSubtes);
    ?>
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1 mx-auto">IST - <?= $dataSubtes['nama_subtes'] ?></span>
            </div>
        </nav>
        <div class="container mt-1">
            <div class="card my-auto">
                <div class="card-header d-flex">
                    <div class="pr-2 flex-fill">IST - <?= $dataSubtes['nama_subtes'] ?></div>
                    <div class="pl-2 pr-2 flex-fill text-right" id="timer">00:00:00</div>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($dataSubtes['soal_hafalan'])) echo $dataSubtes['soal_hafalan'];
                    ?>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <script>
        function numberTwoLength(j) {
            return ('0' + j).slice(-2);
        }
        // set jadwal event
        var countDownDate = new Date(<?php echo "'" . date("M j, Y H:i:s") . "'"; ?>).getTime() + (<?php echo $dataSubtes['timer_hafalan']; ?> * 60000);

        var x = setInterval(function() {

            // tanggal sekarang
            var now = new Date().getTime();

            // hitung perbedaan jarak waktu
            var distance = countDownDate - now;

            // hitungan waktu untuk jam, menit, dan detik
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("timer").innerHTML = numberTwoLength(hours) + ":" +
                numberTwoLength(minutes) + ":" + numberTwoLength(seconds);

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById('timer').innerHTML = "EXPIRED";
                <?php
                echo 'window.location.href = "preview-contoh.php?jenis_tes=IST&id_subtes=13";';
                ?>
            }
        }, 1000);
    </script>

</body>

</html>