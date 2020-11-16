<?php
	if(isset($_POST['btnKirim'])){
		$message = array();
		if (trim($_POST['txtKeterangan'])=="") {
			$message[] = "Keterangan tidak boleh kosong!";		
		}
		
		$txtKeterangan		= $_POST['txtKeterangan'];

		if($userRow['group_id']=='8' OR $userRow['group_id']=='1'){
			$userKirim 		= '9';
		}elseif($userRow['group_id']=='9'){
			$userKirim 		= '10';
		}elseif($userRow['group_id']=='10'){
			$userKirim 		= '11';
		}elseif($userRow['group_id']=='11'){
			$userKirim 		= '12';
		}elseif($userRow['group_id']=='12'){
			$userKirim 		= '13';
		}else{
			$message[] = "Pengiriman tidak terdeteksi";		
		}
		
		if(count($message)==0){			
			$sqlSave="INSERT INTO trx_surtug SET id_surtug='".$_POST['txtKode']."', 
												 id_pegawai='".$userRow['id_pegawai']."',
												 catatan='$txtKeterangan',
												 tgl_kirim='".date('Y-m-d')."',
												 group_id='".$userKirim."',
												 status='Kirim',
												 createdBy = '".$_SESSION['id_user']."',
												 createdTime='".date('Y-m-d H:i:s')."'";
			$qrySave=mysqli_query($koneksidb, $sqlSave) or die ("Gagal query insert".mysqli_error());
			if($qrySave){
				
				$qryUpdate=mysqli_query($koneksidb, "UPDATE ms_surtug SET group_id='".$userKirim."', 
																		updatedBy = '".$_SESSION['id_user']."',
																	 	updatedTime='".date('Y-m-d H:i:s')."',
																	 	id_petugas_ukur='".$_POST['cmbPegawai']."'
															WHERE id_surtug='".$_POST['txtKode']."'") 
				or die ("Gagal query update".mysqli_error());


				$_SESSION['pesan'] = 'Data berhasil dikirim.';
				echo '<script>window.location="?page=datasurtug"</script>';

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
	if(isset($_POST['btnBatal'])){
		$message = array();
		if (trim($_POST['txtKeterangan'])=="") {
			$message[] = "Keterangan tidak boleh kosong!";		
		}
		
		$txtKeterangan		= $_POST['txtKeterangan'];

		if($userRow['group_id']=='8' OR $userRow['group_id']=='1'){
			$userKirim 		= '8';
		}elseif($userRow['group_id']=='9'){
			$userKirim 		= '8';
		}elseif($userRow['group_id']=='10'){
			$userKirim 		= '9';
		}elseif($userRow['group_id']=='11'){
			$userKirim 		= '10';
		}elseif($userRow['group_id']=='12'){
			$userKirim 		= '11';
		}else{
			$message[] = "Pengiriman tidak terdeteksi";		
		}
		
		if(count($message)==0){			
			$sqlSave="INSERT INTO trx_surtug SET id_surtug='".$_POST['txtKode']."', 
												 id_pegawai='".$userRow['id_pegawai']."',
												 catatan='$txtKeterangan',
												 tgl_kirim='".date('Y-m-d')."',
												 group_id='".$userKirim."',
												 status='Batal',
												 createdBy = '".$_SESSION['id_user']."',
												 createdTime='".date('Y-m-d H:i:s')."'";
			$qrySave=mysqli_query($koneksidb, $sqlSave) or die ("Gagal query insert".mysqli_error());
			if($qrySave){
				
				$qryUpdate=mysqli_query($koneksidb, "UPDATE ms_surtug SET group_id='".$userKirim."', 
																			updatedBy = '".$_SESSION['id_user']."',
																	 	updatedTime='".date('Y-m-d H:i:s')."'
															WHERE id_surtug='".$_POST['txtKode']."'") or die ("Gagal query".mysqli_error());


				$_SESSION['pesan'] = 'Data berhasil dikirim.';
				echo '<script>window.location="?page=datasurtug"</script>';

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
	$KodeEdit			= isset($_GET['id']) ?  $_GET['id'] : $_POST['txtKode']; 
	$sqlShow 			= "SELECT * FROM ms_surtug a
							WHERE a.id_surtug='$KodeEdit'";
	$qryShow 			= mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data supplier salah : ".mysqli_error());
	$dataShow 			= mysqli_fetch_array($qryShow);
	
	$dataKode			= $dataShow['id_surtug'];
	$dataKeterangan	 	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="post" class="form-horizontal" enctype="multipart/form-data">
	<div class="portlet box grey-cascade">
		<div class="portlet-title">
			<div class="caption">
	            <span class="caption-subject uppercase bold hidden-xs">Form Kirim Surat Tugas</span>
	        </div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
				<a href="javascript:;" class="remove"></a>
			</div>
		</div>
		<div class="portlet-body form">
			<div class="form-body">
				<input type="hidden" name="txtKode" value="<?php echo $dataKode ?>">
				<div class="form-group">
					<label class="col-lg-2 control-label">Diproses Pada :</label>
					<div class="input-group col-lg-3">
						<input type="text" disabled value="<?php echo date('d/m/Y H:i') ?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Keterangan :</label>
					<div class="input-group col-lg-8">
						<textarea class="form-control" name="txtKeterangan" type="text"/><?php echo $dataKeterangan; ?></textarea>
					</div>
				</div>	
	        </div>
			<?php if($userRow['user_group']==10){ ?>
			<div class="form-group">
				<label class="col-lg-2 control-label">Petugas Ukur :</label>
				<div class="col-lg-3">
					<select name="cmbPegawai" class="select2 form-control" data-placeholder="Pilih Pegawai">
						<option value="BLANK"> </option>
						<?php
						  $dataSql = "SELECT * FROM ms_pegawai a
						  				INNER JOIN ms_user b ON a.id_pegawai=b.id_pegawai
						  				WHERE b.user_group='11'";
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

			<?php } ?>
	        <div class="form-actions">
			    <div class="row">
			        <div class="form-group">
			            <div class="col-lg-offset-2 col-lg-10">
			                <button type="submit" name="btnKirim" class="btn blue"><i class="fa fa-save"></i> Kirim Data</button>
			                <button type="submit" name="btnBatal" class="btn blue"><i class="fa fa-save"></i> Dikembalikan</button>
			                <a href="?page=datasurtug" class="btn blue"><i class="fa fa-undo"></i> Batal/Cancel</a>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</form>