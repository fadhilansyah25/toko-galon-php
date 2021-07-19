<?php
require '../connection.php';
mysqli_select_db($conn, 'toko_galon');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <script src="https://kit.fontawesome.com/322803f301.js" 
    crossorigin="anonymous"></script>
    <link rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" 
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" 
    crossorigin="anonymous">
    <!-- Data tables -->
    <link rel="stylesheet" type="text/css" 
    href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <title>Toko Galon | Data Barang</title>
</head>

<body>
    <?php
    include('../navbar.php');
    ?>
    <div class="mx-auto my-3" style="width: 80%;">
        <h3>Data Inventori Barang</h3>
        <hr>
        <div class="mb-4 mt-2">
            <a href="#" class="btn btn-primary" 
            data-toggle="modal" 
            data-target="#add_barang"><i class="fas fa-plus"></i> Tambah Data</a>
        </div>
        <table class="table table-stripped table-hover datatab" id="dataTable">
            <thead class="thead-dark" style="width: 100%;">
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Tipe</th>
                    <th>ukuran</th>
                    <th>Stok</th>
                    <th>Harga Jual</th>
                    <th>Harga Toko</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                ($result = mysqli_query($conn, "SELECT * FROM tabel_databarang")) or
                    die("Failed to fetch data : " . mysqli_error($conn));
                while ($data = mysqli_fetch_array($result, MYSQLI_BOTH)) : ?>
                    <tr>
                        <td><?php echo $data[0]; ?></td>
                        <td><?php echo $data[1]; ?></td>
                        <td><?php echo $data[2]; ?></td>
                        <td><?php echo $data[3]; ?></td>
                        <td><?php echo $data[4]; ?></td>
                        <td>Rp. <?php echo number_format($data[5], 0, '', '.'); ?></td>
                        <td>Rp. <?php echo number_format($data[6], 0, '', '.'); ?></td>
                        <td>
                            <a href="javascript:void()" type="button" class="btn btn-warning button-update" 
                            data-id="<?= $data[0] ?>" data-nama="<?= $data[1] ?>"
                            data-tipe="<?= $data[2] ?>" data-ukuran="<?= $data[3] ?>"
                            data-stok="<?= $data[4] ?>" data-hargajual="<?= $data[5] ?>"
                            data-hargatoko="<?= $data[6] ?>"
                            >
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="../controller.php?act=delete_barang&id=<?= $data[0] ?>" 
                            onclick="return confirm('Apakah Anda yakin Menghapus Data ini?')" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile;
                ?>
            </tbody>
        </table>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script 
    src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
    crossorigin="anonymous"></script>
    <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" 
    crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" 
    src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <?php
    include "./add_barang.php";
    include "./edit_barang.php";
    ?>
    <script>
        $("#dataTable").on("click", ".button-update", function() {
            let id = $(this).data("id");
            let nama = $(this).data("nama");
            let tipe = $(this).data("tipe");
            let ukuran = $(this).data("ukuran");
            let stok = $(this).data("stok");
            let hargaJual = $(this).data("hargajual");
            let hargaToko = $(this).data("hargatoko");
            $("#edit_barang").modal("show");
            $(".idBarang").val(id);
            $(".namaBarang").val(nama);
            $(".tipeBarang").val(tipe);
            $(".ukuranBarang").val(ukuran);
            $(".stokBarang").val(stok);
            $(".hargaJual").val(hargaJual);
            $(".hargaToko").val(hargaToko);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.datatab').DataTable();
        });
    </script>
</body>

</html>