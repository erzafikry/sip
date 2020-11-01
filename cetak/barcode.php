<?php
 //Define relative path from this script to mPDF
 $nama_file='PRINT_BARCODE'; //Beri nama file PDF hasil.
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
$dataJumlah		= 8;

$KodeEdit		= isset($_GET['id']) ?  $_GET['id'] : $_POST['txtKode']; 
$sqlShow 		= "SELECT * FROM ms_barang
					WHERE ms_barang.id_barang='$dataKode'";
$qryShow 		= mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data supplier salah : ".mysqli_error());
$dataShow 		= mysqli_fetch_array($qryShow);

$dataBarcode	= $dataShow['kode_barcode']; 

	
for($a=1; $a<=$dataJumlah; $a++)
{
echo '<table width="100%">
			<tr>
				<td align="center" style="padding-top:40px"><barcode code="'.$dataBarcode.'" type="C128A" class="barcode" /><br>'.$dataBarcode.'</td>
				<td align="center" style="padding-top:40px"><barcode code="'.$dataBarcode.'" type="C128A" class="barcode" /><br>'.$dataBarcode.'</td>
				<td align="center" style="padding-top:40px"><barcode code="'.$dataBarcode.'" type="C128A" class="barcode" /><br>'.$dataBarcode.'</td>
				<td align="center" style="padding-top:40px"><barcode code="'.$dataBarcode.'" type="C128A" class="barcode" /><br>'.$dataBarcode.'</td>
				<td align="center" style="padding-top:40px"><barcode code="'.$dataBarcode.'" type="C128A" class="barcode" /><br>'.$dataBarcode.'</td>
				<td align="center" style="padding-top:40px"><barcode code="'.$dataBarcode.'" type="C128A" class="barcode" /><br>'.$dataBarcode.'</td>
				<td align="center" style="padding-top:40px"><barcode code="'.$dataBarcode.'" type="C128A" class="barcode" /><br>'.$dataBarcode.'</td>
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

$mpdf->Output($nama_file."_".date('ymd').".pdf" ,'I');

 


exit; 
?>