<?php
include("../koneksi.php");
$id = $_GET['id'];
$deleteSql = mysqli_query($db, "DELETE FROM `tbl_event` WHERE id_event = '$id'");
if ($deleteSql) header('Location: kelola-event.php');
