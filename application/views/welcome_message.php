<?php
$this->load->view('layouts/header');
?>

<body>
	<div class="container py-3">
		<?php if ($this->session->flashdata('message')): ?>
			<div class="alert alert-primary mb-1" role="alert">
				<?= $this->session->flashdata('message') ?>
			</div>
		<?php endif; ?>
		<div class="d-flex gap-2 align-items-center mb-1">
			<a href="<?= base_url('/product/add') ?>" class="btn btn-primary px-4">Tambah</a>
			<form class="w-100">
				<select name="status" id="status" class="form-select" aria-label="Default select example">
					<option selected>All Status</option>
					<?php foreach ($statuses as $status): ?>
						<option value="<?= $status ?>" <?= $this->input->get('status') == $status ? 'selected' : '' ?>><?= $status ?></option>
					<?php endforeach ?>
				</select>
			</form>
		</div>
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
				<?php foreach ($products as $product) : ?>
					<tr>
						<td><?= $product['nama_produk'] ?></td>
						<td>Rp.<?= number_format($product['harga'], 0, '.', '.') ?></td>
						<td><?= $product['nama_kategori'] ?></td>
						<td><?= $product['nama_status'] ?></td>
						<td>
							<div class="d-flex align-items-center gap-1">
								<a href="<?= base_url("/product/edit/{$product['id_produk']}") ?>" class="btn btn-sm btn-warning text-light fw-bold">
									<i class="fa-solid fa-pen"></i>
								</a>
								<form onsubmit="return confirm('apakah yakin?')" action="<?= base_url("/product/delete/{$product['id_produk']}") ?>" method="post">
									<input type="hidden" name="method" value="delete">
									<button type="submit" class="btn btn-sm btn-danger text-light fw-bold">
										<i class="fa-solid fa-trash"></i>
									</button>
								</form>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<script>
		document.querySelector('select#status').addEventListener('change', function() {
			this.closest('form').submit();
		});
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>