<?php			
	if(isset($_POST['btnHapus'])){
		$txtID		= $_POST['txtID'];
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
		$message = array();
		if (trim($_POST['txtTglKirim'])=="") {
			$message[] = "<b>Tgl Kirim</b> tidak boleh kosong.";		
		}
		if (trim($_POST['txtCatatan'])=="") {
			$message[] = "<b>Catatan</b> tidak boleh kosong.";		
		}
		
		$txtTglKirim		= $_POST['txtTglKirim'];
		$txtCatatan			= $_POST['txtCatatan'];
		$createdBy 			= $_SESSION["id_user"];
		$txtID				= $_POST['txtID'];
		
		if(count($message)==0){		
			$sqlSave="INSERT INTO trx_surtug SET id_surtug='$txtID', 
											 id_pegawai='14',
											 tgl_kirim='".InggrisTgl($txtTglKirim)."',
											 catatan='$txtCatatan',
											 createdBy = '$createdBy',
											 createdTime='".date('Y-m-d')."'";
			$qrySave = mysqli_query($koneksidb, $sqlSave)or die ("Gagal query".mysqli_error());
			if($qrySave){
				$_SESSION['pesan'] = 'Surat Tugas berhasil dikirim.';
				echo '<script>window.location="?page=datasurtug"</script>';
			}
			exit;
		}
		
		if (! count($message)==0 ){
			echo "<div class='alert alert-danger alert-dismissable'>
					  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>";
				$Num=0;
				foreach ($message as $indeks=>$pesan_tampil) { 
				$Num++;
					echo "&nbsp;&nbsp;$Num. $pesan_tampil<br>";	
				} 
			echo "</div>"; 
		}
	}
	
	$dataTglKirim	= isset($_POST['txtTglKirim']) ? $_POST['txtTglKirim'] : date('d-m-Y');
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
	<div class="portlet box grey-cascade">
		<div class="portlet-title">
			<div class="caption">
				<span class="caption-subject uppercase bold">Data Surat Tugas</span>
			</div>
			<div class="actions">
				<?php
					if($_SESSION['id_user'] != 1){
						echo "
							<div class='actions'>
								<a href='?page=tambahsurtug' class='btn blue'><i class='icon-plus'></i> Tambah Data</a>
							</div>
						";
					} else {
						echo "
							<div class='actions'>
								<a href='?page=tambahsurtug' class='btn blue'><i class='icon-plus'></i> Tambah Data</a>
								<a data-toggle='modal' data-target='#formKirim' class='btn btn-sm green'><i class='icon-check'></i> Kirim</a>
								<button class='btn red' name='btnHapus' type='submit' onclick='return confirm('Anda yakin ingin menghapus data penting ini !!')'><i class='icon-trash'></i> Hapus Data</button>
							</div>
						";
					}
				?>
				<!--
					<a data-toggle="modal" data-target="#formKirim" class="btn btn-sm green" onclick="return confirm('Kirim ST yang dipilih ke Kasubsie?')"><i class="icon-check"></i> Kirim</a>
				-->
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
									<!--
									<a href="?page=kirimst&amp;id=<?php echo $kode; ?>" class="btn btn-xs green" onclick="return confirm('Kirim ST ini ke Kasubsie?')"><i class="icon-check"></i></a>
									-->									
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
<SCRIPT language="JavaScript">
	function submitform() {
		document.form1.submit();
	}
</SCRIPT>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" class="portlet-body form">
	<input class="form-control" type="hidden" value="<?php echo $dataKode; ?>" name="txtKode" readonly/>
	<div class="modal fade bs-modal" id="formKirim" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Kirim Surat Tugas Ke Kasubsie</h4>
				</div>
				<div class="modal-body"> 
					<div class="form-group">
						<div class="input-icon left">
							<label class="control-label">Tgl. Kirim :</label>
							<i class="icon-calendar"></i>
							<input class="form-control date-picker" data-date-format="dd-mm-yyyy" type="hidden" value="<?php echo $dataTglKirim; ?>" name="txtTglKirim" />
							<input class="form-control date-picker" data-date-format="dd-mm-yyyy" type="text" value="<?php echo $dataTglKirim; ?>" name="txtTglKirim" disabled/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label">Catatan :</label>
						<textarea class="form-control" name="txtCatatan" type="text" /></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn blue" name="btnKirim">Simpan</button>
					<button type="button" class="btn default" data-dismiss="modal">Batal</button>
				</div>
			</div>
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