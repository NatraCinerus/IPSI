<h2>Daftar Produk</h2>
<?php
	foreach ($produk as $row) {
?>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="kotak">
              <form method="post" action="<?php echo base_url('tambah');?>" method="post" accept-charset="utf-8">
                <a href="#">
                  <img class="img-thumbnail" src="<?php echo base_url() . 'assets/img/'.$row['fotoProduk']; ?>" style="height: 150px; width: 250px;">
                </a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#"><?php echo $row['namaProduk'];?></a>
                  </h4>
                  <h5>Rp. <?php echo number_format($row['hargaProduk'],0,",",".");?></h5>
                </div>
                <div class="card-footer">
                  
                  <input type="hidden" name="id" value="<?php echo $row['idProduk']; ?>" />
                  <input type="hidden" name="nama" value="<?php echo $row['namaProduk']; ?>" />
                  <input type="hidden" name="harga" value="<?php echo $row['hargaProduk']; ?>" />
                  <input type="hidden" name="gambar" value="<?php echo $row['fotoProduk']; ?>" />
                  <input type="hidden" name="qty" value="1" />
                  <button type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Beli</button>
                </div>
                </form>
              </div>
            </div>
<?php
	}
?>