<?php
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['txtNama'])=="") {
			$message[] = "<b>Nama Jabatan</b> tidak boleh kosong!";		
		}
		if (trim($_POST['cmbJabatan'])=="") {
			$message[] = "<b>Tipe Jabatan</b> tidak boleh kosong!";		
		}

		$txtNama		= $_POST['txtNama'];
		$txtEselon		= $_POST['txtEselon'];
		$cmbJabatan		= $_POST['cmbJabatan'];
		$createdBy 		= $_SESSION["id_user"];


		if(count($message)==0){			
			$sqlSave="INSERT INTO ms_jabatan SET nama_jabatan='$txtNama', 
				  							tipe_jabatan='$cmbJabatan',
											eselon='$txtEselon',
											createdBy = '$createdBy',
											createdTime='".date('Y-m-d')."'";
			$qrySave = mysqli_query($koneksidb, $sqlSave)or die ("Gagal query".mysqli_error());
			if($qrySave){
				$_SESSION['pesan'] = 'Data Jabatan berhasil ditambahkan';
				echo '<script>window.location="?page=datajab"</script>';
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
	$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
	$dataJabatan	= isset($_POST['cmbJabatan']) ? $_POST['cmbJabatan'] : '';
	$dataEselon		= isset($_POST['txtEselon']) ? $_POST['txtEselon'] : '';
?>
		
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><span class="caption-subject uppercase bold">Form Tambah Jabatan</span></div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmadd" class="form-horizontal">
			<div class="form-body">
				<div class="form-group">
					<label class="col-lg-2 control-label">Nama Jabatan :</label>
					<div class="col-lg-4">
						<input class="form-control" name="txtNama" value="<?php echo $dataNama; ?>" type="text"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Tipe Jabatan :</label>
					<div class="col-lg-4">
						<select data-placeholder="Pilih Jabatan" class="form-control select2" name="cmbJabatan">
							<option value=""></option> 
							   <?php
							  $pilihan	= array(
								"Struktural", 
								"Jabatan Fungsional Umum",
								"Jabatan Fungsional Tertentu",
								"PPNPN",
								"Petugas Ukur",
								"SKB",
								"ASKB",
								"Pembantu Ukur"
								);
							  foreach ($pilihan as $nilai) {
								if ($dataJabatan==$nilai) {
									$cek=" selected";
								} else { $cek = ""; }
								echo "<option value='$nilai' $cek>$nilai</option>";
							  }
							  ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Eselon :</label>
					<div class="col-lg-1">
						<input class="form-control" name="txtEselon" value="<?php echo $dataEselon; ?>" type="text"/>
					</div>
				</div>
			</div>
			<div class="form-actions">
			    <div class="row">
			        <div class="form-group">
			            <div class="col-lg-offset-2 col-lg-10">
			                <button type="submit" name="btnSave" class="btn blue"><i class="fa fa-save"></i> Simpan Data</button>
			                <a href="?page=datajab" class="btn yellow"><i class="fa fa-undo"></i> Batal</a>
			            </div>
			        </div>
			    </div>
			</div>
		</form>
	</div>
</div>