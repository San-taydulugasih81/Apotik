<?php
include '../config.php';

if (isset($_POST['simpan'])) {
    $namabarang = $_POST['namabarang'];
    $merk = $_POST['merk'];
    $satuanbarang = $_POST['satuanbarang'];
    $stok = $_POST['stok'];
    $koneksi->query("INSERT INTO barang (namabarang, merk, satuanbarang, stok) VALUES ('$namabarang','$merk','$satuanbarang','$stok')");
    header("location:index.php");
}

if (isset($_GET['delete'])) {
    $idBarang = $_GET['delete'];
    $koneksi->query("DELETE FROM barang WHERE idBarang = '$idBarang'");
    header("location:index.php");
}

if (isset($_POST['editposting'])) {
    $namabarang = $_POST['namabarang'];
    $merk = $_POST['merk'];
    $satuanbarang = $_POST['satuanbarang'];
    $stok = $_POST['stok'];
    $koneksi->query("UPDATE barang SET namabarang='$namabarang', merk='$merk', satuanbarang='$satuanbarang', stok='$stok' WHERE namabarang='$namabarang'");
    header("location:index.php");
}
?>
