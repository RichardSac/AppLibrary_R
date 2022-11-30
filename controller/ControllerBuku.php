<?php
require 'koneksi.php';
require 'ControllerUser.php';
require 'sessionoff.php';
// Created
if (isset($_POST['simpan'])){
    $kategori = $_POST['kategori'];
    $judul = $_POST['judulbuku'];
    $eksetensi_diperbolehkan = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG');
    $namafile = $_FILES['coverbuku']['name'];
    $x = explode('.', $namafile);
    $eksetensi = strtolower(end($x));
    $ukuran = $_FILES['coverbuku']['size'];
    $file_temp = $_FILES['coverbuku']['tmp_name'];
    $generatename = uniqid(); // hgfhg123Abs334
    $namafile = $generatename;
    $namafile = $generatename.".".$eksetensi;

    if (in_array($eksetensi, $eksetensi_diperbolehkan) === true){
       if($ukuran < 200000){
        move_uploaded_file($file_temp, 'file/'. $namafile);
        $insert = mysqli_query($koneksi, "INSERT INTO tbuku (idkategoribuku, buku, 
        coverbuku) VALUES ('$kategori','$judul','$namafile') ");
       }else{
        $_SESSION["hapus"] = 'Ukuran Terlalu Besar';
        // echo "<script>alert('Ukuran File Lebih Dari 2 MB')</script>";
       }
    }else {
        $_SESSION["hapus"] = 'Eksetensi yang digunakan tidak cocok';
        //  echo "<script>alert('Ekstensi File Tidak Diperbolehkan (PNG, JPG)')</script>";
    }
   
}

//Read
function tampildata($query){
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows=[];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

// Update
if (isset($_POST['ubah'])){
    $id = $_POST['id'];
    $kategori = $_POST['kategori'];
    $waktu = date('Y-m-d  H:i:s');
    $update = mysqli_query($koneksi, "UPDATE tkategoribuku SET 
    kategoribuku='$kategori', update_at='$waktu' WHERE idkategoribuku='$id'");
}

//Delete Temporary
if (isset($_POST['hapus'])){
    $id = $_POST['id'];
    $status = '0';
    $delete = mysqli_query($koneksi, "UPDATE tbuku SET statusbuku='$status' WHERE idbuku='$id'");
}

//Delete Permanentn
if (isset($_POST['hapuspermanent'])){
    $id = $_POST['id'];
    $delete = mysqli_query($koneksi, "DELETE FROM tkategoribuku WHERE
    idkategoribuku='$id'");
}

if(isset($_POST['simpanstock'])){
    $tanggal = $_POST['tanggal'];
    $stock = $_POST['stock'];
    $stockawal = $_POST['stockawal'];
    $id = $_POST['id'];
    $stockakhir = $stock + $stockawal;
    $insert = mysqli_query($koneksi, "INSERT INTO tbukustock (idbuku, tanggal, masuk) 
    Values ('$id','$tanggal','$stock')");
    $update = mysqli_query($koneksi, "UPDATE tbuku SET stockakhir='$stockakhir' WHERE idbuku='$id'");
}

if(isset($_POST['ubahstock'])){
    $idbuku = $_POST['idbuku'];
    $idstock = $_POST['idstock'];
    $stockawal = $_POST['stockawal'];
    $jumlahawal = $_POST['jumlahawal'];
    $masuk = $_POST['masuk'];
    $stockakhir = $masuk - $jumlahawal + $stockawal;
    $updatestockakhir = mysqli_query($koneksi, "UPDATE tbuku SET stockakhir='$stockakhir' 
    WHERE idbuku='$idbuku'");
    $update = mysqli_query($koneksi, "UPDATE tbukustock SET masuk='$masuk'
    WHERE id='$idstock'");
}

if(isset($_POST['hapusstock'])){
    $idbuku = $_POST['idbuku'];
    $idstock = $_POST['idstock'];
    $stockawal = $_POST['stockawal'];
    $jumlahawal = $_POST['jumlahawal'];
    $masuk = $_POST['masuk'];
    $stockakhir = $stockawal - $masuk;
    $updatestockakhir = mysqli_query($koneksi, "UPDATE tbuku SET stockakhir='$stockakhir' 
    WHERE idbuku='$idbuku'");
    $update = mysqli_query($koneksi, "DELETE FROM tbukustock
    WHERE id='$idstock'");
}
?>