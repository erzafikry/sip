<?php
 //Define relative path from this script to mPDF
 $nama_file='Laporan_Berkas'; //Beri nama file PDF hasil.
define('_MPDF_PATH','../plugin/mpdf60/');
//define("_JPGRAPH_PATH", '../mpdf60/graph_cache/src/');

//define("_JPGRAPH_PATH", '../jpgraph/src/'); 
 
include(_MPDF_PATH . "mpdf.php");
//include(_MPDF_PATH . "graph.php");

//include(_MPDF_PATH . "graph_cache/src/");

$mpdf=new mPDF('utf-8', 'legal-L', 10.5, 'arial'); // Membuat file mpdf baru
 
//Beginning Buffer to save PHP variables and HTML tags
ob_start(); 

$mpdf->useGraphs = true;

?>

<?php
	include_once "../config/inc.connection.php";
	include_once "../config/inc.library.php";
		
	
?>
<div align="center" style="margin-bottom:15px">
<h4 style="margin:0px 0px 0px 0px; font-weight:bold"><b>LAPORAN  BERKAS</b></h4>
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
		<th><div align="center">NO </div></th>
      	<th>NO. BERKAS</th>
      	<th>THN. BERKAS</th>
		<th>NAMA PEMOHON</th>
		<th>JENIS KEGIATAN</th>
		<th>KECAMATAN</th>
		<th>KELURANHAN</th>
		<th>VOLUME</th>
		<th>DI.302</th>
		<th>NO. SURTUG</th>
		<th>TGL. MULAI</th>
		<th>TGL. TERBIT</th>
	  	<th>POSISI BERKAS</th>
	  	<th>PETUGAS TERAKHIR</th>
        <th>KETERANGAN BERKAS</th>
        <th>INFORMASI SU & DI.307</th>
	  	<th><div align="center">STATUS</div></th>
	</tr>
	<?php
		$tglAwal		= $_GET['awal'];
		$tglAkhir		= $_GET['akhir'];
											
		$dataSql = mysqli_query($koneksidb, "SELECT 
									        a.id_berkas,
									        a.no_berkas,
									        a.tahun_berkas,
									        b.nama_pemohon,
									        c.nama_layanan,
									        d.nama_kecamatan,
									        e.nama_kelurahan,
									        a.posisi_berkas,
									        a.keterangan_berkas,
									        f.nama_pegawai,
									        a.status_berkas,
									        a.no_su,
									        a.thn_su,
									        a.no_di_307,
									        a.thn_di_307,
									        a.volume,
									        a.di_302,
									        a.no_surtug,
									        a.tgl_mulai_surtug,
									        a.tgl_terbit_surtug
									        FROM ms_berkas a
									        INNER JOIN ms_pemohon b ON a.id_pemohon=b.id_pemohon
									        INNER JOIN ms_layanan c ON a.id_layanan=c.id_layanan
									        INNER JOIN ms_kecamatan d ON a.id_kecamatan=d.id_kecamatan
									        INNER JOIN ms_kelurahan e ON a.id_kelurahan=e.id_kelurahan
									        LEFT JOIN ms_pegawai f ON a.id_pegawai=f.id_pegawai
									       	WHERE date(a.createdTime) BETWEEN '$tglAwal' AND '$tglAkhir'")
						or die ("gagal tampil".mysqli_error());
	$nomor  		= 0;
	while($dataRow	= mysqli_fetch_array($dataSql)){
		$nomor ++;
		if($dataRow['status_berkas']=='Selesai'){
	        $infoSU         = '<b>NO. SU :</b> '.$dataRow['no_su'].' <b>THN. SU :</b> '.$dataRow['thn_su'].'</br>'.'<b>NO. DI.307 : </b>'.$dataRow['no_di_307'].' <b>THN. DI.307 :</b> '.$dataRow['thn_di_307'];
	    }else{
	        $infoSU         = '-';
	    }
	?>
	<tr>
		<td><div align="center"><?php echo $nomor;?></div></td>
		<td><?php echo $dataRow['no_berkas']; ?></td>
		<td><?php echo $dataRow['tahun_berkas']; ?></td>
		<td><?php echo $dataRow['nama_pemohon']; ?></td>
		<td><?php echo $dataRow['nama_layanan']; ?></td>
		<td><?php echo $dataRow['nama_kecamatan']; ?></td>
		<td><?php echo $dataRow['nama_kelurahan']; ?></td>
		<td><?php echo $dataRow['volume']; ?></td>
		<td><?php echo $dataRow['di_302']; ?></td>
		<td><?php echo $dataRow['no_surtug']; ?></td>
		<td><?php echo $dataRow['tgl_mulai_surtug']; ?></td>
		<td><?php echo $dataRow['tgl_terbit_surtug']; ?></td>
		<td><?php echo $dataRow['posisi_berkas']; ?></td>
		<td><?php echo $dataRow['nama_pegawai']; ?></td>
		<td><?php echo $dataRow['keterangan_berkas']; ?></td>
		<td><?php echo $infoSU; ?></td>
		<td><?php echo $dataRow['status_berkas']; ?></td>
	</tr>
	<?php } ?>
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