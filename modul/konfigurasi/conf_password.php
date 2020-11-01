<?php

	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['txtPasswordLama'])=="") {
			$message[] = "Password lama anda tidak boleh dikosongkan!";		
		}
		if (trim($_POST['txtPasswordBaru'])=="") {
			$message[] = "Password baru anda tidak boleh kosong!";		
		}
		if (trim($_POST['txtKonfirmasi'])=="") {
			$message[] = "Konfirmasi password baru anda tidak boleh kosong!";		
		}
				
				
		$txtPasswordLama	= $_POST['txtPasswordLama'];
		$txtPasswordBaru	= $_POST['txtPasswordBaru'];
		$txtKonfirmasi		= $_POST['txtKonfirmasi'];
		
		if($txtPasswordBaru != $txtKonfirmasi){
			$message[] = "Konfirmasi password anda tidak sesuai";
		}
		
		$sqlCek				= "SELECT * FROM ms_user WHERE id_user='".$_SESSION['id_user']."' AND password_user='".md5($txtPasswordLama)."'";
		$qryCek				= mysqli_query($koneksidb, $sqlCek) or die ("Eror Query".mysqli_error()); 
		if(mysqli_num_rows($qryCek)==0){
			$message[] = "Maaf, password lama anda tidak sesuai";
		}
						
		if(count($message)==0){			
			$sqlSave="UPDATE ms_user SET password_user='".md5($txtPasswordBaru)."' WHERE id_user='".$_SESSION['id_user']."'";
			$qrySave=mysqli_query($koneksidb, $sqlSave);
			if($qrySave){
				$_SESSION['pesan'] = 'Password baru anda berhasil diubah';
				echo '<script>window.location="?page=confpassword"</script>';
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
	
?>
		
<div class="portlet box grey-cascade">
	<div class="portlet-title">
		<div class="caption"><span class="caption-subject uppercase bold">Perubahan Password</span></div>
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
					<label class="col-md-2 control-label">Password Lama :</label>
					<div class="col-md-3">
						<div class="input-icon left">
							<i class="icon-lock"></i>
							<input class="form-control" type="password" name="txtPasswordLama" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Password Baru :</label>
					<div class="col-md-3">
						<div class="input-icon left">
							<i class="icon-lock-open"></i>
							<input class="form-control" name="txtPasswordBaru" type="password"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Verifikasi Password :</label>
					<div class="col-md-3">
						<div class="input-icon left">
							<i class="icon-lock-open"></i>
							<input class="form-control" name="txtKonfirmasi" type="password"/>
						</div>
						<span class="help-inline">* Masukkan kembali password baru anda</span>
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
		</form>
	</div>
</div>