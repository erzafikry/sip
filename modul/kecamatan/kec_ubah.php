<?php
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['txtNama'])=="") {
			$message[] = "<b>Nama Kecamatan</b> tidak boleh kosong!";		
		}

		$txtNama		= $_POST['txtNama'];
		$cmbProv		= $_POST['cmbProv'];
		$cmbKot			= $_POST['cmbKot'];
		$txtKeterangan	= $_POST['txtKeterangan'];
		$cmbStatus		= $_POST['cmbStatus'];
		$updatedBy 		= $_SESSION["id_user"];
		
		if(count($message)==0){	
			$qryUpdate=mysqli_query($koneksidb, "UPDATE ms_kecamatan SET nama_kecamatan='$txtNama',
							  							keterangan_kecamatan='$txtKeterangan',
							  							status_kecamatan='$cmbStatus',
														updatedBy='$updatedBy',
														updatedTime='".date('Y-m-d')."'
												WHERE id_kecamatan ='".$_POST['txtKode']."'") 
					   or die ("Gagal query update".mysqli_error());
			if($qryUpdate){
				$_SESSION['pesan'] = 'Data Kecamatan berhasil diperbaharui';
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
	$KodeEdit		= isset($_GET['id']) ?  $_GET['id'] : $_POST['txtKode']; 
	$sqlShow 		= "SELECT * FROM ms_kecamatan WHERE id_kecamatan='$KodeEdit'";
	$qryShow 		= mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data Kecamatan salah : ".mysqli_error());
	$dataShow 		= mysqli_fetch_array($qryShow);
	
	$dataKode		= $dataShow['id_kecamatan'];
	$dataNama		= isset($dataShow['nama_kecamatan']) ?  $dataShow['nama_kecamatan'] : $_POST['txtNama'];
	$dataProv		= isset($dataShow['id_provinsi']) ?  $dataShow['id_provinsi'] : $_POST['cmbProv'];
	$dataKot		= isset($dataShow['id_kota']) ?  $dataShow['id_kota'] : $_POST['cmbKot'];
	$dataKeterangan	= isset($dataShow['keterangan_kecamatan']) ?  $dataShow['keterangan_kecamatan'] : $_POST['txtKeterangan'];
	$dataStatus 	= isset($dataShow['status_kecamatan']) ?  $dataShow['status_kecamatan'] : $_POST['cmbStatus'];
?>
		
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><span class="caption-subject uppercase bold">Form Ubah Kecamatan</span></div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmadd" class="form-horizontal">
			<div class="form-body">
				<input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" />
				<!--
				<div class="form-group">
					<label class="col-lg-2 control-label">Provinsi :</label>
					<div class="col-lg-2">
						<select name="cmbProv" class="select2 form-control" data-placeholder="Pilih Provinsi" disabled>
							<option value="BLANK"> </option>
							<?php
							  // $dataSql = "SELECT * FROM ms_kota ORDER BY id_kota ASC";
							  // $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
							  // while ($dataRow = mysqli_fetch_array($dataQry)) {
								// if ($dataKot == $dataRow['id_kota']) {
									// $cek = " selected";
								// } else { $cek=""; }
								// echo "<option value='$dataRow[id_kota]' $cek>$dataRow[nama_kota]</option>";
							  // }
							  // $sqlData ="";
							?>
						</select>
					</div>
				</div>
				-->
				<div class="form-group">
					<label class="col-lg-2 control-label">Kota :</label>
					<div class="col-lg-2">
						<select name="cmbKot" class="select2 form-control" data-placeholder="Pilih Kota" disabled>
							<option value="BLANK"> </option>
							<?php
							  $dataSql = "SELECT * FROM ms_kota ORDER BY id_kota ASC";
							  $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
							  while ($dataRow = mysqli_fetch_array($dataQry)) {
								if ($dataKot == $dataRow['id_kota']) {
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
					<div class="col-lg-4">
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
