<?php
include("../koneksi.php");
$id = $_GET['id'];
$deleteSql = mysqli_query($db, "DELETE FROM `tbl_grup` WHERE id_grup = '$id'");
if ($deleteSql) header('Location: kelola-grup.php');
?>