<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>
    <?php
    $sql = "INSERT INTO `soal_papi`(`pernyataan1`, `pernyataan2`) VALUES ";
    for ($i = 1; $i <= 90; $i++) {
        $sql .= "('Pernyataan " . $i . "A', 'Pernyataan " . $i . "B'), ";
    }
    echo $sql;
    ?>
</body>

</html>