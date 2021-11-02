<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>

<body>
    <form action="#" method="post">
        Nilai 2 poin :
        <input type="number" name="2poin" id="2poin" oninput="tambahField('2poin')"><br />
        <div id="field_2poin"></div><br />
        Nilai 1 poin :
        <input type="number" name="1poin" id="1poin" oninput="tambahField('1poin')"><br />
        <div id="field_1poin"></div><br />
        Nilai 0 poin :
        <input type="number" name="0poin" id="0poin" oninput="tambahField('0poin')"><br />
        <div id="field_0poin"></div><br />
        <input type="submit" value="Tambah" name="tambah">
    </form>
    <?php
    if (isset($_POST['tambah'])) {
        $point2 = implode("#", $_POST['pgBenar2poin']);
        $point1 = implode("#", $_POST['pgBenar1poin']);
        $point0 = implode("#", $_POST['pgBenar0poin']);
        $penilaian = $point2 . "|" . $point1 . "|" . $point0;
        echo $penilaian . "<br/>";
        $ekstrak1 = explode("|", $penilaian);
        $poin2 = explode("#", $ekstrak1[0]);
        $poin1 = explode("#", $ekstrak1[1]);
        $poin0 = explode("#", $ekstrak1[2]);
        print_r($poin2);
        echo "<br/>";

        $poin = 0;
        $cari = strtolower("Arah / letak");
        if (in_array($cari, array_map("strtolower", $poin2))) {
            $poin = 2;
        } else if (in_array($cari, array_map("strtolower", $poin1))) {
            $poin = 1;
        } else if (in_array($cari, array_map("strtolower", $poin0))) {
            $poin = 0;
        }
        echo $poin;
    }
    ?>
</body>

</html>
<script>
    function tambahField(namaId) {
        var val = document.getElementById(namaId).value;
        var str = "";
        for (i = 0; i < val; i++) {
            str += "Jawaban Benar [" + (i + 1) + "]:<br/><input type='text' name='pgBenar" + namaId + "[]' class='form-control col-lg-6 col-md-12'/><br/>";
        }
        if (namaId == "2poin") document.getElementById('field_2poin').innerHTML = str;
        else if (namaId == "1poin") document.getElementById('field_1poin').innerHTML = str;
        if (namaId == "0poin") document.getElementById('field_0poin').innerHTML = str;
    }
</script>