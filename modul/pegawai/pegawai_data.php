<?php			
	if(isset($_POST['btnHapus'])){
		$txtID 		= $_POST['txtID'];
		foreach ($txtID as $id_key) {
				
			$hapus=mysqli_query($koneksidb, "DELETE FROM ms_pegawai WHERE id_pegawai='$id_key'") 
				or die ("Gagal kosongkan tmp".mysqli_error());
				
			if($hapus){
				$_SESSION['pesan'] = 'Data Pegawai berhasil dihapus.';
				echo '<script>window.location="?page=datapegawai"</script>';
			}	
		}
	}
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption">
				<span class="caption-subject uppercase bold">Data Pegawai</span>
			</div>
			<div class="actions">
				<a href="?page=tambahpegawai" class="btn blue"><i class="icon-plus"></i> Tambah Data</a>	
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
                      	<th width="5%"><div align="center">NO</div></th>
                        <th width="10%">NIP</th>
                        <th width="25%">NAMA PEGAWAI</th>
                        <th width="30%">UNIT KERJA</th>
                        <th width="30%">JABATAN</th>
                        <th width="20%">STATUS</th>
						<th width="20%"><div align="center">AKSI</div></th>
                    </tr>
				</thead>
				<tbody>
                    <?php
						$dataSql = "SELECT * FROM ms_pegawai a 
									INNER JOIN ms_satker b ON a.id_satker=b.id_satker
									INNER JOIN ms_jabatan c ON a.id_jabatan=c.id_jabatan
									ORDER BY c.id_jabatan ASC";
						$dataQry = mysqli_query($koneksidb, $dataSql)  or die ("Query salah : ".mysqli_error());
						$nomor  = 0; 
						while ($data = mysqli_fetch_array($dataQry)) {
						$nomor++;
						$Kode = $data['id_pegawai'];
					?>
                    <tr class="odd gradeX">
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes" value="<?php echo $Kode; ?>" name="txtID[<?php echo $Kode; ?>]" />
                                <span></span>
                            </label>
                        </td>
						<td><div align="center"><?php echo $nomor; ?></div></td>
						<td><?php echo $data ['nip']; ?></td>
						<td><?php echo $data ['nama_pegawai']; ?></td>
						<td><?php echo $data ['nama_satker']; ?></td>
						<td><?php echo $data ['nama_jabatan']; ?></td>
						<td>
							<?php 
								if($data ['status_pegawai']=='Active'){
									echo "<label class='label label-success'>Active</label>";
								}else{
									echo "<label class='label label-danger'>Non Active</label>";
								}
							?>						
						</td>
						<td><div align="center"><a href="?page=ubahpegawai&amp;id=<?php echo $Kode; ?>" class="btn btn-xs blue"><i class="fa fa-edit"></i></a></div></td>
                    </tr>
                    <?php } ?>
				</tbody>
            </table>
		</div>
	</div>
</form>