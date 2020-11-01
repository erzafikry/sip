
<?php
	$pg=$_GET['page'];
		if($pg=="home"){ include"modul/home.php"; }
	// DATA PENGATURAN SEKSI
		elseif($pg=="confseksi"){ include"modul/konfigurasi/conf_seksi.php"; }
		elseif($pg=="confprofile"){ include"modul/konfigurasi/conf_profil.php"; }
		elseif($pg=="confpassword"){ include"modul/konfigurasi/conf_password.php"; }
		elseif($pg=="confbackup"){ include"modul/konfigurasi/conf_backup.php"; }
	// DATA USER
		elseif($pg=="datauser"){ include"modul/user/user_data.php"; }
		elseif($pg=="tambahuser"){ include"modul/user/user_tambah.php"; }
		elseif($pg=="ubahuser"){ include"modul/user/user_ubah.php"; }
	// DATA GROUP
		elseif($pg=="datagroup"){ include"modul/group/group_data.php"; }
		elseif($pg=="tambahgroup"){ include"modul/group/group_tambah.php"; }
		elseif($pg=="ubahgroup"){ include"modul/group/group_ubah.php"; }
	// DATA MENU & MODUL
		elseif($pg=="datamodul"){ include"modul/modul/modul_data.php"; }
		elseif($pg=="tambahmodul"){ include"modul/modul/modul_tambah.php"; }
		elseif($pg=="ubahmodul"){ include"modul/modul/modul_ubah.php"; }
	// DATA SATKER
		elseif($pg=="datasatker"){ include"modul/satker/satker_data.php"; }
		elseif($pg=="tambahsatker"){ include"modul/satker/satker_tambah.php"; }
		elseif($pg=="ubahsatker"){ include"modul/satker/satker_ubah.php"; }
	// DATA PROVINSI
		elseif($pg=="dataprov"){ include"modul/provinsi/provinsi_data.php"; }
		elseif($pg=="tambahprov"){ include"modul/provinsi/provinsi_tambah.php"; }
		elseif($pg=="ubahprov"){ include"modul/provinsi/provinsi_ubah.php"; }
	// DATA KOTA
		elseif($pg=="datakot"){ include"modul/kota/kota_data.php"; }
		elseif($pg=="tambahkot"){ include"modul/kota/kota_tambah.php"; }
		elseif($pg=="ubahkot"){ include"modul/kota/kota_ubah.php"; }
	// DATA KECAMATAN
		elseif($pg=="datakec"){ include"modul/kecamatan/kec_data.php"; }
		elseif($pg=="tambahkec"){ include"modul/kecamatan/kec_tambah.php"; }
		elseif($pg=="ubahkec"){ include"modul/kecamatan/kec_ubah.php"; }
	// DATA KELURAHAN
		elseif($pg=="datakel"){ include"modul/kelurahan/kel_data.php"; }
		elseif($pg=="tambahkel"){ include"modul/kelurahan/kel_tambah.php"; }
		elseif($pg=="ubahkel"){ include"modul/kelurahan/kel_ubah.php"; }
	// DATA JABATAN
		elseif($pg=="datajab"){ include"modul/jabatan/jabatan_data.php"; }
		elseif($pg=="tambahjab"){ include"modul/jabatan/jabatan_tambah.php"; }
		elseif($pg=="ubahjab"){ include"modul/jabatan/jabatan_ubah.php"; }
	// DATA LAYANAN
		elseif($pg=="datalay"){ include"modul/layanan/layanan_data.php"; }
		elseif($pg=="tambahlay"){ include"modul/layanan/layanan_tambah.php"; }
		elseif($pg=="ubahlay"){ include"modul/layanan/layanan_ubah.php"; }
	// DATA PEMOHON
		elseif($pg=="datapemohon"){ include"modul/pemohon/pemohon_data.php"; }
		elseif($pg=="tambahpemohon"){ include"modul/pemohon/pemohon_tambah.php"; }
		elseif($pg=="ubahpemohon"){ include"modul/pemohon/pemohon_ubah.php"; }
	// DATA PEGAWAI
		elseif($pg=="datapegawai"){ include"modul/pegawai/pegawai_data.php"; }
		elseif($pg=="tambahpegawai"){ include"modul/pegawai/pegawai_tambah.php"; }
		elseif($pg=="ubahpegawai"){ include"modul/pegawai/pegawai_ubah.php"; }
	// DATA BERKAS
		elseif($pg=="databerkas"){ include"modul/berkas/berkas_data.php"; }
		elseif($pg=="tambahberkas"){ include"modul/berkas/berkas_tambah.php"; }
		// elseif($pg=="ubahberkas"){ include"modul/berkas/berkas_ubah.php"; }
	// DATA SURTUG
		elseif($pg=="datasurtug"){ include"modul/surtug/surtug_data.php"; }
		elseif($pg=="tambahsurtug"){ include"modul/surtug/surtug_tambah.php"; }
		// elseif($pg=="ubahsurtug"){ include"modul/surtug/surtug_ubah.php"; }
	
	// LAPORAN
		elseif($pg=="lapberkas"){ include"modul/laporan/laporan_berkas.php"; }
		else {
			echo "<div class='col-md-12'><div class='alert alert-dismissable alert-warning'><i class='icon-exclamation-sign'></i> Belum Ada Modul</div></div>";
		}
?>
		
		