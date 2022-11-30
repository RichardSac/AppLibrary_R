<?php
$page = "Peminjaman Buku";
$startpage = "Master Data";
require '../controller/ControllerPeminjam.php';
require '../controller/ControllerUser.php';
require '../controller/sessionoff.php';
$query = tampildata("SELECT * FROM tpeminjaman");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../">
    <?php
       require 'header.php';
       ?>
</head>

<body class="sb-nav-fixed">

    <?php
   require 'navbar.php';
   ?>
    <div id="layoutSidenav">
        <?php
       require 'menu.php';
       ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4" onload="contoh()"><?=$page?></h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><?=$startpage?> / <?=$page?></li>
                    </ol>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Pinjam
                        Buku</button>

                    <div class="card mb-4 mt-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data <?=$page?>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nama Peminjam</th>
                                        <th>Email</th>
                                        <th>NoHP</th>
                                        <th>Buku</th>
                                        <th class="text-center">Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($query as $row): ?>
                                    <tr>
                                        <td><?=$row['namapeminjam']?></td>
                                        <td><?=$row['email']?></td>
                                        <td><?=$row['nohp']?></td>
                                        <td class="text-end"><?=$row['judulbuku']?></td>
                                        <td class="text-center">
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#edit<?=$row['idpinjam']?>">Kembalikan
                                                Buku</button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="edit<?=$row['idpinjam']?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Perubahan <?=$page?>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id" value="<?=$row['idpinjam']?>">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="status" value="1" id="flexCheckChecked" <?php if($row['statuspeminjam']=="0"){
                                                                        echo"Checked" ;
                                                                    }else{
                                                                        echo"";
                                                                    }
                                                                    ?>>
                                                                <label class="form-check-label" for="flexCheckChecked">
                                                                    <?php if($row['statuspeminjam']=="1"){
                                                                        echo"Active" ;
                                                                    }else{
                                                                        echo"Non-Active";
                                                                    }
                                                                    ?>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" name="ubah"
                                                                class="btn btn-primary">Simpan
                                                                Perubahan
                                                            </button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php
          require 'footer.php';
          ?>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah <?=$page?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="mb3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama">
                        </div>
                        <div class="mb3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="mb3">
                            <label for="nohp" class="form-label">No telepon</label>
                            <input type="number" class="form-control" name="nohp" id="nohp">
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Judul Buku</label>
                            <select name="kategori" id="kategori" class="form-select">
                                <option selected>Pilih</option>
                                <?php 
                                $data = mysqli_query($koneksi, "SELECT * FROM tbuku
                                WHERE statusbuku='1'");
                                $detail = mysqli_fetch_array($data);
                                ?>
                                <?php foreach ($data as $row): ?>
                                <option value="<?=$row['buku']?>">
                                    <?=$row['buku']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" onclick="contoh()" class="btn btn-primary" name="simpan">Pinjam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>