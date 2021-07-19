<?php
require '../connection.php';
mysqli_select_db($conn, 'toko_galon');
setlocale(LC_MONETARY,'ID')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../component/meta.php')
    ?>
    <title>Toko Galon | Transaksi</title>
</head>

<body>
    <?php
    include('../component/navbar.php')
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
                penjualan_air.jumlah_beli, penjualan_air.jumlah_beli * tabel_databarang.harga_barang AS total_pembelian, 
                penjualan_air.jumlah_beli*tabel_databarang.harga_distri AS modal, 
                (penjualan_air.jumlah_beli * tabel_databarang.harga_barang)-(penjualan_air.jumlah_beli*tabel_databarang.harga_distri) AS keuntungan
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
                $sql2 = "SELECT SUM(penjualan_air.jumlah_beli * tabel_databarang.harga_barang) AS Total, 
                SUM((penjualan_air.jumlah_beli * tabel_databarang.harga_barang)-(penjualan_air.jumlah_beli*tabel_databarang.harga_distri)) 
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
    <?php
    include "../component/bundle.php";
    ?>
    <!-- <script>
        $(document).ready(function() {
            $('.datatab').DataTable();
        });
    </script> -->
</body>

</html>