<?php
$hostname = "Localhost";
$username = "root";
$password = "";
$db = "db_latihan";
$koneksi = mysqli_connect($hostname, $username, $password, $db);

if(isset($_POST['register'])){
    $nama = $_POST['namapengguna'];
    $username = $_POST['usernameemail'];
    $password = $_POST['password'];
    $date = $_POST['tanggal'];
    $md5 = md5($password);
    $insert = mysqli_query($koneksi, "INSERT INTO tuser (namapengguna, email, password, birthday)
    VALUES ('$nama','$username','$md5','$date')");
    header('location: login.php');
}

if(isset($_POST['login'])){
    $username = mysqli_escape_string($koneksi, $_POST['usernameemail']);
    $password = mysqli_escape_string($koneksi, $_POST['password']);
    $md5 = md5($password);
    $cek_user = mysqli_query($koneksi, "SELECT * FROM tuser WHERE email='$username' AND password='$md5'");
    $data = mysqli_fetch_array($cek_user);
    if($data['email']=!NULL & $data['password']=!NULL){
        echo"<script type='text/javascript'>alert('Selamat Anda Berhasil Login');
        document.location='updatepassword.php'</script>";
    }else{
        echo"<script type='text/javascript'>alert('Username/Password yang anda masukkan salah,mohon coba lagi');
        document.location='login.php'</script>";
    }
}
?>