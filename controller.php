<?php
require "connection.php";
mysqli_select_db($conn, "toko_galon");

// Aksi INSERT Kategori
if ($_GET["act"] == "tambah_barang") {
  $add = mysqli_query(
    $conn,
    "INSERT INTO tabel_databarang (nama_barang, tipe, ukuran, stok_barang, harga_barang, harga_distri)
     VALUES ('$_POST[namaBarang]', '$_POST[tipeBarang]', '$_POST[ukuranBarang]', 
    '$_POST[stokBarang]', '$_POST[hargaJual]', '$_POST[hargaToko]')"
  );

  if ($add) {
    echo "<script type='text/javascript'>
            alert('data telah berhasil di input');
            document.location='./databarang/databarang.php';
            </script>";
  } else {
    $notif = "Data gagal di input : ";
    $message = mysqli_error($conn);
    die("data gagal diinput: " . mysqli_error($conn));
  }
  mysqli_close($conn);
}

// Aksi EDIT Kategori
if ($_GET["act"] == "edit_barang") {
  $edit = mysqli_query(
    $conn,
    "UPDATE tabel_databarang SET nama_barang='$_POST[namaBarang]', tipe='$_POST[tipeBarang]',
     ukuran='$_POST[ukuranBarang]', stok_barang='$_POST[stokBarang]',
     harga_barang='$_POST[hargaJual]', harga_distri='$_POST[hargaToko]'
     WHERE id_barang='$_POST[idBarang]'"
  );

  if ($edit) {
    echo "<script type='text/javascript'>
            alert('data telah berhasil di edit');
            document.location='./databarang/databarang.php';
            </script>";
  } else {
    $notif = "Data gagal di edit : ";
    $message = mysqli_error($conn);
    die("data gagal diedit: " . mysqli_error($conn));
  }
  mysqli_close($conn);
}

// Aksi DELETE Kategori
if ($_GET["act"] == "delete_barang") {
  $delete = mysqli_query(
    $conn,
    "DELETE FROM tabel_databarang WHERE id_barang='$_GET[id]'"
  );

  if ($delete) {
    echo "<script type='text/javascript'>
            alert('data telah terhapus');
            document.location='./databarang/databarang.php';
            </script>";
  } else {
    die("data gagal dihapus: " . mysqli_error($conn));
  }
  mysqli_close($conn);
}

// Aksi INSERT penjualan
if ($_GET["act"] == "transaksi") {
  $add = mysqli_query(
    $conn,
    "INSERT INTO penjualan_air (nama_pembeli, id_barang, jumlah_beli) 
    VALUES ('$_POST[namaPembeli]', '$_POST[idBarang]', 
    '$_POST[jumlahBeli]')"
  );

  if ($add) {
    echo "<script type='text/javascript'>
            alert('Transaksi telah berhasil di input');
            document.location='./transaksi/transaksi.php';
            </script>";
  } else {
    $notif = "Data gagal di input : ";
    $message = mysqli_error($conn);
    die("data gagal diinput: " . mysqli_error($conn));
  }
  mysqli_close($conn);
}

// logout
if ($_GET["logout"] == true) {
  session_start();
  session_destroy();
  header("location: ./login/login.php");
}
