<?php
		
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['txtNip'])=="") {
			$message[] = "NIP tidak boleh kosong!";		
		}
		if (trim($_POST['txtNama'])=="") {
			$message[] = "Nama Lengkap tidak boleh kosong!";		
		}
		if (trim($_POST['txtAlamat'])=="") {
			$message[] = "Alamat tidak boleh kosong!";		
		}
		if (trim($_POST['txtTempatlahir'])=="") {
			$message[] = "Tempat lahir tidak boleh kosong!";		
		}
		if (trim($_POST['txtTgllahir'])=="") {
			$message[] = "Tgl lahir tidak boleh kosong!";		
		}
		if (trim($_POST['cmbKelaminpegawai'])=="") {
			$message[] = "Jenis Kelamin tidak boleh kosong!";		
		}
		if (trim($_POST['cmbSatker'])=="BLANK") {
			$message[] = "Satker tidak boleh kosong, silahkan pilih terlebih dahulu!";		
		}
		if (trim($_POST['cmbJabatan'])=="BLANK") {
			$message[] = "Jabatan tidak boleh kosong, silahkan pilih terlebih dahulu!";		
		}
		if (trim($_POST['cmbStatus'])=="") {
			$message[] = "status tidak boleh kosong!";		
		}
		
		
		$txtNip				= $_POST['txtNip'];
		$txtNama			= $_POST['txtNama'];
		$txtAlamat			= $_POST['txtAlamat'];
		$txtTempatlahir		= $_POST['txtTempatlahir'];
		$txtTgllahir		= $_POST['txtTgllahir'];
		$cmbKelaminpegawai	= $_POST['cmbKelaminpegawai'];
		$cmbSatker			= $_POST['cmbSatker'];
		$cmbJabatan			= $_POST['cmbJabatan'];
		$cmbStatus			= $_POST['cmbStatus'];
		$updatedBy 			= $_SESSION["id_user"];
		
		if(count($message)==0){	
			$qryUpdate=mysqli_query($koneksidb, "UPDATE ms_pegawai SET nip='$txtNip',
							  							nama_pegawai='$txtNama',
							  							alamat_pegawai='$txtAlamat',
							  							tempat_lahir_pegawai='$txtTempatlahir',
							  							tgl_lahir_pegawai='".InggrisTgl($txtTgllahir)."',
							  							kelamin_pegawai='$cmbKelaminpegawai',
							  							status_pegawai='$cmbStatus',
							  							id_satker='$cmbSatker',
							  							id_jabatan='$cmbJabatan',
														updatedBy='$updatedBy',
														updatedTime='".date('Y-m-d')."'
												WHERE id_pegawai ='".$_POST['txtKode']."'") 
					   or die ("Gagal query update".mysqli_error());
			if($qryUpdate){
				$_SESSION['pesan'] = 'Data Pegawai berhasil diperbaharui';
				echo '<script>window.location="?page=datapegawai"</script>';
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

	$KodeEdit		= isset($_GET['id']) ?  $_GET['id'] : $_POST['txtKode']; 
	$sqlShow 		= "SELECT * FROM ms_pegawai WHERE id_pegawai='$KodeEdit'";
	$qryShow 		= mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data Pegawai salah : ".mysqli_error());
	$dataShow 		= mysqli_fetch_array($qryShow);
	
	$dataKode		= $dataShow['id_pegawai'];
	
	$dataNip			= isset($dataShow['nip']) ?  $dataShow['nip'] : $_POST['txtNip'];
	$dataNama			= isset($dataShow['nama_pegawai']) ?  $dataShow['nama_pegawai'] : $_POST['txtNama'];
	$dataAlamat			= isset($dataShow['alamat_pegawai']) ?  $dataShow['alamat_pegawai'] : $_POST['txtAlamat'];
	$dataTempatlahir	= isset($dataShow['tempat_lahir_pegawai']) ?  $dataShow['tempat_lahir_pegawai'] : $_POST['txtTempatlahir'];
	$dataTgllahir		= isset($dataShow['tgl_lahir_pegawai']) ?  $dataShow['tgl_lahir_pegawai'] : $_POST['txtTgllahir'];
	$dataKelaminpegawai	= isset($dataShow['kelamin_pegawai']) ?  $dataShow['kelamin_pegawai'] : $_POST['cmbKelaminpegawai'];
	$dataSatker			= isset($dataShow['id_satker']) ?  $dataShow['id_satker'] : $_POST['cmbSatker'];
	$dataJabatan		= isset($dataShow['id_jabatan']) ?  $dataShow['id_jabatan'] : $_POST['cmbJabatan'];
	$dataStatus			= isset($dataShow['status_pegawai']) ?  $dataShow['status_pegawai'] : $_POST['cmbStatus'];
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="post" class="form-horizontal" enctype="multipart/form-data">
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption">
	            <span class="caption-subject uppercase bold hidden-xs">Form Tambah Pegawai</span>
	        </div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
				<a href="javascript:;" class="remove"></a>
			</div>
		</div>
		<div class="portlet-body form">
			<div class="form-body">
				<input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" />
				<div class="form-group">
					<label class="col-lg-2 control-label">NIP :</label>
					<div class="col-lg-2">
						<input class="form-control" type="text" name="txtNip" value="<?php echo $dataNip; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Nama Pegawai :</label>
					<div class="col-lg-3">
						<input class="form-control" type="text" name="txtNama" value="<?php echo $dataNama; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Alamat :</label>
					<div class="col-lg-3">
						<textarea class="form-control" name="txtAlamat" type="text"/><?php echo $dataAlamat; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Tempat Lahir :</label>
					<div class="col-lg-2">
						<input class="form-control" type="text" name="txtTempatlahir" value="<?php echo $dataTempatlahir; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Tgl. Lahir :</label>
					<div class="col-lg-2">
						<div class="input-icon left">
							<i class="icon-calendar"></i>
							<input class="form-control date-picker" data-date-format="dd-mm-yyyy" type="text" value="<?php echo date('d-m-Y', strtotime($dataTgllahir)); ?>" name="txtTgllahir"/>
						</div>
					</div>
				</div>
				<div class="form-group">
	                <label class="col-md-2 control-label">Jenis Kelamin :</label>
	                <div class="col-md-10">
	                    <div class="md-radio-list">
	                    	<?php
								if($dataKelaminpegawai=='Laki-laki'){
				                    echo " 	<div class='md-radio'>
				                    			<input type='radio' id='radio50' name='cmbKelaminpegawai' value='Laki-laki' class='md-radiobtn' checked>
				                            	<label for='radio50'><span></span><span class='check'></span><span class='box'></span> Laki-laki </label>
				                            </div>
				                        	<div class='md-radio'>
				                            	<input type='radio' id='radio51' name='cmbKelaminpegawai' value='Perempuan' class='md-radiobtn'>
				                            	<label for='radio51'><span></span><span class='check'></span><span class='box'></span> Perempuan </label>
				                        	</div>";
				                }elseif($dataKelaminpegawai=='Perempuan'){
				                	echo "	<div class='md-radio'>
				                            	<input type='radio' id='radio50' name='cmbKelaminpegawai' value='Laki-laki' class='md-radiobtn'>
				                            	<label for='radio50'><span></span><span class='check'></span><span class='box'></span> Laki-laki </label>
				                        	</div>
				                        	<div class='md-radio'>
				                            	<input type='radio' id='radio51' name='cmbKelaminpegawai' value='Perempuan' class='md-radiobtn' checked>
				                            	<label for='radio51'><span></span><span class='check'></span><span class='box'></span> Perempuan </label>
				                            </div>";
				                }else{
				                	echo "	<div class='md-radio'>
				                            	<input type='radio' id='radio50' name='cmbKelaminpegawai' value='Laki-laki' class='md-radiobtn'>
				                            	<label for='radio50'><span></span><span class='check'></span><span class='box'></span> Laki-laki </label>
				                        	</div>
				                        	<div class='md-radio'>
				                            	<input type='radio' id='radio51' name='cmbKelaminpegawai' value='Perempuan' class='md-radiobtn'>
				                            	<label for='radio51'><span></span><span class='check'></span><span class='box'></span> Perempuan </label>
				                            </div>";
				                }
				            ?>
	                    </div>
	                </div>
	            </div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Unit Kerja :</label>
					<div class="col-lg-2">
						<select name="cmbSatker" class="select2 form-control" data-placeholder="Pilih Unit Kerja">
							<option value="BLANK"> </option>
							<?php
							  $dataSql = "SELECT * FROM ms_satker ORDER BY id_satker ASC";
							  $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
							  while ($dataRow = mysqli_fetch_array($dataQry)) {
								if ($dataSatker == $dataRow['id_satker']) {
									$cek = " selected";
								} else { $cek=""; }
								echo "<option value='$dataRow[id_satker]' $cek>$dataRow[nama_satker]</option>";
							  }
							  $sqlData ="";
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Jabatan :</label>
					<div class="col-lg-3">
						<select name="cmbJabatan" class="select2 form-control" data-placeholder="Pilih Jabatan">
							<option value="BLANK"> </option>
							<?php
							  $dataSql = "SELECT * FROM ms_jabatan ORDER BY id_jabatan ASC";
							  $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
							  while ($dataRow = mysqli_fetch_array($dataQry)) {
								if ($dataJabatan == $dataRow['id_jabatan']) {
									$cek = " selected";
								} else { $cek=""; }
								echo "<option value='$dataRow[id_jabatan]' $cek>$dataRow[nama_jabatan]</option>";
							  }
							  $sqlData ="";
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
	                <label class="col-md-2 control-label">Status Pegawai :</label>
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
			                <a href="?page=datapegawai" class="btn yellow"><i class="fa fa-undo"></i> Batal</a>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</form>