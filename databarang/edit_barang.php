<?php
require '../connection.php';
mysqli_select_db($conn, 'db_berita');
?>

<div class="modal fade" id="edit_barang" 
tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controller.php?act=edit_barang" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="NamaBarang">Nama Barang</label>
                        <input type="text" class="form-control namaBarang" 
                        name="namaBarang" placeholder="Nama Barang" required />
                    </div>
                    <div class="form-group">
                        <label for="tipeBarang">Tipe</label>
                        <input type="text" class="form-control tipeBarang" 
                        name="tipeBarang" placeholder="Tipe Barang" required />
                    </div>
                    <div class="form-group">
                        <label for="ukuranBarang">Ukuran</label>
                        <input type="text" class="form-control ukuranBarang" 
                        name="ukuranBarang" placeholder="Ukuran Barang" required />
                    </div>
                    <div class="form-group">
                        <label for="stokBarang">Stok</label>
                        <input type="text" class="form-control stokBarang" 
                        name="stokBarang" placeholder="Stok Barang" required />
                    </div>
                    <div class="form-group">
                        <label for="hargaJual">Harga Jual</label>
                        <input type="text" class="form-control hargaJual" 
                        name="hargaJual" placeholder="Harga Jual" required />
                    </div>
                    <div class="form-group">
                        <label for="hargaToko">Harga Toko</label>
                        <input type="text" class="form-control hargaToko" 
                        name="hargaToko" placeholder="Harga Toko" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="idBarang" name="idBarang">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>