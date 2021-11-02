<?php
include("../koneksi.php");

if (isset($_POST['userid'])) {
    $result = mysqli_query($db, "SELECT * FROM `tbl_user` WHERE id_user='$_POST[userid]'");
    while ($data = mysqli_fetch_array($result)) {
        $perusahaan = (isset($data['perusahaan'])) ? $data['perusahaan'] : null;
        $kode = strtoupper(substr($data['nama'], 0, 2)) . sprintf("%03s", $data['id_user']);
        $response = '
    <table>
        <tr>
            <td>Kode Akses</td>
            <td>: ' . $kode . '</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>: ' . $data['nama'] . '</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: ' . $data['gender'] . '</td>
        </tr>
        <tr>
            <td>E-Mail</td>
            <td>: ' . $data['email'] . '</td>
        </tr>
        <tr>
            <td>No. HP</td>
            <td>: ' . $data['noHp'] . '</td>
        </tr>
        <tr>
            <td>Profesi</td>
            <td>: ' . $data['profesi'] . '</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: ' . $data['jabatan'] . '</td>
        </tr>';
        if ($data['keperluan'] == "Perusahaan") {
            $response .= '
            <tr>
                <td>Perusahaan</td>
                <td>: ' . $data['perusahaan'] . '</td>
            </tr>
            ';
        }
        $response .= '</table><br/>';
        if ($data['status'] == "Belum Aktif") {
            $response .= '
        <form action="#" method="POST">
            <input type="hidden" name="id_user" value="' . $data['id_user'] . '"/>
            <input type="hidden" name="status" value="Aktif"/>
            <input type="submit" name="updateStatus" class="btn btn-block btn-success" value="Aktifkan"/>
        </form>
        ';
        }
    }
    echo $response;
    exit;
}
