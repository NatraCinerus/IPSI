<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800">List Produk</h1>
	<?php if ($this->session->flashdata('crud_menu') == 'hapus') {?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Berhasil Hapus!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php }elseif ($this->session->flashdata('crud_menu') == 'edit') {?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Berhasil diubah!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php }elseif ($this->session->flashdata('crud_menu') == 'tambah'){ ?>
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
					<h6 class="m-0 font-weight-bold text-primary" style="display: inline;">Daftar Harga Produk</h6>
					<button class="btn btn-primary btn-icon-split" style="float: right;" data-toggle="modal" data-target="#myModal">
						<span class="icon text-white-50">
							<i class="fas fa-plus"></i>
						</span>
						<span class="text">Tambah Menu</span>
					</button>
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
<div class="modal fade" id="myModal">
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
					<form class="user" action="<?php echo base_url('main/addSubmit') ?>" method="post" enctype="multipart/form-data">
						<div class="form-group row">
							<div class="col-sm-12">
								<input type="text" class="form-control form-control-user" placeholder="Nama Menu" name="namaProduk">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-12">
								<input type="number" class="form-control form-control-user" placeholder="Harga" name="hargaProduk">
							</div>
						</div>
						<div class="form-group">
							<label for="exampleFormControlFile1">Foto</label>
							<input type="file" class="form-control-file" id="exampleFormControlFile1" name="fotoProduk">
						</div>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" style="float: right;">Batal</button>
						<button type="submit" class="btn btn-success btn-icon-split" value="upload" style="float: right;">
							<span class="icon text-white-50">
								<i class="fas fa-check"></i>
							</span>
							<span class="text">Simpan</span>
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>