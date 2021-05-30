<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800">List Pesanan</h1>
	<?php if ($this->session->flashdata('crud_pesan') == 'hapus') {?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Berhasil Hapus!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php }elseif ($this->session->flashdata('crud_pesan') == 'edit') {?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Status Pesanan Berhasil diubah!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php }elseif ($this->session->flashdata('crud_pesan') == 'tambah'){ ?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Berhasil ditambah!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php }else{} ?>
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary" style="display: inline;">Daftar Pesanan</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Pelanggan</th>
									<th>Tanggal Pemesanan</th>
									<th>Total Pembayaran</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach ($pesanan as $row) { ?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $row['nama']; ?></td>
										<td><?php echo $row['tanggal'] ?></td>
										<td><?php echo $row['total_harga']; ?></td>
										<td>
											<form action="<?php echo base_url('status') ?>" method="POST" id="form_status">
												<div class="form-group">
													<input type="hidden" name="id_pemesanan" value="<?php echo $row['id_pemesanan'] ?>">
													<select class="form-control" name="status" onChange="this.form.submit();">
														<?php if ($row['status'] != 'diproses') {
															echo "<option value='diproses'>Diproses</option>".
																"<option value='selesai' selected>Selesai</option>";
														}else {
															echo "<option value='diproses' selected>Diproses</option>".
																"<option value='selesai'>Selesai</option>";
														} ?>
													</select>
												</div>
											</form>
										</td>
										<td>
											<button type="button" class="edit btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['id_pemesanan'] ?>" nim="<?php echo $row['id_pemesanan'] ?>">
												<span class="glyphicon glyphicon-edit"></span>Detail
											</button>
											<a href="<?php echo base_url('hapus_detail/').$row['id_pemesanan'];?>">
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
<!-- The Modal -->
<?php foreach ($pesanan as $p) {?>
	<div class="modal fade" id="myModal<?php echo $p['id_pemesanan'] ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title" id="judul"></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<div id="tampil_modal">
						<table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Foto Produk</th>
									<th>Nama Produk</th>
									<th>Harga Produk</th>
									<th>QTY</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach ($detail_pesanan as $row) {?>
									<?php if ($p['id_pemesanan'] == $row['id_pemesanan']) {?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td>
												<img height="100px" width="100px" src="<?php echo base_url().'assets/img/'.$row['fotoProduk']; ?>"/>
											</td>
											<td><?php echo $row['namaProduk']; ?></td>
											<td><?php echo number_format($row['hargaProduk'],0,",",".") ?></td>
											<td><?php echo $row['qty']; ?></td>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
				</div>

			</div>
		</div>
	</div>
	<?php } ?>