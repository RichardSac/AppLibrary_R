<?php
$page = "Kategori Buku";
$startpage = "Master Data";
$url = "http://localhost/appbootcamp/admin/restapi.php?function=get_kategoribuku";
$curl = curl_init(); 
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
$response = curl_exec($curl);
curl_close($curl);
$dataapi = json_decode($response,1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../">
    <?php
       require 'header.php';
       ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah
                        Data</button>
                    <button type="button" onclick="window.print()">Test</button>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit">Edit</button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus">Hapus</button>

                    <div class="card mb-4 mt-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data <?=$page?>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Create</th>
                                        <th class="text-center">Update</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php foreach($dataapi as $row){
                                        echo '<td>'.$row->kategoribuku.'</td>';
                                    } ?>
                                    <tr>

                                        <td class="text-center">
                                            <?php 
                                            if($row['statuskategori']==1){
                                                echo "<span class='badge bg-success'>active</span>";
                                            }
                                            else{
                                                echo "<span class='badge bg-danger'>non active</span>";
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center"><?=$row['create_at']?></td>
                                        <td class="text-center"><?=$row['update_at']?></td>
                                        <td class="text-center">
                                            <button class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#edit">Edit</button>
                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapus<?=$row['idkategoribuku']?>">Hapus</button>
                                        </td>
                                    </tr>
                                    <?php ?>
                                    <!-- Modal EDIT-->

                                    <!-- Modal delete-->


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
    <?php if(@$_SESSION['sukses']){ ?>
    <script>
    swal("Good job!", "<?php echo $_SESSION['sukses']; ?>", "success");
    </script>
    <?php unset($_SESSION['sukses']); } ?>

    <?php if(@$_SESSION['ubah']){ ?>
    <script>
    swal("Good job!", "<?php echo $_SESSION['ubah']; ?>", "warning");
    </script>
    <?php unset($_SESSION['ubah']); } ?>

    <?php if(@$_SESSION['hapus']){ ?>
    <script>
    swal("Good job!", "<?php echo $_SESSION['hapus']; ?>", "error");
    </script>
    <?php unset($_SESSION['hapus']); } ?>
    <!-- modal edit -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perubahan <?=$page?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="admin/restapi.php?function=update_kategoribuku&id=42" method="POST">
                    <input type="hidden" name="id" value="42">
                    <input type="hidden" name="statuskategori" value="1">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kategoribuku" class="form-label">Kategori</label>
                            <input type="text" class="form-control" name="kategoribuku" id="kategoribuku">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="ubah" class="btn btn-primary">Simpan
                            Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal delete -->
    <div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus <?=$page?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="admin/restapi.php?function=delete_kategoribuku&id=31" method="POST">
                    <input type="hidden" name="id" value="31">
                    <input type="hidden" name="statuskategori" value="1">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kategoribuku" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategoribuku" name="kategoribuku">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="hapuspermanent" class="btn btn-danger">Hapus
                        </button>
                    </div>
                </form>
            </div>
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
                <form action="admin/restapi.php?function=add_kategoribuku" method="POST">
                    <input type="hidden" value="1" name="statuskategori">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kateogribuku" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategoribuku" name="kategoribuku">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" onclick="contoh()" class="btn btn-primary" name="simpan">Simpan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- <script type="text/javascript">
    // window.print();
    </script> -->
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