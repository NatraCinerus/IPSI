<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800">List Produk</h1>
	<?php if ($this->session->flashdata('hapus') == 'success') {?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Berhasil Hapus!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php } ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary" style="display: inline;">Daftar Harga Produk</h6>
					<a href="<?php echo base_url('addMenu') ?>" class="btn btn-primary btn-icon-split" style="float: right;">
						<span class="icon text-white-50">
							<i class="fas fa-plus"></i>
						</span>
						<span class="text">Tambah Menu</span>
					</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Foto Produk</th>
									<th>Nama Produk</th>
									<th>Harga Produk</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach ($produk as $row) { ?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td>
											<img height="100px" width="100px" src="<?php echo base_url().'assets/img/'.$row['fotoProduk']; ?>"/>
										</td>
										<td><?php echo $row['namaProduk']; ?></td>
										<td><?php echo number_format($row['hargaProduk'],0,",",".") ?></td>
										<td>
											<a href="<?php echo base_url('edit/').$row['idProduk'] ?>">
												<button type="button" class="btn btn-primary">
													<span class="glyphicon glyphicon-edit"></span>Edit
												</button>
											</a>
											<a href="<?php echo base_url('hapus/').$row['idProduk'];?>">
												<button type="button" class="btn btn-danger">
													<span class="glyphicon glyphicon-remove-sign"></span>Hapus
												</button>
											</a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>