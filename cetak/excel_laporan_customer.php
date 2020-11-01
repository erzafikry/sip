<?php
    session_start();
    include_once "../config/inc.connection.php";
    include_once "../config/inc.library.php";
    


    header("Content-type: application/vnd.ms-excel; charset=UTF-8" );
    header("Content-Disposition: attachment; filename=Laporan_Customer_".date('ymd').".xls"); 
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 
    header('Content-Transfer-Encoding: binary');

    ob_end_flush();


    
?>
<table width="100%">
  <tr>
    <td colspan="6" align="center"><h3><u>LAPORAN CUSTOMER</u></h3></td>
  </tr>
  <tr>
    <td colspan="6" align="center" valign="top"></td>
  </tr>
</table>

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
        $tglAwal        = $_GET['awal'];
        $tglAkhir       = $_GET['akhir'];
                                            
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
   $nomor       = 0;
    $beli           = 0;
    $returbeli      = 0;
    while($dataRow  = mysqli_fetch_array($dataSql)){
        $nomor ++;
        $beli       = $beli + $dataRow['total_jual'];
        $returbeli  = $returbeli + $dataRow['total_retur_jual'];
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
