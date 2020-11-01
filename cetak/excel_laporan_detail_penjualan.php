<?php
    session_start();
    include_once "../config/inc.connection.php";
    include_once "../config/inc.library.php";
    


    header("Content-type: application/vnd.ms-excel; charset=UTF-8" );
    header("Content-Disposition: attachment; filename=Laporan_Penjualan_".date('ymd').".xls"); 
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 
    header('Content-Transfer-Encoding: binary');

    ob_end_flush();


    
?>
<table width="100%">
  <tr>
    <td colspan="9" align="center"><h3><u>LAPORAN PENJUALAN</u></h3></td>
  </tr>
  <tr>
    <td colspan="9" align="center" valign="top"></td>
  </tr>
</table>

<table border="1" width="100%">
    <tr>
        <th width="20%">NAMA CUSTOMER</th>
        <th width="10%"><div align="center">TGL. TRANSAKSI</div></th>
        <th width="10%"><div align="center">NO. TRANSAKSI</div></th>
        <th width="12%"><div align="center">KODE BARANG</div></th>
        <th width="30%">NAMA BARANG</th>
        <th width="5%"><div align="center">DISKON</div></th>
        <th width="5%"><div align="right">HARGA</div></th>
        <th width="5%"><div align="center">JUMLAH</div></th>
        <th width="5%"><div align="right">SUBTOTAL</div></th>
    </tr>
    <?php
        
        $tglAwal        = $_GET['awal'];
        $tglAkhir       = $_GET['akhir'];       
        $dataSql        = mysqli_query($koneksidb, "SELECT * FROM tr_penjualan_item a 
                                                        INNER JOIN tr_penjualan b ON a.id_penjualan=b.id_penjualan
                                                        INNER JOIN ms_barang c ON a.id_barang=c.id_barang
                                                        LEFT JOIN ms_customer d ON b.id_customer=d.id_customer
                                                        WHERE date(b.tgl_penjualan) BETWEEN '$tglAwal' AND '$tglAkhir' 
                                                        ORDER BY b.tgl_penjualan DESC");
        $nomor          = 0;
        $subtotal       = 0;
        $total          = 0;
        $harga          = 0;
        $jumlah         = 0;
        while($dataRow  = mysqli_fetch_array($dataSql)){    
            $nomor ++;
            $total      = intval($dataRow ['jumlah_penjualan']*($dataRow['harga_penjualan']-($dataRow['harga_penjualan']*$dataRow['diskon_penjualan']/100)));
            $subtotal   = $subtotal + $total;
            $jumlah     = $jumlah + $dataRow ['jumlah_penjualan'];
            $harga      = $harga + $dataRow ['harga_penjualan'];
            if($dataRow['nama_customer']==''){
                $dataCustomer ='UMUM';
            }else{
                $dataCustomer = $dataRow['nama_customer'];
            }
    ?>
    <tr>
        <td><?php echo $dataCustomer;?></td>
        <td><div align="center"><?php echo indonesiaTgl($dataRow ['tgl_penjualan']); ?> </div></td>
        <td><div align="center"><?php echo $dataRow ['kode_penjualan']; ?></div></td>
        <td><div align="center"><?php echo $dataRow ['kode_barcode']; ?></div></td>
        <td><?php echo $dataRow ['nama_barang']; ?></td>
        <td><div align="center"><?php echo number_format($dataRow ['diskon_penjualan']); ?>%</div></td>
        <td><div align="right"><?php echo ($dataRow ['harga_penjualan']); ?></div></td>
        <td><div align="center"><?php echo ($dataRow ['jumlah_penjualan']); ?></div></td>
        <td><div align="right"><?php echo ($total); ?></div></td>
    </tr>
    <?php } ?>
    <tr>
        <th colspan="6"><div align="right">GRAND TOTAL : </div></th>
        <th width="10%"><div align="right"><?php echo ($harga) ?></div></th>
        <th width="8%"><div align="center"><?php echo ($jumlah) ?></div></th>
        <th width="8%"><div align="right"><?php echo ($subtotal) ?></div></th>
    </tr>
</table>
