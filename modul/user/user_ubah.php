<?php
		
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['cmbPegawai'])=="") {
			$message[] = "Nama Pegawai tidak boleh kosong!";		
		}
		if (trim($_POST['txtUser'])=="") {
			$message[] = "Username tidak boleh kosong!";		
		}
		if (trim($_POST['cmbLevel'])=="BLANK") {
			$message[] = "Level tidak boleh kosong, silahkan pilih terlebih dahulu!";		
		}
		if (trim($_POST['cmbStatus'])=="") {
			$message[] = "status tidak boleh kosong!";		
		}
		if (trim($_POST['cmbDefault'])=="") {
			$message[] = "<b>Default </b> tidak boleh kosong!";		
		}
		
		$cmbPegawai	= $_POST['cmbPegawai'];
		$txtUser	= $_POST['txtUser'];
		$txtUserLm	= $_POST['txtUserLm'];
		$txtPassLama= $_POST['txtPassLama'];
		$txtPassBaru= $_POST['txtPassBaru'];
		$cmbLevel	= $_POST['cmbLevel'];
		$cmbStatus	= $_POST['cmbStatus'];
		$cmbDefault	= $_POST['cmbDefault'];
		$updatedBy	= $_SESSION['id_user'];
		if($cmbDefault=='Y'){
			$qryUpdate=mysqli_query($koneksidb, "UPDATE ms_user SET default_user='N'") 
					   or die ("Gagal query update".mysqli_error());
		}

		$sqlCek="SELECT * FROM ms_user WHERE username_user='$txtUser' AND NOT(username_user='$txtUserLm')";
		$qryCek=mysqli_query($koneksidb, $sqlCek) or die ("Eror Query".mysqli_error()); 
		if(mysqli_num_rows($qryCek)>=1){
			$message[] = "Maaf, Username <b> $ txtUsername </b> sudah ada, ganti dengan username lain";
		}
				
		if(count($message)==0){			
			if (trim($txtPassBaru)=="") {
				$sqlSub = " password_user='$txtPassLama'";
			}
			else {
				$sqlSub = "  password_user='".md5($txtPassBaru)."'";
			}
			
		
			$sqlSave="UPDATE ms_user SET id_pegawai='$cmbPegawai', 
										username_user='$txtUser',
										$sqlSub, 
					  					user_group='$cmbLevel', 
										default_user='$cmbDefault',
										status_user='$cmbStatus',
										updatedBy = '$updatedBy',
										updatedTime='".date('Y-m-d')."'										
									WHERE id_user='".$_POST['txtKode']."'";
			$qrySave=mysqli_query($koneksidb, $sqlSave);
			if($qrySave){
				$_SESSION['pesan'] = 'Data User berhasil diperbaharui';
				echo '<script>window.location="?page=datauser"</script>';
			}
		}	
		
		if (! count($message)==0 ){
			echo "<div class='alert alert-danger'>";
				$Num=0;
				foreach ($message as $indeks=>$pesan_tampil) { 
				$Num++;
					echo "&nbsp;&nbsp;$Num. $pesan_tampil<br>";	
				} 
			echo "</div>"; 
		}
	} 
	$KodeEdit	= isset($_GET['id']) ?  $_GET['id'] : $_POST['txtKode']; 
	$sqlShow 	= "SELECT * FROM ms_user WHERE id_user='$KodeEdit'";
	$qryShow 	= mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data user salah : ".mysqli_error());
	$dataShow 	= mysqli_fetch_array($qryShow);

	$dataKode	= $dataShow['id_user'];
	$dataUser	= isset($dataShow['username_user']) ?  $dataShow['username_user'] : $_POST['txtUser'];
	$dataUserLm	= $dataShow['username_user'];
	$dataPass	= isset($dataShow['password_user']) ?  $dataShow['password_user'] : $_POST['txtPassBaru'];
	$dataLevel 	= isset($dataShow['user_group']) ?  $dataShow['user_group'] : $_POST['cmbLevel'];
	$dataPegawai = isset($dataShow['id_pegawai']) ?  $dataShow['id_pegawai'] : $_POST['cmbPegawai'];
	$dataStatus = isset($dataShow['status_user']) ?  $dataShow['status_user'] : $_POST['cmbStatus'];
	$dataDefault= isset($dataShow['default_user']) ?  $dataShow['default_user'] : $_POST['cmbDefault'];
			

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="post" class="form-horizontal" enctype="multipart/form-data">
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption">
	            <span class="caption-subject uppercase bold hidden-xs">Form Ubah User</span>
	        </div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
				<a href="javascript:;" class="remove"></a>
			</div>
		</div>
		<div class="portlet-body form">
			<div class="form-body">
				<input class="form-control" type="hidden" value="<?php echo $dataKode; ?>" readonly="readonly" name="txtKode"/>					
				<div class="form-group">
					<label class="col-lg-2 control-label">Nama Pegawai :</label>
					<div class="col-lg-2">
						<select name="cmbPegawai" class="select2 form-control" data-placeholder="Pilih Pegawai">
							<option value="BLANK"> </option>
							<?php
							  $dataSql = "SELECT * FROM ms_pegawai ORDER BY id_pegawai DESC";
							  $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
							  while ($dataRow = mysqli_fetch_array($dataQry)) {
								if ($dataPegawai == $dataRow['id_pegawai']) {
									$cek = " selected";
								} else { $cek=""; }
								echo "<option value='$dataRow[id_pegawai]' $cek>$dataRow[nama_pegawai]</option>";
							  }
							  $sqlData ="";
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Username :</label>
					<div class="col-lg-3">
						<input class="form-control" type="text" name="txtUser"  value="<?php echo $dataUser; ?>"/>
						<input name="txtUserLm" type="hidden" value="<?php echo $dataUserLm; ?>" />
					</div>
				</div>
				<div class="form-group">
                    <label class="col-md-2 control-label">Password :</label>
                    <div class="col-md-9">
                        <div class="input-inline input-medium">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-lock"></i>
                                </span>
                                <input class="form-control" name="txtPassBaru" type="password" />
                                <input name="txtPassLama" type="hidden" value="<?php echo $dataPass; ?>" />
                           </div>
                        </div>
                        <span class="help-inline"> Kosongkan apabila tidak diubah. </span>
                    </div>
                </div>					
				<div class="form-group">
					<label class="col-lg-2 control-label">Level Group :</label>
					<div class="col-lg-2">
						<select name="cmbLevel" class="select2 form-control" data-placeholder="Pilih Level">
							<option value="BLANK"> </option>
							<?php
							  $dataSql = "SELECT * FROM sys_group ORDER BY group_id DESC";
							  $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
							  while ($dataRow = mysqli_fetch_array($dataQry)) {
								if ($dataLevel == $dataRow['group_id']) {
									$cek = " selected";
								} else { $cek=""; }
								echo "<option value='$dataRow[group_id]' $cek>$dataRow[group_nama]</option>";
							  }
							  $sqlData ="";
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Default :</label>
					<div class="col-lg-2">
						<select data-placeholder="Pilih Default" class="form-control select2" name="cmbDefault">
							<option value=""></option> 
							   <?php
							  $pilihan	= array("Y", "N");
							  foreach ($pilihan as $nilai) {
								if ($dataDefault==$nilai) {
									$cek=" selected";
								} else { $cek = ""; }
								echo "<option value='$nilai' $cek>$nilai</option>";
							  }
							  ?>
						</select>
					</div>
				</div>
				<div class="form-group">
	                <label class="col-md-2 control-label">Status User :</label>
	                <div class="col-md-10">
	                    <div class="md-radio-list">
	                    	<?php
								if($dataStatus=='Active'){
				                    echo " 	<div class='md-radio'>
				                    			<input type='radio' id='radio53' name='cmbStatus' value='Active' class='md-radiobtn' checked>
				                            	<label for='radio53'><span></span><span class='check'></span><span class='box'></span> Active </label>
				                            </div>
				                        	<div class='md-radio'>
				                            	<input type='radio' id='radio54' name='cmbStatus' value='Non Active' class='md-radiobtn'>
				                            	<label for='radio54'><span></span><span class='check'></span><span class='box'></span> Non Active </label>
				                        	</div>";
				                }elseif($dataStatus=='Non Active'){
				                	echo "	<div class='md-radio'>
				                            	<input type='radio' id='radio53' name='cmbStatus' value='Active' class='md-radiobtn'>
				                            	<label for='radio53'><span></span><span class='check'></span><span class='box'></span> Active </label>
				                        	</div>
				                        	<div class='md-radio'>
				                            	<input type='radio' id='radio54' name='cmbStatus' value='Non Active' class='md-radiobtn' checked>
				                            	<label for='radio54'><span></span><span class='check'></span><span class='box'></span> Non Active </label>
				                            </div>";
				                }else{
				                	echo "	<div class='md-radio'>
				                            	<input type='radio' id='radio53' name='cmbStatus' value='Active' class='md-radiobtn'>
				                            	<label for='radio53'><span></span><span class='check'></span><span class='box'></span> Active </label>
				                        	</div>
				                        	<div class='md-radio'>
				                            	<input type='radio' id='radio54' name='cmbStatus' value='Non Active' class='md-radiobtn'>
				                            	<label for='radio54'><span></span><span class='check'></span><span class='box'></span> Non Active </label>
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
			                <a href="?page=datauser" class="btn yellow"><i class="fa fa-undo"></i> Batal</a>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</form>