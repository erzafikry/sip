<?php
session_start();
include "config/inc.connection.php";

 	$txtUsername 	= $_POST['username'];
	$txtPassword	= $_POST['password'];
	
		
	$cekLogin		= mysqli_query($koneksidb, "SELECT * FROM ms_user WHERE username_user='".$txtUsername."' 
												AND password_user='".md5($txtPassword)."' AND status_user='Active'");
	if(mysqli_num_rows($cekLogin)==1){
		$login = mysqli_fetch_array($cekLogin);
		$_SESSION['id_user'] 	= $login['id_user'];
		
		echo '<script>window.location="admin.php"</script>';
		
	}else{
		$_SESSION['pesan'] = 'Username dan password anda salah';
		echo '<script>window.location="index.php"</script>';
	}

?>