<?php
 //Define relative path from this script to mPDF
 $nama_file='PRINT_QRCODE'; //Beri nama file PDF hasil.
define('_MPDF_PATH','../plugin/mpdf60/');
//define("_JPGRAPH_PATH", '../mpdf60/graph_cache/src/');

//define("_JPGRAPH_PATH", '../jpgraph/src/'); 
 
include(_MPDF_PATH . "mpdf.php");
//include(_MPDF_PATH . "graph.php");

//include(_MPDF_PATH . "graph_cache/src/");

$mpdf=new mPDF('utf-8', array(190,165), '', '', '0','0','0','0'); // Membuat file mpdf baru
 
//Beginning Buffer to save PHP variables and HTML tags
ob_start(); 

$mpdf->useGraphs = true;

?>
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
            border-spacing:15;
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
<?php
include		 "../config/bar128.php";
include_once "../config/inc.connection.php";
include_once "../config/inc.library.php";	

$dataKode		= $_GET['id'];
$dataJumlah		= 6;

$KodeEdit		= isset($_GET['id']) ?  $_GET['id'] : $_POST['txtKode']; 
$sqlShow 		= "SELECT * FROM ms_barang
					WHERE ms_barang.id_barang='$dataKode'";
$qryShow 		= mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data supplier salah : ".mysqli_error());
$dataShow 		= mysqli_fetch_array($qryShow);

$dataBarcode	= $dataShow['kode_barcode']; 
$namafile		= $dataBarcode.'.png';
if(!file_exists("../photo/".$namafile)){
	$dataQRCode	= 'File QR Code Belum Digenerate';
}else{
	$dataQRCode	= '<img src="../photo/'.$namafile.'"></img>';
}
	
for($a=1; $a<=$dataJumlah; $a++)
{
echo '<table width="100%">
			<tr>
				<td align="center" style="padding:25px">'.$dataQRCode,'</td>
				<td align="center" style="padding:25px">'.$dataQRCode,'</td>
				<td align="center" style="padding:25px">'.$dataQRCode,'</td>
				<td align="center" style="padding:25px">'.$dataQRCode,'</td>
				<td align="center" style="padding:25px">'.$dataQRCode,'</td>
				<td align="center" style="padding:25px">'.$dataQRCode,'</td>
                <td align="center" style="padding:25px">'.$dataQRCode,'</td>
			</tr>
			
		</table>';
}

?>



<?php



$html = ob_get_contents(); //Proses untuk mengambil data
ob_end_clean();
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);

$mpdf->WriteHTML(utf8_encode($html));
// LOAD a stylesheet
// $stylesheet = file_get_contents('mpdfstyletables.css');

$mpdf->WriteHTML($stylesheet,1);    // The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->Output($nama_file."_".date('ymd').".pdf" ,'I');

 


exit; 
?>