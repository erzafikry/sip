
<link href="../assets/global/css/components.css" rel="stylesheet" type="text/css" />
<body OnLoad="window.print()" OnFocus="window.close()">
<?php
	include "../config/inc.connection.php";
	include "../config/inc.library.php";
				
	$kodeTransaksi = $_GET['id'];				
	$beliSql = "SELECT * FROM tr_penjualan a
				LEFT JOIN ms_customer b ON a.id_customer=b.id_customer
				INNER JOIN ms_user c ON a.id_user=c.id_user
				AND a.id_penjualan='$kodeTransaksi'";
	$beliQry = mysqli_query($koneksidb, $beliSql)  or die ("Query pembelian salah : ".mysqli_error());
	$beliRow = mysqli_fetch_array($beliQry);
	
	$tokoSql = "SELECT * FROM ms_toko ";
	$tokoQry = mysqli_query($koneksidb, $tokoSql)  or die ("Query toko salah : ".mysqli_error());
	$tokoRow = mysqli_fetch_array($tokoQry);
?>
<div align="center">
<h4 style="margin-bottom:0px; font-weight: bold;"><?php echo strtoupper($tokoRow['nama_toko']) ?></h4>
<small style="margin-top:0px"><?php echo $tokoRow['alamat_toko'] ?>, Telp: <?php echo $tokoRow['telp_toko'] ?>, Email: <?php echo $tokoRow['email_toko'] ?></small> 
<div style="border-bottom:1px dashed #000;"></div>
</div>
 <table style="font-size: 12px">
  <tr>
    <td width="4%">NOMOR</td>
    <td width="96%">: <span style="margin-top:0px"><?php echo $beliRow['kode_penjualan'] ?></span></td>
  </tr>
  <tr>
    <td>TANGGAL</td>
    <td>: <span style="margin-top:0px"><?php echo date('d/m/Y', strtotime($beliRow['tgl_penjualan'])) ?></span></td>
  </tr>
  <tr>
    <td>KASIR</td>
    <td>: <span style="margin-top:0px"><?php echo $beliRow['nama_user'] ?></span></td>
  </tr>
  <tr>
    <td colspan="2"><div style="border-bottom:1px dashed #000;"></div></td>
  </tr>
</table>
<table width="100%" style="font-size: 12px">
  <tr>
    <th width="2%"><div align="center">QTY</div></th>
    <th width="98%"><div align="left">ITEM</div></th>
    <th width="10%"><div align="left">HARGA</div></th>
    <th width="10%"><div align="center">DISC</div></th>
    <th><div align="right">SUBTOTAL</div></th>
  </tr>
  <tr>
    <th colspan="5"><div style="border-bottom:1px dashed #000;"></div></th>
  </tr>
<?php
	$listBarangSql = "SELECT * FROM tr_penjualan_item a
						LEFT JOIN tr_penjualan b ON a.id_penjualan=b.id_penjualan 
						INNER JOIN ms_barang c ON a.id_barang=c.id_barang
						WHERE a.id_penjualan='$kodeTransaksi'
						ORDER BY c.id_barang ASC";
	$listBarangQry = mysqli_query($koneksidb, $listBarangSql)  or die ("Query list barang salah : ".mysqli_error());
	$total 	= 0; 
	$qtyBrg = 0; 
	$qtyPPN	= 0;
	while ($listBarangRow = mysqli_fetch_array($listBarangQry)) {
	$subSotal 	= $listBarangRow['jumlah_penjualan'] * intval($listBarangRow['harga_penjualan'] - ($listBarangRow['harga_penjualan']*$listBarangRow['diskon_penjualan']/100));
	$total 		  = $total + $subSotal;
	$qtyBrg 	  = $qtyBrg + $listBarangRow['jumlah_penjualan'];
?>
  <tr>
    <td width="2%"><div align="center"><?php echo number_format($listBarangRow['jumlah_penjualan']); ?></div></td>
    <td width="98%"><div align="left"><?php echo $listBarangRow['nama_barang']; ?></div></td>
    <td width="10%"><div align="left"><?php echo number_format($listBarangRow['harga_penjualan']); ?></div></td>
    <td width="10%"><div align="center"><?php echo number_format($listBarangRow['diskon_penjualan']); ?>%</div></td>
    <td><div align="right"><?php echo number_format($subSotal); ?></div></td>
  </tr>
  <?php } ?>
</table>
<div style="border-bottom:1px dashed #000;"></div>
<table width="100%" border="0" style="font-size: 12px">
  <tr>
    <td width="60%"><div align="right">GRAND TOTAL  </div></td>
    <td width="1%">:</td>
    <td width="39%"><div align="right"><?php echo number_format($total); ?></div></td>
  </tr>
  <tr>
    <td><div align="right">BAYAR </div></td>
    <td>:</td>
    <td><div align="right"><?php echo number_format($beliRow['total_pembayaran']); ?></div></td>
  </tr>
  <tr>
    <td><div align="right">KEMBALI </div></td>
    <td>:</td>
    <td><div align="right"><?php echo number_format(($beliRow['total_pembayaran']) - ($total)); ?></div></td>
  </tr>
</table>
<div style="border-bottom:1px dashed #000;"></div>
<div align="center" style="margin-top:20px">
<b>===== TERIMA KASIH =====</b><br>
<?php echo $tokoRow['keterangan_toko'] ?>
</div>
</body>



