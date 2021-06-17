<?php
	if(isset($_POST['btnSave'])){
		$message = array();
		// if (trim($_POST['cmbProv'])=="") {
			// $message[] = "<b>Nama Provinsi</b> tidak boleh kosong!";		
		// }
		if (trim($_POST['cmbKot'])=="") {
			$message[] = "<b>Nama Kota</b> tidak boleh kosong!";		
		}
		if (trim($_POST['txtNama'])=="") {
			$message[] = "<b>Nama Kota</b> tidak boleh kosong!";		
		}

		$txtNama		= $_POST['txtNama'];
		// $cmbProv		= $_POST['cmbProv'];
		$cmbKot			= $_POST['cmbKot'];
		$txtKeterangan	= $_POST['txtKeterangan'];
		$cmbStatus		= $_POST['cmbStatus'];
		$cmbLevel		= $_POST['cmbLevel'];
		$createdBy 		= $_SESSION["id_user"];


		if(count($message)==0){			
			$sqlSave="INSERT INTO ms_kecamatan SET id_kota='$cmbKot',
				  							nama_kecamatan='$txtNama',
				  							keterangan_kecamatan='$txtKeterangan',
				  							status_kecamatan='$cmbStatus',
											createdBy = '$createdBy',
											createdTime='".date('Y-m-d')."'";
			$qrySave = mysqli_query($koneksidb, $sqlSave)or die ("Gagal query".mysqli_error());
			if($qrySave){
				$_SESSION['pesan'] = 'Data Kecamatan berhasil ditambahkan';
				echo '<script>window.location="?page=datakec"</script>';
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
	// $dataProv		= isset($_POST['cmbProv']) ? $_POST['cmbProv'] : '';
	$dataKot		= isset($_POST['cmbKot']) ? $_POST['cmbKot'] : '';
	$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
	$dataStatus		= isset($_POST['cmbStatus']) ? $_POST['cmbStatus'] : '';
	$dataLevel		= isset($_POST['cmbLevel']) ? $_POST['cmbLevel'] : '';
?>
		
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><span class="caption-subject uppercase bold">Form Tambah Kecamatan</span></div>
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
					<label class="col-lg-2 control-label">Provinsi :</label>
					<div class="col-lg-2">
						<select name="cmbProv" class="select2 form-control" data-placeholder="Pilih Provinsi" disabled>
							<option value="BLANK">Jawa Barat</option>
							<?php
							  // $dataSql = "SELECT * FROM ms_provinsi ORDER BY id_provinsi ASC";
							  // $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
							  // while ($dataRow = mysqli_fetch_array($dataQry)) {
								// if ($dataLevel == $dataRow['id_provinsi']) {
									// $cek = " selected";
								// } else { $cek=""; }
								// echo "<option value='$dataRow[id_provinsi]' $cek>$dataRow[nama_provinsi]</option>";
							  // }
							  // $sqlData ="";
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Kota :</label>
					<div class="col-lg-2">
						<select name="cmbKot" class="select2 form-control" data-placeholder="Pilih Kota">
							<option value="BLANK"> </option>
							<?php
							  $dataSql = "SELECT * FROM ms_kota ORDER BY id_kota ASC";
							  $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
							  while ($dataRow = mysqli_fetch_array($dataQry)) {
								if ($dataLevel == $dataRow['id_kota']) {
									$cek = " selected";
								} else { $cek=""; }
								echo "<option value='$dataRow[id_kota]' $cek>$dataRow[nama_kota]</option>";
							  }
							  $sqlData ="";
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Kecamatan :</label>
					<div class="col-lg-2">
						<input class="form-control" name="txtNama" value="<?php echo $dataNama; ?>" type="text"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Keterangan :</label>
					<div class="col-lg-3">
						<textarea class="form-control" name="txtKeterangan" type="text"/><?php echo $dataKeterangan; ?></textarea>
					</div>
				</div>
				<div class="form-group">
	                <label class="col-md-2 control-label">Status Kecamatan :</label>
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
			                <a href="?page=datakec" class="btn yellow"><i class="fa fa-undo"></i> Batal</a>
			            </div>
			        </div>
			    </div>
			</div>
		</form>
	</div>
</div>