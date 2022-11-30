<?php
require 'koneksi.php';
require 'ControllerUser.php';
require 'sessionoff.php';
// Created
if (isset($_POST['simpan'])){
    $kategori = $_POST['kategori'];
    $insert = mysqli_query($koneksi, "INSERT INTO tkategoribuku (kategoribuku) 
    VALUES ('$kategori') ");
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
    $status = $_POST['status'];
    $update = mysqli_query($koneksi, "UPDATE tkategoribuku SET 
    kategoribuku='$kategori', update_at='$waktu', statuskategori='$status' WHERE idkategoribuku='$id'");
}

//Delete Temporary
if (isset($_POST['hapus'])){
    $id = $_POST['id'];
    $status = '0';
     $waktu = date('Y-m-d  H:i:s');
    $delete = mysqli_query($koneksi, "UPDATE tkategoribuku SET statuskategori='$status',
    delete_at='$waktu' WHERE idkategoribuku='$id'");
}

//Delete Permanentn
if (isset($_POST['hapuspermanent'])){
    $id = $_POST['id'];
    $delete = mysqli_query($koneksi, "DELETE FROM tkategoribuku WHERE
    idkategoribuku='$id'");
}
?>