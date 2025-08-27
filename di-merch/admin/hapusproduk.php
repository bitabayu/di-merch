<?php

$stmt = $koneksi->prepare("SELECT * FROM produk WHERE id_produk=?");
$stmt->bind_param("s", $_GET['id']);
$stmt->execute();
$ambil = $stmt->get_result();
$pecah = $ambil->fetch_assoc();
$fotoproduk = $pecah['foto_produk'];
	if (file_exists("../foto_produk/$fotoproduk"))
	{
		unlink("../foto_produk/$fotoproduk");
	}

	$stmt = $koneksi->prepare("DELETE FROM produk WHERE id_produk=?");
	$stmt->bind_param("s", $_GET['id']);
	$stmt->execute();
	echo "<script>alert('produk terhapus');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
