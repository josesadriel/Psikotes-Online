<?php
include("../koneksi.php");
$id = $_GET['id'];
$deleteSql = mysqli_query($db, "DELETE FROM `tbl_jenistes` WHERE id_jenistes = '$id'");
if ($deleteSql) header('Location: kelola-jenis-tes.php');
?>