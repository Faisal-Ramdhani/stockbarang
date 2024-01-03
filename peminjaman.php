<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Stock - Peminjaman Barang</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <script>
        $(document).ready(function () {
            // Hide logo when sidebar toggle button is clicked
            $("#sidebarToggle").on("click", function () {
                $(".navbar-brand img").toggle();
            });
        });
        </script>


        <style>
        .zoomable{
            width: 100px;
        }
        .zoomable:hover{
            transform: scale(2.5);
            transition: 0.3s ease;
        }
        </style>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">
            <img src="assets/img/logo.png" alt="On Target Logo" height="50" style="margin-top: 5px;">
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php" style="margin-top: 40px;">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Keluar
                            </a>                           
                            <a class="nav-link" href="peminjaman.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Peminjaman Barang
                            </a>                           
                            <a class="nav-link" href="logout.php">
                                logout
                            </a>                             
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Pinjam Barang</h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                    Tambah Data
                                </button>
                                <br>

                                <div class="row mt-4">
                                    <div class="col">
                                        <form method="post" class="form-inline">
                                            <input type="date" name="tgl_mulai" class="form-control">
                                            <input type="date" name="tgl_selesai" class="form-control ml-3">
                                            <button type="submit" name="filter_tgl" class="btn btn-info ml-3">filter</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Gambar</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Kepada</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        <?php

                                            if (isset($_POST['filter_tgl'])) {
                                                $mulai = $_POST['tgl_mulai'];
                                                $selesai = $_POST['tgl_selesai'];

                                                if($mulai!=null || $selesai!=null){
                                                    $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM peminjaman p, stock s WHERE s.idbarang = p.idbarang AND tanggalpinjam BETWEEN '$mulai' AND DATE_ADD('$selesai',INTERVAL 1 DAY) ORDER BY idpeminjaman DESC");
                                                } else {
                                                    $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM peminjaman p, stock s WHERE s.idbarang = p.idbarang ORDER BY idpeminjaman DESC");
                                                }

                                            } else {
                                                $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM peminjaman p, stock s WHERE s.idbarang = p.idbarang ORDER BY idpeminjaman DESC");
                                            }

                                            while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                                                $idb = $data['idbarang'];
                                                $idk = $data['idpeminjaman'];
                                                $tanggal = $data['tanggalpinjam'];
                                                $namabarang = $data['namabarang'];
                                                $qty = $data['qty'];
                                                $penerima = $data['peminjam'];
                                                $status = $data['status'];



                                                // cek ada gambar atau tidak
                                                $gambar = $data['image']; //ambil gambar
                                                if($gambar==null){
                                                    //jika tidak ada gambar
                                                    $img = 'No Photo';
                                                } else {
                                                    //jika ada gambar
                                                    $img = '<img src="images/'.$gambar.'" class="zoomable">';
                                                }

                                            ?>
                                            <tr>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$img;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$qty;?></td>
                                                <td><?=$penerima;?></td>
                                                <td><?=$status;?></td>
                                                <td> 

                                                <?php

                                                    //cek status
                                                    if($status=='Dipinjam'){
                                                        echo '<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit'.$idk.'">
                                                        Selesai
                                                        </button>';
                                                    } else {
                                                        //jika statusnya bukan dipinjam (sudah kembali)
                                                    }

                                                ?>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?=$idk;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Selsaikan</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <form method="post">
                                                        <div class="modal-body">
                                                        Apakah Barang Ini Sudah Selsai Dipinjam ?
                                                        <br>
                                                        <input type="hidden" name="idpinjam" value="<?=$idk;?>">
                                                        <input type="hidden" name="idbarang" value="<?=$idb;?>">
                                                        <button type="submit" class="btn btn-primary" name="barangkembali">Submit</button>
                                                        </div>
                                                        </form>

                                                        
                                                    </div>
                                                    </div>
                                                </div>

                                            <?php
                                            };

                                            ?>

                                        </tbody>
                                    </table>
                                </div>                                     
                            </div>
                        </div>
                    </div>
                </main>                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Peminjaman</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <form method="post">
                <div class="modal-body">
                <select name="barangnya" class="form-control">
                    <?php
                        $ambilsemuadatanya = mysqli_query($conn,"select * from stock");
                        while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                            $namabarangnya = $fetcharray['namabarang'];
                            $idbarangnya = $fetcharray['idbarang'];
                    ?>

                    <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>

                    <?php
                        }
                    ?>
                </select>
                <br>
                <input type="number" name="qty" class="form-control" placeholder="Quantity" min="1" required>
                <br>
                <input type="text" name="penerima" placeholder="kepada" class="form-control" required>
                <br>
                <button type="submit" class="btn btn-primary" name="pinjam">Submit</button>
                </div>
                </form>

            
            </div>
        </div>
    </div>
</html>
