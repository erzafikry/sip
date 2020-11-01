<?php
			
	if(isset($_POST['btnHapus'])){
		$txtID 		= $_POST['txtID'];
		foreach ($txtID as $id_key) {
				
			$hapus=mysqli_query($koneksidb, "DELETE FROM ms_berkas WHERE id_berkas='$id_key'") 
				or die ("Gagal kosongkan tmp".mysqli_error());
			
			if($hapus){	
				$_SESSION['pesan'] = 'Data Berkas berhasil dihapus';
				echo '<script>window.location="?page=databerkas"</script>';
			}else{
				$_SESSION['pesan'] = 'Tidak ada data yang dihapus';
				echo '<script>window.location="?page=databerkas"</script>';
			}	
		}
	}
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
	<div class="portlet box grey-cascade">
		<div class="portlet-title">
		<div class="caption"><span class="caption-subject uppercase bold">Data Berkas</span></div>
			<div class="actions">
				<a href="?page=tambahberkas" class="btn blue"><i class="icon-plus"></i> Tambah Data</a>	
				<button class="btn red" name="btnHapus" type="submit" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="icon-trash"></i> Hapus Data</button>
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
                      	<th width="5%"><div align="center">NO BERKAS </div></th>
                      	<th width="5%"><div align="center">TAHUN</div></th>
						<th width="15%">NAMA PEMOHON</th>
						<th width="25%">JENIS KEGIATAN</th>
						<th width="15%">KECAMATAN</th>
						<th width="15%">KELURAHAN</th>
						<th width="2%">VOLUME</th>
						<th width="5%">DI.305</th>
						<th width="5%">DI.302</th>
					  	<th width="8%">STATUS BERKAS</th>
                        <th width="24%">KETERANGAN BERKAS</th>
					  	<th width="10%"><div align="center">AKSI</div></th>
                    </tr>
				</thead>
				<tbody>
                    <?php
						$dataSql = "SELECT * FROM ms_berkas a
									INNER JOIN ms_pemohon b ON a.id_pemohon=b.id_pemohon
									INNER JOIN ms_layanan c ON a.id_layanan=c.id_layanan
									INNER JOIN ms_kecamatan d ON a.id_kecamatan=d.id_kecamatan
									INNER JOIN ms_kelurahan e ON a.id_kelurahan=e.id_kelurahan
									INNER JOIN ms_status_berkas f ON a.id_status_berkas=f.id_status_berkas
									ORDER BY id_berkas ASC";
						$dataQry = mysqli_query($koneksidb, $dataSql)  or die ("Koneksi gagal : ".mysqli_error());
						$nomor  = 0; 
						while ($data = mysqli_fetch_array($dataQry)) {
						$nomor++;
						$kode = $data['id_berkas'];
					?>
                    <tr class="odd gradeX">
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes" value="<?php echo $kode; ?>" name="txtID[<?php echo $kode; ?>]" />
                                <span></span>
                            </label>
                        </td>
						<td><div align="center"><?php echo $nomor ?></div></td>
						<td><div align="left"><?php echo $data ['no_berkas']; ?></div></td>
						<td><div align="left"><?php echo $data ['tahun_berkas']; ?></div></td>
						<td><?php echo $data ['nama_pemohon']; ?></td>
						<td><?php echo $data ['nama_layanan']; ?></td>
						<td><?php echo $data ['nama_kecamatan']; ?></td>
						<td><?php echo $data ['nama_kelurahan']; ?></td>
						<td><?php echo $data ['volume']; ?> m2</td>
						<td><?php echo $data ['di_305']; ?></td>
						<td><?php echo $data ['di_302']; ?></td>
						<td><?php echo $data ['status_berkas']; ?></td>
						<td><?php echo $data ['keterangan_berkas']; ?></td>
						<td>
							<div class="box-tools pull-center" align="center">
								<div class="btn-group">
									<a href="?page=ubahberkas&amp;id=<?php echo $kode; ?>" class="btn btn-xs blue"><i class="fa fa-edit"></i></a>
								</div>
							</div>
						</td>
                    </tr>
                    <?php } ?>
				</tbody>
            </table>
		</div>
	</div>
</form>