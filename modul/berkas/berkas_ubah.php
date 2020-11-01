<?php
	if(isset($_POST['btnSave'])){
		$message = array();
		if (trim($_POST['txtNama'])=="") {
			$message[] = "Nama Service & Pelayanan tidak boleh kosong!";		
		}
		if (trim($_POST['cmbKategori'])=="") {
			$message[] = "Data kategori belum dipilih, silahkan pilih terlebih dahulu!";		
		}
		if (trim($_POST['cmbMerk'])=="") {
			$message[] = "Merk barang masih kosong, silahkan diisi terlebih dahulu";		
		}
		if (trim($_POST['txtJual'])=="" ) {
			$message[] = "Harga jual tidak boleh kosong, silahkan isi dengan angka!";		
		}
		if (trim($_POST['cmbStatus'])=="") {
			$message[] = "Data status belum dipilih, silahkan pilih terlebih dahulu!";		
		}
		if (trim($_POST['txtBarcode'])=="") {
			$message[] = "Kode Barcode masih kosong, silahkan diisi terlebih dahulu";		
		}
		
		$txtBarcode		= $_POST['txtBarcode'];
		$txtBarcodeLm	= $_POST['txtBarcodeLm'];
		$txtNama		= $_POST['txtNama'];
		$txtLama		= $_POST['txtLama'];
		$cmbKategori	= $_POST['cmbKategori'];
		$txtJual		= $_POST['txtJual'];
		$txtJual		= str_replace(".","",$txtJual);
		$txtKeterangan	= $_POST['txtKeterangan'];
		$cmbStatus		= $_POST['cmbStatus'];
		$txtStok		= $_POST['txtStok'];
		$cmbMerk		= $_POST['cmbMerk'];		
		$txtUkuran		= $_POST['txtUkuran'];
		
		$namafile       = $txtBarcode.'.png';
		$tempdir 		= "photo/"; 
        $quality        = "H"; // ini ada 4 pilihan yaitu L (Low), M(Medium), Q(Good), H(High)
        $ukuran         = 5; // 1 adalah yang terkecil, 10 paling besar
        $padding        = 1;
		
		
		$sqlCek2	= "SELECT COUNT(*) as total FROM ms_barang WHERE kode_barcode='$txtBarcode' AND NOT(kode_barcode='$txtBarcodeLm')";
		$qryCek2	= mysqli_query($koneksidb, $sqlCek2) or die ("Eror Query".mysqli_error()); 
		$cek2Row	= mysqli_fetch_array($qryCek2);
		if($cek2Row['total']>=1){
			$message[] = "Maaf, barang dan item dengan kode barcode <b> $txtBarcode </ b> sudah ada, silahkan ganti dengan yang lain";
		}
		
		
		if(count($message)==0){			
			$qrySave=mysqli_query($koneksidb, "UPDATE ms_barang SET nama_barang='$txtNama', 
														id_kategori='$cmbKategori', 
														kode_barcode='$txtBarcode', 
														stok_barang='$txtStok',
														harga_jual='$txtJual',
														id_merk='$cmbMerk',
														ukuran_barang='$txtUkuran',
														status_barang='$cmbStatus',
														keterangan_barang='$txtKeterangan'
													WHERE id_barang='".$_POST['txtKode']."'") or die ("Gagal query".mysqli_error());
			if($qrySave){

				if($txtBarcode!=$txtBarcodeLm){
					unlink("photo/".$txtBarcodeLm);	
					QRCode::png($txtBarcode, $tempdir.$namafile, $quality, $ukuran, $padding);
				}elseif(!file_exists("photo/".$namafile)) {
					QRCode::png($txtBarcode, $tempdir.$namafile, $quality, $ukuran, $padding);
				}

				$_SESSION['pesan'] = 'Data barang & item berhasil diperbaharui';
				echo '<script>window.location="?page=databarang"</script>';
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
	$sqlShow 			= "SELECT * FROM ms_barang WHERE id_barang='$KodeEdit'";
	$qryShow 			= mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data supplier salah : ".mysqli_error());
	$dataShow 			= mysqli_fetch_array($qryShow);
	
	$dataKode			= $dataShow['id_barang'];
	$dataLama			= $dataShow['nama_barang'];
	$dataBarcodeLm		= $dataShow['kode_barcode'];
	$dataBarcode		= isset($dataShow['kode_barcode']) ?  $dataShow['kode_barcode'] : $_POST['txtBarcode'];
	$dataNama			= isset($dataShow['nama_barang']) ?  $dataShow['nama_barang'] : $_POST['txtNama'];
	$dataKategori		= isset($dataShow['id_kategori']) ?  $dataShow['id_kategori'] : $_POST['cmbKategori'];
	$dataJual			= isset($dataShow['harga_jual']) ?  format_angka($dataShow['harga_jual']) : $_POST['txtJual'];
	$dataMerk			= isset($dataShow['id_merk']) ?  $dataShow['id_merk'] : $_POST['cmbMerk'];
	$dataKeterangan		= isset($dataShow['keterangan_barang']) ?  $dataShow['keterangan_barang'] : $_POST['txtKeterangan'];
	$dataStatus			= isset($dataShow['status_barang']) ?  $dataShow['status_barang'] : $_POST['cmbStatus'];
	$dataStok			= isset($dataShow['stok_barang']) ?  format_angka($dataShow['stok_barang']) : $_POST['txtStok'];
	$dataUkuran			= isset($dataShow['ukuran_barang']) ?  $dataShow['ukuran_barang'] : $_POST['txtUkuran'];

?>
<div class="portlet box grey-cascade">
	<div class="portlet-title">
		<div class="caption"><span class="caption-subject uppercase bold"> Form Penambahan Barang & Item</span></div>
		<div class="tools">
			<a href="javascript:;" class="collapse"></a>
			<a href="javascript:;" class="reload"></a>
			<a href="javascript:;" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body form">
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" class="form-horizontal">
			<div class="form-body">
				<input class="form-control" type="hidden" value="<?php echo $dataKode; ?>" readonly="readonly" name="txtKode"/>
					
				<div class="form-group">
					<label class="col-md-2 control-label">Kode Barang :</label>
					<div class="col-md-3">
						<input class="form-control" type="text" value="<?php echo $dataBarcode; ?>" name="txtBarcode"/>
						<input class="form-control" type="hidden" value="<?php echo $dataBarcodeLm; ?>" name="txtBarcodeLm"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Nama Barang :</label>
					<div class="col-md-7">
						<input class="form-control" name="txtNama" value="<?php echo $dataNama; ?>" type="text"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Kategori :</label>
					<div class="col-md-4">
					<select name="cmbKategori" class="form-control select2" data-placeholder="Pilih Kategori" tabindex="1">
					  <option value=""> </option>
					  <?php
						  $dataSql = "SELECT * FROM ms_kategori WHERE status_kategori='Active' ORDER BY id_kategori";
						  $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
						  while ($dataRow = mysqli_fetch_array($dataQry)) {
							if ($dataKategori == $dataRow['id_kategori']) {
								$cek = " selected";
							} else { $cek=""; }
							echo "<option value='$dataRow[id_kategori]' $cek>$dataRow[nama_kategori]</option>";
						  }
						  $sqlData ="";
					  ?>
				  	</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Merk Barang :</label>
					<div class="col-md-4">
					<select name="cmbMerk" class="form-control select2" data-placeholder="Pilih Merk" tabindex="1">
					  <option value=""> </option>
					  <?php
						  $dataSql = "SELECT * FROM ms_merk WHERE status_merk='Active' ORDER BY id_merk";
						  $dataQry = mysqli_query($koneksidb, $dataSql) or die ("Gagal Query".mysqli_error());
						  while ($dataRow = mysqli_fetch_array($dataQry)) {
							if ($dataMerk == $dataRow['id_merk']) {
								$cek = " selected";
							} else { $cek=""; }
							echo "<option value='$dataRow[id_merk]' $cek>$dataRow[nama_merk]</option>";
						  }
						  $sqlData ="";
					  ?>
				  	</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Harga Jual &nbsp;Rp. :</label>
					<div class="col-md-2">
						<input class="form-control" name="txtJual" value="<?php echo $dataJual; ?>" type="text" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Ukuran :</label>
					<div class="col-md-4">
						<input class="form-control" name="txtUkuran" value="<?php echo $dataUkuran; ?>" type="text"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Stok Tersedia :</label>
					<div class="col-md-2">
						<input class="form-control" name="txtStok" value="<?php echo $dataStok; ?>" type="text"/>
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
			                <a href="?page=databarang" class="btn yellow"><i class="fa fa-undo"></i> Batalkan</a>
			            </div>
			        </div>
			    </div>
			</div>
		</form>
	</div>
</div>