<?php
$this->load->view('layouts/header');
?>

<body>
	<div class="container py-3">
		<div class="row justify-content-center">
			<div class="col-sm-6">
				<div class="card shadow p-3">
					<div class="card-head">
						<a href="<?= base_url('/') ?>" class="btn btn-outline-secondary">
							<i class="fa-solid fa-arrow-left fw-bold"></i>
						</a>
					</div>
					<div class="card-body">
						<form method="post">
							<div class="mb-3">
								<label for="produkName" class="form-label">Product Name</label>
								<input placeholder="Alchooohoo" type="text" name="produk_nama" class="form-control <?= form_error('produk_nama') ? 'is-invalid' : '' ?>" id="produkName" value="<?= set_value('produk_nama') ?>" required>
								<div class="invalid-feedback">
									<?= form_error('produk_nama') ?>
								</div>
							</div>
							<div class="mb-3">
								<label for="produkHarga" class="form-label">Product Price</label>
								<input placeholder="2500" type="text" class="form-control <?= form_error('produk_harga') ? 'is-invalid' : '' ?>" name="produk_harga" id="produkHarga" value="<?= set_value('produk_harga') ?>" required>
								<div class="invalid-feedback">
									<?= form_error('produk_harga') ?>
								</div>
							</div>
							<div class="mb-3">
								<label for="produkKategori" class="form-label">Product Category</label>
								<select class="form-select" id="produkKategori" name="produk_kategori" required>
									<?php foreach ($kategories as $kategori) : ?>
										<option value="<?= $kategori['id_kategori'] ?>" <?= $kategori['id_kategori'] == set_value('produk_kategori') ? 'selected' : '' ?>><?= $kategori['nama_kategori'] ?></option>
									<?php endforeach; ?>
								</select>
								<div class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="mb-3">
								<label for="produkStatus" class="form-label">Product Status</label>
								<select class="form-select" id="produkStatus" name="produk_status" required>
									<?php foreach ($status as $status) : ?>
										<option value="<?= $status['id_status'] ?>" <?= $status['id_status'] == set_value('produk_status') ? 'selected' : '' ?>><?= $status['nama_status'] ?></option>
									<?php endforeach; ?>
								</select>
								<div class="invalid-feedback">
									Please select a valid state.
								</div>
							</div>
							<div class="mb-3">
								<button class="btn-success btn px-4 fw-bold">Save Data</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>