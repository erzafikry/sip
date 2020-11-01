<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../assets/css/metro.css" rel="stylesheet" />
<link href="../assets/css/style.css" rel="stylesheet" />
<body OnLoad="window.print()" OnFocus="window.close()">
<?php
	include_once "../config/inc.connection.php";
	include_once "../config/inc.library.php";
	
	$tokoSql = "SELECT * FROM ms_toko ";
	$tokoQry = mysql_query($tokoSql, $koneksidb)  or die ("Query toko salah : ".mysql_error());
	$tokoRow = mysql_fetch_array($tokoQry);	
	
?>
<div align="center" style="margin-bottom:15px">
<h3 style="margin:0px 0px 0px 0px; font-weight:bold"><strong><?php echo $tokoRow['nama_toko']; ?></strong></h3>
<h4 style="margin:0px 0px 0px 0px"><?php echo $tokoRow['alamat_toko'] ?>, Telp: <?php echo $tokoRow['telp_toko'] ?>, Email: <?php echo $tokoRow['email_toko'] ?></h4>
<h4 style="margin:0px 0px 0px 0px; font-weight:bold"><b>LAPORAN STOK BARANG</b></h4>
<h4 style="margin:0px 0px 0px 0px">PERIODE : <?php echo date('d-m-Y H:i:s');?></h4>
</div>
<br>
<table width="100%" class="table-list">
	<tr>
		<th width="2%"><div align="center">No</div></th>
	  	<th width="9%"><div align="center">Kode</div></th>
		<th width="22%">Kategori</th>
	  	<th width="37%"><div align="left">Nama Barang</div></th>
	  	<th width="12%"><div align="right">Harga Beli</div></th>
	  	<th width="10%"><div align="right">Harga Jual</div></th>
	  	<th width="8%"><div align="center">Stok</div></th>
	</tr>
	<?php
	if(isset($_GET['kategori'])){
		$dataKategori	= $_GET['kategori'];
											
		$dataSql = mysql_query("SELECT * FROM ms_barang a
								LEFT JOIN ms_kategori b ON a.kode_kategori=b.kode_kategori 
								WHERE b.kode_kategori LIKE '$dataKategori'
								ORDER BY a.kode_kategori DESC");
	}
	$nomor  		= 0;
	$hargaBeli		= 0;
	$hargaJual		= 0;
	$jumlahStok		= 0;
	while($dataRow	= mysql_fetch_array($dataSql)){
		$nomor ++;
		$hargaBeli	= $hargaBeli + $dataRow['harga_beli'];
		$hargaJual	= $hargaJual + $dataRow['harga_jual'];
		$jumlahStok	= $jumlahStok + $dataRow['stok_barang'];
		
	?>
	<tr>
		<td><div align="center"><?php echo $nomor;?></div></td>
		<td><div align="center"><?php echo $dataRow['kode_barcode']; ?></div></td>
		<td class="hidden-phone"><?php echo $dataRow['kode_kategori']; ?> - <?php echo $dataRow['nama_kategori']; ?></td>
		<td><div align="left"><?php echo $dataRow['nama_barang']; ?></div></td>
		<td class="hidden-phone"><div align="right"><?php echo format_angka($dataRow['harga_jual']); ?></div></td>
		<td><div align="right"><?php echo format_angka($dataRow['harga_beli']); ?></div></td>
		<td><div align="center"><?php echo format_angka($dataRow['stok_barang']); ?></div></td>
	</tr>
	<?php } ?>
	<tr>
		<th colspan="4"><div align="right">Subtotal : </div></th>
	  	<th width="12%"><div align="right"><?php echo format_angka($hargaJual); ?></div></th>
	  	<th width="10%"><div align="right"><?php echo format_angka($hargaBeli); ?></div></th>
	  	<th width="8%"><div align="center"><?php echo format_angka($jumlahStok); ?></div></th>
	</tr>
</table>
