<?php
    session_start();
    include_once "../config/inc.connection.php";
    include_once "../config/inc.library.php";
    


    header("Content-type: application/vnd.ms-excel; charset=UTF-8" );
    header("Content-Disposition: attachment; filename=Laporan_Barang_".date('ymd').".xls"); 
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 
    header('Content-Transfer-Encoding: binary');

    ob_end_flush();


    
?>
<table width="100%">
  <tr>
    <td colspan="6" align="center"><h3><u>LAPORAN BARANG</u></h3></td>
  </tr>
  <tr>
    <td colspan="6" align="center" valign="top"></td>
  </tr>
</table>

<table border="1" width="100%">
    <tr>
        <th width="2%"><div align="center">NO</div></th>
        <th width="11%"><div align="center">KODE</div></th>
        <th width="23%">KATEGORI</th>
        <th width="34%"><div align="left">NAMA BARANG</div></th>
        <th width="7%"><div align="center">TERJUAL</div></th>
        <th width="8%"><div align="center">RETUR</div></th>
    </tr>
    <?php
        $tglAwal        = $_GET['awal'];
        $tglAkhir       = $_GET['akhir'];
                                            
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
    $nomor          = 0;
    $jual           = 0;
    $returjual      = 0;
    while($dataRow  = mysqli_fetch_array($dataSql)){
        $nomor ++;
        $jual       = $jual + $dataRow['total_jual'];
        $returjual  = $returjual + $dataRow['total_retur_jual'];
        
    ?>
    <tr>
        <td><div align="center"><?php echo $nomor;?></div></td>
        <td><div align="center"><?php echo $dataRow['kode_barcode']; ?></div></td>
        <td><?php echo $dataRow['kode_kategori']; ?> - <?php echo $dataRow['nama_kategori']; ?></td>
        <td><div align="left"><?php echo $dataRow['nama_barang']; ?></div></td>
        <td><div align="center"><?php echo ($dataRow['total_jual']); ?></div></td>
        <td><div align="center"><?php echo ($dataRow['total_retur_jual']); ?></div></td>
    </tr>
    <?php } ?>
    <tr>
        <th colspan="4" align="right"><div align="right">SUBTOTAL : </div></th>
        <th width="7%"><div align="center"><?php echo ($jual); ?></div></th>
        <th width="8%"><div align="center"><?php echo ($returjual); ?></div></th>
    </tr>
</table>
