<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Menu</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
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
                        <button type="submit" class="btn btn-success btn-icon-split" value="upload">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Simpan</span>
                        </button>
                        <a href="<?php echo base_url('menu') ?>" class="btn btn-secondary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>