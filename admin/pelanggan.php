<?php
$page = "Pelanggan";
$startpage = "Master Data";
require '../controller/ControllerPelanggan.php';
require '../controller/ControllerUser.php';
require '../controller/sessionoff.php';
$query = tampildata("SELECT * FROM tpelanggan ");
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
                    <h1 class="mt-4"><?=$page?></h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><?=$startpage?> / <?=$page?></li>
                    </ol>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah
                        Data</button>

                    <div class="card mb-4 mt-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data <?=$page?>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No Customer</th>
                                        <th class="text-center">Nama Pelanggan</th>
                                        <th>No Handphone</th>
                                        <th>Email</th>
                                        <th>Pekerjaan</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($query as $row): ?>
                                    <tr>
                                        <td><?=$row['nocustomer']?></td>
                                        <td><?=$row['namapelanggan']?></td>
                                        <td><?=$row['hp']?></td>
                                        <td class="text-center"><?=$row['email']?></td>
                                        <td><?=$row['pekerjaan']?></td>
                                        <td class="text-center">
                                            <?php 
                                            if($row['statuspelanggan']==1){
                                                echo "<span class='badge bg-success'>active</span>";
                                            }
                                            else{
                                                echo "<span class='badge bg-danger'>non active</span>";
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#edit<?=$row['id']?>">Edit</button>
                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapus<?=$row['id']?>">Hapus</button>
                                            <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#suspend<?=$row['id']?>">Suspend</button>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="edit<?=$row['id']?>" tabindex="-1"
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
                                                    <input type="hidden" name="id" value="<?=$row['id']?>">
                                                    <input type="hidden" name="nouser" value="<?=$row['nocustomer']?>">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="nemalengkap" class="form-label">Nama
                                                                Lengkap</label>
                                                            <input type="text" required class="form-control"
                                                                value="<?=$row['namapelanggan']?>" id="namalengkap"
                                                                name="namalengkap">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" required class="form-control" id="email"
                                                                value="<?=$row['email']?>" name="email">
                                                        </div>
                                                        <div class="mb3">
                                                            <label for="nohp" class="form-label">NoHP</label>
                                                            <input type="number" required class="form-control"
                                                                value="<?=$row['hp']?>" name="nohp" id="nohp">
                                                        </div>
                                                        <div class="mb3">
                                                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                                            <Select required name="pekerjaan" id="pekerjaan "
                                                                class="form-select">
                                                                <option selected value="<?=$row['pekerjaan']?>">
                                                                    <?=$row['pekerjaan']?>"
                                                                </option>
                                                                <option value="Siswa/Mahasiswa">Siswa/Mahasiswa</option>
                                                                <option value="Guru/Dosen">Guru/Dosen</option>
                                                                <option value="Umum">Umum</option>
                                                            </Select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" name="ubah" class="btn btn-primary">Simpan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapus<?=$row['id']?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus <?=$page?>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id" value="<?=$row['id']?>">
                                                    <input type="hidden" name="nouser" value="<?=$row['nocustomer']?>">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="nama" class="form-label">Nama</label>
                                                            <input type="text" class="form-control" id="nama"
                                                                name="nama" value="<?=$row['namapelanggan']?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" name="hapuspermanent"
                                                            class="btn btn-danger">Hapus
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Suspend -->
                                    <div class="modal fade" id="suspend<?=$row['id']?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suspend <?=$page?>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id" value="<?=$row['id']?>">
                                                    <input type="hidden" name="nouser" value="<?=$row['nocustomer']?>">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="kategori" class="form-label">Nama
                                                                Pelanggan</label>
                                                            <input type="text" readonly class="form-control"
                                                                name="kategori" value="<?=$row['namapelanggan']?>"
                                                                id="kategori">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" name="suspend"
                                                            class="btn btn-danger">Suspend
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
                    <h5 class="modal-title" id="exampleModalLabel">Peminjaman buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nocustomer" class="form-label">No Customer</label>
                            <input type="text" class="form-control" readonly value="<?=date('Y'),rand(11111,99999)?>"
                                id="nocustomer" name="nocustomer">
                        </div>
                        <div class="mb-3">
                            <label for="nemalengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" required class="form-control" id="namalengkap" name="namalengkap">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" required class="form-control" id="email" name="email">
                        </div>
                        <div class="mb3">
                            <label for="nohp" class="form-label">NoHP</label>
                            <input type="number" required class="form-control" name="nohp" id="nohp">
                        </div>
                        <div class="mb3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <Select required name="pekerjaan" id="pekerjaan" class="form-select">
                                <option value="Siswa/Mahasiswa">Siswa/Mahasiswa</option>
                                <option value="Guru/Dosen">Guru/Dosen</option>
                                <option value="Umum">Umum</option>
                            </Select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan </button>
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