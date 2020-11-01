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
<h4 style="margin:0px 0px 0px 0px; font-weight:bold"><b>LAPORAN  SUPPLIER / PEMASOK</b></h4>
<h4 style="margin:0px 0px 0px 0px">PERIODE : <?php echo IndonesiaTgl($_GET['awal'])?> S/D <?php echo IndonesiaTgl($_GET['akhir'])?></h4>
</div>
<br>
<table class="table-list" width="100%">
	<tr>
		<th width="2%"><div align="center">No</div></th>
		<th width="6%"><div align="center">Kode</div></th>
		<th width="22%"><div align="left">Nama Barang</div></th>
		<th width="36%" class="hidden-phone">Alamat</th>
		<th width="23%" class="hidden-phone">Jenis Supplier</th>
		<th width="6%" class="hidden-phone"><div align="center">Supply</div></th>
		<th width="5%" class="hidden-phone"><div align="center">Retur</div></th>
	</tr>
	<?php
		$tglAwal		= $_GET['awal'];
		$tglAkhir		= $_GET['akhir'];
											
		$dataSql = mysql_query("SELECT
								a.kode_supplier,
								a.nama_supplier,
								a.jenis_supplier,
								a.alamat_supplier,
								(SELECT SUM(jumlah_pembelian) FROM tr_pembelian_item a1
								INNER JOIN tr_pembelian b1 ON a1.kode_pembelian=b1.kode_pembelian
								WHERE b1.kode_supplier=a.kode_supplier
								AND date(b1.tgl_pembelian) BETWEEN '$tglAwal' AND '$tglAkhir'
								) AS total_beli,
								(SELECT SUM(jumlah_retur_beli) FROM tr_retur_beli_item a1
								INNER JOIN tr_retur_beli b1 ON a1.kode_retur_beli=b1.kode_retur_beli
								INNER JOIN tr_pembelian c1 ON b1.kode_pembelian=c1.kode_pembelian
								WHERE c1.kode_supplier=a.kode_supplier
								AND date(b1.tgl_retur_beli) BETWEEN '$tglAwal' AND '$tglAkhir'
								) AS total_retur_beli
								FROM ms_supplier a 
								ORDER BY a.kode_supplier DESC");
	
	$nomor  		= 0;
	$beli			= 0;
	$returbeli		= 0;
	while($dataRow	= mysql_fetch_array($dataSql)){
		$nomor ++;
		$beli		= $beli + $dataRow['total_beli'];
		$returbeli	= $returbeli + $dataRow['total_retur_beli'];
		
	?>
	<tr>
		<td><div align="center"><?php echo $nomor;?></div></td>
		<td><div align="center"><?php echo $dataRow['kode_supplier']; ?></div></td>
		<td class="hidden-phone"><?php echo $dataRow['nama_supplier']; ?></td>
		<td><div align="left"><?php echo $dataRow['alamat_supplier']; ?></div></td>
		<td><div align="left"><?php echo $dataRow['jenis_supplier']; ?></div></td>
		<td><div align="center"><?php echo format_angka($dataRow['total_beli']); ?></div></td>
		<td><div align="center"><?php echo format_angka($dataRow['total_retur_beli']); ?></div></td>
	</tr>
	<?php } ?>
	<tr>
		<th colspan="5"><div align="right">Subtotal : </div></th>
	  	<th width="6%"><div align="center"><?php echo format_angka($beli); ?></div></th>
	  	<th width="5%"><div align="center"><?php echo format_angka($returbeli); ?></div></th>
	</tr>
</table>
