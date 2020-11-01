<?php
    session_start();
    include_once "../config/inc.connection.php";
    include_once "../config/inc.library.php";
    


    header("Content-type: application/vnd.ms-excel; charset=UTF-8" );
    header("Content-Disposition: attachment; filename=Laporan_Retur_Penjualan_".date('ymd').".xls"); 
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 
    header('Content-Transfer-Encoding: binary');

    ob_end_flush();


    
?>
<table width="100%">
  <tr>
    <td colspan="10" align="center"><h3><u>LAPORAN RETUR PENJUALAN</u></h3></td>
  </tr>
  <tr>
    <td colspan="10" align="center" valign="top"></td>
  </tr>
</table>

<table border="1" width="100%">
	<tr>
		<th width="2%"><div align="center">NO</div></th>
        <th width="10%"><div align="center">TGL. RETUR</div></th>
        <th width="10%"><div align="center">NO. RETUR</div></th>
        <th width="10%"><div align="center">NO. TRANS</div></th>
		<th width="12%"><div align="center">KODE</div></th>
		<th width="40%">NAMA BARANG</th>
		<th width="5%"><div align="center">DISKON</div></th>
	  	<th width="10%"><div align="right">HARGA</div></th>
		<th width="8%"><div align="center">JUMLAH</div></th>
		<th width="8%"><div align="right">SUBTOTAL</div></th>
	</tr>
	<?php
		
		$tglAwal		= $_GET['awal'];
		$tglAkhir		= $_GET['akhir'];		
		$dataSql 		= mysqli_query($koneksidb, "SELECT * FROM tr_retur_jual_item a 
														INNER JOIN tr_retur_jual b ON a.id_retur_jual=b.id_retur_jual
														INNER JOIN ms_barang c ON a.id_barang=c.id_barang
														INNER JOIN tr_penjualan d ON b.id_penjualan=d.id_penjualan
														WHERE date(b.tgl_retur_jual) BETWEEN '$tglAwal' AND '$tglAkhir' 
														ORDER BY b.tgl_retur_jual DESC");
		$nomor  		= 0;
		$subtotal 		= 0;
		$total			= 0;
		$harga			= 0;
		$jumlah			= 0;
		while($dataRow	= mysqli_fetch_array($dataSql)){	
			$nomor ++;
			$total		= intval($dataRow ['jumlah_retur_jual']*($dataRow['harga_retur_jual']-($dataRow['harga_retur_jual']*$dataRow['diskon_retur_jual']/100)));
			$subtotal 	= $subtotal + $total;
			$jumlah 	= $jumlah + $dataRow ['jumlah_retur_jual'];
			$harga	 	= $harga + $dataRow ['harga_retur_jual'];
	?>
	<tr>
        <td><div align="center"><?php echo $nomor;?></div></td>
		<td><div align="center"><?php echo date('d/m/Y H:i', strtotime($dataRow ['tgl_retur_jual'])); ?> </div></td>
		<td><div align="center"><?php echo $dataRow ['kode_retur_jual']; ?></div></td>
		<td><div align="center"><?php echo $dataRow ['kode_penjualan']; ?></div></td>
		<td><div align="center"><?php echo $dataRow ['kode_barcode']; ?></div></td>
		<td><?php echo $dataRow ['nama_barang']; ?></td>
		<td><div align="center"><?php echo number_format($dataRow ['diskon_retur_jual']); ?></div></td>
		<td><div align="right"><?php echo ($dataRow ['harga_retur_jual']); ?></div></td>
		<td><div align="center"><?php echo ($dataRow ['jumlah_retur_jual']); ?></div></td>
		<td><div align="right"><?php echo ($total); ?></div></td>
    </tr>
    <?php } ?>
    <tr>
        <th colspan="7"><div align="right">SUBTOTAL : </div></th>
		<th width="10%"><div align="right"><?php echo ($harga) ?></div></th>
		<th width="8%"><div align="center"><?php echo ($jumlah) ?></div></th>
		<th width="8%"><div align="right"><?php echo ($subtotal) ?></div></th>
    </tr>
</table>