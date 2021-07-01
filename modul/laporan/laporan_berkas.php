<?php							
	$tglAwal		= isset($_POST['txtAwal']) ? $_POST['txtAwal'] : date('d-m-Y');
	$tglAkhir		= isset($_POST['txtAkhir']) ? $_POST['txtAkhir'] : date('d-m-Y');
 ?> 	
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="fieldset-form">
	<div class="portlet box green">
	    <div class="portlet-title">
	        <div class="caption">
	            <span class="caption-subject uppercase bold">Laporan Berkas</span>
	        </div>
	        <div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
				<a href="javascript:;" class="remove"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="row">
				<div class="col-lg-4">	
					<div class="form-group">
						<label>Periode Input Berkas :</label>
						<div class="input-group" style="margin-top: 6px">
                            <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" placeholder="Periode Awal" name="txtAwal" value="<?php echo $tglAwal; ?>" >
                            <span class="input-group-addon">s/d</span>
                            <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" placeholder="Periode Akhir" name="txtAkhir" value="<?php echo $tglAkhir; ?>" >
						
						</div>
					</div>
				</div>
				<div class="col-lg-2">	
					<div class="form-group">
						<div class="controls" style="margin-top: 30px">
							<button type="submit" class="btn blue" name="btnTampil"><i class="icon-magnifier-add"></i> Tampilkan</button>
						</div>
					</div>
				</div>
				<div class="col-lg-6" align="right">
					<div class="form-group">
						<div class="controls" style="margin-top: 30px">
						<?php
	                    	if(isset($_POST['btnTampil'])){
	                    ?>
						 <button name="bar" type="button" onClick="cetak_pdf()" class="btn blue"><i class="icon-printer"></i> Export PDF</button>
						 <button name="bar" type="button" onClick="cetak_exl()" class="btn blue"><i class="icon-doc"></i> Export Excel</button>
	                    <?php } ?>
						</div>
					</div>
				</div>
			</div>	
			<hr>
			<table class="table table-striped table-bordered table-hover " id="sample_4">
				<thead>
                    <tr class="active">
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
				</thead>
				<tbody>
                    <?php
                    if(isset($_POST['btnTampil'])){
						$tglAwal		= InggrisTgl($_POST['txtAwal']);
						$tglAkhir		= InggrisTgl($_POST['txtAkhir']);
															
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
														       	WHERE date(a.createdTime) BETWEEN '$tglAwal' AND '$tglAkhir'");
					}
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
				</tbody>
            </table>
	  </div>
  		</div>
	</div>
</div>
<script type="text/javascript"> 
    function cetak_pdf()	 
    { 
    win=window.open('./cetak/pdf_laporan_berkas.php?awal=<?php echo $tglAwal; ?>&akhir=<?php echo $tglAkhir ?>','win','width=1500, height=600, menubar=0, scrollbars=1, resizable=0, status=0'); 
    } 
     function cetak_exl()	 
    { 
    win=window.open('./cetak/excel_laporan_berkas.php?awal=<?php echo $tglAwal; ?>&akhir=<?php echo $tglAkhir ?>','win','width=1500, height=600, menubar=0, scrollbars=1, resizable=0, status=0'); 
    } 
</script>