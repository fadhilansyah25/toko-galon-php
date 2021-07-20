<?php 
$username;

if ($_SESSION['username']) {
    $username = $_SESSION['username'];
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="padding: 16px 150px">
    <a class="navbar-brand" href="/"><b>Toko Galon & GAS</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" 
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
    aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../databarang/databarang.php"><b>Data Barang</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../transaksi/transaksi.php"><b>Transaksi</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../dataPenjualan/data_penjualan.php"><b>Data Transaksi</b></a>
            </li>
        </ul>
    </div>
    <p class="text-light m-0">Selamat Datang, <?=$username?> </p>
    <a class="nav-link" href="../controller.php?logout=true"><b>Logout</b></a>
</nav>