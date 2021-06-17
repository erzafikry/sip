<?php			
	if(isset($_POST['btnHapus'])){
		$txtID 		= $_POST['txtID'];
		foreach ($txtID as $id_key) {
				
			$hapus=mysqli_query($koneksidb, "DELETE FROM ms_kelurahan WHERE id_kelurahan='$id_key'") 
				or die ("Gagal kosongkan tmp".mysqli_error());
				
			if($hapus){
				$_SESSION['pesan'] = 'Data Kelurahan berhasil dihapus.';
				echo '<script>window.location="?page=datakel"</script>';
			}	
		}
	}
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption">
				<span class="caption-subject uppercase bold">Data Kelurahan</span>
			</div>
			<div class="actions">
				<a href="?page=tambahkel" class="btn blue"><i class="icon-plus"></i> Tambah Data</a>	
				<button class="btn red" name="btnHapus" type="submit" onclick="return confirm('Anda yakin ingin menghapus data ini ?')"><i class="icon-trash"></i> Hapus Data</button>
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
                        <th width="15%">NAMA PROVINSI</th>
                        <th width="15%">NAMA KOTA</th>
                        <th width="15%">NAMA KECAMATAN</th>
                        <th width="15%">NAMA KELURAHAN</th>
                        <th width="10%">STATUS</th>
						<th width="20%"><div align="center">AKSI</div></th>
                    </tr>
				</thead>
				<tbody>
                    <?php
						$dataSql = "SELECT * FROM ms_kelurahan a 
									INNER JOIN ms_kecamatan b ON a.id_kecamatan=b.id_kecamatan
									INNER JOIN ms_kota c ON b.id_kota=c.id_kota
									INNER JOIN ms_provinsi d ON c.id_provinsi=d.id_provinsi
									ORDER BY b.id_kecamatan ASC";
						$dataQry = mysqli_query($koneksidb, $dataSql)  or die ("Query salah : ".mysqli_error());
						$nomor  = 0; 
						while ($data = mysqli_fetch_array($dataQry)) {
						$nomor++;
						$Kode = $data['id_kelurahan'];
					?>
                    <tr class="odd gradeX">
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes" value="<?php echo $Kode; ?>" name="txtID[<?php echo $Kode; ?>]" />
                                <span></span>
                            </label>
                        </td>
						<td><div align="center"><?php echo $nomor; ?></div></td>
						<td><?php echo $data ['nama_provinsi']; ?></td>
						<td><?php echo $data ['nama_kota']; ?></td>
						<td><?php echo $data ['nama_kecamatan']; ?></td>
						<td><?php echo $data ['nama_kelurahan']; ?></td>
						<td>
							<?php 
								if($data ['status_kelurahan']=='Active'){
									echo "<label class='label label-success'>Active</label>";
								}else{
									echo "<label class='label label-danger'>Non Active</label>";
								}
							?>						
						</td>
						<td><div align="center"><a href="?page=ubahkel&amp;id=<?php echo $Kode; ?>" class="btn btn-xs blue"><i class="fa fa-edit"></i></a></div></td>
                    </tr>
                    <?php } ?>
				</tbody>
            </table>
		</div>
	</div>
</form>