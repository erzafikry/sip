<?php
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['txtNoberkas'])=="") {
			$message[] = "No Berkas tidak boleh kosong!";		
		}
		if (trim($_POST['txtThnberkas'])=="") {
			$message[] = "Tahun Berkas tidak boleh kosong!";		
		}
		if (trim($_POST['cmbPemohon'])=="") {
			$message[] = "Nama Pemohon tidak boleh kosong!";		
		}
		if (trim($_POST['cmbLayanan'])=="") {
			$message[] = "Jenis Kegiatan tidak boleh kosong!";		
		}
		if (trim($_POST['cmbKecamatan'])=="") {
			$message[] = "Kecamatan tidak boleh kosong!";		
		}
		if (trim($_POST['cmbKelurahan'])=="") {
			$message[] = "Kelurahan tidak boleh kosong!";		
		}
		if (trim($_POST['txtVolume'])=="") {
			$message[] = "Volume tidak boleh kosong!";		
		}
		if (trim($_POST['txtDi305'])=="") {
			$message[] = "DI.305 tidak boleh kosong!";		
		}
		if (trim($_POST['txtDi302'])=="") {
			$message[] = "DI.302 tidak boleh kosong!";		
		}	
		
		$txtNoberkas		= $_POST['txtNoberkas'];
		$txtThnberkas		= $_POST['txtThnberkas'];
		$cmbPemohon			= $_POST['cmbPemohon'];
		$cmbLayanan			= $_POST['cmbLayanan'];
		$cmbKecamatan		= $_POST['cmbKecamatan'];
		$cmbKelurahan		= $_POST['cmbKelurahan'];
		$txtVolume			= $_POST['txtVolume'];
		$txtDi305			= $_POST['txtDi305'];
		$txtDi302			= $_POST['txtDi302'];
		$cmbStatus			= $_POST['cmbStatus'];
		$txtKeterangan		= $_POST['txtKeterangan'];
		
		
		if(count($message)==0){			
			$qrySave=mysqli_query($koneksidb, "UPDATE ms_berkas SET no_berkas='$txtNoberkas', 
																	 tahun_berkas='$txtThnberkas', 
																	 id_pemohon='$cmbPemohon', 
																	 id_layanan='$cmbLayanan', 
																	 id_kecamatan='$cmbKecamatan', 
																	 id_kelurahan='$cmbKelurahan', 
																	 volume='$txtVolume',
																	 di_305='$txtDi305',
																	 di_302='$txtDi302',
																	 id_status_berkas='$cmbStatus',
																	 keterangan_berkas='$txtKeterangan',
																	 updatedBy = '".$_SESSION['id_user']."',
																	 updatedTime='".date('Y-m-d H:i:s')."'
													WHERE id_berkas='".$_POST['txtKode']."'") or die ("Gagal query".mysqli_error());
			if($qrySave){

				$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
				echo '<script>window.location="?page=databerkas"</script>';
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
	//Tambah Pemohon Baru
	if(isset($_POST['btnSavePemohon'])){
		$message = array();
		if (trim($_POST['txtNikPemohon'])=="") {
			$message[] = "<b>NIK</b> tidak boleh kosong!";		
		}
		if (trim($_POST['txtNamaPemohon'])=="") {
			$message[] = "<b>Nama Pemohon</b> tidak boleh kosong!";		
		}
		if (trim($_POST['txtAlamatPemohon'])=="") {
			$message[] = "<b>Alamat</b> tidak boleh kosong!";		
		}
		if (trim($_POST['txtTelpPemohon'])=="") {
			$message[] = "<b>No. Tlp </b> tidak boleh kosong!";		
		}

		$txtNikPemohon		= $_POST['txtNikPemohon'];
		$txtNamaPemohon		= $_POST['txtNamaPemohon'];
		$txtAlamatPemohon	= $_POST['txtAlamatPemohon'];
		$txtTelpPemohon		= $_POST['txtTelpPemohon'];
		$txtKetPemohon		= $_POST['txtKetPemohon'];
		$createdBy 			= $_SESSION["id_user"];
		
		$sqlCek="SELECT COUNT(*) as total FROM ms_pemohon WHERE nik_pemohon='$txtNikPemohon'";
		$qryCek=mysqli_query($koneksidb, $sqlCek) or die ("Eror Query".mysqli_error()); 
		$rowCek 		= mysqli_fetch_array($qryCek);
		if($rowCek['total']>=1){
			$message[] = "Maaf, NIK <b> $txtNikPemohon </b> sudah ada, ganti dengan NIK lain";
		}

		if(count($message)==0){			
			$sqlSave="INSERT INTO ms_pemohon SET nik_pemohon='$txtNikPemohon', 
				  							nama_pemohon='$txtNamaPemohon',
				  							alamat_pemohon='$txtAlamatPemohon',
				  							telp_pemohon='$txtTelpPemohon',
				  							keterangan_pemohon='-',
				  							status_pemohon='Active',
											createdBy = '$createdBy',
											createdTime='".date('Y-m-d')."'";
			$qrySave = mysqli_query($koneksidb, $sqlSave)or die ("Gagal query".mysqli_error());
			if($qrySave){
				$_SESSION['pesan'] = 'Data Pemohon Baru berhasil ditambahkan';
				echo '<script>window.location="?page=tambahberkas"</script>';
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
	
	// $pemohonSql 	= "SELECT * FROM ms_pemohon WHERE nama_pemohon='null'";
	// $pemohonQry		= mysqli_query($koneksidb, $pemohonSql);
	// $pemohonRow		= mysqli_fetch_array($pemohonQry);
	
	

	$KodeEdit			= isset($_GET['id']) ?  $_GET['id'] : $_POST['txtKode']; 
	$sqlShow 			= "SELECT * FROM ms_berkas a
							INNER JOIN ms_pemohon b on a.id_pemohon=b.id_pemohon
							WHERE a.id_berkas='$KodeEdit'";
	$qryShow 			= mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data supplier salah : ".mysqli_error());
	$dataShow 			= mysqli_fetch_array($qryShow);
	
	$dataKode			= $dataShow['id_perkas'];
	$dataPemohon		= isset($_POST['cmbPemohon']) ? $_POST['cmbPemohon'] : $pemohonRow['id_pemohon'] ;
	$dataNikPemohon		= isset($_POST['txtNikPemohon']) ? $_POST['txtNikPemohon'] : $pemohonRow['nik_pemohon'];
	$dataNamaPemohon	= isset($_POST['txtNamaPemohon']) ? $_POST['txtNamaPemohon'] : $pemohonRow['nama_pemohon'];
	$dataAlamatPemohon	= isset($_POST['txtAlamatPemohon']) ? $_POST['txtAlamat'] : $pemohonRow['alamat_pemohon'] ;
	$dataTelpPemohon	= isset($_POST['txtTelpPemohon']) ? $_POST['txtTelpPemohon'] : $pemohonRow['telp_pemohon'] ;
	
	$dataNoberkas		= isset($_POST['txtNoberkas']) ? $_POST['txtNoberkas'] : $dataShow['no_berkas'];
	$dataTahunberkas	= isset($_POST['txtThnberkas']) ? $_POST['txtThnberkas'] : $dataShow['tahun_berkas'];
	$dataLayanan		= isset($_POST['cmbLayanan']) ? $_POST['cmbLayanan'] : $dataShow['id_layanan'];
	$dataKecamatan		= isset($_POST['cmbKecamatan']) ? $_POST['cmbKecamatan'] : $dataShow['id_kecamatan'];
	$dataKelurahan		= isset($_POST['cmbKelurahan']) ? $_POST['cmbKelurahan'] : $dataShow['id_kelurahan'];
	$dataVolume			= isset($_POST['txtVolume']) ? $_POST['txtVolume'] : $dataShow['volume'];
	$dataDi305			= isset($_POST['txtDi305']) ? $_POST['txtDi305'] : $dataShow['di_305'];
	$dataDi302			= isset($_POST['txtDi302']) ? $_POST['txtDi302'] : $dataShow['di_302'];
	$dataStatus		 	= isset($_POST['cmbStatus']) ? $_POST['cmbStatus'] : $dataShow['id_status_berkas'];
	$dataKeterangan	 	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : $dataShow['keterangan_berkas'];

?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmadd" class="form-horizontal">	
	<div class="portlet box grey-cascade">
		<div class="portlet-title">
			<div class="caption">
	            <span class="caption-subject uppercase bold hidden-xs">Form Ubah Berkas</span>
	        </div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
				<a href="javascript:;" class="remove"></a>
			</div>
		</div>
		<div class="portlet-body form">
			<div class="form-body">
				<div class="form-group">
					<label class="col-lg-2 control-label">No Berkas :</label>
					<div class="col-lg-2">
						<input class="form-control" type="number" name="txtNoberkas" value="<?php echo $dataNoberkas; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Tahun Berkas :</label>
					<div class="col-lg-2">
						<input class="form-control" type="number" name="txtThnberkas" value="<?php echo $dataTahunberkas; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">NIK :</label>
					<div class="col-lg-2">
						<input class="form-control" id="nik_pemohon" readonly type="text" value="<?php echo $dataNikPemohon; ?>" name="txtNikPemohon"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Nama Pemohon :</label>
					<div class="col-lg-3">
						<div class="input-group">
							<input type="hidden" name="cmbPemohon" id="id_pemohon" value="<?php echo $dataPemohon ?>">
							<input class="form-control" type="text" name="txtNamaPemohon" value="<?php echo $dataNamaPemohon ?>" id="nama_pemohon" readonly />
							<span class="input-group-btn">
								<a class="btn blue btn-block" data-toggle="modal" data-target="#pemohon"><i class="icon-magnifier"></i></a>
							</span>
						</div>
					</div>
					<a data-toggle="modal" data-target="#formpemohon" class="btn btn-sm default"><i class="fa fa-user"></i> Pemohon Baru</a>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Jenis Kegiatan :</label>
					<div class="col-lg-3">
						<select name="cmbLayanan" class="select2 form-control" data-placeholder="Pilih Layanan">
							<option value="BLANK"> </option>
							<?php
							  $dataSql = "SELECT * FROM ms_layanan ORDER BY id_layanan ASC";
							  $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
							  while ($dataRow = mysqli_fetch_array($dataQry)) {
								if ($dataLayanan == $dataRow['id_layanan']) {
									$cek = " selected";
								} else { $cek=""; }
								echo "<option value='$dataRow[id_layanan]' $cek>$dataRow[nama_layanan]</option>";
							  }
							  $sqlData ="";
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Kecamatan :</label>
					<div class="col-lg-3">
						<select name="cmbKecamatan" class="select2 form-control" data-placeholder="Pilih Kecamatan">
							<option value="BLANK"> </option>
							<?php
							  $dataSql = "SELECT * FROM ms_kecamatan ORDER BY nama_kecamatan ASC";
							  $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
							  while ($dataRow = mysqli_fetch_array($dataQry)) {
								if ($dataKecamatan == $dataRow['id_kecamatan']) {
									$cek = " selected";
								} else { $cek=""; }
								echo "<option value='$dataRow[id_kecamatan]' $cek>$dataRow[nama_kecamatan]</option>";
							  }
							  $sqlData ="";
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Kelurahan :</label>
					<div class="col-lg-3">
						<select name="cmbKelurahan" class="select2 form-control" data-placeholder="Pilih Kelurahan">
							<option value="BLANK"> </option>
							<?php
							  $dataSql = "SELECT * FROM ms_kelurahan ORDER BY nama_kelurahan ASC";
							  $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
							  while ($dataRow = mysqli_fetch_array($dataQry)) {
								if ($dataKelurahan == $dataRow['id_kelurahan']) {
									$cek = " selected";
								} else { $cek=""; }
								echo "<option value='$dataRow[id_kelurahan]' $cek>$dataRow[nama_kelurahan]</option>";
							  }
							  $sqlData ="";
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Volume (m2) :</label>
					<div class="col-lg-1">
						<input class="form-control" type="text" name="txtVolume" value="<?php echo $dataVolume; ?> "/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">DI.305 :</label>
					<div class="col-lg-2">
						<input class="form-control" type="text" name="txtDi305" value="<?php echo $dataDi305; ?> "/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">DI.302 :</label>
					<div class="col-lg-2">
						<input class="form-control" type="text" name="txtDi302" value="<?php echo $dataDi302; ?> "/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Status Berkas :</label>
					<div class="col-lg-2">
						<select name="cmbStatus" class="select2 form-control" data-placeholder="Pilih Status">
							<option value="BLANK"> </option>
							<?php
							  $dataSql = "SELECT * FROM ms_status_berkas ORDER BY id_status_berkas ASC";
							  $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
							  while ($dataRow = mysqli_fetch_array($dataQry)) {
								if ($dataStatus == $dataRow['id_status_berkas']) {
									$cek = " selected";
								} else { $cek=""; }
								echo "<option value='$dataRow[id_status_berkas]' $cek>$dataRow[status_berkas]</option>";
							  }
							  $sqlData ="";
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Keterangan :</label>
					<div class="col-lg-3">
						<textarea class="form-control" name="txtKeterangan" type="text"/><?php echo $dataKeterangan; ?></textarea>
					</div>
				</div>				
	         </div>
			
	         <div class="form-actions">
			    <div class="row">
			        <div class="form-group">
			            <div class="col-lg-offset-2 col-lg-10">
			                <button type="submit" name="btnSave" class="btn blue"><i class="fa fa-save"></i> Simpan Data</button>
			                <a href="?page=databerkas" class="btn yellow"><i class="fa fa-undo"></i> Batal</a>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</form>
<SCRIPT language="JavaScript">
	function submitform() {
		document.form1.submit();
	}
</SCRIPT>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" class="portlet-body form">
<div class="modal fade bs-modal-lg" id="pemohon" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Data Pemohon</h4>
			</div>
			<div class="modal-body"> 
				<table class="table table-hover table-bordered table-striped table-condensed" width="100%" id="sample_4">
					<thead>
						<tr class="active">
							<th width="20"><div align="center">NO</div></th>
							<th width="100">NIK</th>
							<th width="200">NAMA PEMOHON</th>
							<th width="300">ALAMAT</th>
							<th width="100">TELP</th>
							<th width="10">#</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//Data mentah yang ditampilkan ke tabel    
						$query = mysqli_query($koneksidb, "SELECT * FROM ms_pemohon a WHERE a.status_pemohon='Active' ORDER BY nama_pemohon ASC");
						$nomor = 0;
						while ($data = mysqli_fetch_array($query)) {
							$nomor ++;
							?>
							<tr class="pilihPemohon" data-dismiss="modal" aria-hidden="true" 
							nik-pemohon="<?php echo $data['nik_pemohon']; ?>"
							id-pemohon="<?php echo $data['id_pemohon']; ?>"
							nama-pemohon="<?php echo $data['nama_pemohon']; ?>">
								<td><div align="center"><?php echo $nomor; ?></div></td>
								<td><?php echo $data['nik_pemohon']; ?></td>
								<td><?php echo $data['nama_pemohon']; ?></td>
								<td><?php echo $data['alamat_pemohon']; ?></td>
								<td><?php echo $data['telp_pemohon']; ?></td>
								<td><i class="btn btn-xs green fa fa-check"></i></td>
							</tr>
							<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn blue" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade bs-modal" id="formpemohon" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Form Pemohon Baru</h4>
			</div>
			<div class="modal-body"> 
				<div class="form-group">
					<label class="control-label">NIK :</label>
					<input class="form-control" name="txtNikPemohon" type="text"/>
				</div>
				<div class="form-group">
					<label class="control-label">Nama Pemohon :</label>
					<input class="form-control" name="txtNamaPemohon" type="text"/>
				</div>
				<div class="form-group">
					<label class="control-label">Alamat :</label>
					<textarea class="form-control" name="txtAlamatPemohon" type="text" /></textarea>
				</div>
				<div class="form-group">
					<label class="control-label">No. Telp :</label>
					<input class="form-control" name="txtTelpPemohon" type="number"/>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn blue" name="btnSavePemohon">Simpan</button>
				<button type="button" class="btn default" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>
</form>
<script src="./assets/scripts/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
	$(document).on('click', '.pilihPemohon', function (e) {
			document.getElementById("id_pemohon").value = $(this).attr('id-pemohon');
			document.getElementById("nama_pemohon").value = $(this).attr('nama-pemohon');
			document.getElementById("nik_pemohon").value = $(this).attr('nik-pemohon');
			// document.getElementById("telp_pemohon").value = $(this).attr('telp-pemohon');
	});
</script>