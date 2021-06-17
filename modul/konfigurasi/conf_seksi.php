<?php		
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['txtNama'])=="") {
			$message[] = "Nama seksi tidak boleh kosong";		
		}
		if (trim($_POST['txtMoto'])=="") {
			$message[] = "slogan seksi tidak boleh kosong !";		
		}
		if (trim($_POST['txtAlamat'])=="") {
			$message[] = "alamat seksi tidak boleh kosong";		
		}
		if (trim($_POST['txtTelp'])=="") {
			$message[] = "no. telp seksi tidak boleh kosong";		
		}
						
		$txtNama		= $_POST['txtNama'];
		$txtMoto		= $_POST['txtMoto'];
		$txtTelp		= $_POST['txtTelp'];
		$txtAlamat		= $_POST['txtAlamat'];
		$txtEmail		= $_POST['txtEmail'];
		$txtKeterangan	= $_POST['txtKeterangan'];
		$txtWebsite		= $_POST['txtWebsite'];
							
		if(count($message)==0){			
			$sqlSave="UPDATE ms_seksi SET nama_seksi='$txtNama', 
										telp_seksi='$txtTelp', 
										alamat_seksi='$txtAlamat', 
										email_seksi='$txtEmail',
					  					moto_seksi='$txtMoto', 
										keterangan_seksi='$txtKeterangan',
										website_seksi='$txtWebsite'";
			$qrySave=mysqli_query($koneksidb, $sqlSave);
			if($qrySave){
				$_SESSION['pesan'] = 'Data seksi berhasil ubah';
						echo '<script>window.location="?page=confseksi"</script>';
				
			}
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
	$sqlShow 		= "SELECT * FROM ms_seksi";
	$qryShow 		= mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data salah : ".mysqli_error());
	$dataShow 		= mysqli_fetch_array($qryShow);
	
	$dataNama		= isset($dataShow['nama_seksi']) ?  $dataShow['nama_seksi'] : $_POST['txtNama'];
	$dataTelp		= isset($dataShow['telp_seksi']) ?  $dataShow['telp_seksi'] : $_POST['txtTelp'];
	$dataAlamat		= isset($dataShow['alamat_seksi']) ?  $dataShow['alamat_seksi'] : $_POST['txtAlamat'];
	$dataEmail		= isset($dataShow['email_seksi']) ?  $dataShow['email_seksi'] : $_POST['txtEmail'];
	$dataMoto		= isset($dataShow['moto_seksi']) ?  $dataShow['moto_seksi'] : $_POST['txtMoto'];
	$dataKeterangan = isset($dataShow['keterangan_seksi']) ?  $dataShow['keterangan_seksi'] : $_POST['txtKeterangan'];
	$dataWebsite	= isset($dataShow['website_seksi']) ?  $dataShow['website_seksi'] : $_POST['txtWebsite'];
			
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="form-horizontal">
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption"><span class="caption-subject uppercase bold">Konfigurasi Seksi</span></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
				<a href="javascript:;" class="remove"></a>
			</div>
		</div>
		<div class="portlet-body form">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-2 control-label">Nama Seksi :</label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="txtNama" value="<?php echo $dataNama; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Moto Seksi :</label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="txtMoto"  value="<?php echo $dataMoto; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Alamat :</label>
					<div class="col-md-10">
						<input type="text" class="form-control" name="txtAlamat" value="<?php echo $dataAlamat; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">No. Telp :</label>
					<div class="col-md-3">
						<input type="text" class="form-control" name="txtTelp" value="<?php echo $dataTelp; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Email :</label>
					<div class="col-md-3">
						<input type="text" class="form-control" name="txtEmail" value="<?php echo $dataEmail; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Keterangan :</label>
					<div class="col-md-10">
						<textarea name="txtKeterangan" cols="2" rows="2" class="form-control"><?php echo $dataKeterangan; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Website :</label>
					<div class="col-md-3">
						<input type="text" class="form-control" name="txtWebsite" value="<?php echo $dataWebsite; ?>">
					</div>
				</div>
		 	</div>
		 	<div class="form-actions">
			    <div class="row">
			        <div class="form-group">
			            <div class="col-lg-offset-2 col-lg-10">
			                <button type="submit" name="btnSave" class="btn blue"><i class="fa fa-save"></i> Simpan Data</button>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</form>