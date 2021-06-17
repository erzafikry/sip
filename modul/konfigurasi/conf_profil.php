<?php
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['txtNama'])=="") {
			$message[] = "Nama lengkap tidak boleh kosong!";		
		}
		if (trim($_POST['txtUsername'])=="") {
			$message[] = "Username tidak boleh kosong";		
		}
		if (trim($_POST['cmbKelamin'])=="") {
			$message[] = "Jenis kelamin tidak boleh kosong";		
		}
		
		$txtNama		= $_POST['txtNama'];
		$txtUsername	= $_POST['txtUsername'];
		$txtTelp		= $_POST['txtTelp'];
		$txtAlamat		= $_POST['txtAlamat'];
		$txtEmail		= $_POST['txtEmail'];
		$cmbKelamin		= $_POST['cmbKelamin'];
		$txtUsernameLm	= $_POST['txtUsernameLm'];

		$sqlCek="SELECT * FROM ms_user WHERE username_user='$txtUser' AND NOT(username_user='$txtUsernameLm')";
		$qryCek=mysqli_query($koneksidb, $sqlCek) or die ("Eror Query".mysqli_error()); 
		if(mysqli_num_rows($qryCek)>=1){
			$message[] = "Maaf, Username <b> $txtUsername </b> sudah ada, ganti dengan username lain";
		}
				
		if(count($message)==0){								

			$sqlSave="UPDATE ms_user SET nama_user='$txtNama', 
											telp_user='$txtTelp', 
											alamat_user='$txtAlamat', 
											email_user='$txtEmail', 
											username_user='$txtUsername',
											kelamin_user='$cmbKelamin'
									WHERE id_user='".$_POST['txtKode']."'";
			$qrySave=mysqli_query($koneksidb, $sqlSave);
			if($qrySave){
				$_SESSION['pesan'] = 'Profile anda berhasil diperbaharui';
				echo '<script>window.location="?page=confprofile"</script>';
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
	$sqlShow 		= "SELECT * FROM ms_user WHERE id_user='".$_SESSION['id_user']."'";
	$qryShow 		= mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data user salah : ".mysqli_error());
	$dataShow 		= mysqli_fetch_array($qryShow);

	$dataKode		= $dataShow['id_user'];
	$dataNama		= isset($dataShow['nama_user']) ?  $dataShow['nama_user'] : $_POST['txtNama'];
	$dataTelp		= isset($dataShow['telp_user']) ?  $dataShow['telp_user'] : $_POST['txtTelp'];
	$dataEmail		= isset($dataShow['email_user']) ?  $dataShow['email_user'] : $_POST['txtEmail'];
	$dataKelamin	= isset($dataShow['kelamin_user']) ?  $dataShow['kelamin_user'] : $_POST['cmbKelamin'];
	$dataAlamat		= isset($dataShow['alamat_user']) ?  $dataShow['alamat_user'] : $_POST['txtAlamat'];
	$dataUsername	= isset($dataShow['username_user']) ?  $dataShow['username_user'] : $_POST['txtUsername'];
	$dataUsernameLm	= $dataShow['username_user'];
?>
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><span class="caption-subject uppercase bold">Perubahan Profil</span></div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body form">			
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="post" class="form-horizontal">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-2 control-label">Nama Lengakap :</label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="txtNama" value="<?php echo $dataNama; ?>">
						<input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Username :</label>
					<div class="col-md-3">
						<input class="form-control" type="text" name="txtUsername"  value="<?php echo $dataUsername; ?>"/>
						<input name="txtUsernameLm" type="hidden" value="<?php echo $dataUsernameLm; ?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">No. Telp :</label>
					<div class="col-md-3">
						<input class="form-control" name="txtTelp" type="text"  value="<?php echo $dataTelp; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Email :</label>
					<div class="col-md-3">
						<input class="form-control" name="txtEmail" type="text"  value="<?php echo $dataEmail; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Alamat :</label>
					<div class="col-md-10">
						<textarea class="form-control" name="txtAlamat" type="text"/><?php echo $dataAlamat; ?></textarea>
					</div>
				</div>
				<div class="form-group">
	                <label class="col-md-2 control-label">Jenis Kelamin :</label>
	                <div class="col-md-10">
	                    <div class="md-radio-list">
	                    	<?php
								if($dataKelamin=='Pria'){
				                    echo " 	<div class='md-radio'>
				                    			<input type='radio' id='radio53' name='cmbKelamin' value='Pria' class='md-radiobtn' checked>
				                            	<label for='radio53'><span></span><span class='check'></span><span class='box'></span> Pria </label>
				                            </div>
				                        	<div class='md-radio'>
				                            	<input type='radio' id='radio54' name='cmbKelamin' value='Wanita' class='md-radiobtn'>
				                            	<label for='radio54'><span></span><span class='check'></span><span class='box'></span> Wanita </label>
				                        	</div>";
				                }elseif($dataKelamin=='Wanita'){
				                	echo "	<div class='md-radio'>
				                            	<input type='radio' id='radio53' name='cmbKelamin' value='Pria' class='md-radiobtn'>
				                            	<label for='radio53'><span></span><span class='check'></span><span class='box'></span> Pria </label>
				                        	</div>
				                        	<div class='md-radio'>
				                            	<input type='radio' id='radio54' name='cmbKelamin' value='Wanita' class='md-radiobtn' checked>
				                            	<label for='radio54'><span></span><span class='check'></span><span class='box'></span> Wanita </label>
				                            </div>";
				                }else{
				                	echo "	<div class='md-radio'>
				                            	<input type='radio' id='radio53' name='cmbKelamin' value='Pria' class='md-radiobtn'>
				                            	<label for='radio53'><span></span><span class='check'></span><span class='box'></span> Pria </label>
				                        	</div>
				                        	<div class='md-radio'>
				                            	<input type='radio' id='radio54' name='cmbKelamin' value='Wanita' class='md-radiobtn'>
				                            	<label for='radio54'><span></span><span class='check'></span><span class='box'></span> Wanita </label>
				                            </div>";
				                }
				            ?>
	                    </div>
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