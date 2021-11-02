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

<?php
if (isset($_GET['id_subtes'])) {
    $getDataSubtes = mysqli_query($db, "SELECT * FROM `tbl_soal` INNER JOIN `tbl_subtes` ON tbl_soal.subtes = tbl_subtes.nama_subtes WHERE tbl_subtes.id_subtes = '$_GET[id_subtes]' LIMIT 1");
    if (mysqli_num_rows($getDataSubtes) > 0) {
        $dataSubtes = mysqli_fetch_array($getDataSubtes);
?>

        <body>
            <nav class="navbar navbar-dark bg-dark">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1 mx-auto"><?= "CFIT" . '-' . $dataSubtes['nama_subtes'] ?></span>
                </div>
            </nav>

            <div class="container-fluid mt-1">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="card my-auto">
                            <div class="card-header d-flex">
                                <div class="pr-2 flex-fill"><?= "CFIT" . '-' . $dataSubtes['nama_subtes'] ?></div>
                                <div class="pl-2 pr-2 flex-fill text-right" id="timer">00:00:00</div>
                            </div>
                            <?php
                            if (isset($_GET['id_subtes'])) {
                                // paging
                                $limit = 1; // berapa banyak soal yang akan ditampilkan
                                $hitungSoal = mysqli_query($db, "SELECT COUNT(tbl_soal.id_soal) AS 'jumlah' FROM `tbl_soal` INNER JOIN `tbl_jenistes` ON tbl_soal.jenis_tes = tbl_jenistes.nama_tes INNER JOIN `tbl_subtes` ON tbl_subtes.nama_subtes = tbl_soal.subtes WHERE tbl_jenistes.nama_tes = 'CFIT' AND tbl_subtes.id_subtes = '$_GET[id_subtes]'");
                                if (mysqli_num_rows($hitungSoal) > 0) {
                                    $getRow = mysqli_fetch_row($hitungSoal);
                                    $total_records = $getRow[0]; // ambil baris pertama dari hasil query
                                    $total_pages = ceil($total_records / $limit);
                                }
                                // selesai paging
                            ?>
                                <div class="card-body" id="isi-soal">Loading...</div>
                                <?php
                                //jika sudah klik submit jawaban
                                if (isset($_POST['submit_jawaban'])) {
                                }
                                ?>
                            <?php
                            }
                            ?>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="row justify-content-center">
                            <ul class="pagination justify-content-center" id="pagination">
                                <?php
                                if (!empty($total_pages)) {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == 1) {

                                ?>
                                            <li class='page-item active' id="<?php echo $i; ?>"><a href='ist.php?page=<?php echo $i; ?>' class='page-link'><?php echo $i; ?></a></li>
                                        <?php
                                        } else {
                                        ?>
                                            <li id="<?php echo $i; ?>" class='page-item'><a href='ist.php?page=<?php echo $i; ?>' class='page-link'><?php echo $i; ?></a></li>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </ul>
                            <script>
                                <?php
                                $jwb = mysqli_query($db, "
                                SET @urutan:=0;
                                SELECT tbl_soal.id_soal, tbl_soal.jenis_tes, tbl_soal.subtes, b.id_user, b.jawaban, (@urutan:= @urutan + 1) AS rowNumber FROM `tbl_soal` 
                                LEFT JOIN (SELECT * FROM `tbl_jwbuser` WHERE id_user = 1 ORDER BY added_at ASC) b ON tbl_soal.id_soal = b.id_soal 
                                WHERE tbl_soal.jenis_tes = 'CFIT' AND tbl_soal.subtes = 'Subtes 1'
                                ORDER BY tbl_soal.added_at ASC");
                                if (mysqli_num_rows($jwb) > 0) {
                                    while ($dJawaban = mysqli_fetch_array($jwb)) {
                                ?>
                                        $("a[href$='?page=<?= $dJawaban['rowNumber'] ?>']").addClass("bg-success");
                                <?php
                                    }
                                }
                                ?>
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        <script>
            $(document).ready(function() {
                $("#isi-soal").load("temp_data_soal_cfit.php?page=1&id_subtes=" + <?= $_GET['id_subtes']; ?>);
                $("#pagination li").on('click', function(e) {
                    e.preventDefault();
                    var id = $('input[type="number"][name="id"]').val();
                    var event = <?php echo $_GET['id_subtes']; ?>;
                    <?php
                    if ($dataSubtes['jumlah_benar'] == 1) {
                    ?>
                        var jawaban = $('input[type="radio"][name="jawaban"]:checked').val();
                    <?php
                    } else if ($dataSubtes['jumlah_benar'] > 1) {
                    ?>
                        var jawaban = [];
                        $(':checkbox:checked').each(function(i) {
                            jawaban[i] = $(this).val();
                        });
                        var jawabanText = jawaban.join("|");
                        if (jawaban.length > 2) alert('Hanya bisa memilih 2 option!');
                        if (jawaban.length == 2) {}
                    <?php
                    }
                    ?>
                    $("#isi-soal").html('loading...');
                    $("#pagination li").removeClass('active');
                    $(this).addClass('active');
                    var pageNum = this.id;
                    $("#isi-soal").load("temp_data_soal_cfit.php?page=" + pageNum + "&id_subtes=" + <?= $_GET['id_subtes']; ?>);
                });
            });
        </script>
<?php
    }
}
?>

</html>