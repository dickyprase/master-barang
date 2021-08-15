<?php 

function prefix_id_brg() {
    global $connect;
    
    $query = "SELECT max(id_barang) as maxKode FROM barang";
    $hasil = mysqli_query($connect,$query);
    $data = mysqli_fetch_array($hasil);
    $idBarang = $data['maxKode'];

    $noUrut = (int) substr($idBarang, 3, 3);

    $noUrut++;

    $char = "BRG";
    $idBarang = $char . sprintf("%03s", $noUrut);
    return $idBarang;
}

function prefix_kode_barcode() {
    global $connect;

    $query = "SELECT max(kode_barcode) as maxKode FROM barang";
    $hasil = mysqli_query($connect,$query);
    $data = mysqli_fetch_array($hasil);
    $kodeBarcode = $data['maxKode'];

    $noUrut = (int) substr($kodeBarcode, 6, 3);

    $noUrut++;

    $char = "112233";
    $kodeBarcode = $char . sprintf("%03s", $noUrut);
    return $kodeBarcode;
}

function gambar(){

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];
  
    if ($error == 4) {
        echo '<script>alert("Data gambar gagal ditambahkan"); </script>';
        echo "<script> window.location.href = 'produk.php'; </script>";
        return false;
    }
  
    $extValid = ['jpg', 'jpeg', 'png'];
    $extGambar = explode('.', $namaFile);
    $extGambar = strtolower(end($extGambar));
    if (!in_array($extGambar, $extValid)) {
        echo '<script> alert("your file is not image file");</script>';
        echo "<script> window.location.href = 'produk.php'; </script>";
        return false;
    }
  
    if ($ukuranFile > 5000000) {
        echo '<script>alert("Size gambar terlalu besar"); </script>';
        echo "<script> window.location.href = 'produk.php'; </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extGambar;
  
    move_uploaded_file($tmpName, 'img/barang/' . $namaFileBaru);
    return $namaFileBaru;
  
}

