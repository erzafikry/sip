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
<h4 style="margin:0px 0px 0px 0px; font-weight:bold"><b>LAPORAN  BARANG</b> &amp; ITEM </h4>
<h4 style="margin:0px 0px 0px 0px">PERIODE : <?php echo IndonesiaTgl($_GET['awal'])?> S/D <?php echo IndonesiaTgl($_GET['akhir'])?></h4>
</div>
<br>
<table width="100%" class="table-list">
	<tr>
		<th width="2%"><div align="center">No</div></th>
	  <th width="11%"><div align="center">Kode</div></th>
		<th width="23%" class="hidden-phone">Kategori</th>
	  <th width="34%"><div align="left">Nama Barang</div></th>
		<th width="7%" class="hidden-phone"><div align="center">Beli</div></th>
		<th width="7%" class="hidden-phone"><div align="center">Jual</div></th>
		<th width="8%" class="hidden-phone"><div align="center">Retur Beli</div></th>
		<th width="8%" class="hidden-phone"><div align="center">Retur Jual</div></th>
	</tr>
	<?php
		$tglAwal		= $_GET['awal'];
		$tglAkhir		= $_GET['akhir'];
											
		$dataSql = mysql_query("SELECT
								a.kode_barcode,
								a.nama_barang,
								b.kode_kategori,
								b.nama_kategori,
								(SELECT COUNT(*) FROM tr_pembelian_item a1
								INNER JOIN tr_pembelian b1 ON a1.kode_pembelian=b1.kode_pembelian
								WHERE a1.kode_barang=a.kode_barang
								AND date(b1.tgl_pembelian) BETWEEN '$tglAwal' AND '$tglAkhir'
								) AS total_beli,
								(SELECT COUNT(*) FROM tr_penjualan_item a1
								INNER JOIN tr_penjualan b1 ON a1.kode_penjualan=b1.kode_penjualan
								WHERE a1.kode_barang=a.kode_barang
								AND date(b1.tgl_penjualan) BETWEEN '$tglAwal' AND '$tglAkhir'
								) AS total_jual,
								(SELECT COUNT(*) FROM tr_retur_beli_item a1
								INNER JOIN tr_retur_beli b1 ON a1.kode_retur_beli=b1.kode_retur_beli
								WHERE a1.kode_barang=a.kode_barang
								AND date(b1.tgl_retur_beli) BETWEEN '$tglAwal' AND '$tglAkhir'
								) AS total_retur_beli,
								(SELECT COUNT(*) FROM tr_retur_jual_item a1
								INNER JOIN tr_retur_jual b1 ON a1.kode_retur_jual=b1.kode_retur_jual
								WHERE a1.kode_barang=a.kode_barang
								AND date(b1.tgl_retur_jual) BETWEEN '$tglAwal' AND '$tglAkhir'
								) AS total_retur_jual
								FROM ms_barang a
								LEFT JOIN ms_kategori b ON a.kode_kategori=b.kode_kategori 
								ORDER BY a.kode_kategori DESC");
	$nomor  		= 0;
	$beli			= 0;
	$jual			= 0;
	$returjual		= 0;
	$returbeli		= 0;
	while($dataRow	= mysql_fetch_array($dataSql)){
		$nomor ++;
		$beli		= $beli + $dataRow['total_beli'];
		$jual		= $jual + $dataRow['total_jual'];
		$returjual	= $returjual + $dataRow['total_retur_jual'];
		$returbeli	= $returbeli + $dataRow['total_retur_beli'];
		
	?>
	<tr>
		<td><div align="center"><?php echo $nomor;?></div></td>
		<td><div align="center"><?php echo $dataRow['kode_barcode']; ?></div></td>
		<td class="hidden-phone"><?php echo $dataRow['kode_kategori']; ?> - <?php echo $dataRow['nama_kategori']; ?></td>
		<td><div align="left"><?php echo $dataRow['nama_barang']; ?></div></td>
		<td><div align="center"><?php echo format_angka($dataRow['total_beli']); ?></div></td>
		<td><div align="center"><?php echo format_angka($dataRow['total_jual']); ?></div></td>
		<td><div align="center"><?php echo format_angka($dataRow['total_retur_beli']); ?></div></td>
		<td><div align="center"><?php echo format_angka($dataRow['total_retur_jual']); ?></div></td>
	</tr>
	<?php } ?>
	<tr>
		<th colspan="4"><div align="right">Subtotal : </div></th>
		<th width="7%"><div align="center"><?php echo format_angka($beli); ?></div></th>
		<th width="7%"><div align="center"><?php echo format_angka($jual); ?></div></th>
		<th width="8%"><div align="center"><?php echo format_angka($returbeli); ?></div></th>
		<th width="8%"><div align="center"><?php echo format_angka($returjual); ?></div></th>
	</tr>
</table>
