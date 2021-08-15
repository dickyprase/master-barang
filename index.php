<?php include('header.php'); ?>

<div class="container">
<form action="" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="id" class="form-label">ID Barang</label>
        <input name="id" type="text" class="form-control" id="id" value="<?= prefix_id_brg() ?>" readonly >
    </div>
    <div class="mb-3">
        <label for="kode_barcode" class="form-label">Kode Barcode</label>
        <input name="kode_barcode" type="text" class="form-control" id="kode_barcode" value="<?= prefix_kode_barcode() ?>" readonly>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Barang</label>
        <input name="nama" type="text" class="form-control" id="nama">
    </div>
    <div class="mb-3">
        <label for="hrg_beli" class="form-label">Harga Beli</label>
        <input name="hrg_beli" type="number" class="form-control" id="hrg_beli">
    </div>
    <div class="mb-3">
        <label for="hrg_jual" class="form-label">Harga Jual</label>
        <input name="hrg_jual" type="number" class="form-control" id="hrg_jual">
    </div>
    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar </label><br>
        <input type="file" name="gambar" class="form-control-file" id="gambar">
    </div>


  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<?php 

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $kode_barcode = $_POST['kode_barcode'];
    $nama = $_POST['nama'];
    $hrg_beli = $_POST['hrg_beli'];
    $hrg_jual = $_POST['hrg_jual'];

    $gambar = gambar();
    $img_barcode = $kode_barcode. ".png";

    $cek = mysqli_query($connect,"SELECT * FROM barang WHERE kode_barcode='$kode_barcode'");
    $res = mysqli_num_rows($cek);
    if ($res>0) {
        echo "<script>alert('Kode barcode sudah tersedia, silahkan buat yang lain.'); window.history.go(-1);</script>";
        die();
    }

    $tempdir="img/barcode/";
      if (!file_exists($tempdir))
      mkdir($tempdir, 0755);
      $target_path=$tempdir . $kode_barcode . ".png";

      $fileImage="http://localhost:3000".dirname($_SERVER['PHP_SELF']) . "/barcode.php?text=" . $kode_barcode . "&codetype=code128&print=true&size=55";
      $content=file_get_contents($fileImage);
      file_put_contents($target_path, $content);

    $sql = "INSERT INTO barang values('$id','$kode_barcode','$img_barcode','$nama','$hrg_beli','$hrg_jual','$gambar')";
    $input = mysqli_query($connect,$sql);

    if($input){
        echo "<script>alert('Data berhasil disimpan'); window.location.href='index.php';</script>";
    }else{
        echo "<script>alert('Data gagal disimpan'); window.history.go(-1);</script>";
    }


}

?>
<?php include('footer.php') ?>