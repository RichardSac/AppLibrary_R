<?php
$page = "Kategori Buku";
$startpage = "Master Data";
require '../controller/ControllerKategoriBuku.php';
$query = tampildata ("SELECT * FROM tdenda");
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
                                        <th>Hari</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Create</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($query as $row): ?>
                                    <tr>
                                        <td><?=$row['hari']?></td>
                                        <td class="text-center">
                                            <?php 
                                            if($row['statusdenda']==1){
                                                echo "<span class='badge bg-success'>Active</span>";
                                            }
                                            else{
                                               echo "<span class='badge bg-danger'>Non Active</span>";
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center"><?=$row['create_at']?></td>
                                        <td class="text-center">
                                            <button class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#edit<?=$row['id']?>">Edit</button>
                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapus<?=$row['id']?>">Hapus</button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
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
                                                    <?php
                                                    $data=explode(",",$row['hari']);
                                                    ?>
                                                    <input type="text" value="<?=$data[0]?>">
                                                    <input type="hidden" name="id" value="<?=$row['id']?>">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="senin" name="hari[]"
                                                                    <?php if ($data[0]=="Senin") echo "checked"?>checkedid="flexCheckChecked">
                                                                <label class="form-check-label" for="flexCheckChecked">
                                                                    Senin
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="selasa" name="hari[]"
                                                                    <?php if ($data[1]=="Selasa") echo "checked"?>
                                                                    id="flexCheckChecked">
                                                                <label class="form-check-label" for="flexCheckChecked">
                                                                    Selasa
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <?php 
                                                            $status = $row['statusdenda'];
                                                            if ($status==1) {
                                                                $keteragan="Active";
                                                                $code ="1";
                                                            } else {
                                                                $keteragan="NonActive";
                                                                $code ="0";
                                                            }
                                                            ?>
                                                            <select class="form-select" name="status"
                                                                aria-label="Default select example">
                                                                <option selected value="?$code ?>
                                                                    <?$keteragan ?>">
                                                                </option>
                                                                <option value="1">Active</option>
                                                                <option value="0">NonActive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" name="ubah" class="btn btn-primary">Simpan
                                                            Perubahan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="hapus<?=$row['idkategoribuku']?>" tabindex="-1"
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
                                                    <input type="hidden" name="id" value="<?=$row['idkategoribuku']?>">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="kategori" class="form-label">Kategori</label>
                                                            <input type="text" value="<?=$row['kategoribuku']?>"
                                                                readonly class="form-control" id="kategori">
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
            <?php if(@$_SESSION['eror']){ ?>
            <script>
            swal("Good job!", "<?php echo $_SESSION['eror']; ?>", "info");
            </script>
            <?php unset($_SESSION['hapus']); } ?>
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
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="senin" name="hari[]"
                                    id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Senin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="selasa" name="hari[]"
                                    id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Selasa
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="simpandenda">Simpan </button>
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
    <script type="text/javascript" src="notif.js">
    </script>
    <script type="text/javascript">
    // window.print();
    </script>
</body>

</html>