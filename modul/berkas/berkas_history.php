<?php 
$KodeEdit			= isset($_GET['id']) ?  $_GET['id'] : $_POST['txtKode']; 
$sqlShow 			= "SELECT 
						a.no_berkas,
						a.tahun_berkas,
						c.nama_layanan,
						b.nama_pemohon,
						d.nama_pegawai,
						a.createdTime,
						a.updatedTime,
						a.posisi_berkas,
						a.status_berkas,
						a.tgl_mulai_surtug,
						a.tgl_akhir
						FROM ms_berkas a
						INNER JOIN ms_pemohon b on a.id_pemohon=b.id_pemohon
						INNER JOIN ms_layanan c ON a.id_layanan=c.id_layanan
						LEFT JOIN ms_pegawai d ON a.id_pegawai=d.id_pegawai
						WHERE a.id_berkas='$KodeEdit'";
$qryShow 			= mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data supplier salah : ".mysqli_error());
$dataShow 			= mysqli_fetch_array($qryShow);

$dataNoberkas		= $dataShow['no_berkas'];
$dataThnBerkas 		= $dataShow['tahun_berkas'];
$dataKegiatan 		= $dataShow['nama_layanan'];
$dataPemohon 		= $dataShow['nama_pemohon'];
$dataPosisi 		= $dataShow['posisi_berkas'];
$dataKegiatan 		= $dataShow['nama_layanan'];
$dataPetugas 		= $dataShow['nama_pegawai'];
$dataLamaBerkas 	= hitungHari($dataShow['tgl_mulai_surtug'], $dataShow['tgl_akhir']).' Hari';
$dataStatus 		= $dataShow['status_berkas'];
?>
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption">
            <span class="caption-subject uppercase bold hidden-xs">Form Riwayat Berkas</span>
        </div>
		<div class="actions">
			<button onclick=self.history.back() class="btn blue" ><i class="fa fa-undo"></i> Kembali</button>
		</div>
	</div>
	<div class="portlet-body">
		
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" class="form-horizontal" autocomplete="off">	
			<div class="form-body">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label class="col-lg-4 control-label" style="text-align: left;">No Berkas :</label>
							<div class="col-lg-8">
								<input class="form-control" value="<?php echo $dataNoberkas; ?>" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label" style="text-align: left;">Thn Berkas :</label>
							<div class="col-lg-8">
								<input class="form-control" value="<?php echo $dataThnBerkas; ?>" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label" style="text-align: left;">Jenis Kegiatan :</label>
							<div class="col-lg-8">
								<input class="form-control" value="<?php echo $dataKegiatan; ?>" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label" style="text-align: left;">Nama Pemohon :</label>
							<div class="col-lg-8">
								<input class="form-control" value="<?php echo $dataPemohon; ?>" disabled/>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label class="col-lg-4 control-label" style="text-align: left;">Posisi Berkas Sekarang :</label>
							<div class="col-lg-8">
								<input class="form-control" value="<?php echo $dataPosisi; ?>" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label" style="text-align: left;">Petugas Terakhir :</label>
							<div class="col-lg-8">
								<input class="form-control" value="<?php echo $dataPetugas; ?>" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label" style="text-align: left;">Lama Hari :</label>
							<div class="col-lg-8">
								<input class="form-control" value="<?php echo $dataLamaBerkas; ?>" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label" style="text-align: left;">Status Berkas :</label>
							<div class="col-lg-8">
								<input class="form-control" value="<?php echo $dataStatus; ?>" disabled/>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</form>
		<div class="batas2"></div>
		<table class="table table-striped table-bordered table-hover" id="sample_2">
			<thead>
                <tr class="active">
                  	<th width="2%"><div align="center">NO </div></th>
                  	<th width="15%">PETUGAS</th>
                  	<th width="10%"><div align="center">TANGGAL DIBUAT</div></th>
                  	<th width="25%">KETERANGAN</th>
                  	<th width="10%">LAMA BERKAS</th>
                  	<th width="15%">POSISI BERKAS</th>
                  	<th width="10%"><div align="center">STATUS</div></th>
                </tr>
			</thead>
			<tbody>
                <?php
                	$dataKode= $_GET['id'];
					$dataSql = "SELECT 
									c.nama_pegawai,
									a.createdTime,
									a.status,
									a.lama_berkas,
									a.catatan,
									a.posisi
								FROM
								trx_history a
								INNER JOIN ms_berkas b ON a.id_berkas = b.id_berkas
								LEFT JOIN ms_pegawai c ON a.id_pegawai = c.id_pegawai
								INNER JOIN ms_user d ON a.createdBy = d.id_user
								WHERE a.id_berkas='$dataKode'";
					$dataQry = mysqli_query($koneksidb, $dataSql)  or die ("Koneksi gagal : ".mysqli_error());
					$nomor  = 0; 
					while ($data = mysqli_fetch_array($dataQry)) {
					$nomor++;
					if($data['status']=='Dikirim'){
						$dataStatus		= '<label class="label label-info">Terkirim</label>';
					}elseif($data['status']=='Dikembalikan'){
						$dataStatus		= '<label class="label label-warning">Dikembalikan</label>';
					}elseif($data['status']=='Dibuat'){
						$dataStatus		= '<label class="label label-success">Dibuat</label>';
					}elseif($data['status']=='Selesai'){
						$dataStatus		= '<label class="label label-default">Selesai</label>';
					}elseif($data['status']=='Dibatalkan'){
						$dataStatus		= '<label class="label label-danger">Dibatalkan</label>';
					}else{
						$dataStatus		= '<label class="label label-danger">Tidak Terdeteksi</label>';
					}
				?>
                <tr class="odd gradeX">
					<td><div align="center"><?php echo $nomor ?></div></td>
					<td><div align="left"><?php echo $data ['nama_pegawai']; ?></div></td>
					<td><div align="center"><?php echo date("d/m/Y H:i", strtotime($data ['createdTime'])); ?></div></td>
					<td><?php echo $data ['catatan']; ?></td>
					<td><?php echo $data ['lama_berkas']; ?></td>
					<td><div align="left"><?php echo $data ['posisi']; ?></div></td>
					<td><div align="center"><?php echo $dataStatus; ?></div></td>
                </tr>
                <?php } ?>
			</tbody>
        </table>
    </div>
</div>