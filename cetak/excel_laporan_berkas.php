<?php
    session_start();
    include_once "../config/inc.connection.php";
    include_once "../config/inc.library.php";
    


    header("Content-type: application/vnd.ms-excel; charset=UTF-8" );
    header("Content-Disposition: attachment; filename=Laporan_Berkas_".date('ymd').".xls"); 
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 
    header('Content-Transfer-Encoding: binary');

    ob_end_flush();


    
?>
<table width="100%">
  <tr>
    <td colspan="17" align="center"><h3><u>LAPORAN BERKAS</u></h3></td>
  </tr>
  <tr>
    <td colspan="17" align="center" valign="top"></td>
  </tr>
</table>

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
        <th><div align="center">LAMA BERKAS</div></th>
        <th><div align="center">STATUS</div></th>
    </tr>
    <?php
        $tglAwal        = $_GET['awal'];
        $tglAkhir       = $_GET['akhir'];
                                            
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
                                            a.tgl_terbit_surtug,
                                            b.tgl_selesai
                                            FROM ms_berkas a
                                            INNER JOIN ms_pemohon b ON a.id_pemohon=b.id_pemohon
                                            INNER JOIN ms_layanan c ON a.id_layanan=c.id_layanan
                                            INNER JOIN ms_kecamatan d ON a.id_kecamatan=d.id_kecamatan
                                            INNER JOIN ms_kelurahan e ON a.id_kelurahan=e.id_kelurahan
                                            LEFT JOIN ms_pegawai f ON a.id_pegawai=f.id_pegawai
                                            WHERE date(a.createdTime) BETWEEN '$tglAwal' AND '$tglAkhir'")
                        or die ("gagal tampil".mysqli_error());
    $nomor       = 0;
    while($dataRow  = mysqli_fetch_array($dataSql)){
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
