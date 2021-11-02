 <?php
   include("../koneksi.php");
   if (isset($_GET['id']) && isset($_GET['tipe'])) {
      $id = $_GET['id'];
      if ($_GET['tipe'] == "soal") {
         $deleteSql = mysqli_query($db, "DELETE FROM `tbl_soal` WHERE id_soal = '$id'");
      } else if ($_GET['tipe'] == "contoh") {
         $deleteSql = mysqli_query($db, "DELETE FROM `tbl_contohsoal` WHERE id_soal = '$id'");
      }
      if ($deleteSql) header('Location: kelola-soal.php');
   } else header('Location: kelola-soal.php');
   ?>