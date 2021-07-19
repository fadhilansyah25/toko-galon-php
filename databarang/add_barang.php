<?php
require '../connection.php';
mysqli_select_db($conn, 'toko_galon');
?>

<div class="modal fade" id="add_barang" tabindex="-1" 
aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controller.php?act=tambah_barang" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="NamaBarang">Nama Barang</label>
                        <input type="text" class="form-control" id="namaBarang" 
                        name="namaBarang" placeholder="Nama Barang" required />
                    </div>
                    <div class="form-group">
                        <label for="tipeBarang">Tipe</label>
                        <input type="text" class="form-control" id="tipeBarang" 
                        name="tipeBarang" placeholder="Tipe Barang" required />
                    </div>
                    <div class="form-group">
                        <label for="ukuranBarang">Ukuran</label>
                        <input type="text" class="form-control" id="ukuranBarang" 
                        name="ukuranBarang" placeholder="Ukuran Barang" required />
                    </div>
                    <div class="form-group">
                        <label for="stokBarang">Stok</label>
                        <input type="text" class="form-control" id="stokBarang" 
                        name="stokBarang" placeholder="Stok Barang" required />
                    </div>
                    <div class="form-group">
                        <label for="hargaJual">Harga Jual</label>
                        <input type="text" class="form-control" id="hargaJual" 
                        name="hargaJual" placeholder="Harga Jual" required />
                    </div>
                    <div class="form-group">
                        <label for="hargaToko">Harga Toko</label>
                        <input type="text" class="form-control" id="hargaToko" 
                        name="hargaToko" placeholder="Harga Toko" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>