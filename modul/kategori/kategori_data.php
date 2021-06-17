<?php
			
	if(isset($_POST['btnHapus'])){
		$txtID 		= $_POST['txtID'];
		foreach ($txtID as $id_key) {
				
			$hapus=mysqli_query($koneksidb, "DELETE FROM ms_kategori WHERE id_kategori='$id_key'") 
				or die ("Gagal kosongkan tmp".mysqli_error());
				
			if($hapus){
				$_SESSION['pesan'] = 'Data kategori berhasil dihapus.';
				echo '<script>window.location="?page=datakategori"</script>';
			}	
					
		}
	}
 ?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
	<div class="portlet box green">
		<div class="portlet-title">
		<div class="caption"><span class="caption-subject uppercase bold">Data Kategori Barang</span></div>
			<div class="actions">
				<a href="?page=tambahkategori" class="btn blue"><i class="icon-plus"></i> Tambah Data</a>	
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
                        <th width="5%"><div align="center">KODE</div></th>
                        <th width="24%">NAMA KETEGORI</th>
						<th width="53%">KETERANGAN</th>
			  	  	  	<th width="11%"><div align="center">STATUS</div></th>
			  	  	  	<th width="10%"><div align="center">AKSI</div></th>
                    </tr>
				</thead>
				<tbody>
                    <?php
						$dataSql = "SELECT * FROM ms_kategori ORDER BY id_kategori DESC";
						$dataQry = mysqli_query($koneksidb, $dataSql)  or die ("Query salah : ".mysqli_error());
						$nomor  = 0; 
						while ($data = mysqli_fetch_array($dataQry)) {
						$nomor++;
						$Kode = $data['id_kategori'];
					?>
                   <tr class="odd gradeX">
                        <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes" value="<?php echo $Kode; ?>" name="txtID[<?php echo $Kode; ?>]" />
                                <span></span>
                            </label>
                        </td>
						<td><div align="center"><?php echo $nomor; ?></div></td>
						<td><?php echo $data ['nama_kategori']; ?></td>
						<td><?php echo $data ['keterangan_kategori']; ?></td>
                        <td class="hidden-phone">
						  <div align="center">
						    <?php 
						if($data ['status_kategori']=='Active'){
							echo "<label class='label label-success'>Active</label>";
						}else{
							echo "<label class='label label-important'>Non Active</label>";
						}
						?>						
				        </div></td>
						<td><div align="center"><a href="?page=ubahkategori&amp;id=<?php echo $Kode; ?>" class="btn btn-xs blue"><i class="fa fa-edit"></i></a></div></td>
                    </tr>
                    <?php } ?>
				</tbody>
            </table>
		</div>
	</div>
</form>