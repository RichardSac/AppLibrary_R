<?php
require 'koneksi.php';

// Created
if (isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $kontrak = $_POST['kontrak'];
    $insert = mysqli_query($koneksi, "INSERT INTO tpenerbit (namapenerbit, alamat, telepon, email, website, kontrak)
    VALUES ('$nama', '$alamat','$nohp', '$email', '$website', '$kontrak') ");
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
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $kontrak = $_POST['kontrak'];
    $update = mysqli_query($koneksi, "UPDATE tpenerbit SET 
    namapenerbit='$nama', alamat='$alamat',telepon='$nohp', email='$email', website='$website', kontrak='$kontrak'  WHERE id='$id'");
}

//Delete Permanentn
if (isset($_POST['hapus'])){
    $id = $_POST['id'];
    $delete = mysqli_query($koneksi, "DELETE FROM tpenerbit WHERE
    id='$id'");
}

?>