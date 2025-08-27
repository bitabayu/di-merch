<h2>Ubah Produk</h2>
<!-- <?php
		$stmt = $koneksi->prepare("SELECT * FROM produk WHERE id_produk=?");
		$stmt->bind_param("s", $_GET['id']);
		$stmt->execute();
		$ambil = $stmt->get_result();
		$pecah = $ambil->fetch_assoc();

		echo "<pre>";
		print_r($pecah);
		echo "</pre>";
		?> -->

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk']; ?>">
	</div>

	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_produk']; ?>">
	</div>

	<div class="form-group">
		<label>Berat (Gr)</label>
		<input type="number" class="form-control" name="berat" value="<?php echo $pecah['berat_produk']; ?>">
	</div>

	<div class="form-group">
		<img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200">
	</div>

	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>

	<div class="form-group">
		<label>Deskripsi</label>
		<textarea name="deskripsi" class="form-control" rows="10"><?php echo $pecah['deskripsi_produk']; ?></textarea>
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
if (isset($_POST['ubah'])) {
	$namafoto = $_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	//Jika foto dirubah

	if (!empty($lokasifoto)) {
		move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

		$stmt = $koneksi->prepare("UPDATE produk SET nama_produk=?, harga_produk=?, berat_produk=?, foto_produk=?, deskripsi_produk=? WHERE id_produk=?");
		$stmt->bind_param("ssssss", $_POST['nama'], $_POST['harga'], $_POST['berat'], $namafoto, $_POST['deskripsi'], $_GET['id']);
		$stmt->execute();
	} else {
		$stmt = $koneksi->prepare("UPDATE produk SET nama_produk=?, harga_produk=?, berat_produk=?, deskripsi_produk=? WHERE id_produk=?");
		$stmt->bind_param("sssss", $_POST['nama'], $_POST['harga'], $_POST['berat'], $_POST['deskripsi'], $_GET['id']);
		$stmt->execute();
	}
	echo "<script>alert('Data produk telah diubah');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
}
