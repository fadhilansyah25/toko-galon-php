<?php
require '../connection.php';
include '../session.php';
mysqli_select_db($conn, 'toko_galon');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../component/meta.php')
    ?>
    <title>Toko Galon | Data Barang</title>
</head>

<body>
    <?php
    include('../component/navbar.php');
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
    <?php
    include "../component/bundle.php";
    ?>
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