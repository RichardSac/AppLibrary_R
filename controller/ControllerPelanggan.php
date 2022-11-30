<?php
require 'koneksi.php';

// Created
if (isset($_POST['simpan'])){
    $nocustomer = $_POST['nocustomer'];
    $namalengkap = $_POST['namalengkap'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    $pekerjaan = $_POST['pekerjaan'];
    $password = "admin";
    $md5 = md5($password);
    $role = "User";
    $insert = mysqli_query($koneksi, "INSERT INTO tpelanggan (nocustomer, namapelanggan, email, hp, pekerjaan) VALUES
    ('$nocustomer', '$namalengkap', '$email','$nohp','$pekerjaan')");
    $insertuser = mysqli_query($koneksi, "INSERT INTO tuser (nouser, namalengkap, username, password, role) 
    VALUES ('$nocustomer', '$namalengkap', '$email', '$md5', '$role')");
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
    $nouser = $_POST['nouser'];
    $namalengkap = $_POST['namalengkap'];
    $email = $_POST['email'];
    $hp = $_POST['nohp'];
    $pekerjaan = $_POST['pekerjaan'];
    $update = mysqli_query($koneksi, "UPDATE tpelanggan SET namapelanggan='$namalengkap', email='$email',
    hp='$hp', pekerjaan='$pekerjaan' WHERE id='$id'");
    $updateuser = mysqli_query($koneksi, "UPDATE tuser SET namalengkap='$namalengkap', username='$email' WHERE nouser='$nouser'");
}
// Suspend
if (isset($_POST['suspend'])){
    $id = $_POST['nouser'];
    $status = "0";
    $suspend = mysqli_query($koneksi, "UPDATE tpelanggan SET statuspelanggan='$status' WHERE nocustomer='$id'");
    $suspenduser = mysqli_query($koneksi, "UPDATE tuser SET status_user='$status' WHERE nouser='$id'");
    
}

//Delete Permanentn
if (isset($_POST['hapuspermanent'])){
    $id = $_POST['nouser'];
    $delete = mysqli_query($koneksi, "DELETE FROM tpelanggan WHERE
    nocustomer='$id'");
    $deleteuser = mysqli_query($koneksi, "DELETE FROM tuser WHERE
    nouser='$id'");
}
?>