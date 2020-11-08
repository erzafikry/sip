<div class="portlet box grey-cascade">
	<div class="portlet-title">
		<div class="caption">
            <span class="caption-subject uppercase bold hidden-xs">Form Riwayat Surat Tugas</span>
        </div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body">
		<table class="table table-striped table-bordered table-hover" id="sample_2">
			<thead>
                <tr class="active">
                  	<th width="2%"><div align="center">NO </div></th>
                  	<th width="15%">DIBUAT OLEH</th>
                  	<th width="10%"><div align="center">TANGGAL DIBUAT</div></th>
                  	<th width="25%">KETERANGAN</th>
                  	<th width="10%">TUJUAN</th>
                  	<th width="10%"><div align="center">STATUS</div></th>
                </tr>
			</thead>
			<tbody>
                <?php
                	$dataKode= $_GET['id'];
					$dataSql = "SELECT
									e.nama_pegawai,
									a.createdTime,
									a.catatan,
									c.group_nama,
									a.status
								FROM
									trx_surtug a
									INNER JOIN ms_surtug b ON a.id_surtug = b.id_surtug
									INNER JOIN sys_group c ON a.group_id = c.group_id
									INNER JOIN ms_user d ON a.createdby = d.id_user
									INNER JOIN ms_pegawai e ON d.id_pegawai = e.id_pegawai 
								WHERE a.id_surtug='$dataKode'
								ORDER BY
									a.id_trx_surtug ASC";
					$dataQry = mysqli_query($koneksidb, $dataSql)  or die ("Koneksi gagal : ".mysqli_error());
					$nomor  = 0; 
					while ($data = mysqli_fetch_array($dataQry)) {
					$nomor++;
					if($data['status']=='Kirim'){
						$dataStatus		= '<label class="label label-info">Terkirim</label>';
					}elseif($data['status']=='Batal'){
						$dataStatus		= '<label class="label label-warning">Dikembalikan</label>';
					}else{
						$dataStatus		= '<label class="label label-danger">Tidak Terdeteksi</label>';
					}
				?>
                <tr class="odd gradeX">
					<td><div align="center"><?php echo $nomor ?></div></td>
					<td><div align="left"><?php echo $data ['nama_pegawai']; ?></div></td>
					<td><div align="center"><?php echo date("d/m/Y H:i", strtotime($data ['createdTime'])); ?></div></td>
					<td><?php echo $data ['catatan']; ?></td>
					<td><?php echo $data ['group_nama']; ?></td>
					<td><div align="center"><?php echo $dataStatus; ?></div></td>
                </tr>
                <?php } ?>
			</tbody>
        </table>
    </div>
</div>