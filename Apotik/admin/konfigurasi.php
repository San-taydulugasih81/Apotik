<?php
include '../config.php';

if (isset($_POST['simpan'])) {
    $namapegawai = $_POST['namapegawai'];
    $password = $_POST['password'];
    $gaji = $_POST['gaji'];
    $level = $_POST['level'];
    $koneksi->query("INSERT INTO pegawai (namapegawai, password, gaji, level) VALUES ('$namapegawai','$password','$gaji','$level')");
    header("location:index.php");
}

if (isset($_GET['delete'])) {
    $idPegawai = $_GET['delete'];
    $koneksi->query("DELETE FROM pegawai WHERE idPegawai = '$idPegawai'");
    header("location:index.php");
}

if (isset($_POST['editposting'])) {
    $namapegawai = $_POST['namapegawai'];
    $password = $_POST['password'];
    $gaji = $_POST['gaji'];
    $level = $_POST['level'];
    $koneksi->query("UPDATE pegawai SET namapegawai='$namapegawai', password='$password', gaji='$gaji', level='$level' WHERE namapegawai='$namapegawai'");
    header("location:index.php");
}
?>
