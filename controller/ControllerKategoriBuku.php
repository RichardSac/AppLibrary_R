<?php
require 'koneksi.php';
require 'ControllerUser.php';
require 'sessionoff.php';
// Created
if (isset($_POST['simpan'])){
    $kategori = $_POST['kategori'];
$insert = mysqli_query($koneksi, "INSERT INTO tkategoribuku (kategoribuku)
VALUES ('$kategori') ");
if($insert){
    $_SESSION["sukses"] = 'Data Berhasil Disimpan';
   }else{
       header('Location: user.php');   
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
$waktu = date('Y-m-d H:i:s');
$status = $_POST['status'];
$update = mysqli_query($koneksi, "UPDATE tkategoribuku SET
kategoribuku='$kategori', update_at='$waktu', statuskategori='$status' WHERE idkategoribuku='$id'");
if($update){
    $_SESSION["ubah"] = 'Data Berhasil Disimpan';
   }else{
       header('Location: user.php');   
   }
}

//Delete Temporary
if (isset($_POST['hapus'])){
$id = $_POST['id'];
$status = '0';
$waktu = date('Y-m-d H:i:s');
$delete = mysqli_query($koneksi, "UPDATE tkategoribuku SET statuskategori='$status',
delete_at='$waktu' WHERE idkategoribuku='$id'");
}

//Delete Permanentn
if (isset($_POST['hapuspermanent'])){
$id = $_POST['id'];
$delete = mysqli_query($koneksi, "DELETE FROM tkategoribuku WHERE
idkategoribuku='$id'");
if($delete){
    $_SESSION["hapus"] = 'Data Berhasil Dihapus';
   }else{
       header('Location: user.php');   
   }
}
if (isset($_POST['simpandenda'])){
    $hari = $_POST['hari'];
    $data=implode(",",$hari);
    $insert = mysqli_query($koneksi, "INSERT INTO tdenda (hari) 
    VALUES('$data')");
}
?>