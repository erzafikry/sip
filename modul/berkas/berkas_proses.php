<?php
	
	if(isset($_POST['btnSave'])){
		$message = array();
		
		// if (trim($_POST['txtDi305'])=="") {
		// 	$message[] = "DI.305 tidak boleh kosong!";		
		// }
		if (trim($_POST['txtTglSurtug'])=="") {
			$message[] = "Tgl Mulai Surat Tugas tidak boleh kosong!";		
		}	
		
		// $txtDi305			= $_POST['txtDi305'];
		$txtTglSurtug		= $_POST['txtTglSurtug'];
		
		
		if(count($message)==0){			
			$qrySave=mysqli_query($koneksidb, "UPDATE ms_berkas SET tgl_mulai_surtug='$txtTglSurtug',
																	 status_berkas='Diproses'
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
	
	

	$KodeEdit			= isset($_GET['id']) ?  $_GET['id'] : $_POST['txtKode']; 
	$sqlShow 			= "SELECT * FROM ms_berkas a WHERE a.id_berkas='$KodeEdit'";
	$qryShow 			= mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data supplier salah : ".mysqli_error());
	$dataShow 			= mysqli_fetch_array($qryShow);
	
	$dataKode			= $dataShow['id_berkas'];

?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" class="form-horizontal" autocomplete="off">	
	<input type="hidden" name="txtKode" value="<?php echo $dataKode ?>">
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption">
	            <span class="caption-subject uppercase bold hidden-xs">Form Proses Berkas</span>
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
					<label class="col-lg-3 control-label">Tgl. Mulai Surat Tugas :</label>
					<div class="col-lg-3">
						<div class="input-icon left">
							<i class="icon-calendar"></i>
							<input class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="txtTglSurtug"/>
						</div>
					</div>
				</div>	
			</div>
			<div class="form-actions">
			    <div class="row">
			        <div class="form-group">
			            <div class="col-lg-offset-3 col-lg-9">
			                <button type="submit" name="btnSave" class="btn blue"><i class="fa fa-save"></i> Simpan Data</button>
			                <a href="?page=databerkas" class="btn yellow"><i class="fa fa-undo"></i> Batal</a>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</form>
