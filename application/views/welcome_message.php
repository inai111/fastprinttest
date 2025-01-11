<?php
$this->load->view('layouts/header');
?>

<body>
	<div class="container py-3">
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
				<?php foreach() :?>
					<tr>
						<td>Nama Produk</td>
						<td>Harga</td>
						<td>Kategori</td>
						<td>Status</td>
					</tr>
					<?php endforeach;?>
			</tbody>
		</table>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>