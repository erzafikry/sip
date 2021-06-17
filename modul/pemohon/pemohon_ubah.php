<?php
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['txtNama'])=="") {
			$message[] = "<b>Nama Pemohon</b> tidak boleh kosong!";		
		}
		if (trim($_POST['txtTelpon'])=="") {
			$message[] = "<b>No. Tlp </b> tidak boleh kosong!";		
		}
		if (trim($_POST['cmbStatus'])=="") {
			$message[] = "<b>Status </b> tidak boleh kosong!";		
		}

		$txtNik			= $_POST['txtNik'];
		$txtNama		= $_POST['txtNama'];
		$txtAlamat		= $_POST['txtAlamat'];
		$txtTelpon		= $_POST['txtTelpon'];
		$txtKeterangan	= $_POST['txtKeterangan'];
		$cmbStatus		= $_POST['cmbStatus'];
		$updatedBy 		= $_SESSION["id_user"];
		
		if(count($message)==0){	
			$qryUpdate=mysqli_query($koneksidb, "UPDATE ms_pemohon SET nik_pemohon='$txtNik', 
								  							nama_pemohon='$txtNama',
								  							alamat_pemohon='$txtAlamat',
															telp_pemohon='$txtTelpon',
															keterangan_pemohon='$txtKeterangan',
															status_pemohon='$cmbStatus',
															updatedBy='$updatedBy',
															updatedTime='".date('Y-m-d')."'
													WHERE id_pemohon ='".$_POST['txtKode']."'") 
					   or die ("Gagal query update".mysqli_error());
			if($qryUpdate){
				$_SESSION['pesan'] = 'Data Pemohon berhasil diperbaharui';
				echo '<script>window.location="?page=datapemohon"</script>';
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
	$sqlShow 		= "SELECT * FROM ms_pemohon WHERE id_pemohon='$KodeEdit'";
	$qryShow 		= mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data Pemohon salah : ".mysqli_error());
	$dataShow 		= mysqli_fetch_array($qryShow);
	
	$dataKode		= $dataShow['id_pemohon'];
	$dataNik		= isset($dataShow['nik_pemohon']) ?  $dataShow['nik_pemohon'] : $_POST['txtNik'];
	$dataNama		= isset($dataShow['nama_pemohon']) ?  $dataShow['nama_pemohon'] : $_POST['txtNama'];
	$dataAlamat 	= isset($dataShow['alamat_pemohon']) ?  $dataShow['alamat_pemohon'] : $_POST['txtAlamat'];
	$dataTelpon 	= isset($dataShow['telp_pemohon']) ?  $dataShow['telp_pemohon'] : $_POST['txtTelpon'];
	$dataKeterangan	= isset($dataShow['keterangan_pemohon']) ?  $dataShow['keterangan_pemohon'] : $_POST['txtKeterangan'];
	$dataStatus 	= isset($dataShow['status_pemohon']) ?  $dataShow['status_pemohon'] : $_POST['cmbStatus'];
?>
		
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><span class="caption-subject uppercase bold">Form Ubah Pemohon</span></div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmadd" class="form-horizontal">
			<div class="form-body">
				<input class="form-control" type="hidden" value="<?php echo $dataKode; ?>" name="txtKode" readonly/>
					
				<div class="form-group">
					<label class="col-md-2 control-label">NIK :</label>
					<div class="col-md-5">
						<input class="form-control" name="txtNik" value="<?php echo $dataNik; ?>" type="text"/>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-md-2 control-label">Nama Pemohon :</label>
					<div class="col-md-5">
						<input class="form-control" name="txtNama" value="<?php echo $dataNama; ?>" type="text"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Alamat :</label>
					<div class="col-md-10">
						<textarea class="form-control" name="txtAlamat" type="text"/><?php echo $dataAlamat; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">No. Telp :</label>
					<div class="col-md-3">
						<input class="form-control" name="txtTelpon" value="<?php echo $dataTelpon; ?>" type="text"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Keterangan :</label>
					<div class="col-md-10">
						<textarea class="form-control" name="txtKeterangan" type="text"/><?php echo $dataKeterangan; ?></textarea>
					</div>
				</div>
				<div class="form-group">
	                <label class="col-md-2 control-label">Status :</label>
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
			                <a href="?page=datapemohon" class="btn yellow"><i class="fa fa-undo"></i> Batal</a>
			            </div>
			        </div>
			    </div>
			</div>
		</form>
	</div>
</div>