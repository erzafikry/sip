<?php			
	if(isset($_POST['btnHapus'])){
		$txtID 		= $_POST['txtID'];
		foreach ($txtID as $id_key) {
				
			$hapus=mysqli_query($koneksidb, "DELETE FROM ms_surtug WHERE id_surtug='$id_key'") 
				or die ("Gagal kosongkan tmp".mysqli_error());
				
			if($hapus){
				$_SESSION['pesan'] = 'Data Surat Tugas berhasil dihapus.';
				echo '<script>window.location="?page=datasurtug"</script>';
			}	
		}
	}			
	if(isset($_POST['btnKirim'])){
		$txtID 		= $_POST['txtID'];
		foreach ($txtID as $id_key) {
				
			$kirim=mysqli_query($koneksidb, "DELETE FROM ms_surtug WHERE id_surtug='$id_key'") 
				or die ("Gagal kosongkan tmp".mysqli_error());
				
			if($kirim){
				$_SESSION['pesan'] = 'Data Surat Tugas berhasil dikirim ke kasubsie.';
				echo '<script>window.location="?page=datasurtug"</script>';
			}	
		}
	}
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
	<div class="portlet box grey-cascade">
		<div class="portlet-title">
			<div class="caption">
				<span class="caption-subject uppercase bold">Data Surat Tugas</span>
			</div>
			<div class="actions">
				<a href="?page=tambahsurtug" class="btn blue"><i class="icon-plus"></i> Tambah Data</a>	
				<button class="btn btn-xs green" name="btnKirim" type="submit" onclick="return confirm('Kirim ST yang dipilih ke Kasubsie?')"><i class="icon-check"></i> Kirim</button>
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
                      	<th width="15%"><div align="center">NO SURAT TUGAS</div></th>
                      	<th width="7%"><div align="center">TGL MULAI </div></th>
                      	<th width="7%"><div align="center">TGL TERBIT </div></th>
                      	<th width="5%"><div align="center">NO BERKAS </div></th>
                      	<th width="5%"><div align="center">TAHUN</div></th>
                      	<th width="15%"><div align="center">KETERANGAN</div></th>
                      	<th width="15%"><div align="center">PETUGAS UKUR</div></th>
                      	<th width="15%"><div align="center">JABATAN</div></th>
					  	<th width="5%"><div align="center">AKSI</div></th>
                    </tr>
				</thead>
				<tbody>
                    <?php
						$dataSql = "SELECT * FROM ms_surtug a
									INNER JOIN ms_berkas b ON a.id_berkas=b.id_berkas
									INNER JOIN ms_pegawai c ON a.id_pegawai=c.id_pegawai
									INNER JOIN ms_jabatan d ON c.id_jabatan=d.id_jabatan
									ORDER BY id_surtug ASC";
						$dataQry = mysqli_query($koneksidb, $dataSql)  or die ("Koneksi gagal : ".mysqli_error());
						$nomor  = 0; 
						while ($data = mysqli_fetch_array($dataQry)) {
						$nomor++;
						$kode = $data['id_surtug'];
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
						<td><?php echo $data ['nama_pegawai']; ?></td>
						<td><?php echo $data ['nama_jabatan']; ?></td>
						<td>
							<div class="box-tools pull-center" align="center">
								<div class="btn-group">
									<a href="?page=ubahsurtug&amp;id=<?php echo $kode; ?>" class="btn btn-xs blue" onclick="return confirm('Yakin untuk ubah data ST ini?')"><i class="fa fa-edit"></i></a>
									<!--<button id="kirim" class='btn btn-xs green' name='btnKirim' type='button' onclick="return confirm('Kirim ST ke Kasubsie?')"><i class='icon-check' id='ok'></i></button>-->
									<?php
										// if ((isset($_POST['btnKirim'])=="1")) {
											// echo "<button class='btn btn-xs yellow' name='btnKirim' type='submit'><i class='fa fa-check'> Kirim</i></button>";
										// } else {
											// echo "<button class='btn btn-xs green' name='btnKirim' type='submit'>OK</button>";
										// }
									?>
									
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
<script src="./assets/scripts/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
// $(document).ready(function() {
     // $("#kirim").click(function() {
       // $("#ok").html("OK");
       // kirim.disabled = true;
     // })
// });
</script>