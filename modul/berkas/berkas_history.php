<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption">
            <span class="caption-subject uppercase bold hidden-xs">Form Riwayat Berkas</span>
        </div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body">
		<button onclick=self.history.back() class="btn blue" style="margin-bottom:15px"><i class="fa fa-undo"></i> Kembali</button>
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