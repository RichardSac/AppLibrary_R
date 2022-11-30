<?php 
require 'koneksi.php';
session_start();
if(isset($_POST['login'])){
    $username = mysqli_escape_string($koneksi, $_POST['username']);
    $password = mysqli_escape_string($koneksi, $_POST['password']);
    $md5 = md5($password);
    $cek_user = mysqli_query($koneksi, "SELECT * FROM tuser WHERE username='$username' AND password='$md5'");
    $data_user = mysqli_fetch_array($cek_user);
    $role = $data_user['role'];
    if($role=="admin"){
        $_SESSION["namalengkap"] = $data_user['namalengkap'];
        $_SESSION["nouser"] = $data_user['nouser'];
        $_SESSION["username"] = $data_user['username'];
        echo "<script type='text/javascript'>alert('Selamat Anda Berhasil Login');
        document.location='../admin/home.php'</script>";
    }else if($role=="User"){
        echo "<script type='text/javascript'>alert('Selamat Anda Berhasil Login');
        document.location='../user/home.php'</script>";
    }else{
        echo "<script type='text/javascript'>alert('Akun Anda Tidak Terdaftar !!!');
        document.location='../index.php'</script>";
    }
}
?>