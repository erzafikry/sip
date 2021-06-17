<?php
	
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['txtModul'])=="") {
			$message[] = "<b>Nama Modul</b> tidak boleh kosong !";		
		}
		if (trim($_POST['txtLink'])=="") {
			$message[] = "<b>Link modul</b> tidak boleh kosong !";		
		}
		if (trim($_POST['cmbMenu'])=="") {
			$message[] = "<b>Menu utama</b> tidak boleh kosong !";		
		}
		
		$txtModul		= $_POST['txtModul'];
		$txtLink		= $_POST['txtLink'];
		$cmbMenu		= $_POST['cmbMenu'];
		$txtUrutan		= $_POST['txtUrutan'];

		if(count($message)==0){
			$sqlSave="INSERT INTO sys_submenu SET submenu_nama='$txtModul', 
						 							submenu_link='$txtLink', 
													submenu_menu='$cmbMenu', 
													submenu_urutan='$txtUrutan',
													submenu_dibuat='".date('Y-m-d')."'";
			$qrySave	= mysqli_query($koneksidb, $sqlSave) or die ("gagal insert". mysqli_error());
			if($qrySave){
				$_SESSION['pesan'] = 'Data modul berhasil ditambahkan';
				echo '<script>window.location="?page=datamodul"</script>';
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
	
	$dataModul		= isset($_POST['txtModul']) ? $_POST['txtModul'] : '';
	$dataLink		= isset($_POST['txtLink']) ? $_POST['txtLink'] : '';
	$dataMenu		= isset($_POST['cmbMenu']) ? $_POST['cmbMenu'] : ''; 
	$dataUrutan		= isset($_POST['txtUrutan']) ? $_POST['txtUrutan'] : ''; 
?>
<div class="portlet box green">
	<div class="portlet-title">
        <div class="caption">
            <span class="caption-subject uppercase bold">Form Data Menu & Modul</span>
        </div>
        <div class="tools">
            <a href="" class="collapse"> </a>
            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
            <a href="" class="reload"> </a>
            <a href="" class="remove"> </a>
        </div>
    </div>
	<div class="portlet-body form">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="form-horizontal" autocomplete="off">
        	<div class="form-body">
		        <div class="form-group">
					<label class="col-lg-2 control-label">Nama Modul :</label>
					<div class="col-lg-3">
						<input type="text" name="txtModul" value="<?php echo $dataModul; ?>" class="form-control"/>
		             </div>
				</div>
		        <div class="form-group">
					<label class="col-lg-2 control-label">Link Modul :</label>
					<div class="col-lg-3">
						<input type="text" name="txtLink" value="<?php echo $dataLink; ?>" class="form-control"/>
		             </div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Menu Utama :</label>
					<div class="col-lg-2">
						<select name="cmbMenu" data-placeholder="- Pilih Menu -" class="select2 form-control">
							<option value=""></option> 
							<?php
								  $dataSql = "SELECT * FROM sys_menu ORDER BY menu_id DESC";
								  $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
								  while ($dataRow = mysqli_fetch_array($dataQry)) {
									if ($dataMenu == $dataRow['menu_id']) {
										$cek = " selected";
									} else { $cek=""; }
									echo "<option value='$dataRow[menu_id]' $cek>$dataRow[menu_nama]</option>";
								  }
								  $sqlData ="";
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">Urutan Modul :</label>
					<div class="col-lg-2">
						<input type="number" name="txtUrutan" value="<?php echo $dataUrutan; ?>" class="form-control"/>
		             </div>
				</div>
			</div>
	    	<div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-10">
		                <button type="submit" name="btnSave" class="btn blue"><i class="fa fa-save"></i> Simpan Data</button>
		                <a href="?page=datamodul" class="btn yellow"><i class="fa fa-undo"></i> Batalkan</a>
			        </div>
			    </div>
			</div>
		</form>
	</div>
</div>
		