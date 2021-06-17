<?php
			
	if(isset($_POST['btnHapus'])){
		$txtID 		= $_POST['txtID'];
		foreach ($txtID as $id_key) {
				
			$qryHapus = mysqli_query($koneksidb, "DELETE FROM ms_user WHERE id_user='$id_key'") 
				or die ("query salah !!!".mysqli_error());
			if($qryHapus){
				$_SESSION['pesan'] = 'Data User Berhasil dihapus.';
				echo '<script>window.location="?page=datauser"</script>';
			}	
					
		}
	}
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
	<div class="portlet box green">
	    <div class="portlet-title">
	        <div class="caption">
	            <span class="caption-subject uppercase bold hidden-xs">Data User</span>
	        </div>
	        <div class="actions">
				<a href="?page=tambahuser" class="btn blue"><i class="icon-plus"></i> Tambah Data </a>
				<button class="btn red" name="btnHapus" type="submit" onclick="return confirm('Anda yakin ingin menghapus data?')"><i class="icon-trash"></i> Hapus Data</button>
			</div>
		</div>
    	<div class="portlet-body">
           <table class="table table-striped table-bordered table-hover" id="sample_2">
				<thead>
                    <tr class="active">
       	  	  	  	  	<th class="table-checkbox">
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                <span></span>
                            </label>
                        </th>
                        <th width="25%">NAMA USER</th>
						<th width="20%">JABATAN</th>
                        <th width="20%">USERNAME</th>
						<th width="13%">GROUP LEVEL</th>
						<th width="5%">DEFAULT</th>
						<th width="9%"><div align="center">STATUS</div></th>
						<th width="7%"><div align="center">AKSI</div></th>
                    </tr>
				</thead>
				<tbody>
               <?php
						$dataSql = "SELECT * FROM ms_user a 
									INNER JOIN sys_group b ON a.user_group=b.group_id
									INNER JOIN ms_pegawai c ON a.id_pegawai=c.id_pegawai
									INNER JOIN ms_jabatan d ON c.id_jabatan=d.id_jabatan
									ORDER BY id_user ASC";
						$dataQry = mysqli_query($koneksidb, $dataSql)  or die ("Query salah : ".mysqli_error());
						$nomor  = 0; 
						while ($data = mysqli_fetch_array($dataQry)) {
						$nomor++;
						$Kode = $data['id_user'];
				?>
                    <tr class="odd gradeX">
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes" value="<?php echo $Kode; ?>" name="txtID[<?php echo $Kode; ?>]" />
                                <span></span>
                            </label>
                        </td>
						<td><?php echo $data ['nama_pegawai']; ?></td>
						<td><?php echo $data ['nama_jabatan']; ?></td>
						<td><?php echo $data ['username_user']; ?></td>
						<td><?php echo $data ['group_nama']; ?></td>
						<td><?php echo $data ['default_user']; ?></td>
						<td>
							<div align="center">
								<?php 
									if($data ['status_user']=='Active'){
										echo "<label class='label label-success'>Active</label>";
									}else{
										echo "<label class='label label-danger'>Non Active</label>";
									}
								?>						
							</div>
						</td>
						<td><div align="center"><a href="?page=ubahuser&amp;id=<?php echo $Kode; ?>" class="btn btn-xs blue"><i class="fa fa-edit"></i></a></div></td>

                    </tr>
                    <?php
                        
                    }
                    ?>
				</tbody>
            </table>
  		</div>
	</div>
</form>