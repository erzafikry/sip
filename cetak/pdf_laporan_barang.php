<?php
 //Define relative path from this script to mPDF
 $nama_file='Laporan_Barang'; //Beri nama file PDF hasil.
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
<h4 style="margin:0px 0px 0px 0px; font-weight:bold"><b>LAPORAN  BARANG</b> &amp; ITEM </h4>
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
	  	<th width="11%"><div align="center">KODE</div></th>
		<th width="23%" class="hidden-phone">KATEGORI</th>
	  	<th width="34%"><div align="left">NAMA BARANG</div></th>
		<th width="7%" class="hidden-phone"><div align="center">TERJUAL</div></th>
		<th width="8%" class="hidden-phone"><div align="center">RETUR</div></th>
	</tr>
	<?php
		$tglAwal		= $_GET['awal'];
		$tglAkhir		= $_GET['akhir'];
											
		$dataSql = mysqli_query($koneksidb, "SELECT * FROM (SELECT
												a.kode_barcode,
												a.nama_barang,
												b.kode_kategori,
												b.nama_kategori,
												c.nama_merk,
												a.status_barang,
												(SELECT SUM(jumlah_penjualan) FROM tr_penjualan_item a1
												INNER JOIN tr_penjualan b1 ON a1.id_penjualan=b1.id_penjualan
												WHERE a1.id_barang=a.id_barang
												AND date(b1.tgl_penjualan) BETWEEN '$tglAwal' AND '$tglAkhir'
												) AS total_jual,
												(SELECT SUM(jumlah_retur_jual) FROM tr_retur_jual_item a1
												INNER JOIN tr_retur_jual b1 ON a1.id_retur_jual=b1.id_retur_jual
												WHERE a1.id_barang=a.id_barang
												AND date(b1.tgl_retur_jual) BETWEEN '$tglAwal' AND '$tglAkhir'
												) AS total_retur_jual
												FROM ms_barang a
												LEFT JOIN ms_kategori b ON a.id_kategori=b.id_kategori
												LEFT JOIN ms_merk c ON a.id_merk=c.id_merk) as tbl order by total_jual DESC ")
						or die ("gagal tampil".mysqli_error());
	$nomor  		= 0;
	$jual			= 0;
	$returjual		= 0;
	while($dataRow	= mysqli_fetch_array($dataSql)){
		$nomor ++;
		$jual		= $jual + $dataRow['total_jual'];
		$returjual	= $returjual + $dataRow['total_retur_jual'];
		
	?>
	<tr>
		<td><div align="center"><?php echo $nomor;?></div></td>
		<td><div align="center"><?php echo $dataRow['kode_barcode']; ?></div></td>
		<td class="hidden-phone"><?php echo $dataRow['kode_kategori']; ?> - <?php echo $dataRow['nama_kategori']; ?></td>
		<td><div align="left"><?php echo $dataRow['nama_barang']; ?></div></td>
		<td><div align="center"><?php echo format_angka($dataRow['total_jual']); ?></div></td>
		<td><div align="center"><?php echo format_angka($dataRow['total_retur_jual']); ?></div></td>
	</tr>
	<?php } ?>
	<tr>
		<th colspan="4" align="right"><div align="right">SUBTOTAL : </div></th>
		<th width="7%"><div align="center"><?php echo format_angka($jual); ?></div></th>
		<th width="8%"><div align="center"><?php echo format_angka($returjual); ?></div></th>
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