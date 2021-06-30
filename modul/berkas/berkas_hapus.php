<?php
			
	if(isset($_GET['id'])){
		$txtID 		= $_GET['id'];
				
		$hapus=mysqli_query($koneksidb, "UPDATE  ms_berkas SET status_berkas='Batal' WHERE id_berkas='$txtID'") 
			or die ("Gagal kosongkan tmp".mysqli_error());
		
		if($hapus){	
			$qrySave=mysqli_query($koneksidb, "INSERT INTO trx_history SET id_berkas='".$_GET['id']."',  
																			 catatan='Berkas Dibatalkan', 
																			 id_pegawai='".$userRow['id_pegawai']."',
																			 status='Dibatalkan', 
																			 posisi='Operator',
																			 lama_berkas='-',
																			 createdBy = '".$_SESSION['id_user']."',
																			 createdTime='".date('Y-m-d H:i:s')."'") 
				or die ("Gagal insert history".mysqli_error());
			$_SESSION['pesan'] = 'Data Berkas berhasil dihapus';
			echo '<script>window.location="?page=databerkas"</script>';
		}else{
			$_SESSION['pesan'] = 'Tidak ada data yang dihapus';
			echo '<script>window.location="?page=databerkas"</script>';
		}	
		
	}
?>
