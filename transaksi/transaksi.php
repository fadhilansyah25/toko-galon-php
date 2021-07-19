<?php
require('../connection.php');
mysqli_select_db($conn, 'toko_galon');
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

    <div class="mx-auto my-5" style="width:80%">
        <h3>Transaksi Barang</h3>
        <hr>
        <div class="row">
            <div class="col-sm">
                <h4 class="mb-5 mt-2">Barang Tersedia</h4>
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
                            </tr>
                        <?php endwhile;
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm" id="transaksi">
                <h4 class="mb-5 mt-2">Form Transaksi</h4>
                <form action="../controller.php?act=transaksi" method="POST">
                    <div class="form-group">
                        <label for="namaPembeli">Nama Pembeli</label>
                        <input type="text" class="form-control" name="namaPembeli" placeholder="Nama Pembeli">
                    </div>
                    <div class="form-group">
                        <label for="idBarang">ID Barang</label>
                        <select class="custom-select id-barang" name="idBarang" required>
                            <option selected>Pilih Barang</option>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM tabel_databarang");

                            while ($data = mysqli_fetch_array($result, MYSQLI_BOTH)) : ?>
                                <option value="<?= $data['id_barang'] ?>" 
                                data-price="<?= $data['harga_barang'] ?>">
                                <?= $data['nama_barang'] ?></option>
                            <?php
                            endwhile
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hargaBarang">Harga Barang</label>
                        <input type="number" class="form-control hargaBarang" placeholder="Harga Barang" readonly>
                    </div>
                    <div class="form-group">
                        <label for="jumlahBeli">Jumlah</label>
                        <input type="number" class="form-control jumlahBeli" name="jumlahBeli" placeholder="Jumlah Pembelian">
                    </div>
                    <div class="form-group">
                        <label for="totalPembelian">Total Pembelian</label>
                        <input type="text" class="form-control totalPembelian" placeholder="Total Pembelian" value="0" readonly>
                    </div>
                    <div class="form-group">
                        <label for="uangBayar">Bayar</label>
                        <input type="number" class="form-control uangBayar" placeholder="Uang Bayar">
                    </div>
                    <div class="form-group">
                        <label for="kembalian">Kembalian</label>
                        <input type="text" class="form-control kembalian" placeholder="Kembalian" value="0" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Bayar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <?php
    include "../component/bundle.php";
    ?>
    <!-- intern script -->
    <script>
        $(".id-barang").on('change', function() {
            let price = $(this).find(':selected').attr('data-price');
            $(".hargaBarang").val(price);

            if($('.jumlahBeli').val() != 0) {
                let harga = $('.hargaBarang').val();
                let jumlah = $('.jumlahBeli').val();
                let total = parseInt(harga) * parseInt(jumlah);

                if (isNaN(total)) {
                    total = 0;
                }

                $('.totalPembelian').val(total);
            }
        });

        $('.jumlahBeli').on('input', function () {
            let harga = $('.hargaBarang').val();
            let jumlah = $('.jumlahBeli').val();
            let total = parseInt(harga) * parseInt(jumlah);

            if (isNaN(total)) {
                total = 0;
            }

            $('.totalPembelian').val(total);
        });

        $('.uangBayar').on('input', function() {
            let total = $('.totalPembelian').val();
            let bayar = $('.uangBayar').val();
            let kembalian = parseInt(bayar) - parseInt(total);

            if (isNaN(kembalian)) {
                total = 0;
            }

            $('.kembalian').val(kembalian);
        });
    </script>
    <!-- <script>
        $(document).ready(function() {
            $('.datatab').DataTable();
        });
    </script> -->
</body>

</html>