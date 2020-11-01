<?php
 //Define relative path from this script to mPDF
 $nama_file='Laporan_Customer'; //Beri nama file PDF hasil.
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
<h4 style="margin:0px 0px 0px 0px; font-weight:bold"><b>LAPORAN  CUSTOMER</b></h4>
<h4 style="margin:0px 0px 0px 0px">PERIODE : <?php echo IndonesiaTgl($_GET['awal'])?> S/D <?php echo IndonesiaTgl($_GET['akhir'])?></h4>
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
	  	<th width="5%"><div align="center">KODE</div></th>
      	<th width="20%"><div align="left">NAMA CUSTOMER</div></th>
		<th width="65%">ALAMAT</th>
  	  	<th width="5%"><div align="center">PEMBELIAN</div></th>
  	  	<th width="5%"><div align="center">RETUR</div></th>
	</tr>
	<?php
		$tglAwal		= $_GET['awal'];
		$tglAkhir		= $_GET['akhir'];
											
		$dataSql = mysqli_query($koneksidb, "SELECT
												a.nama_customer,
												a.kode_customer,
												a.alamat_customer,
												a.status_customer,
												count(b.id_customer) as total_jual,
												count(c.id_penjualan) as total_retur_jual
											FROM
												ms_customer a
												INNER JOIN tr_penjualan b ON b.id_customer = a.id_customer AND b.tgl_penjualan BETWEEN '$tglAwal' and '$tglAkhir'
												LEFT JOIN tr_retur_jual c ON b.id_penjualan=c.id_penjualan AND c.tgl_retur_jual BETWEEN '$tglAwal' and '$tglAkhir'
											GROUP BY
												a.nama_customer,
												a.kode_customer,
												a.alamat_customer,
												a.status_customer")
						or die ("gagal tampil".mysqli_error());
	$nomor  		= 0;
	$beli			= 0;
	$returbeli		= 0;
	while($dataRow	= mysqli_fetch_array($dataSql)){
		$nomor ++;
		$beli		= $beli + $dataRow['total_jual'];
		$returbeli	= $returbeli + $dataRow['total_retur_jual'];
	?>
	<tr>
		<td><div align="center"><?php echo $nomor;?></div></td>
		<td><div align="center"><?php echo $dataRow['kode_customer']; ?></div></td>
		<td><?php echo $dataRow['nama_customer']; ?></td>
		<td><div align="left"><?php echo $dataRow['alamat_customer']; ?></div></td>
        <td><div align="center"><?php echo number_format($dataRow['total_jual']); ?></div></td>
        <td><div align="center"><?php echo number_format($dataRow['total_retur_jual']); ?></div></td>
	</tr>
	<?php } ?>
	<tr>
		<th colspan="4"><b><div align="right">SUBTOTAL : </div></b></th>
  	  	<th width="6%"><b><div align="center"><?php echo number_format($beli); ?></div></b></th>
  	  	<th width="5%"><b><div align="center"><?php echo number_format($returbeli); ?></div></b></th>
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