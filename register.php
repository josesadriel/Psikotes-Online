<?php
include("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Register</h3>
                                </div>
                                <div class="card-body">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputNama">Nama Lengkap</label>
                                            <input class="form-control py-4" id="inputNama" name="namaLengkap" type="text" placeholder="Masukkan nama lengkap" minlength="3" maxlength="25" autofocus required oninvalid="this.setCustomValidity('Minimal terdiri dari 3 huruf')" oninput="this.setCustomValidity('')" onkeypress="return /[A-Za-z- ]/i.test(event.key)" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputGender">Jenis Kelamin</label>
                                            <select class="form-control" id="inputGender" name="gender" required>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputProfesi">Profesi</label>
                                            <select class="form-control" id="inputProfesi" name="profesi" required>
                                                <option value="" disabled selected>Pilih Profesi</option>
                                                <option value="Entrepreneur">Entrepreneur</option>
                                                <option value="Karyawan">Karyawan</option>
                                                <option value="Guru">Guru</option>
                                                <option value="Belum Bekerja">Belum Bekerja</option>
                                            </select>
                                            <!-- <input class="form-control py-4" id="inputProfesi" name="profesi" type="text" placeholder="Masukkan profesi" required /> -->
                                        </div>
                                        <div class="form-group" id="formJabatan">
                                            <label class="small mb-1" for="inputJabatan">Jabatan</label>
                                            <select class="form-control" id="inputJabatan" name="jabatan">
                                                <option value="" disabled selected>Pilih Jabatan</option>
                                                <option value="Administrasi">Administrasi</option>
                                                <option value="Manager">Manager</option>
                                                <option value="Operator">Operator</option>
                                                <option value="Sekretaris">Sekretaris</option>
                                                <option value="Staf">Staf</option>
                                            </select>
                                            <!-- <input class="form-control py-4" id="inputJabatan" name="jabatan" type="text" placeholder="Masukkan jabatan" oninvalid="this.setCustomValidity('Minimal terdiri dari 2 huruf dan maksimal 15 huruf!')" oninput="this.setCustomValidity('')" onkeypress="return /[A-Za-z- ]/i.test(event.key)" /> -->
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPTrakhir">Pendidikan Terakhir</label>
                                            <select class="form-control" id="inputPTrakhir" name="pendidikanTerakhir" required>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmail">Email</label>
                                            <input class="form-control py-4" id="inputEmail" name="email" type="email" placeholder="Masukkan alamat e-mail" required oninvalid="this.setCustomValidity('Masukkan @ pada alamat e-mail!')" oninput="this.setCustomValidity('')" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputNoHP">Nomor Handphone</label>
                                            <input class="form-control py-4" id="inputNoHP" name="noHP" type="text" placeholder="Masukkan nomor handphone" minlength="12" maxlength="12" required oninvalid="this.setCustomValidity('Nomor Handphone harus terdiri dari 12 digit!')" oninput="this.setCustomValidity('')" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputAcara">Tujuan</label>
                                            <select class="form-control" id="inputAcara" name="acara" required>
                                                <option value="" disabled selected>-</option>
                                                <?php
                                                $dataEvent = mysqli_query($db, "SELECT id_event, nama_event, tgl_mulai FROM `tbl_event` WHERE tgl_mulai >= DATE(NOW()) OR tgl_akhir >= DATE(NOW())");
                                                if (mysqli_num_rows($dataEvent) > 0) {
                                                    while ($data = mysqli_fetch_array($dataEvent)) {
                                                ?>
                                                        <option value="<?php echo $data['id_event']; ?>"><?php echo $data['nama_event']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputKeperluan">Keperluan</label>
                                            <select class="form-control" id="inputKeperluan" name="keperluan" required>
                                                <option value="Individu">Individu</option>
                                                <option value="Perusahaan">Perusahaan</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="namaPerusahaan" style="display:none">
                                            <label class="small mb-1" for="inputPerusahaan">Nama Perusahaan</label>
                                            <input type="text" name="perusahaan" id="inputPerusahaan" class="form-control" oninvalid="this.setCustomValidity('Minimal 6 huruf dan maksimal 24 huruf!')" oninput="this.setCustomValidity('')" onkeypress="return /[A-Za-z ]/i.test(event.key)">
                                        </div>
                                        <div class="form-group mt-4 mb-0">
                                            <input type="submit" name="register" class="btn btn-primary btn-block" value="Buat Akun" />
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_POST['register'])) {
                                        // buat password
                                        $cekUrutan = mysqli_query($db, "SELECT max(`id_user`) as urutan FROM `tbl_user`");
                                        $getUrutan = mysqli_fetch_array($cekUrutan);
                                        $urutan = $getUrutan['urutan']; //ambil hanya 3 angka dari kode
                                        $urutan++;
                                        $kode = strtoupper(substr($_POST['namaLengkap'], 0, 2)) . sprintf("%03s", $urutan); // buat 3 digit untuk urutan 001
                                        $password = md5($kode);
                                        //selesai buat password
                                        if ($_POST['keperluan'] == "Individu") {
                                            $inputData = mysqli_query($db, "INSERT INTO `tbl_user`(`nama`, `email`, `noHp`, `password`, `acara`, `keperluan`, `gender`, `profesi`, `jabatan`, `pendidikan_terakhir`) 
                                            VALUES ('$_POST[namaLengkap]','$_POST[email]','$_POST[noHP]','$password','$_POST[acara]','$_POST[keperluan]','$_POST[gender]', '$_POST[profesi]', '$_POST[jabatan]', '$_POST[pendidikanTerakhir]')");
                                            echo "INSERT INTO `tbl_user`(`nama`, `email`, `noHp`, `password`, `acara`, `keperluan`, `gender`, `profesi`, `jabatan`, `pendidikan_terakhir`) 
                                            VALUES ('$_POST[namaLengkap]','$_POST[email]','$_POST[noHP]','$password','$_POST[acara]','$_POST[keperluan]','$_POST[gender]', '$_POST[profesi]', '$_POST[jabatan]', '$_POST[pendidikanTerakhir]')";
                                        } else if ($_POST['keperluan'] == "Perusahaan") {
                                            $inputData = mysqli_query($db, "INSERT INTO `tbl_user`(`nama`, `email`, `noHp`, `password`, `acara`, `keperluan`, `gender`, `profesi`, `jabatan`, `pendidikan_terakhir`, `perusahaan`) 
                                            VALUES ('$_POST[namaLengkap]','$_POST[email]','$_POST[noHP]','$password','$_POST[acara]','$_POST[keperluan]','$_POST[gender]', '$_POST[profesi]', '$_POST[jabatan]', '$_POST[pendidikanTerakhir]', '$_POST[perusahaan]')");
                                            echo "INSERT INTO `tbl_user`(`nama`, `email`, `noHp`, `password`, `acara`, `keperluan`, `gender`, `profesi`, `jabatan`, `pendidikan_terakhir`, `perusahaan`) 
                                            VALUES ('$_POST[namaLengkap]','$_POST[email]','$_POST[noHP]','$password','$_POST[acara]','$_POST[keperluan]','$_POST[gender]', '$_POST[profesi]', '$_POST[jabatan]', '$_POST[pendidikanTerakhir]', '$_POST[perusahaan]')";
                                        }
                                        if ($inputData) {
                                            echo "<meta http-equiv='refresh' content='0; url=berhasil-register.php?nama=" . $_POST['namaLengkap'] . "&p=" . base64_encode($kode) . "'>";
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="login.php">Login sekarang!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-5">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Psikotes Online 2021</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
<script>
    $(document).ready(function() {
        $('#formJabatan').hide();
        $('#inputProfesi').on('change', function() {
            if (this.value == "Entrepreneur" || this.value == "Guru") {
                $('#inputJabatan').val($('#inputProfesi').find(":selected").text());
                $('#formJabatan').hide();
                $("#inputJabatan").prop('required', false);
            } else if (this.value != "Belum Bekerja") {
                $('#formJabatan').show();
                $('#inputJabatan').val('');
                $('#inputJabatan').attr('minlength', '2');
                $('#inputJabatan').attr('maxlength', '15');
                $('#inputJabatan').attr('required', "true");
                $("#inputJabatan").prop('required', true);
            } else {
                $('#formJabatan').hide();
                $('#inputJabatan').val('-');
                $('#inputJabatan').attr('minlength', '1');
                $("#inputJabatan").prop('required', false);
            }
        });
        $('#inputKeperluan').on('change', function() {
            if (this.value == "Perusahaan") {
                $('#namaPerusahaan').show();
                $("input[name='perusahaan']").attr('minlength', '6');
                $("input[name='perusahaan']").attr('maxlength', '24');
                $("input[name='perusahaan']").prop('required', true);
            } else {
                $('#namaPerusahaan').hide();
                $("input[name='perusahaan']").prop('required', false);
            }
        });
    });
    (function($) {
        $.fn.inputFilter = function(inputFilter) {
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        };
    }(jQuery));


    // Install input filters.
    $("#inputNoHP").inputFilter(function(value) {
        return /^-?\d*$/.test(value);
    });
</script>
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

</html>