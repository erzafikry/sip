<?php
 //Define relative path from this script to mPDF
 $nama_file='Nota_Penjualan'; //Beri nama file PDF hasil.
define('_MPDF_PATH','../plugin/mpdf60/');
//define("_JPGRAPH_PATH", '../mpdf60/graph_cache/src/');
//define("_JPGRAPH_PATH", '../jpgraph/src/'); 
 
include(_MPDF_PATH . "mpdf.php");
//include(_MPDF_PATH . "graph.php");
//include(_MPDF_PATH . "graph_cache/src/");
$mpdf=new mPDF('utf-8', 'A5-P', 10, 'Arial'); // Membuat file mpdf baru
 
//Beginning Buffer to save PHP variables and HTML tags
ob_start(); 
$mpdf->useGraphs = true;
?>
<?php
    include "../config/inc.connection.php";
    include "../config/inc.library.php";
    $tokoSql            = "SELECT * FROM ms_toko";
    $tokoQry            = mysqli_query($koneksidb, $tokoSql)  or die ("Query toko salah : ".mysqli_error());
    $tokoRow            = mysqli_fetch_array($tokoQry);    
    
    $KodeEdit           = isset($_GET['id']) ?  $_GET['id'] : $_POST['txtKode']; 
    $sqlShow            = "SELECT * FROM tr_penjualan a
                            LEFT JOIN ms_customer b ON a.id_customer=b.id_customer
                            LEFT JOIN ms_user c ON a.id_user=c.id_user
                            WHERE a.id_penjualan='".($KodeEdit)."'";
    $qryShow            = mysqli_query($koneksidb,$sqlShow)  or die ("Query ambil data supplier salah : ".mysqli_error());
    $dataShow           = mysqli_fetch_array($qryShow);
    $dataKode           = $dataShow['id_penjualan'];
    $dataNomor          = $dataShow['kode_penjualan'];
    $dataTanggal        = $dataShow['tgl_penjualan'];
    if(empty($dataShow['keterangan_penjualan'])){
      $dataKeterangan     = 'Tidak Ada';
    }else{
      $dataKeterangan     = $dataShow['keterangan_penjualan'];
    }
    
    $dataUser           = $dataShow['nama_user'];
    if(empty($dataShow['nama_customer'])){
      $dataCustomer     = 'Customer Umum';
    }else{
      $dataCustomer     = $dataShow['nama_customer'];
    }
    $dataPembayaran     = $dataShow['jenis_pembayaran'];
    $dataBayar          = $dataShow['total_pembayaran'];
?>
<style>
        *
        {
            margin:0;
            padding:0;
            font-family: 'Arial';
            font-size:12px;
            color:#000;
        }
        body
        {
            width:100%;            
            font-family: 'Arial';
            font-size:12px;
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
            font-family: 'Arial'; 
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
</style>
<table width="100%">
    <tr>
      <td colspan="3"><span style="font-size:20px; font-weight:bold"><?php echo $tokoRow['nama_toko']; ?></span><br>
      <span style="font-size:13px; font-style: italic;"><?php echo $tokoRow['alamat_toko'] ?></span>
      </td>
      <td align="right"><span style="font-size:25px; font-weight:bold">INVOICE</span></td>
    </tr>
    <tr>
      <td colspan="4" align="center" style="border-bottom: 1px dashed #000"></td>
    </tr>
</table>
<table style="font-size: 14px">
  <tr>
    <td width="30%">Nota </td>
    <td width="70%">: <?php  echo $dataNomor ?></td>
  </tr>
  <tr>
    <td>Tanggal </td>
    <td>: <?php echo date('d/m/Y', strtotime($dataTanggal)) ?></td>
  </tr>
  <tr>
    <td>Pelanggan </td>
    <td>: <?php echo $dataCustomer ?></td>
  </tr>
</table>
<table width="100%" style="font-size: 14px">
    <tr>
        <th align="left" width="20px" style="border-top: 1px dashed #000; border-bottom: 1px dashed #000;">KODE</th>
        <th align="left" width="30%" style="border-top: 1px dashed #000; border-bottom: 1px dashed #000;">ITEM</th>
        <th align="right" width="10%" style="border-top: 1px dashed #000; border-bottom: 1px dashed #000;"><div align="right">HARGA</div></th>
        <th align="center" width="5%" style="border-top: 1px dashed #000; border-bottom: 1px dashed #000;"><div align="center">DISKON</div></th>
        <th align="center" width="5%" style="border-top: 1px dashed #000; border-bottom: 1px dashed #000;"><div align="center">QTY</div></th>
        <th align="right" width="10%" style="border-top: 1px dashed #000; border-bottom: 1px dashed #000;"><div align="center">SUBTOTAL</div></th>
    </tr>
    <?php
        $dataSql        = "SELECT * FROM tr_penjualan_item a
                            INNER JOIN ms_barang b ON a.id_barang=b.id_barang
                            WHERE a.id_penjualan='$dataKode'
                            ORDER BY a.id DESC";
        $dataQry        = mysqli_query($koneksidb, $dataSql);
        $nomor          = 0;
        $grandTotal     = 0;
        while($data = mysqli_fetch_array($dataQry)) {
            $subtotal   = ($data['harga_penjualan']-($data['harga_penjualan']*$data['diskon_penjualan']/100))*$data['jumlah_penjualan'];
            $grandTotal = $grandTotal + $subtotal;
            $nomor++;
    ?>
    <tr>
        <td align="left"><?php echo $data['kode_barcode']; ?></td>
        <td><?php echo $data['nama_barang']; ?></td>
        <td align="right"><?php echo number_format($data['harga_penjualan']); ?></td>
        <td align="center"><?php echo number_format($data['diskon_penjualan']); ?>%</td>
        <td align="center"><?php echo number_format($data['jumlah_penjualan']); ?></td>
        <td align="right"><?php echo number_format($subtotal); ?></td>
    </tr>
    <?php } ?>
    <tr>
      <td style="border-top: 1px dashed #000;" colspan="5" align="right">GRAND TOTAL :</td>
      <td style="border-top: 1px dashed #000;" align="right"><?php echo number_format($grandTotal) ?></td>
    </tr>
    <tr>
      <td colspan="5" align="right">PEMBAYARAN <?php echo strtoupper($dataPembayaran) ?> :</td>
      <td align="right"><?php echo number_format($dataBayar) ?></td>
    </tr>
    <tr>
      <td colspan="5" style="border-bottom: 1px dashed #000;" align="right">KEMBALI :</td>
      <td align="right" style="border-bottom: 1px dashed #000;"><?php echo number_format($dataBayar-$grandTotal) ?></td>
    </tr>
</table>
<table style="font-size: 14px" width="100%">
  <tr>
    <td>CATATAN :</td>
  </tr>
  <tr>
    <td style="border-bottom: 1px dashed #000;"><?php echo $dataKeterangan ?></td>
  </tr>
</table>
<table style="font-size: 14px" width="100%">
  <tr>
    <td align="center">======= Terima Kasih =======</td>
  </tr>
  <tr>
    <td align="center"><?php echo $tokoRow['keterangan_toko'] ?></td>
  </tr>
</table>
<?php
$html = ob_get_contents(); 
$mpdf->WriteHTML($html);
// LOAD a stylesheet 
ob_end_clean();
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);

// LOAD a stylesheet

$mpdf->WriteHTML($stylesheet,1);    // The parameter 1 tells that this is css/style only and no body/html/text
$mpdf->Output($nama_file."-".$dataNomor.".pdf" ,'I');
exit; 
?>
