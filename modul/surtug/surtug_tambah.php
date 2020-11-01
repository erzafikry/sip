<?php
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['cmbBerkas'])=="") {
			$message[] = "No Berkas tidak boleh kosong!";		
		}
		if (trim($_POST['txtThnberkas'])=="") {
			$message[] = "Tahun Berkas tidak boleh kosong!";		
		}
		if (trim($_POST['txtNoSurtug'])=="") {
			$message[] = "No Surat Tugas tidak boleh kosong!";		
		}
		if (trim($_POST['txtTglSurtug'])=="") {
			$message[] = "Tgl Mulai Surat Tugas tidak boleh kosong!";		
		}
		if (trim($_POST['txtTglSurtug2'])=="") {
			$message[] = "Tgl Terbit Surat Tugas tidak boleh kosong!";		
		}
		if (trim($_POST['cmbPegawai'])=="BLANK") {
			$message[] = "Petugas Ukur tidak boleh kosong, silahkan pilih terlebih dahulu!";		
		}
		
		$cmbBerkas			= $_POST['cmbBerkas'];
		$txtThnberkas		= $_POST['txtThnberkas'];
		$txtNoSurtug		= $_POST['txtNoSurtug'];
		$txtTglSurtug		= $_POST['txtTglSurtug'];
		$txtTglSurtug2		= $_POST['txtTglSurtug2'];
		$cmbPegawai			= $_POST['cmbPegawai'];
		$txtKeterangan		= $_POST['txtKeterangan'];
		$createdBy 			= $_SESSION["id_user"];

		$sqlCek="SELECT COUNT(*) as total FROM ms_surtug WHERE no_surtug='$txtNoSurtug'";
		$qryCek=mysqli_query($koneksidb, $sqlCek) or die ("Eror Query".mysqli_error()); 
		$rowCek 		= mysqli_fetch_array($qryCek);
		if($rowCek['total']>=1){
			$message[] = "No Surat Tugas <b> $txtNoSurtug </b> sudah ada, silahkan input baru !";
		}
		
		if(count($message)==0){		
			$sqlSave="INSERT INTO ms_surtug SET no_surtug='$txtNoSurtug', 
											 tgl_mulai_surtug='".InggrisTgl($txtTglSurtug)."', 
											 tgl_terbit_surtug='".InggrisTgl($txtTglSurtug2)."',
											 keterangan_surtug='$txtKeterangan',
											 id_berkas='$cmbBerkas', 
											 id_pegawai='$cmbPegawai',
											 createdBy = '$createdBy',
											 createdTime='".date('Y-m-d')."'";
			$qrySave=mysqli_query($koneksidb, $sqlSave) or die ("Gagal query".mysqli_error());
			if($qrySave){
				$_SESSION['pesan'] = 'Data berhasil ditambahkan.';
			echo '<script>window.location="?page=datasurtug"</script>';

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
	
	$dataBerkas			= isset($_POST['cmbBerkas']) ? $_POST['cmbBerkas'] : $berkasRow['id_berkas'] ;
	$dataNoBerkas		= isset($_POST['txtNoBerkas']) ? $_POST['txtNoBerkas'] : $berkasRow['no_berkas'];
	$dataTahunBerkas	= isset($_POST['txtThnberkas']) ? $_POST['txtThnberkas'] : $berkasRow['tahun_berkas'];
	$dataNosurtug		= isset($_POST['txtNoSurtug']) ? $_POST['txtNoSurtug'] : '';
	$dataTglSurtug		= isset($_POST['txtTglSurtug']) ? $_POST['txtTglSurtug'] : date('d-m-Y');
	$dataTglSurtug2		= isset($_POST['txtTglSurtug2']) ? $_POST['txtTglSurtug2'] : date('d-m-Y');
	$dataKeterangan	 	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="post" class="form-horizontal" enctype="multipart/form-data">
	<div class="portlet box grey-cascade">
		<div class="portlet-title">
			<div class="caption">
	            <span class="caption-subject uppercase bold hidden-xs">Form Tambah Surat Tugas</span>
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
					<label class="col-lg-2 control-label">No.Berkas :</label>
					<div class="input-group col-md-1">
						<input type="hidden" name="cmbBerkas" id="id_berkas" value="<?php echo $dataBerkas ?>">
						<input class="form-control" type="text" name="txtNoBerkas" value="<?php echo $dataNoBerkas ?>" id="no_berkas" readonly />
						<span class="input-group-btn">
							<a class="btn blue btn-block" data-toggle="modal" data-target="#berkas"><i class="icon-magnifier"></i></a>
						</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Tahun Berkas :</label>
					<div class="input-group col-md-1">
						<input class="form-control" id="tahun_berkas" readonly type="text" value="<?php echo $dataTahunBerkas; ?>" name="txtThnberkas"/>
					</div>
				</div>				
				<div class="form-group">
					<label class="col-lg-2 control-label">No. Surat Tugas :</label>
					<div class="input-group col-lg-2">
						<input class="form-control" type="text" name="txtNoSurtug" value="<?php echo $dataNosurtug; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Tgl. Mulai Surat Tugas :</label>
					<div class="input-group col-lg-2">
						<div class="input-icon left">
							<i class="icon-calendar"></i>
							<input class="form-control date-picker" data-date-format="dd-mm-yyyy" type="text" value="<?php echo $dataTglSurtug; ?>" name="txtTglSurtug"/>
						</div>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-lg-2 control-label">Tgl. Terbit Surat Tugas :</label>
					<div class="input-group col-lg-2">
						<div class="input-icon left">
							<i class="icon-calendar"></i>
							<input class="form-control date-picker" data-date-format="dd-mm-yyyy" type="text" value="<?php echo $dataTglSurtug2; ?>" name="txtTglSurtug2"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Keterangan :</label>
					<div class="input-group col-lg-3">
						<textarea class="form-control" name="txtKeterangan" type="text"/><?php echo $dataKeterangan; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Petugas Ukur :</label>
					<div class="input-group col-lg-3">
						<select name="cmbPegawai" class="select2 form-control" data-placeholder="Pilih Pegawai">
							<option value="BLANK"> </option>
							<?php
							  $dataSql = "SELECT * FROM ms_pegawai a
											INNER JOIN ms_jabatan c ON a.id_jabatan=c.id_jabatan
											WHERE c.nama_jabatan IN ('Petugas Ukur','Surveyor Pemetaan Penyelia',
											'Surveyor Pemetaan Pelaksana','Asisten Surveyor Kadaster Berlisensi','Pembantu Ukur')
											ORDER BY a.nama_pegawai ASC";
							  $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
							  while ($dataRow = mysqli_fetch_array($dataQry)) {
								if ($dataLevel == $dataRow['id_pegawai']) {
									$cek = " selected";
								} else { $cek=""; }
								echo "<option value='$dataRow[id_pegawai]' $cek>$dataRow[nama_pegawai]</option>";
							  }
							  $sqlData ="";
							?>
						</select>
					</div>
				</div>					
	         </div>
			
	         <div class="form-actions">
			    <div class="row">
			        <div class="form-group">
			            <div class="col-lg-offset-2 col-lg-10">
			                <button type="submit" name="btnSave" class="btn blue"><i class="fa fa-save"></i> Simpan Data</button>
			                <a href="?page=datasurtug" class="btn yellow"><i class="fa fa-undo"></i> Batal</a>
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
<div class="modal fade bs-modal-lg" id="berkas" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Data Berkas Masuk</h4>
			</div>
			<div class="modal-body"> 
				<table class="table table-hover table-bordered table-striped table-condensed" width="100%" id="sample_4">
					<thead>
						<tr class="active">
							<th width="5"><div align="center">NO</div></th>
							<th width="10">NO BERKAS</th>
							<th width="10">TAHUN BERKAS</th>
							<th width="30">NAMA PEMOHON</th>
							<th width="30">KEGIATAN</th>
							<th width="20">KECAMATAN</th>
							<th width="20">KELURAHAN</th>
							<th width="5">#</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//Data mentah yang ditampilkan ke tabel    
						$query = mysqli_query($koneksidb, "SELECT * FROM ms_berkas a
									INNER JOIN ms_pemohon b ON a.id_pemohon=b.id_pemohon
									INNER JOIN ms_layanan c ON a.id_layanan=c.id_layanan
									INNER JOIN ms_kecamatan d ON a.id_kecamatan=d.id_kecamatan
									INNER JOIN ms_kelurahan e ON a.id_kelurahan=e.id_kelurahan
									INNER JOIN ms_status_berkas f ON a.id_status_berkas=f.id_status_berkas
									ORDER BY id_berkas ASC");
						$nomor = 0;
						while ($data = mysqli_fetch_array($query)) {
							$nomor ++;
							?>
							<tr class="pilihBerkas" data-dismiss="modal" aria-hidden="true" 
							id-berkas="<?php echo $data['id_berkas']; ?>"
							no-berkas="<?php echo $data['no_berkas']; ?>"
							tahun-berkas="<?php echo $data['tahun_berkas']; ?>">
								<td><div align="center"><?php echo $nomor; ?></div></td>
								<td><?php echo $data['no_berkas']; ?></td>
								<td><?php echo $data['tahun_berkas']; ?></td>
								<td><?php echo $data ['nama_pemohon']; ?></td>
								<td><?php echo $data ['nama_layanan']; ?></td>
								<td><?php echo $data ['nama_kecamatan']; ?></td>
								<td><?php echo $data ['nama_kelurahan']; ?></td>
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
</form>
<script src="./assets/scripts/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
	$(document).on('click', '.pilihBerkas', function (e) {
			document.getElementById("id_berkas").value = $(this).attr('id-berkas');
			document.getElementById("no_berkas").value = $(this).attr('no-berkas');
			document.getElementById("tahun_berkas").value = $(this).attr('tahun-berkas');
			// document.getElementById("telp_pemohon").value = $(this).attr('telp-pemohon');
	});
</script>