<?php	
	$dataKategori	= isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : '';
 ?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="fieldset-form">
	<div class="portlet box grey-cascade">
	    <div class="portlet-title">
	        <div class="caption">
	            <span class="caption-subject uppercase bold">Laporan Stok Barang & Produk</span>
	        </div>
	        <div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
				<a href="javascript:;" class="remove"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="row">
				<div class="col-lg-4">	
					<div class="form-group">
						<label>Kategori Barang :</label>
						<div class="controls" style="margin-top: 6px">
							<select name="cmbKategori" class="form-control select2" data-placeholder="Pilih Kategori" tabindex="1">
							  <option value="%"> PILIH SEMUA</option>
							  <?php
								  $dataSql = "SELECT * FROM ms_kategori WHERE status_kategori='Active' ORDER BY id_kategori DESC";
								  $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
								  while ($dataRow = mysqli_fetch_array($dataQry)) {
									if ($dataKategori == $dataRow['id_kategori']) {
										$cek = " selected";
									} else { $cek=""; }
									echo "<option value='$dataRow[id_kategori]' $cek>$dataRow[nama_kategori]</option>";
								  }
								  $sqlData ="";
							  ?>
						  	</select>
						
						</div>
					</div>
				</div>
				<div class="col-lg-2">	
					<div class="form-group">
						<div class="controls" style="margin-top: 30px">
							<button type="submit" class="btn blue" name="btnTampil"><i class="icon-magnifier-add"></i> Tampilkan</button>
						</div>
					</div>
				</div>
				<div class="col-lg-6" align="right">
					<div class="form-group">
						<div class="controls" style="margin-top: 30px">
						<?php
	                    	if(isset($_POST['btnTampil'])){
	                    ?>
						 <button name="bar" type="button" onClick="cetak_pdf()" class="btn blue"><i class="icon-printer"></i> Export PDF</button>
						 <button name="bar" type="button" onClick="cetak_excel()" class="btn blue"><i class="icon-printer"></i> Export Excel</button>
	                    <?php } ?>
						</div>
					</div>
				</div>
			</div>	
			<hr>
			<table class="table table-striped table-bordered table-hover " id="sample_4">
				<thead>
                    <tr class="active">
               	  	  	<th width="2%"><div align="center">NO</div></th>
                        <th width="8%"><div align="center">KODE BARANG</div></th>
						<th width="19%">KATEGORI</th>
                        <th width="33%"><div align="left">NAMA BARANG</div></th>
				  	  	<th width="10%"><div align="right">HARGA JUAL</div></th>
                      	<th width="13%"><div align="center">STOK</div></th>
					  	<th width="7%"><div align="right">SALDO</div></th>
                    </tr>
				</thead>
				<tbody>
                    <?php
                    if(isset($_POST['btnTampil'])){
						$dataKategori	= $_POST['cmbKategori'];
															
						$dataSql = mysqli_query($koneksidb, "SELECT * FROM ms_barang a
												LEFT JOIN ms_kategori b ON a.id_kategori=b.id_kategori 
												WHERE b.id_kategori LIKE '$dataKategori'");
					}
					$nomor  		= 0;
					$hargaJual		= 0;
					$jumlahStok		= 0;
					$saldo			= 0;
					$totalSaldo		= 0;
					while($dataRow	= mysqli_fetch_array($dataSql)){
						$nomor ++;
						$hargaJual	= $hargaJual + $dataRow['harga_jual'];
						$jumlahStok	= $jumlahStok + $dataRow['stok_barang'];
						$saldo 		= $dataRow['harga_jual']*$dataRow['stok_barang'];
						$totalSaldo	= $totalSaldo + $saldo;
						
                    ?>
                    <tr>
                        <td><div align="center"><?php echo $nomor;?></div></td>
						<td><div align="center"><?php echo $dataRow['kode_barcode']; ?></div></td>
						<td><?php echo $dataRow['nama_kategori']; ?></td>
						<td><div align="left"><?php echo $dataRow['nama_barang']; ?></div></td>
						<td><div align="right"><?php echo number_format($dataRow['harga_jual']); ?></div></td>
                        <td><div align="center"><?php echo number_format($dataRow['stok_barang']); ?></div></td>
						<td><div align="right"><?php echo number_format($saldo); ?></div></td>
                    </tr>
                    <?php } ?>
				</tbody>
				<tfoot>
                    <tr>
               	  	  	<th colspan="4"><div align="right"><b>SUBTOTAL : </b></div></th>
					  	<th width="12%"><div align="right"><b><?php echo number_format($hargaJual); ?></b></div></th>
					  	<th width="12%"><div align="center"><b><?php echo number_format($jumlahStok); ?></b></div></th>
						<th width="8%"><div align="right"><b><?php echo number_format($totalSaldo); ?></b></div></th>
                    </tr>
				</tfoot>
            </table>
	  </div>
  		</div>
	</div>
</div>
<script type="text/javascript"> 
    function cetak_pdf()	 
    { 
    win=window.open('./cetak/pdf_laporan_stok.php?kategori=<?php echo $dataKategori; ?>','win','width=1500, height=600, menubar=0, scrollbars=1, resizable=0, status=0'); 
    } 
    function cetak_excel()	 
    { 
    win=window.open('./cetak/excel_laporan_stok.php?kategori=<?php echo $dataKategori; ?>','win','width=1500, height=600, menubar=0, scrollbars=1, resizable=0, status=0'); 
    } 
</script>