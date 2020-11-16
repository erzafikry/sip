<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
	<div class="portlet box grey-cascade">
		<div class="portlet-title">
			<div class="caption">
				<span class="caption-subject uppercase bold">Data Berkas Masuk</span>
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
       	  	  	  	  	<th class="table-checkbox" width="3%">
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                <span></span>
                            </label>
                        </th>
                      	<th width="2%"><div align="center">NO </div></th>
                      	<th width="10%"><div align="center">NO SURAT TUGAS</div></th>
                      	<th width="7%"><div align="center">TGL MULAI </div></th>
                      	<th width="7%"><div align="center">TGL TERBIT </div></th>
                      	<th width="5%"><div align="center">NO BERKAS </div></th>
                      	<th width="5%"><div align="center">TAHUN</div></th>
                      	<th width="15%"><div align="center">KETERANGAN</div></th>
                      	<th width="15%"><div align="center">JABATAN</div></th>
					  	<th width="5%"><div align="center">STATUS</div></th>
					  	<th width="5%"><div align="center">AKSI</div></th>
                    </tr>
				</thead>
				<tbody>
                    <?php
						$dataSql = "SELECT 
									a.id_surtug,
									a.no_surtug,
									a.tgl_mulai_surtug,
									a.tgl_terbit_surtug,
									b.no_berkas,
									a.keterangan_surtug,
									b.tahun_berkas,
									c.nama_pegawai,
									d.nama_jabatan,
									a.group_id,
									a.status_surtug
									FROM trx_surtug e
									INNER JOIN ms_surtug a ON e.id_surtug=a.id_surtug
									INNER JOIN ms_berkas b ON a.id_berkas=b.id_berkas
									INNER JOIN ms_pegawai c ON a.id_pegawai=c.id_pegawai
									INNER JOIN ms_jabatan d ON c.id_jabatan=d.id_jabatan
									WHERE (a.id_petugas_ukur='".$userRow['id_pegawai']."' OR a.id_petugas_grafis='".$userRow['id_pegawai']."' OR a.id_petugas_textual='".$userRow['id_pegawai']."' OR a.id_kasubsie='".$userRow['id_pegawai']."' OR a.id_kasie='".$userRow['id_pegawai']."')
									GROUP BY
									a.id_surtug,
									a.no_surtug,
									a.tgl_mulai_surtug,
									a.tgl_terbit_surtug,
									b.no_berkas,
									a.keterangan_surtug,
									b.tahun_berkas,
									c.nama_pegawai,
									d.nama_jabatan,
									a.group_id,
									a.status_surtug
									ORDER BY a.id_surtug DESC";
						$dataQry = mysqli_query($koneksidb, $dataSql)  or die ("Koneksi gagal : ".mysqli_error());
						$nomor  = 0; 
						while ($data = mysqli_fetch_array($dataQry)) {
						$nomor++;
						$kode = $data['id_surtug'];

						if($userRow['user_group']==$data['group_id'] AND $data['status_surtug']!='Selesai'){
							$btnProses 	='<li><a href="?page=kirimberkasmasuk&id='.$kode.'" >Proses</a></li>';
						}else{
							$btnProses 	='';
						}

						if($data['status_surtug']=='Selesai'){
							$dataStatus	= '<label class="label label-success">Selesai</label>';
						}else{
							$dataStatus	= '<label class="label label-warning">Proses</label>';
						}
					?>
                    <tr class="odd gradeX">
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes" value="<?php echo $kode; ?>" name="txtID[<?php echo $kode; ?>]" />
                                <span></span>
                            </label>
                        </td>
						<td><div align="center"><?php echo $nomor ?></div></td>
						<td><div align="left"><?php echo $data ['no_surtug']; ?></div></td>
						<td><?php echo date("d/m/Y", strtotime($data ['tgl_mulai_surtug'])); ?></td>
						<td><?php echo date("d/m/Y", strtotime($data ['tgl_terbit_surtug'])); ?></td>
						<td><?php echo $data ['no_berkas']; ?></td>
						<td><div align="center"><?php echo $data ['tahun_berkas']; ?></div></td>
						<td><?php echo $data ['keterangan_surtug']; ?></td>
						<td><?php echo $data ['nama_jabatan']; ?></td>
						<td><div align="center"><?php echo $dataStatus; ?></div></td>
						<td>
								<div class="btn-group">
			                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
			                            <i class="fa fa-angle-down"></i>
			                        </button>
			                        <ul class="dropdown-menu left" role="menu">
			                            <?php echo $btnProses ?>
			                            <li><a href="?page=historyberkasmasuk&amp;id=<?php echo $kode; ?>">History</a></li>
			                           
			                        </ul>
			                    </div>
						</td>
                    </tr>
                    <?php } ?>
				</tbody>
            </table>
		</div>
	</div>
</form>
