<?php
	if(isset($_POST['btnSelesai'])){
		$message = array();
		if (trim($_POST['txtKeterangan'])=="") {
			$message[] = "Keterangan tidak boleh kosong!";		
		}

		// CEK DATA PETUGAS
		$ptgcekSql	= "SELECT * FROM ms_surtug WHERE id_surtug='".$_POST['txtKode']."'";
		$ptgcekQry	= mysqli_query($koneksidb, $ptgcekSql) or die ("cek petugas error".mysqli_error());
		$ptgcekRow	= mysqli_fetch_array($ptgcekQry);

		if (!empty($ptgcekRow['id_kasie']) AND trim($_POST['txtNoSuratUkur'])=="") {
			$message[] = "No. surat ukur tidak boleh kosong!";		
		}
		if (!empty($ptgcekRow['id_kasie']) AND trim($_POST['cmbTahun'])=="") {
			$message[] = "Tahun surat ukur tidak boleh kosong!";		
		}
		if (!empty($ptgcekRow['id_kasie']) AND trim($_POST['txtNo307'])=="") {
			$message[] = "No DI.307 tidak boleh kosong!";		
		}
		if (!empty($ptgcekRow['id_kasie']) AND trim($_POST['cmbTahun307'])=="") {
			$message[] = "Tahun DI.307 tidak boleh kosong!";		
		}

		
		$txtKeterangan		= $_POST['txtKeterangan'];
		$txtNoSuratUkur		= $_POST['txtNoSuratUkur'];
		$cmbTahun 			= $_POST['cmbTahun'];
		$txtNo307			= $_POST['txtNo307'];
		$cmbTahun307		= $_POST['cmbTahun307'];

		if(count($message)==0){			
			$sqlSave="INSERT INTO trx_surtug SET id_surtug='".$_POST['txtKode']."', 
												 id_pegawai='".$userRow['id_pegawai']."',
												 catatan='$txtKeterangan',
												 tgl_kirim='".date('Y-m-d')."',
												 status='Selesai',
												 group_id='10',
												 createdBy = '".$_SESSION['id_user']."',
												 createdTime='".date('Y-m-d H:i:s')."'";
			$qrySave=mysqli_query($koneksidb, $sqlSave) or die ("Gagal query insert".mysqli_error());
			if($qrySave){
				
				$qryUpdate=mysqli_query($koneksidb, "UPDATE ms_surtug SET updatedBy = '".$_SESSION['id_user']."',
																	 	 updatedTime='".date('Y-m-d H:i:s')."',
																		 no_surat_ukur='$txtNoSuratUkur',
																		 tahun_surat_ukur='$cmbTahun',
																		 no_307='$txtNo307',
																		 tahun_307='$cmbTahun307',
																	 	 status_surtug='Selesai'
																	WHERE id_surtug='".$_POST['txtKode']."'") 
				or die ("Gagal query update".mysqli_error());


				$_SESSION['pesan'] = 'Data berhasil diselesaikan.';
				echo '<script>window.location="?page=databerkasmasuk"</script>';

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
	if(isset($_POST['btnKirim'])){
		$message = array();
		if (trim($_POST['txtKeterangan'])=="") {
			$message[] = "Keterangan tidak boleh kosong!";		
		}
		
		$txtKeterangan		= $_POST['txtKeterangan'];
		// CEK DATA PETUGAS
		$ptgcekSql	= "SELECT * FROM ms_surtug WHERE id_surtug='".$_POST['txtKode']."'";
		$ptgcekQry	= mysqli_query($koneksidb, $ptgcekSql) or die ("cek petugas error".mysqli_error());
		$ptgcekRow	= mysqli_fetch_array($ptgcekQry);

		if($userRow['group_id']=='8' OR $userRow['group_id']=='1'){
			$userKirim 		= '9';
		}elseif($userRow['group_id']=='9' AND empty($ptgcekRow['id_petugas_ukur']) AND empty($ptgcekRow['id_petugas_grafis']) AND empty($ptgcekRow['id_petugas_textual']) AND empty($ptgcekRow['id_kasubsie'])){
			$userKirim 		= '10';
		}elseif($userRow['group_id']=='10' AND empty($ptgcekRow['id_petugas_ukur']) AND empty($ptgcekRow['id_petugas_grafis']) AND empty($ptgcekRow['id_petugas_textual']) AND empty($ptgcekRow['id_kasubsie'])){
			$userKirim 		= '11';
		}elseif($userRow['group_id']=='11'){
			$userKirim 		= '12';
		}elseif($userRow['group_id']=='12'){
			$userKirim 		= '13';
		}elseif($userRow['group_id']=='13' AND !empty($ptgcekRow['id_petugas_ukur']) AND !empty($ptgcekRow['id_petugas_grafis']) AND !empty($ptgcekRow['id_petugas_textual'])){
			$userKirim 		= '9';
		}elseif($userRow['group_id']=='9' AND !empty($ptgcekRow['id_petugas_ukur']) AND !empty($ptgcekRow['id_petugas_grafis']) AND !empty($ptgcekRow['id_petugas_textual'])){
			$userKirim 		= '10';
		}else{
			$message[] = "Pengiriman tidak terdeteksi";		
		}



		if($userRow['user_group']==10){
			$insertPetugas	= "id_petugas_ukur='".$_POST['cmbPegawai']."'";
		}elseif($userRow['user_group']==11 AND !empty($ptgcekRow['id_petugas_ukur'])){
			$insertPetugas	= "id_petugas_grafis='".$_POST['cmbGrafis']."'";
		}elseif($userRow['user_group']==12 AND !empty($ptgcekRow['id_petugas_grafis'])){
			$insertPetugas	= "id_petugas_textual='".$_POST['cmbTextual']."'";
		}elseif($userRow['user_group']==13 AND !empty($ptgcekRow['id_petugas_textual'])){
			$insertPetugas	= "id_kasubsie='".$_POST['cmbKasubsie']."'";
		}elseif($userRow['user_group']==9 AND !empty($ptgcekRow['id_kasubsie'])){
			$insertPetugas	= "id_kasie='12'";
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
																	 	".$insertPetugas."
															WHERE id_surtug='".$_POST['txtKode']."'") 
				or die ("Gagal query update".mysqli_error());


				$_SESSION['pesan'] = 'Data berhasil dikirim.';
				echo '<script>window.location="?page=databerkasmasuk"</script>';

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
		// CEK DATA PETUGAS
		$ptgcekSql	= "SELECT * FROM ms_surtug WHERE id_surtug='".$_POST['txtKode']."'";
		$ptgcekQry	= mysqli_query($koneksidb, $ptgcekSql) or die ("cek petugas error".mysqli_error());
		$ptgcekRow	= mysqli_fetch_array($ptgcekQry);

		if($userRow['group_id']=='8' OR $userRow['group_id']=='1'){
			$userKirim 		= '8';
		}elseif($userRow['group_id']=='9' AND empty($ptgcekRow['id_petugas_ukur']) AND empty($ptgcekRow['id_petugas_grafis']) AND empty($ptgcekRow['id_petugas_textual']) AND empty($ptgcekRow['id_kasubsie'])){
			$userKirim 		= '8';
		}elseif($userRow['group_id']=='10' AND empty($ptgcekRow['id_petugas_ukur']) AND empty($ptgcekRow['id_petugas_grafis']) AND empty($ptgcekRow['id_petugas_textual']) AND empty($ptgcekRow['id_kasubsie'])){
			$userKirim 		= '9';
		}elseif($userRow['group_id']=='11'){
			$userKirim 		= '10';
		}elseif($userRow['group_id']=='12'){
			$userKirim 		= '11';
		}elseif($userRow['group_id']=='13'){
			$userKirim 		= '12';
		}elseif($userRow['group_id']=='9' AND !empty($ptgcekRow['id_petugas_textual']) AND !empty($ptgcekRow['id_kasubsie'])){
			$userKirim 		= '13';
		}elseif($userRow['group_id']=='10' AND !empty($ptgcekRow['id_petugas_textual']) AND !empty($ptgcekRow['id_kasubsie'])){
			$userKirim 		= '9';
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
				echo '<script>window.location="?page=databerkasmasuk"</script>';

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

	if(!empty($dataShow['id_petugas_ukur']) AND !empty($dataShow['id_petugas_textual']) AND !empty($dataShow['id_petugas_grafis']) AND !empty($dataShow['id_kasubsie']) AND !empty($dataShow['id_kasie']) AND $userRow['user_group']=='10') {
		$tombol 		= '<button type="submit" name="btnSelesai" class="btn blue"><i class="fa fa-save"></i> Selesai </button>';
	}else{
		$tombol			= '<button type="submit" name="btnKirim" class="btn blue"><i class="fa fa-save"></i> Kirim Data </button>';
	}

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
			<?php if($userRow['user_group']==11){ ?>
			<div class="form-group">
				<label class="col-lg-2 control-label">Petugas Grafis :</label>
				<div class="col-lg-3">
					<select name="cmbGrafis" class="select2 form-control" data-placeholder="Pilih Pegawai">
						<option value="BLANK"> </option>
						<?php
						  $dataSql = "SELECT * FROM ms_pegawai a
						  				INNER JOIN ms_user b ON a.id_pegawai=b.id_pegawai
						  				WHERE b.user_group='12'";
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

			<?php }elseif($userRow['user_group']==12){ ?>

			<div class="form-group">
				<label class="col-lg-2 control-label">Petugas Textual :</label>
				<div class="col-lg-3">
					<select name="cmbTextual" class="select2 form-control" data-placeholder="Pilih Pegawai">
						<option value="BLANK"> </option>
						<?php
						  $dataSql = "SELECT * FROM ms_pegawai a
						  				INNER JOIN ms_user b ON a.id_pegawai=b.id_pegawai
						  				WHERE b.user_group='13'";
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
			<?php }elseif($userRow['user_group']==13){ ?>
			<div class="form-group">
				<label class="col-lg-2 control-label">Kasubsie :</label>
				<div class="col-lg-3">
					<select name="cmbKasubsie" class="select2 form-control" data-placeholder="Pilih Pegawai">
						<option value="BLANK"> </option>
						<?php
						  $dataSql = "SELECT * FROM ms_pegawai a
						  				INNER JOIN ms_user b ON a.id_pegawai=b.id_pegawai
						  				WHERE b.user_group='9'";
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
			<?php }elseif($userRow['user_group']==10 AND !empty($dataShow['id_kasie'])){ ?>	

			<div class="form-group">
				<label class="col-lg-2 control-label">No. Surat Ukur :</label>
				<div class="col-lg-3">
					<input type="text" name="txtNoSuratUkur" value="<?php echo $dataNoSuratUkur ?>" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">Tahun Surat Ukur :</label>
				<div class="col-lg-2">
					<select data-placeholder="- Pilih Tahun -" name="cmbTahun" class="form-control select2">
						<option value=""></option> 
						<?php
						$tahunKemaren = date('Y') - 5;
							for($thn= $tahunKemaren; $thn <= date('Y'); $thn++) {
							if ($thn == $dataTahun) {
									$cek = " selected";
							} else { $cek=""; }
								echo "<option value='$thn' $cek>$thn</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">No. DI.307 :</label>
				<div class="col-lg-3">
					<input type="text" name="txtNo307" value="<?php echo $dataNo307 ?>" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">Tahun DI.307 :</label>
				<div class="col-lg-2">
					<select data-placeholder="- Pilih Tahun -" name="cmbTahun307" class="form-control select2">
						<option value=""></option> 
						<?php
						$tahunKemaren = date('Y') - 5;
							for($thn= $tahunKemaren; $thn <= date('Y'); $thn++) {
							if ($thn == $dataTahun307) {
									$cek = " selected";
							} else { $cek=""; }
								echo "<option value='$thn' $cek>$thn</option>";
							}
						?>
					</select>
				</div>
			</div>
			<?php } ?>
	        <div class="form-actions">
			    <div class="row">
			        <div class="form-group">
			            <div class="col-lg-offset-2 col-lg-10">
			                <?php echo $tombol ?>
			                <button type="submit" name="btnBatal" class="btn blue"><i class="fa fa-save"></i> Dikembalikan</button>
			                <a href="?page=databerkasmasuk" class="btn blue"><i class="fa fa-undo"></i> Batal/Cancel</a>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</form>