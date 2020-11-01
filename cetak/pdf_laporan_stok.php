<?php
 //Define relative path from this script to mPDF
 $nama_file='Laporan_Stock'; //Beri nama file PDF hasil.
define('_MPDF_PATH','../plugin/mpdf60/');
//define("_JPGRAPH_PATH", '../mpdf60/graph_cache/src/');

//define("_JPGRAPH_PATH", '../jpgraph/src/'); 
 
include(_MPDF_PATH . "mpdf.php");
//include(_MPDF_PATH . "graph.php");

//include(_MPDF_PATH . "graph_cache/src/");

$mpdf=new mPDF('utf-8', 'A4-L', 10.5, 'arial'); // Membuat file mpdf baru
 
//Beginning Buffer to save PHP variables and HTML tags
ob_start(); 

$mpdf->useGraphs = true;

?>
<?php
	include_once "../config/inc.connection.php";
	include_once "../config/inc.library.php";
	
	$tokoSql = "SELECT * FROM ms_toko ";
	$tokoQry = mysqli_query($koneksidb, $tokoSql)  or die ("Query toko salah : ".mysqli_error());
	$tokoRow = mysqli_fetch_array($tokoQry);	
	
?>
<div align="center" style="margin-bottom:15px">
<h3 style="margin:0px 0px 0px 0px; font-weight:bold"><strong><?php echo $tokoRow['nama_toko']; ?></strong></h3>
<h4 style="margin:0px 0px 0px 0px"><?php echo $tokoRow['alamat_toko'] ?>, Telp: <?php echo $tokoRow['telp_toko'] ?>, Email: <?php echo $tokoRow['email_toko'] ?></h4>
<h4 style="margin:0px 0px 0px 0px; font-weight:bold"><b>LAPORAN STOK BARANG</b></h4>
<h4 style="margin:0px 0px 0px 0px">PERIODE : <?php echo date('d-m-Y H:i:s');?></h4>
</div>
<br>
<style>
        *
        {
            margin:0;
            padding:0;
            font-family: calibri;
            font-size:10pt;
            color:#000;
        }
        body
        {
            width:100%;
            font-family: calibri;
            font-size:8pt;
            margin:0;
            padding:0;
        }
         
        p
        {
            margin:0;
            padding:0;
            margin-left: 200px;
        }
         
        table
        {
            font-family: calibri; 
            border-spacing:0;
            border-collapse: collapse; 
             
        }
         
        table td 
        {
            padding: 1mm;
            
        }
.style2 {
    font-size: 14pt;
    font-weight: bold;
    outline:dashed
}
.style5 {
    font-size: 13pt;
    font-weight: bold
}
</style>
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
		<td><div align="right"><?php echo number_format($dataRow['harga_jual']); ?></div></td>
        <td><div align="center"><?php echo number_format($dataRow['stok_barang']); ?></div></td>
		<td><div align="right"><?php echo number_format($saldo); ?></div></td>
    </tr>
    <?php } ?>
    <tr>
	  	  	<th colspan="4"><div align="right"><b>SUBTOTAL : </b></div></th>
	  	<th width="12%"><div align="right"><b><?php echo number_format($hargaJual); ?></b></div></th>
	  	<th width="12%"><div align="center"><b><?php echo number_format($jumlahStok); ?></b></div></th>
		<th width="8%"><div align="right"><b><?php echo number_format($totalSaldo); ?></b></div></th>
    </tr>
</table>
<?php



$html = ob_get_contents(); //Proses untuk mengambil data
ob_end_clean();
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);

$mpdf->WriteHTML(utf8_encode($html));
// LOAD a stylesheet

$mpdf->Output($nama_file."_".date('ymd').".pdf" ,'I');

 


exit; 
?>