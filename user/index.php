<?php 
	// menghubungkan ke function
	require "function.php";

	$produk = getDataBaseProduk("SELECT * FROM produk");

	if(isset($_POST['filter-harga'])){
		$produk = getDataBaseProduk("SELECT * FROM produk ORDER BY harga DESC");
	} else if(isset($_POST['filter-stok'])){
		$produk = getDataBaseProduk("SELECT * FROM produk ORDER BY stok DESC");
	}

 ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Free User</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		.hidden {
			display: none;
		}
	</style>
</head>
<body>
	<div class="container-keseluruhan">
		<div class="conten">
		<!-- header -->
		<div class="header">
			<img src="img/logo1.png" class="logo img-fluid">	
		</div>
		<!-- Typografi -->
		<div class="typo">
			<h2>SELAMAT DATANG DI TOKO BUAH DEVI</h2>
			<h6>Menyediakan</h6>
			<h3>Buah</h3>
			<h3>Frozen Food</h3>
			<!-- Tanggal -->
			<?php echo date("l, d-M-Y"); ?>
		</div>
		<!-- hero -->
		<img src="img/hero.png" class="hero img-fluid">
		<!-- copyright -->
		<div class="copyright">
			<div class="gambar"></div>
			<div class="kiri">
				<p>Toko buah devi berlokasi di Kintap, Kabupaten Tanah Laut, Kalimantan Selatan</p>
			</div>
			<div class="tengah-kanan">
				<p>Selamat datang di toko buah devi tempatnya untuk membeli buah, dengan web ini anda bisa melihat stok buah yang tersedia di toko buah devi</p>
			</div>
			<div class="sosialmedia">
				<a href=""><img src="img/fb.png"></a>
				<a href=""><img src="img/ig.png"></a>
				<a href=""><img src="img/twitter.png"></a>
			</div>
		</div>
		<!-- end header -->
	</div>
	<!-- end conten -->
	<div class="pembatas"></div>
	<div class="keranjang">
		<h2>Produk </h2>
		<div class="button-switch">
			<button onclick="switchProduk('all')" class="switch-all" id="tombol-all">All</button>
			<button onclick="switchProduk('buah')" class="switch-buah" id="tombol-buah">Buah</button>
			<button onclick="switchProduk('food')" class="switch-food" id="tombol-frozen">Frozen Food</button>
			<button onclick="switchProduk('')" class="switch-lainnya" id="tombol-lainnya">Lainnya</button>		
		</div>
		<div class="search">
				<input type="text" id="cari" name="input-user" placeholder="Cari..">	
		</div>
	</div>

	<div class="container-produk">
		<div id="kotak-produk">
			<ul>
				<div id="produk-buah">
					<div id="conten"></div>
						<?php for($i = count($produk)-1; $i >= 0; $i-- ): ?>
						<?php if($produk[$i]['kategori'] == 'buah'){ ?>
							<li>
								<div class="image" style="background-image: url(../assets/img/<?php echo $produk[$i]["gambar"]; ?>);"></div>
							 	<h2><?php echo $produk[$i]['nama']; ?></h2>	
							 	<p class="harga">Rp <?php echo number_format($produk[$i]['harga'], 0, ',', '.'); ?></p>
							 	<?php if($produk[$i]['stok'] == 0): ?>
							 		<p class="sold-out">Sold Out</p>
							 	<?php endif; ?>
							 	<p class="stok">
							 			<?php echo $produk[$i]['stok'] ?>
							 		<span class="satuan"><?php echo $produk[$i]['satuan']; ?></span>	
							 	</p> 	
							 	<!-- pop up -->
								<button type="button" class="selengkapnya btn btn-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#<?php echo $produk[$i]["id"] ?>">
									<img alt="<?php $produk[$i]["gambar"]; ?>">
									Selengkapnya
								</button>
							</li>
						<!-- Modal -->
					<div class="modal fade" id="<?php echo $produk[$i]["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered">
					    <div class="modal-content">
					      <div class="modal-header">
					      	<?php if($produk[$i]["kategori"] == "buah"){ ?>
					      		<h1 class="modal-title fs-5" id="exampleModalLabel">Produk Buah</h1>
					      	<?php } else if($produk[$i]["kategori"] == "frozen food"){ ?>
					      		<h1 class="modal-title fs-5" id="exampleModalLabel">Produk Frozen Food</h1>
					     	<?php } ?>
					        
					        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					      </div>
					      <!-- isi pop up -->
					      <div class="isi-popup modal-body">
					      	 <img src="../assets/img/<?php echo $produk[$i]["gambar"] ?>" class="img-fluid">
					      	 <table class="table">
					      	 	<thead>
					      	 		<th>Produk</th>
					      	 		<th>Kategori</th>
					      	 		<th>Harga</th>
					      	 	</thead>
					      	 	<tbody>
					      	 		<tr>
					      	 			<th><?php echo $produk[$i]["nama"]; ?></th>
					      	 			<th>Buah</th>
					      	 			<th>Rp.<?php echo $produk[$i]["harga"];?>/<?php echo $produk[$i]["satuan"]; ?></th>
					      	 		</tr>
					      	 	</tbody>
					      	 </table>
					       <div class="deskripsi">
					       	<h6>Deskripsi</h6>
					       	<div class="form-deskripsi"><p><?php echo $produk[$i]["deskripsi"] ?></p></div>
					       </div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
					<!-- end pop up -->
					<?php }?>
					<?php endfor; ?>
				</div>

				<div id="produk-food">
						<?php for($i = count($produk)-1; $i > 0; $i-- ): ?>
						<?php if($produk[$i]['kategori'] == 'frozen food'){ ?>
							<li>
								<div class="image" style="background-image: url(../assets/img/<?php echo $produk[$i]["gambar"]; ?>);"></div>
							 	<h2><?php echo $produk[$i]['nama']; ?></h2>	
							 	<p class="harga">Rp <?php echo number_format($produk[$i]['harga'], 0, ',', '.'); ?></p>
							 	<?php if($produk[$i]['stok'] == 0): ?>
							 		<p class="sold-out">Sold Out</p>
							 	<?php endif; ?>
							 	<p class="stok">
							 			<?php echo $produk[$i]['stok'] ?>
							 		<span class="satuan"><?php echo $produk[$i]['satuan']; ?></span>	
							 	</p> 	
							 	<!-- pop up -->
								<button type="button" class="selengkapnya btn btn-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#<?php echo $produk[$i]["id"] ?>">
									<img alt="<?php $produk[$i]["gambar"]; ?>">
									Selengkapnya
								</button>
							</li>
						<!-- Modal -->
					<div class="modal fade" id="<?php echo $produk[$i]["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered">
				    <div class="modal-content">
				      <div class="modal-header">
				      	<?php if($produk[$i]["kategori"] == "buah"){ ?>
				      		<h1 class="modal-title fs-5" id="exampleModalLabel">Produk Buah</h1>
				      	<?php } else if($produk[$i]["kategori"] == "frozen food"){ ?>
				      		<h1 class="modal-title fs-5" id="exampleModalLabel">Produk Frozen Food</h1>
				     	<?php } ?>
				        
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>
				      <!-- isi pop up -->
				      <div class="isi-popup modal-body">
				      	 <img src="../assets/img/<?php echo $produk[$i]["gambar"] ?>" class="img-fluid">
				      	 <table class="table">
				      	 	<thead>
				      	 		<th>Produk</th>
				      	 		<th>Kategori</th>
				      	 		<th>Harga</th>
				      	 	</thead>
				      	 	<tbody>
				      	 		<tr>
				      	 			<th><?php echo $produk[$i]["nama"]; ?></th>
				      	 			<th>Buah</th>
				      	 			<th>Rp.<?php echo $produk[$i]["harga"];?>/<?php echo $produk[$i]["satuan"]; ?></th>
				      	 		</tr>
				      	 	</tbody>
				      	 </table>
				       <div class="deskripsi">
				       	<h6>Deskripsi</h6>
				       	<div class="form-deskripsi"><p><?php echo $produk[$i]["deskripsi"] ?></p></div>
				       </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				      </div>
				    </div>
				  </div>
					</div>
					<!-- end pop up -->
					<?php }?>
				<?php endfor; ?>
				</div>

				<div id="produk-lainnya">
						<?php for($i = count($produk)-1; $i > 0; $i-- ): ?>
						<?php if($produk[$i]['kategori'] == 'lainnya'){ ?>
							<li>
								<div class="image" style="background-image: url(../assets/img/<?php echo $produk[$i]["gambar"]; ?>);"></div>
							 	<h2><?php echo $produk[$i]['nama']; ?></h2>	
							 	<p class="harga">Rp <?php echo number_format($produk[$i]['harga'], 0, ',', '.'); ?></p>
							 	<?php if($produk[$i]['stok'] == 0): ?>
							 		<p class="sold-out">Sold Out</p>
							 	<?php endif; ?>
							 	<p class="stok">
							 			<?php echo $produk[$i]['stok'] ?>
							 		<span class="satuan"><?php echo $produk[$i]['satuan']; ?></span>	
							 	</p> 	
							 	<!-- pop up -->
								<button type="button" class="selengkapnya btn btn-primary text-decoration-none" data-bs-toggle="modal" data-bs-target="#<?php echo $produk[$i]["id"] ?>">
									<img alt="<?php $produk[$i]["gambar"]; ?>">
									Selengkapnya
								</button>
							</li>
						<!-- Modal -->
					<div class="modal fade" id="<?php echo $produk[$i]["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered">
				    <div class="modal-content">
				      <div class="modal-header">
				      	<?php if($produk[$i]["kategori"] == "buah"){ ?>
				      		<h1 class="modal-title fs-5" id="exampleModalLabel">Produk Buah</h1>
				      	<?php } else if($produk[$i]["kategori"] == "frozen food"){ ?>
				      		<h1 class="modal-title fs-5" id="exampleModalLabel">Produk Frozen Food</h1>
				     	<?php } ?>
				        
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>
				      <!-- isi pop up -->
				      <div class="isi-popup modal-body">
				      	 <img src="../assets/img/<?php echo $produk[$i]["gambar"] ?>" class="img-fluid">
				      	 <table class="table">
				      	 	<thead>
				      	 		<th>Produk</th>
				      	 		<th>Kategori</th>
				      	 		<th>Harga</th>
				      	 	</thead>
				      	 	<tbody>
				      	 		<tr>
				      	 			<th><?php echo $produk[$i]["nama"]; ?></th>
				      	 			<th>Buah</th>
				      	 			<th>Rp.<?php echo $produk[$i]["harga"];?>/<?php echo $produk[$i]["satuan"]; ?></th>
				      	 		</tr>
				      	 	</tbody>
				      	 </table>
				       <div class="deskripsi">
				       	<h6>Deskripsi</h6>
				       	<div class="form-deskripsi"><p><?php echo $produk[$i]["deskripsi"] ?></p></div>
				       </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				      </div>
				    </div>
				  </div>
					</div>
					<!-- end pop up -->
					<?php }?>
				<?php endfor; ?>
				</div>
				<div class="wa">
					<a href="https://api.whatsapp.com/send?phone=6282150646254&text=Halo%20saya%20ingin%20bertanya" target="blank"><img src="img/wa.png" width="60px"></a>

				</div>


				<div class="clear"></div>
			</ul>
			
		</div>
	</div>
	</div>
	</div>

	<!-- bootrsap -->
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/popper.js"></script>

	<script type="text/javascript" src="script.js"></script>
</body>
</html>