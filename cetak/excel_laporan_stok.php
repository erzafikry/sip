<?php
    session_start();
    include_once "../config/inc.connection.php";
    include_once "../config/inc.library.php";
    


    header("Content-type: application/vnd.ms-excel; charset=UTF-8" );
    header("Content-Disposition: attachment; filename=Laporan_Stok_Barang_".date('ymd').".xls"); 
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 
    header('Content-Transfer-Encoding: binary');

    ob_end_flush();


    
?>
<table width="100%">
  <tr>
    <td colspan="7" align="center"><h3><u>LAPORAN STOK BARANG</u></h3></td>
  </tr>
  <tr>
    <td colspan="7" align="center" valign="top"></td>
  </tr>
</table>

<table border="1" width="100%">
	<tr>
		<th width="2%"><div align="center">NO</div></th>
	  	<th width="9%"><div align="center">KODE</div></th>
		<th width="22%">KATEGORI</th>
	  	<th width="37%"><div align="left">NAMA BARANG</div></th>
	  	<th width="10%"><div align="right">HARGA</div></th>
	  	<th width="8%"><div align="center">STOK</div></th>
	  	<th width="12%"><div align="right">SALDO</div></th>
	</tr>
	<?php
	if(isset($_GET['kategori'])){
		$dataKategori	= $_GET['kategori'];
											
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
		<td><div align="right"><?php echo ($dataRow['harga_jual']); ?></div></td>
        <td><div align="center"><?php echo ($dataRow['stok_barang']); ?></div></td>
		<td><div align="right"><?php echo ($saldo); ?></div></td>
    </tr>
    <?php } ?>
    <tr>
	  	  	<th colspan="4"><div align="right"><b>SUBTOTAL : </b></div></th>
	  	<th width="12%"><div align="right"><b><?php echo ($hargaJual); ?></b></div></th>
	  	<th width="12%"><div align="center"><b><?php echo ($jumlahStok); ?></b></div></th>
		<th width="8%"><div align="right"><b><?php echo ($totalSaldo); ?></b></div></th>
    </tr>
</table>