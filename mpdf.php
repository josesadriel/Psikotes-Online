<?php
require_once __DIR__ . '/vendor/autoload.php';
include("koneksi.php");
ob_start();
?>

<html>

<body>
    <table border='1' bordercolor='#000' style='border-spacing:0'>
        <tr align='center'>
            <th>No</th>
            <th width='10%'>M</th>
            <th width='10%'>L</th>
            <th>Pernyataan</th>
        </tr>
        <?php
        $getSoal = mysqli_query($db, "SELECT * FROM `jawaban_disc` INNER JOIN `soal_disc` ON jawaban_disc.id_soal = soal_disc.id_soal WHERE jawaban_disc.id_user = '1'");
        if (mysqli_num_rows($getSoal) > 0) {
            while ($data = mysqli_fetch_array($getSoal)) {
        ?>
                <tr>
                    <td rowspan="4" align="center"><b><?= $data['id_soal'] ?></b></td>
                    <td style="margin:0" align="center">
                        <font color="red"><b><?= (($data['setuju'] == $data['pernyataan_1']) ? 'X' : '') ?></b></font>
                    </td>
                    <td style="margin:0" align="center">
                        <font color="red"><b><?= (($data['tidak_setuju'] == $data['pernyataan_1']) ? 'X' : '') ?></b></font>
                    </td>
                    <td style="margin:0"><?= $data['pernyataan_1'] ?></td>
                </tr>
                <tr>
                    <td style="margin:0" align="center">
                        <font color="red"><b><?= (($data['setuju'] == $data['pernyataan_2']) ? 'X' : '') ?></b></font>
                    </td>
                    <td style="margin:0" align="center">
                        <font color="red"><b><?= (($data['tidak_setuju'] == $data['pernyataan_2']) ? 'X' : '') ?></b></font>
                    </td>
                    <td style="margin:0"><?= $data['pernyataan_2'] ?></td>
                </tr>
                <tr>
                    <td style="margin:0" align="center">
                        <font color="red"><b><?= (($data['setuju'] == $data['pernyataan_3']) ? 'X' : '') ?></b></font>
                    </td>
                    <td style="margin:0" align="center">
                        <font color="red"><b><?= (($data['tidak_setuju'] == $data['pernyataan_3']) ? 'X' : '') ?></b></font>
                    </td>
                    <td style="margin:0"><?= $data['pernyataan_3'] ?></td>
                </tr>
                <tr>
                    <td style="margin:0" align="center">
                        <font color="red"><b><?= (($data['setuju'] == $data['pernyataan_4']) ? 'X' : '') ?></b></font>
                    </td>
                    <td style="margin:0" align="center">
                        <font color="red"><b><?= (($data['tidak_setuju'] == $data['pernyataan_4']) ? 'X' : '') ?></b></font>
                    </td>
                    <td style="margin:0"><?= $data['pernyataan_4'] ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding:15px"></td>
                </tr>
        <?php
            }
        }
        ?>
    </table>


</body>

</html>

<?php
$html = ob_get_contents();
ob_end_clean();

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetHTMLHeader('
<center>
    <h3>PERSONALITY SYSTEM ANALYSIS</h3>
</center><br/>');
$mpdf->WriteHTML($html);
$mpdf->Output();
?>