<?php
include '../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apotik</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Apotik</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </ul>
                    <?php if (!isset($_SESSION['username'])) { ?>
                        <a class="nav-link btn btn-primary btn-sm d-flex justify-content-end" style="color: white;" aria-current="page" href="../login.php">Login</a>
                    <?php } else { ?>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <b><?php echo $_SESSION['nmUser']; ?></b>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="../index.php">Stok Obat</a></li>                                    
                                <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </nav>

        <div class="container mt-4">
            <div class="row">
                <div class="col">
                    <h4>Admin</h4>
                </div>
            </div>
            <nav style="--bs-breadcrumb-divider: url('data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E');" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Pegawai</li>
                </ol>
            </nav>
            <div class="row">
                <div class="col">
                    <?php if (isset($_GET['gagal'])) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-triangle-exclamation"></i></strong>
                            <?= $_SESSION['gagalposting']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <a href="#" class="btn btn-primary btn-sm float-end mb-2" data-bs-toggle="modal" data-bs-target="#tambahdata">
                        <i class="fa-solid fa-plus"></i> Tambah Pegawai
                    </a>
                </div>
            </div>

            <table class="table table-striped table-sm mt-1" id="tabel">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Gaji</th>
                        <th>Level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $panggil = $koneksi->query("SELECT * FROM pegawai ORDER BY idPegawai DESC");
                    while ($row = $panggil->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="align-middle"><?= $no++; ?></td>
                            <td class="align-middle"><?= $row['namapegawai']; ?></td>
                            <td class="align-middle"><?= $row['gaji']; ?></td>
                            <td class="align-middle"><?= $row['level']; ?></td>
                            <td class="align-middle">
                                <a data-href="#" class="btn btn-warning btn-sm update" data-bs-toggle="modal" data-bs-target="#editdata" data-idPegawai="<?= $row['idPegawai'] ?>" data-namapegawai="<?= $row['namapegawai'] ?>" data-gaji="<?= $row['gaji'] ?>" data-stok="<?= $row['level'] ?>">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="konfigurasi.php?delete=<?= $row['idPegawai']; ?>" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="tambahdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Anggota</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="konfigurasi.php" method="POST" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="namapegawai" class="col-sm-3 col-formlabel">Nama Pegawai</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="namapegawai" class="form-control" required>
                                    </div>
                            </div>
                            <div class="row mb-3">
                                <label for="gaji" class="col-sm-3 col-formlabel">Gaji</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="gaji" id="gaji" class="form-control" required>
                                    </div>
                            </div>
                            <div class="row mb-3">
                                <label for="level" class="col-sm-3 col-formlabel">Level</label>
                                    <select name="level" id="level" class="form-control">
                                        <option value=""></option>
                                        <option value="admin">Admin</option>
                                        <option value="manajer">Manajer</option>
                                        <option value="gudang">Gudang</option>
                                        <option value="kasir">Kasir</option>
                                    </select>       
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
        <div class="modal fade" id="editdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="konfigurasi.php" method="POST" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="namapegawai" class="col-sm-3 col-formlabel">Nama Pegawai</label>
                                <div class="col-sm-9">
                                    <input type="text" name="namapegawai" class="form-control" id="namapegawai_u">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="gaji" class="col-sm-3 col-formlabel">Gaji</label>
                                <div class="col-sm-9">
                                    <input type="text" name="gaji" id="gaji_u" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="level" class="col-sm-3 col-formlabel">Level</label>
                                <div class="col-sm-9">
                                    <select name="level" id="level" class="form-control">
                                        <option value=""></option>
                                        <option value="admin">Admin</option>
                                        <option value="manajer">Manajer</option>
                                        <option value="gudang">Gudang</option>
                                        <option value="kasir">Kasir</option>
                                    </select>                                    
                                </div>
                            </div>
                            </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="editposting" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>

    <script src="../assets/js/jquery-min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).on('click', '.update', function (e) {
            var idPegawai = $(this).attr("data-idPegawai");
            var namapegawai = $(this).attr("data-namapegawai");
            var gaji = $(this).attr("data-gaji");
            $('#idPegawai_u').val(idPegawai);
            $('#namapegawai_u').val(namapegawai);
            $('#gaji_u').val(gaji);
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#tabel').DataTable({
                "paging": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
