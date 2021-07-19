<?php
require '../connection.php';
mysqli_select_db($conn, 'toko_galon');
setlocale(LC_MONETARY,'ID')
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
    <title>Toko Galon | Transaksi</title>
</head>

<body>
    <?php
    include('../navbar.php')
    ?>

    <div class="mx-auto my-3" style="width: 80%;">
        <h3>Data Transaksi Penjualan</h3>
        <hr>
        <table class="table table-stripped table-hover datatab" id="dataTable">
            <thead class="thead-dark" style="width: 100%;">
                <tr>
                    <th>ID</th>
                    <th>Nama Pembeli</th>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Jumlah Beli</th>
                    <th>Pembelian</th>
                    <th>Modal</th>
                    <th>Keuntungan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT 
                penjualan_air.id_transaksi, penjualan_air.nama_pembeli, 
                tabel_databarang.nama_barang, tabel_databarang.harga_barang, 
                penjualan_air.jumlah_beli, penjualan_air.Total_Pembelian, 
                penjualan_air.jumlah_beli*tabel_databarang.harga_distri AS modal, 
                penjualan_air.Total_Pembelian-(penjualan_air.jumlah_beli*tabel_databarang.harga_distri) AS keuntungan
                FROM penjualan_air
                JOIN tabel_databarang ON penjualan_air.id_barang=tabel_databarang.id_barang";

                ($result = mysqli_query($conn, $sql)) or
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
                        <td>Rp. <?php echo number_format($data[7], 0, '', '.'); ?></td>
                    </tr>
                <?php endwhile;
                ?>

                <?php
                $sql2 = "SELECT SUM(penjualan_air.Total_Pembelian) AS Total, 
                SUM(penjualan_air.Total_Pembelian-(penjualan_air.jumlah_beli*tabel_databarang.harga_distri)) 
                AS keuntungan FROM penjualan_air JOIN tabel_databarang ON penjualan_air.id_barang=tabel_databarang.id_barang";
                ($sum = mysqli_query($conn, $sql2))
                    or die("Failed to fetch data : " . mysqli_error($conn));
                while ($total = mysqli_fetch_array($sum, MYSQLI_BOTH)) : ?>
                    <tr style="background-color:antiquewhite;">
                        <td colspan="4"></td>
                        <td><b>Total Penjualan:</b></td>
                        <td>Rp. <?php echo number_format($total[0], 0, '', '.'); ?></td>
                        <td><b>Total Keuntungan</b></td>
                        <td>Rp. <?php echo number_format($total[1], 0, '', '.'); ?></td>
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
    <!-- <script>
        $(document).ready(function() {
            $('.datatab').DataTable();
        });
    </script> -->
</body>

</html>