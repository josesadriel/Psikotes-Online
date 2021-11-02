<?php
include("koneksi.php");
?>
<html>

<head>
    <title>Tambah Soal DISC</title>
</head>

<body>
    <form action="#" method="post">
        Pernyataan 1:<br />
        <input type="text" name="pernyataan1" /><br />
        Pernyataan 2:<br />
        <input type="text" name="pernyataan2" /><br />
        Pernyataan 3:<br />
        <input type="text" name="pernyataan3" /><br />
        Pernyataan 4:<br />
        <input type="text" name="pernyataan4" /><br />

        <input type="submit" value="Submit" name="submit" />
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $inputSql = mysqli_query($db, "INSERT INTO `soal_disc` (pernyataan_1, pernyataan_2, pernyataan_3, pernyataan_4) VALUES ('$_POST[pernyataan1]', '$_POST[pernyataan2]', '$_POST[pernyataan3]', '$_POST[pernyataan4]')");
        if ($inputSql) echo "berhasil";
    }
    ?>
</body>

</html>