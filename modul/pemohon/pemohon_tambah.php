<?php
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['txtNik'])=="") {
			$message[] = "<b>NIK</b> tidak boleh kosong!";		
		}
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
		$createdBy 		= $_SESSION["id_user"];
		
		$sqlCek="SELECT COUNT(*) as total FROM ms_pemohon WHERE nik_pemohon='$txtNik'";
		$qryCek=mysqli_query($koneksidb, $sqlCek) or die ("Eror Query".mysqli_error()); 
		$rowCek 		= mysqli_fetch_array($qryCek);
		if($rowCek['total']>=1){
			$message[] = "Maaf, NIK <b> $txtNik </b> sudah ada, ganti dengan NIK lain";
		}

		if(count($message)==0){			
			$sqlSave="INSERT INTO ms_pemohon SET nik_pemohon='$txtNik', 
				  							nama_pemohon='$txtNama',
				  							alamat_pemohon='$txtAlamat',
				  							telp_pemohon='$txtTelpon',
				  							keterangan_pemohon='$txtKeterangan',
				  							status_pemohon='$cmbStatus',
											createdBy = '$createdBy',
											createdTime='".date('Y-m-d')."'";
			$qrySave = mysqli_query($koneksidb, $sqlSave)or die ("Gagal query".mysqli_error());
			if($qrySave){
				$_SESSION['pesan'] = 'Data Pemohon berhasil ditambahkan';
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
	$dataNik		= isset($_POST['txtNik']) ? $_POST['txtNik'] : '';
	$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
	$dataAlamat 	= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '';
	$dataTelpon 	= isset($_POST['txtTelpon']) ? $_POST['txtTelpon'] : '';
	$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
	$dataStatus 	= isset($_POST['cmbStatus']) ? $_POST['cmbStatus'] : '';
?>
		
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption"><span class="caption-subject uppercase bold">Form Tambah Pemohon</span></div>
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
					<label class="col-md-2 control-label">NIK :</label>
					<div class="col-md-2">
						<input class="form-control" name="txtNik" value="<?php echo $dataNik; ?>" type="text"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Nama Pemohon :</label>
					<div class="col-md-3">
						<input class="form-control" name="txtNama" value="<?php echo $dataNama; ?>" type="text"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Alamat :</label>
					<div class="col-md-3">
						<textarea class="form-control" name="txtAlamat" type="text"/><?php echo $dataAlamat; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">No. Telp :</label>
					<div class="col-md-2">
						<input class="form-control" name="txtTelpon" value="<?php echo $dataTelpon; ?>" type="text"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Keterangan :</label>
					<div class="col-md-3">
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