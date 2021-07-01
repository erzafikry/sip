<?php
	// AKSI PETUGAS UKUR
	if(isset($_POST['btnPetugasUkur'])){
		if($_POST['cmbPenerimaan']=='Ya'){
			$message = array();
			if (trim($_POST['txtTglMulai'])=="") {
				$message[] = "Tgl. Mulai tidak boleh kosong!";		
			}
			if (trim($_POST['txtTglSelesai'])=="") {
				$message[] = "Tgl. Selesai tidak boleh kosong!";		
			}
			if (trim($_POST['cmbPegawai'])=="") {
				$message[] = "Pegawai tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			$lama_berkas 	= hitungHari($_POST['txtTglMulai'], $_POST['txtTglSelesai']).' Hari';

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 id_pegawai='".$_POST['cmbPegawai']."', 
																			 tgl_mulai='".$_POST['txtTglMulai']."', 
																			 tgl_selesai='".$_POST['txtTglSelesai']."', 
																			 catatan='".$_POST['txtKeterangan']."', 
																			 status='Dikirim', 
																			 lama_berkas='$lama_berkas',
																			 posisi='Petugas Ukur',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='Petugas Grafis', 
																			tgl_awal='".$_POST['txtTglMulai']."', 
																			id_pegawai='".$_POST['cmbPegawai']."',
																			keterangan_berkas='".$_POST['txtKeterangan']."',
																			updatedTime='".date('Y-m-d')."',
																			tgl_akhir='".$_POST['txtTglSelesai']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}
		if($_POST['cmbPenerimaan']=='Tidak'){
			$message = array();
			if (trim($_POST['txtTglKembali'])=="") {
				$message[] = "Tgl. Kembali tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 tgl_kembali='".$_POST['txtTglKembali']."',  
																			 catatan='".$_POST['txtKeterangan']."', 
																			 id_pegawai='".$_POST['cmbPetugas']."',
																			 status='Dikembalikan', 
																			 posisi='Petugas Ukur',
																			 lama_berkas='-',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='Operator', 
																			updatedTime='".date('Y-m-d')."',
																			keterangan_berkas='".$_POST['txtKeterangan']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}

	}
	// AKHIR AKSI PETUGAS UKUR
	// AKSI PETUGAS GRAFIS
	if(isset($_POST['btnPetugasGrafis'])){
		if($_POST['cmbPenerimaan']=='Ya'){
			$message = array();
			if (trim($_POST['txtTglMulai'])=="") {
				$message[] = "Tgl. Mulai tidak boleh kosong!";		
			}
			if (trim($_POST['txtTglSelesai'])=="") {
				$message[] = "Tgl. Selesai tidak boleh kosong!";		
			}
			if (trim($_POST['cmbPegawai'])=="") {
				$message[] = "Pegawai tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			$lama_berkas 	= hitungHari($_POST['txtTglMulai'], $_POST['txtTglSelesai']).' Hari';

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 id_pegawai='".$_POST['cmbPegawai']."', 
																			 tgl_mulai='".$_POST['txtTglMulai']."', 
																			 tgl_selesai='".$_POST['txtTglSelesai']."', 
																			 catatan='".$_POST['txtKeterangan']."', 
																			 status='Dikirim', 
																			 lama_berkas='$lama_berkas',
																			 posisi='Petugas Grafis',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='Petugas Textual', 
																			tgl_awal='".$_POST['txtTglMulai']."', 
																			id_pegawai='".$_POST['cmbPegawai']."',
																			updatedTime='".date('Y-m-d')."',
																			keterangan_berkas='".$_POST['txtKeterangan']."',
																			tgl_akhir='".$_POST['txtTglSelesai']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}
		if($_POST['cmbPenerimaan']=='Tidak'){
			$message = array();
			if (trim($_POST['txtTglKembali'])=="") {
				$message[] = "Tgl. Kembali tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 tgl_kembali='".$_POST['txtTglKembali']."',  
																			 catatan='".$_POST['txtKeterangan']."', 	 
																			 id_pegawai='".$_POST['cmbPetugas']."',
																			 status='Dikembalikan', 
																			 posisi='Petugas Grafis',
																			 lama_berkas='-',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='Petugas Ukur', 
																			updatedTime='".date('Y-m-d')."',
																			keterangan_berkas='".$_POST['txtKeterangan']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}

	}
	// AKHIR AKSI PETUGAS GRAFIS
	// AKSI PETUGAS TEXTUAL
	if(isset($_POST['btnPetugasTextual'])){
		if($_POST['cmbPenerimaan']=='Ya'){
			$message = array();
			if (trim($_POST['txtTglMulai'])=="") {
				$message[] = "Tgl. Mulai tidak boleh kosong!";		
			}
			if (trim($_POST['txtTglSelesai'])=="") {
				$message[] = "Tgl. Selesai tidak boleh kosong!";		
			}
			if (trim($_POST['cmbPegawai'])=="") {
				$message[] = "Pegawai tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			$lama_berkas 	= hitungHari($_POST['txtTglMulai'], $_POST['txtTglSelesai']).' Hari';

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 id_pegawai='".$_POST['cmbPegawai']."', 
																			 tgl_mulai='".$_POST['txtTglMulai']."', 
																			 tgl_selesai='".$_POST['txtTglSelesai']."', 
																			 catatan='".$_POST['txtKeterangan']."', 
																			 status='Dikirim', 
																			 lama_berkas='$lama_berkas',
																			 posisi='Petugas Textual',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='Kordinator Pemetaan', 
																			tgl_awal='".$_POST['txtTglMulai']."', 
																			id_pegawai='".$_POST['cmbPegawai']."',
																			keterangan_berkas='".$_POST['txtKeterangan']."',
																			updatedTime='".date('Y-m-d')."',
																			tgl_akhir='".$_POST['txtTglSelesai']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}
		if($_POST['cmbPenerimaan']=='Tidak'){
			$message = array();
			if (trim($_POST['txtTglKembali'])=="") {
				$message[] = "Tgl. Kembali tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 tgl_kembali='".$_POST['txtTglKembali']."',  
																			 catatan='".$_POST['txtKeterangan']."', 
																			 id_pegawai='".$_POST['cmbPetugas']."',
																			 status='Dikembalikan', 
																			 posisi='Petugas Textual',
																			 lama_berkas='-',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='Petugas Grafis', 
																			updatedTime='".date('Y-m-d')."',
																			keterangan_berkas='".$_POST['txtKeterangan']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}

	}
	// AKHIR AKSI PETUGAS TEXTUAL
	// AKSI PETUGAS KORDINATOR PEMETAAN
	if(isset($_POST['btnPetugasPemetaan'])){
		if($_POST['cmbPenerimaan']=='Ya'){
			$message = array();
			if (trim($_POST['txtTglMulai'])=="") {
				$message[] = "Tgl. Mulai tidak boleh kosong!";		
			}
			if (trim($_POST['txtTglSelesai'])=="") {
				$message[] = "Tgl. Selesai tidak boleh kosong!";		
			}
			if (trim($_POST['cmbPegawai'])=="") {
				$message[] = "Pegawai tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			$lama_berkas 	= hitungHari($_POST['txtTglMulai'], $_POST['txtTglSelesai']). ' Hari';

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 id_pegawai='".$_POST['cmbPegawai']."', 
																			 tgl_mulai='".$_POST['txtTglMulai']."', 
																			 tgl_selesai='".$_POST['txtTglSelesai']."', 
																			 catatan='".$_POST['txtKeterangan']."', 
																			 status='Dikirim', 
																			 lama_berkas='$lama_berkas',
																			 posisi='Kordinator Pemetaan',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='Kordinator Pengukuran', 
																			tgl_awal='".$_POST['txtTglMulai']."', 
																			id_pegawai='".$_POST['cmbPegawai']."',
																			updatedTime='".date('Y-m-d')."',
																			keterangan_berkas='".$_POST['txtKeterangan']."',
																			tgl_akhir='".$_POST['txtTglSelesai']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}
		if($_POST['cmbPenerimaan']=='Tidak'){
			$message = array();
			if (trim($_POST['txtTglKembali'])=="") {
				$message[] = "Tgl. Kembali tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 tgl_kembali='".$_POST['txtTglKembali']."',  
																			 catatan='".$_POST['txtKeterangan']."', 
																			 id_pegawai='".$_POST['cmbPetugas']."',
																			 status='Dikembalikan', 
																			 posisi='Kordinator Pemetaan',
																			 lama_berkas='-',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='Petugas Grafis', 
																			updatedTime='".date('Y-m-d')."',
																			keterangan_berkas='".$_POST['txtKeterangan']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}

	}
	// AKHIR AKSI KORDINATOR PEMETAAN
	// AKSI PETUGAS KORDINATOR PENGUKURAN
	if(isset($_POST['btnPetugasPengukuran'])){
		if($_POST['cmbPenerimaan']=='Ya'){
			$message = array();
			if (trim($_POST['txtTglMulai'])=="") {
				$message[] = "Tgl. Mulai tidak boleh kosong!";		
			}
			if (trim($_POST['txtTglSelesai'])=="") {
				$message[] = "Tgl. Selesai tidak boleh kosong!";		
			}
			if (trim($_POST['cmbPegawai'])=="") {
				$message[] = "Pegawai tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			$lama_berkas 	= hitungHari($_POST['txtTglMulai'], $_POST['txtTglSelesai']).' Hari';

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 id_pegawai='".$_POST['cmbPegawai']."', 
																			 tgl_mulai='".$_POST['txtTglMulai']."', 
																			 tgl_selesai='".$_POST['txtTglSelesai']."', 
																			 catatan='".$_POST['txtKeterangan']."', 
																			 status='Dikirim', 
																			 lama_berkas='$lama_berkas',
																			 posisi='Kordinator Pengukuran',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='Kasubsi', 
																			tgl_awal='".$_POST['txtTglMulai']."', 
																			id_pegawai='".$_POST['cmbPegawai']."',
																			keterangan_berkas='".$_POST['txtKeterangan']."',
																			updatedTime='".date('Y-m-d')."',
																			tgl_akhir='".$_POST['txtTglSelesai']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}
		if($_POST['cmbPenerimaan']=='Tidak'){
			$message = array();
			if (trim($_POST['txtTglKembali'])=="") {
				$message[] = "Tgl. Kembali tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 tgl_kembali='".$_POST['txtTglKembali']."',  
																			 catatan='".$_POST['txtKeterangan']."', 
																			 id_pegawai='".$_POST['cmbPetugas']."',
																			 status='Dikembalikan', 
																			 posisi='Kordinator Pengukuran',
																			 lama_berkas='-',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='Kordinator Pemetaan', 
																			updatedTime='".date('Y-m-d')."',
																			keterangan_berkas='".$_POST['txtKeterangan']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}

	}
	// AKHIR AKSI KORDINATOR PENGUKURAN
	// AKSI KASUBSI
	if(isset($_POST['btnKasubsi'])){
		if($_POST['cmbPenerimaan']=='Ya'){
			$message = array();
			if (trim($_POST['txtTglMulai'])=="") {
				$message[] = "Tgl. Mulai tidak boleh kosong!";		
			}
			if (trim($_POST['txtTglSelesai'])=="") {
				$message[] = "Tgl. Selesai tidak boleh kosong!";		
			}
			if (trim($_POST['cmbPegawai'])=="") {
				$message[] = "Pegawai tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			$lama_berkas 	= hitungHari($_POST['txtTglMulai'], $_POST['txtTglSelesai']).' Hari';

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 id_pegawai='".$_POST['cmbPegawai']."', 
																			 tgl_mulai='".$_POST['txtTglMulai']."', 
																			 tgl_selesai='".$_POST['txtTglSelesai']."', 
																			 catatan='".$_POST['txtKeterangan']."', 
																			 status='Dikirim', 
																			 lama_berkas='$lama_berkas',
																			 posisi='Kasubsi',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='Kasi', 
																			tgl_awal='".$_POST['txtTglMulai']."', 
																			id_pegawai='".$_POST['cmbPegawai']."',
																			updatedTime='".date('Y-m-d')."',
																			keterangan_berkas='".$_POST['txtKeterangan']."',
																			tgl_akhir='".$_POST['txtTglSelesai']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}
		if($_POST['cmbPenerimaan']=='Tidak'){
			$message = array();
			if (trim($_POST['txtTglKembali'])=="") {
				$message[] = "Tgl. Kembali tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 tgl_kembali='".$_POST['txtTglKembali']."',  
																			 catatan='".$_POST['txtKeterangan']."', 
																			 id_pegawai='".$_POST['cmbPetugas']."',
																			 status='Dikembalikan', 
																			 posisi='Kasubsi',
																			 lama_berkas='-',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='Kordinator Pengukuran', 
																			updatedTime='".date('Y-m-d')."',
																			keterangan_berkas='".$_POST['txtKeterangan']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}

	}
	// AKHIR AKSI KASUBSI
	// AKSI PETUGAS KASI
	if(isset($_POST['btnKasi'])){
		if($_POST['cmbPenerimaan']=='Ya'){
			$message = array();
			if (trim($_POST['txtTglMulai'])=="") {
				$message[] = "Tgl. Mulai tidak boleh kosong!";		
			}
			if (trim($_POST['txtTglSelesai'])=="") {
				$message[] = "Tgl. Selesai tidak boleh kosong!";		
			}
			if (trim($_POST['cmbPegawai'])=="") {
				$message[] = "Pegawai tidak boleh kosong!";		
			}
			if (trim($_POST['txtNoSU'])=="") {
				$message[] = "No. SU tidak boleh kosong!";		
			}
			if (trim($_POST['txtThnSU'])=="") {
				$message[] = "Tahun SU tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			$lama_berkas 	= hitungHari($_POST['txtTglMulai'], $_POST['txtTglSelesai']).' Hari';

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 id_pegawai='".$_POST['cmbPegawai']."', 
																			 tgl_mulai='".$_POST['txtTglMulai']."', 
																			 tgl_selesai='".$_POST['txtTglSelesai']."', 
																			 catatan='".$_POST['txtKeterangan']."', 
																			 status='Dikirim', 
																			 lama_berkas='$lama_berkas',
																			 posisi='Kasi',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='DP 307', 
																			tgl_awal='".$_POST['txtTglMulai']."', 
																			no_su='".$_POST['txtNoSU']."',
																			thn_su='".$_POST['txtThnSU']."',
																			no_di_307='".$_POST['txtNoDI307']."',
																			thn_di_307='".$_POST['txtThnDI307']."',
																			id_pegawai='".$_POST['cmbPegawai']."',
																			updatedTime='".date('Y-m-d')."',
																			keterangan_berkas='".$_POST['txtKeterangan']."',
																			tgl_akhir='".$_POST['txtTglSelesai']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}
		if($_POST['cmbPenerimaan']=='Tidak'){
			$message = array();
			if (trim($_POST['txtTglKembali'])=="") {
				$message[] = "Tgl. Kembali tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 tgl_kembali='".$_POST['txtTglKembali']."',  
																			 catatan='".$_POST['txtKeterangan']."', 
																			 id_pegawai='".$_POST['cmbPetugas']."',
																			 status='Dikembalikan', 
																			 posisi='Kasi',
																			 lama_berkas='-',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='Kasubsi', 
																			updatedTime='".date('Y-m-d')."',
																			keterangan_berkas='".$_POST['txtKeterangan']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}

	}
	// AKHIR AKSI KASI
	// AKSI PETUGAS KASI
	if(isset($_POST['btnDP307'])){
		if($_POST['cmbPenerimaan']=='Ya'){
			$message = array();
			if (trim($_POST['txtTglMulai'])=="") {
				$message[] = "Tgl. Mulai tidak boleh kosong!";		
			}
			if (trim($_POST['txtTglSelesai'])=="") {
				$message[] = "Tgl. Selesai tidak boleh kosong!";		
			}
			if (trim($_POST['cmbPegawai'])=="") {
				$message[] = "Pegawai tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			$lama_berkas 	= hitungHari($_POST['txtTglMulai'], $_POST['txtTglSelesai']).' Hari';

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 id_pegawai='".$_POST['cmbPegawai']."', 
																			 tgl_mulai='".$_POST['txtTglMulai']."', 
																			 tgl_selesai='".$_POST['txtTglSelesai']."', 
																			 catatan='".$_POST['txtKeterangan']."', 
																			 status='Selesai', 
																			 lama_berkas='$lama_berkas',
																			 posisi='DP 307',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='DP 307', 
																			tgl_awal='".$_POST['txtTglMulai']."', 
																			status_berkas='Selesai',
																			id_pegawai='".$_POST['cmbPegawai']."',
																			updatedTime='".date('Y-m-d')."',
																			keterangan_berkas='".$_POST['txtKeterangan']."',
																			tgl_akhir='".$_POST['txtTglSelesai']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}
		if($_POST['cmbPenerimaan']=='Tidak'){
			$message = array();
			if (trim($_POST['txtTglKembali'])=="") {
				$message[] = "Tgl. Kembali tidak boleh kosong!";		
			}
			if (trim($_POST['txtKeterangan'])=="") {
				$message[] = "Catatan tidak boleh kosong!";		
			}

			if(count($message)==0){	
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 tgl_kembali='".$_POST['txtTglKembali']."',  
																			 catatan='".$_POST['txtKeterangan']."', 
																			 id_pegawai='".$_POST['cmbPetugas']."',
																			 status='Dikembalikan', 
																			 posisi='DP 307',
																			 lama_berkas='-',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
				if($qrySave){
					$update=mysqli_query($koneksidb, "UPDATE ms_berkas SET posisi_berkas='Kasi', 
																			updatedTime='".date('Y-m-d')."',
																			keterangan_berkas='".$_POST['txtKeterangan']."'
														WHERE id_berkas='".$_POST['txtKode']."'") 
					or die ("Gagal query update".mysqli_error());
					$_SESSION['pesan'] = 'Data berhasil diperbahrui.';
					echo '<script>window.location="?page=databerkas"</script>';
				}
				exit;

			}

		}

	}
	// AKHIR AKSI KASI
	if(isset($_POST['btnOperator'])){
		$message = array();
		if (trim($_POST['txtNoBerkas'])=="") {
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
		// if (trim($_POST['txtDi305'])=="") {
		// 	$message[] = "DI.305 tidak boleh kosong!";		
		// }
		if (trim($_POST['txtDi302'])=="") {
			$message[] = "DI.302 tidak boleh kosong!";		
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
		
		$txtNoBerkas		= $_POST['txtNoBerkas'];
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
		$txtNoSurtug		= $_POST['txtNoSurtug'];
		$txtTglSurtug		= $_POST['txtTglSurtug'];
		$txtTglSurtug2		= $_POST['txtTglSurtug2'];
		$cmbPegawai 		= $_POST['cmbPegawai'];
		
		
		if(count($message)==0){			
			$qrySave=mysqli_query($koneksidb, "UPDATE ms_berkas SET no_berkas='$txtNoBerkas', 
																	 tahun_berkas='$txtThnberkas', 
																	 id_pemohon='$cmbPemohon', 
																	 id_layanan='$cmbLayanan', 
																	 id_kecamatan='$cmbKecamatan', 
																	 id_kelurahan='$cmbKelurahan', 
																	 volume='$txtVolume',
																	 di_305='$txtDi305',
																	 di_302='$txtDi302',
																	 no_surtug='$txtNoSurtug',
																	 tgl_mulai_surtug='$txtTglSurtug',
																	 id_pegawai='$cmbPegawai',
																	 tgl_terbit_surtug='$txtTglSurtug2',
																	 posisi_berkas='Petugas Ukur',
																	 keterangan_berkas='$txtKeterangan',
																	 updatedBy = '".$_SESSION['id_user']."',
																	 updatedTime='".date('Y-m-d H:i:s')."'
													WHERE id_berkas='".$_POST['txtKode']."'") or die ("Gagal query".mysqli_error());
			if($qrySave){
				$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_POST['txtKode']."', 
																			 id_pegawai='".$userRow['id_pegawai']."', 
																			 catatan='".$_POST['txtKeterangan']."', 
																			 status='Dikirim', 
																			 lama_berkas='-',
																			 posisi='Operator',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
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
	$sqlShow 			= "SELECT *,
							( SELECT tgl_selesai FROM trx_history WHERE id_berkas = '4' AND NOT tgl_selesai IS NULL ORDER BY id_history DESC LIMIT 1) AS tgl_akhir_his
							FROM ms_berkas a
							INNER JOIN ms_pemohon b on a.id_pemohon=b.id_pemohon
							WHERE a.id_berkas='$KodeEdit'";
	$qryShow 			= mysqli_query($koneksidb, $sqlShow)  or die ("Query ambil data berkas salah : ".mysqli_error());
	$dataShow 			= mysqli_fetch_array($qryShow);
	
	$dataKode			= $dataShow['id_berkas'];
	$dataPemohon		= isset($_POST['cmbPemohon']) ? $_POST['cmbPemohon'] : $dataShow['id_pemohon'] ;
	$dataNikPemohon		= isset($_POST['txtNikPemohon']) ? $_POST['txtNikPemohon'] : $dataShow['nik_pemohon'];
	$dataNamaPemohon	= isset($_POST['txtNamaPemohon']) ? $_POST['txtNamaPemohon'] : $dataShow['nama_pemohon'];
	$dataAlamatPemohon	= isset($_POST['txtAlamatPemohon']) ? $_POST['txtAlamat'] : $dataShow['alamat_pemohon'] ;
	$dataTelpPemohon	= isset($_POST['txtTelpPemohon']) ? $_POST['txtTelpPemohon'] : $dataShow['telp_pemohon'] ;
	
	$dataNoBerkas		= isset($_POST['txtNoBerkas']) ? $_POST['txtNoBerkas'] : $dataShow['no_berkas'];
	$dataTahunberkas	= isset($_POST['txtThnberkas']) ? $_POST['txtThnberkas'] : $dataShow['tahun_berkas'];
	$dataLayanan		= isset($_POST['cmbLayanan']) ? $_POST['cmbLayanan'] : $dataShow['id_layanan'];
	$dataKecamatan		= isset($_POST['cmbKecamatan']) ? $_POST['cmbKecamatan'] : $dataShow['id_kecamatan'];
	$dataKelurahan		= isset($_POST['cmbKelurahan']) ? $_POST['cmbKelurahan'] : $dataShow['id_kelurahan'];
	$dataVolume			= isset($_POST['txtVolume']) ? $_POST['txtVolume'] : $dataShow['volume'];
	$dataDi305			= isset($_POST['txtDi305']) ? $_POST['txtDi305'] : $dataShow['di_305'];
	$dataDi302			= isset($_POST['txtDi302']) ? $_POST['txtDi302'] : $dataShow['di_302'];
	$dataKeterangan	 	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : $dataShow['keterangan_berkas'];
	$dataTglSurtug	 	= isset($_POST['txtTglSurtug']) ? $_POST['txtTglSurtug'] : $dataShow['tgl_mulai_surtug'];
	$dataTglSurtug2	 	= isset($_POST['txtTglSurtug2']) ? $_POST['txtTglSurtug2'] : $dataShow['tgl_terbit_surtug'];
	$dataNoSurtug	 	= isset($_POST['txtNoSurtug']) ? $_POST['txtNoSurtug'] : $dataShow['no_surtug'];
	$dataPenerimaan	 	= isset($_POST['cmbPenerimaan']) ? $_POST['cmbPenerimaan'] : 'Ya';
	$dataTglUpdate		= $dataShow['updatedTime'];

	if($dataShow['posisi_berkas']=='Petugas Ukur'){
		$value = 'value="'.$dataShow['tgl_mulai_surtug'].'" readonly';
		$dataPegawai	 	= isset($_POST['cmbPegawai']) ? $_POST['cmbPegawai'] : $dataShow['id_pegawai'];
	}else{
		$value = 'value="'.$dataShow['tgl_akhir_his'].'" ';
		$dataPegawai ='';
	}

	$dataPetugas	= $dataShow['id_pegawai'];


	if($dataShow['posisi_berkas']=='Petugas Ukur'){
		$note = 'Posisi berkas berada di <b>Petugas Ukur</b>, silahkan pilih penerimaan "Ya" apabila berkas diterima "Tidak" untuk pengembalian ke proses sebelumnya';
		$tombol = 'btnPetugasUkur';
		$where ="WHERE a.level_pegawai='Petugas Ukur'";
	}elseif($dataShow['posisi_berkas']=='Petugas Grafis'){
		$note = 'Posisi berkas berada di <b>Petugas Grafis</b>, silahkan pilih penerimaan "Ya" apabila berkas diterima "Tidak" untuk pengembalian ke proses sebelumnya';
		$tombol = 'btnPetugasGrafis';
		$where ="WHERE a.level_pegawai='Petugas Grafis'";
	}elseif($dataShow['posisi_berkas']=='Petugas Textual'){
		$note = 'Posisi berkas berada di <b>Petugas Textual</b>, silahkan pilih penerimaan "Ya" apabila berkas diterima "Tidak" untuk pengembalian ke proses sebelumnya';
		$tombol = 'btnPetugasTextual';
		$where ="WHERE a.level_pegawai='Petugas Textual'";
	}elseif($dataShow['posisi_berkas']=='Kordinator Pemetaan'){
		$note = 'Posisi berkas berada di <b>Petugas Kordinator Pemetaan</b>, silahkan pilih penerimaan "Ya" apabila berkas diterima "Tidak" untuk pengembalian ke proses sebelumnya';
		$tombol = 'btnPetugasPemetaan';
		$where ="WHERE a.level_pegawai='Kordinator Pemetaan'";
	}elseif($dataShow['posisi_berkas']=='Kordinator Pengukuran'){
		$note = 'Posisi berkas berada di <b>Petugas Kordinator Pengukuran</b>, silahkan pilih penerimaan "Ya" apabila berkas diterima "Tidak" untuk pengembalian ke proses sebelumnya';
		$tombol = 'btnPetugasPengukuran';
		$where ="WHERE a.level_pegawai='Kordinator Pemetaan'";
	}elseif($dataShow['posisi_berkas']=='Kasubsi'){
		$note = 'Posisi berkas berada di <b>Kasubsi</b>, silahkan pilih penerimaan "Ya" apabila berkas diterima "Tidak" untuk pengembalian ke proses sebelumnya';
		$tombol = 'btnKasubsi';
		$where ="WHERE a.level_pegawai='Kasubsi'";
	}elseif($dataShow['posisi_berkas']=='Kasi'){
		$note = 'Posisi berkas berada di <b>Kasi</b>, silahkan pilih penerimaan "Ya" apabila berkas diterima "Tidak" untuk pengembalian ke proses sebelumnya';
		$tombol = 'btnKasi';
		$where ="WHERE a.level_pegawai='Kasi'";
	}elseif($dataShow['posisi_berkas']=='DP 307'){
		$note = 'Posisi berkas berada di <b>DP 307</b>, silahkan pilih penerimaan "Ya" apabila berkas diterima "Tidak" untuk pengembalian ke proses sebelumnya';
		$tombol = 'btnDP307';
		$where ="WHERE a.level_pegawai='DP 307'";
	}elseif($dataShow['posisi_berkas']=='Operator'){
		$note = 'Posisi berkas berada di <b>Operator</b>';
		$tombol = 'btnOperator';
		$where ="";
	}

?>
<div class="note note-info"><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	<p><?php echo $note ?></p>
</div>
<SCRIPT language="JavaScript">
function submitform() {
	document.form1.submit();
}
</SCRIPT>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" class="form-horizontal" autocomplete="off">	
	<input type="hidden" name="txtKode" value="<?php echo $dataKode ?>">
	<input type="hidden" name="cmbPetugas" value="<?php echo $dataPetugas ?>">
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption">
	            <span class="caption-subject uppercase bold hidden-xs">Form Perubahan Berkas</span>
	        </div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
				<a href="javascript:;" class="remove"></a>
			</div>
		</div>
		<div class="portlet-body form">
			<?php if($dataShow['posisi_berkas']=='Operator'){ ?>
			<div class="form-body">
				<div class="form-group">
					<label class="col-lg-3 control-label">No Berkas :</label>
					<div class="col-lg-3">
						<input class="form-control" type="number" name="txtNoBerkas" value="<?php echo $dataNoBerkas; ?>"/>
						<input type="hidden" name="txtKode" value="<?php echo $dataKode ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Tahun Berkas :</label>
					<div class="col-lg-3">
						<input class="form-control" type="number" name="txtThnberkas" value="<?php echo $dataTahunberkas; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">NIK :</label>
					<div class="col-lg-3">
						<input class="form-control" id="nik_pemohon" readonly type="text" value="<?php echo $dataNikPemohon; ?>" name="txtNikPemohon"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Nama Pemohon :</label>
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
					<label class="col-lg-3 control-label">Jenis Kegiatan :</label>
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
					<label class="col-lg-3 control-label">Kecamatan :</label>
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
					<label class="col-lg-3 control-label">Kelurahan :</label>
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
					<label class="col-lg-3 control-label">Volume (m2) :</label>
					<div class="col-lg-1">
						<input class="form-control" type="text" name="txtVolume" value="<?php echo $dataVolume; ?> "/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">DI.305 :</label>
					<div class="col-lg-3">
						<input class="form-control" type="text" name="txtDi305" value="<?php echo $dataDi305; ?> "/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">DI.302 :</label>
					<div class="col-lg-3">
						<input class="form-control" type="text" name="txtDi302" value="<?php echo $dataDi302; ?> "/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">No. Surat Tugas :</label>
					<div class="col-lg-3">
						<input class="form-control" type="text" name="txtNoSurtug" value="<?php echo $dataNoSurtug; ?>"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Tgl. Mulai Surat Tugas :</label>
					<div class="col-lg-3">
						<div class="input-icon left">
							<i class="icon-calendar"></i>
							<input class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" value="<?php echo $dataTglSurtug; ?>" name="txtTglSurtug"/>
						</div>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-lg-3 control-label">Tgl. Terbit Surat Tugas :</label>
					<div class="col-lg-3">
						<div class="input-icon left">
							<i class="icon-calendar"></i>
							<input class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" value="<?php echo $dataTglSurtug2; ?>" name="txtTglSurtug2"/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Petugas Ukur :</label>
					<div class="col-lg-3">
						<select name="cmbPegawai" class="select2 form-control" data-placeholder="Pilih Pegawai">
							<option value="BLANK"> </option>
							<?php
							  $dataSql = "SELECT * FROM ms_pegawai a
											INNER JOIN ms_jabatan c ON a.id_jabatan=c.id_jabatan
											WHERE a.level_pegawai='Petugas Ukur'";
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
				<div class="form-group">
					<label class="col-lg-3 control-label">Keterangan :</label>
					<div class="col-lg-8">
						<textarea class="form-control" name="txtKeterangan" type="text"/></textarea>
					</div>
				</div>				
	         </div>
			
			<?php }elseif($dataShow['posisi_berkas']=='Petugas Ukur' OR $dataShow['posisi_berkas']=='Petugas Grafis' OR $dataShow['posisi_berkas']=='Petugas Textual' OR $dataShow['posisi_berkas']=='Kordinator Pemetaan' OR $dataShow['posisi_berkas']=='Kordinator Pengukuran' OR $dataShow['posisi_berkas']=='Kasubsi' OR $dataShow['posisi_berkas']=='Kasi' OR $dataShow['posisi_berkas']=='DP 307'){ ?>
			<div class="form-body">
				<div class="form-group">
					<label class="col-lg-3 control-label">Penerimaan :</label>
					<div class="col-lg-2">
						<select onChange="javascript:submitform();" class="form-control select2" name="cmbPenerimaan">
							   <?php
							  $pilihan	= array("Ya", "Tidak");
							  foreach ($pilihan as $nilai) {
								if ($dataPenerimaan==$nilai) {
									$cek=" selected";
								} else { $cek = ""; }
								echo "<option value='$nilai' $cek>$nilai</option>";
							  }
							  ?>
						</select>
					</div>
				</div>
				<div class="batas"></div>
				<?php if($dataPenerimaan=='Ya'){ ?>
				<div class="form-group">
					<label class="col-lg-3 control-label">Tgl. Mulai :</label>
					<div class="col-lg-3">
						<div class="input-icon left">
							<i class="icon-calendar"></i>
							<input class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text"  name="txtTglMulai" <?php echo $value ?>/>
						</div>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-lg-3 control-label">Tgl. Selesai :</label>
					<div class="col-lg-3">
						<div class="input-icon left">
							<i class="icon-calendar"></i>
							<input class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text" name="txtTglSelesai"/>
						</div>
					</div>
				</div>
				<?php if($dataShow['posisi_berkas']=='Kasi'){ ?>
				<div class="form-group">
					<label class="col-lg-3 control-label">No. SU :</label>
					<div class="col-lg-3">
						<input class="form-control"  type="text" name="txtNoSU"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Tahun SU :</label>
					<div class="col-lg-3">
						<input class="form-control"  type="text" name="txtThnSU"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">No. DI.307 :</label>
					<div class="col-lg-3">
						<input class="form-control"  type="text" name="txtNoDI307"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">Tahun DI.307 :</label>
					<div class="col-lg-3">
						<input class="form-control"  type="text" name="txtThnDI307"/>
					</div>
				</div>
				<?php } ?>
				<div class="form-group">
					<label class="col-lg-3 control-label">Petugas :</label>
					<div class="col-lg-3">
						<select name="cmbPegawai" class="select2 form-control" data-placeholder="Pilih Pegawai">
							<option value=""> </option>
							<?php
							  $dataSql = "SELECT * FROM ms_pegawai a
											INNER JOIN ms_jabatan c ON a.id_jabatan=c.id_jabatan
											".$where."
											ORDER BY a.nama_pegawai ASC";
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
				<?php }else{ ?>
				<div class="form-group">
					<label class="col-lg-3 control-label">Tgl. Kembali :</label>
					<div class="col-lg-3">
						<div class="input-icon left">
							<i class="icon-calendar"></i>
							<input class="form-control date-picker" data-date-format="yyyy-mm-dd" type="text"  name="txtTglKembali"/>
						</div>
					</div>
				</div>	
				<?php } ?>
				<div class="form-group">
					<label class="col-lg-3 control-label">Keterangan :</label>
					<div class="col-lg-8">
						<textarea class="form-control" name="txtKeterangan" type="text"/></textarea>
					</div>
				</div>				
	         </div>
			
	         

			<?php } ?>
			<div class="form-actions">
			    <div class="row">
			        <div class="form-group">
			            <div class="col-lg-offset-3 col-lg-9">
			                <button type="submit" name="<?php echo $tombol ?>" class="btn blue"><i class="fa fa-save"></i> Simpan Data</button>
			                <a href="?page=databerkas" class="btn yellow"><i class="fa fa-undo"></i> Batal</a>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</form>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="portlet-body form">
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