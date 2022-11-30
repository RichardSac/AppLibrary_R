<?php 
require '../controller/koneksi.php';
// GET DATA KATEGORI BUKU
if(function_exists($_GET['function'])){
    $_GET['function']();
}

function get_kategoribuku(){
    global $koneksi;
    $query = $koneksi->query("SELECT * FROM tkategoribuku");  //PHP versi 6
    //$query = mysqli_query($koneksi, "SELECT * FROM"); //PHP versi dibawah 5
    while($row=mysqli_fetch_object($query)){
        $data[] = $row;
    };
    $respons = array(
        'status'=>1,
        'message'=>'Success',
        'data'=>$data
    );
    header('Content-Type:application/json');
    echo json_encode($respons);
}

function get_kategoribuku_id(){
    global $koneksi;
    if(!empty($_GET["id"])){
        $id = $_GET["id"];
    }
    $query = "SELECT * FROM tkategoribuku WHERE idkategoribuku=$id";
    $result = $koneksi->query($query);
    while($row=mysqli_fetch_object($result)){
        $data[] = $row;
    }
    if($data){
        $respons = array(
            'status'=>1,
            'message'=>'Success',
            'data'=>$data
        );
    }else{
        $respons = array(
            'status'=>0,
            'message'=>'No Data Found',
            'data'=>$data
        );
    }
    header('Content-Type:application/json');
    echo json_encode($respons);
}

function add_kategoribuku(){
    global $koneksi;
    $check = array('kategoribuku'=>'', 'statuskategori'=>'');
    $match = count(array_intersect_key($_POST, $check));
    if($match == count($check)){
        $result = mysqli_query($koneksi, "INSERT INTO tkategoribuku SET 
        kategoribuku='$_POST[kategoribuku]',
        statuskategori='$_POST[statuskategori]'");
        if($result){
            $respons=array(
                'status'=>1,
                'message'=>'Insert Success'
            );
            header('location: view_kategoribuku.php');
        }else{
            $respons=array(
                'status'=>0,
                'message'=>'Insert Failed'
            );
        }
    }else{
        $respons=array(
            'status'=>0,
            'message'=>'Wrong Parameter'
        );
    }
    header('Content-Type:application/json');
    echo json_encode($respons);
}

function delete_kategoribuku(){
    global $koneksi;
    $id = $_GET['id'];
    $query = "DELETE FROM tkategoribuku WHERE idkategoribuku=".$id;
    if(mysqli_query($koneksi, $query)){
        $respons = array(
            'status'=>1,
            'message'=>'Delete Success'
        );
        header('location: view_kategoribuku.php');
    }else{
        $respons = array(
            'status'=>0,
            'message'=>'Delete fail'
        );
    }
    header('Content-Type:application/json');
    echo json_encode($respons);
}

function update_kategoribuku(){
    global $koneksi;
    if(!empty($_GET["id"])){
        $id = $_GET["id"];
    }
    $check = array('kategoribuku'=>'', 'statuskategori'=>'');
    $match = count(array_intersect_key($_POST, $check));
    if($match == count($check)){
        $result = mysqli_query($koneksi, "UPDATE tkategoribuku SET 
        kategoribuku='$_POST[kategoribuku]',
        statuskategori='$_POST[statuskategori]' WHERE idkategoribuku=$id");
        if($result){
            $respons=array(
                'status'=>1,
                'message'=>'Update Success',
            );
            header('location: view_kategoribuku.php');
        }else{
            $respons=array(
                'status'=>0,
                'message'=>'Update Failed',
            );
        }
    }else{
        $respons=array(
            'status'=>0,
            'message'=>'Wrong Parameter'
        );
    }
    header('Content-Type:application/json');
    echo json_encode($respons);
}
?>