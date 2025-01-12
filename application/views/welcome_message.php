<?php
$this->load->view('layouts/header');
?>

<body>
	<div class="container py-3">
		<button class="btn btn-primary px-4">Tambah</button>
		<table class="table table-hover table-stripped">
			<thead>
				<tr>
					<th>Nama Produk</th>
					<th>Harga</th>
					<th>Kategori</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($products as $product) :?>
					<tr>
						<td><?= $product['nama_produk']?></td>
						<td><?= $product['harga']?></td>
						<td><?= $product['nama_kategori']?></td>
						<td><?= $product['nama_status']?></td>
						<td>
							<div class="flex item-center justify-content-between flex-wrap">
								<a href="/product/edit/<?= $product['id_produk']?>" class="btn btn-warning text-light fw-bold">Edit</a>
								<form action="/product/delete/<?= $product['id_produk']?>" method="post">
									<button type="submit" onclick="confirm('apakah yakin?')" class="btn btn-danger text-light fw-bold">Remove</button>
								</form>
							</div>
						</td>
					</tr>
					<?php endforeach;?>
			</tbody>
		</table>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>