<?php
session_start();
include_once "config/inc.connection.php";
include_once "config/inc.library.php";
include_once "plugin/phpqrcode/qrlib.php";
date_default_timezone_set('Asia/Jakarta');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING |E_DEPRECATED));

if(!isset($_SESSION['id_user'])){
	$_SESSION['pesan'] = 'Session anda terhapus, silahkan login kembali';
    header("Location:index.php"); 
}



$userSql = "SELECT * FROM ms_user a 
            INNER JOIN ms_pegawai b ON a.id_pegawai=b.id_pegawai 
            INNER JOIN sys_group c ON a.user_group=c.group_id
            WHERE a.id_user='".$_SESSION['id_user']."'";
$userQry = mysqli_query($koneksidb, $userSql)  or die ("Query salah : ".mysqli_error());
$userRow = mysqli_fetch_array($userQry);


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Seksi | Infrastruktur Pertanahan</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

<link href="assets/global/css/components.css" rel="stylesheet" type="text/css" />
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css" />

<link href="assets/layouts/layout/css/layout.css" rel="stylesheet" type="text/css" />
<link href="assets/layouts/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />

<link href="assets/layouts/layout/css/custom.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />

<link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END THEME LAYOUT STYLES -->
<link rel="shortcut icon" href="favicon.ico" />

</head>
<body class="page-header-fixed page-quick-sidebar-over-content page-full-width">
<div class="loader"></div>
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
      <a href="?page=home">
		<img src="assets/pages/img/atrbpn.png" alt="logo" class="logo-default" style="height:45px; width:45px;"/>
		<!-- <h4 style="color:#fff;">LOGO TOKO</h4> -->
      </a>
	  <div align="center" style="margin-top:15px;"><h4 style="color:#fff;">Seksi IP</h4></div>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN HORIZANTAL MENU -->
    <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
    <!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) sidebar menu below. So the horizontal menu has 2 seperate versions -->
    <div class="hor-menu hidden-sm hidden-xs">
      <ul class="nav navbar-nav">
        <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
        <li class="classic-menu-dropdown">
          <a href="?page=home"><i class="icon-home"></i> Dashboard </a>
        </li>
        <?php
            $menuSql    = "SELECT * FROM sys_menu WHERE menu_id IN (SELECT c.menu_id FROM sys_akses a 
                                                                    INNER JOIN sys_submenu b ON a.akses_submenu=b.submenu_id
                                                                    INNER JOIN sys_menu c ON b.submenu_menu=c.menu_id
                                                                    WHERE a.akses_group='".$userRow['user_group']."')
                            ORDER BY menu_urutan ASC";
            $menuQry    = mysqli_query($koneksidb, $menuSql) or die ("Query menu salah : ".mysqli_error());              
            while ($menuShow    = mysqli_fetch_assoc($menuQry)) {
                
        ?>
        <li class="classic-menu-dropdown">
			<a data-toggle="dropdown" href="javascript:;">
				<i class="<?php echo $menuShow['menu_icon'] ?>"></i> <?php echo $menuShow['menu_nama'] ?> <i class="fa fa-angle-down"></i>
			</a>
          <ul class="dropdown-menu pull-left">
            <?php 
	            $submenuSql     = "SELECT * FROM sys_submenu 
	                                WHERE submenu_menu='$menuShow[menu_id]' AND submenu_id IN (SELECT b.submenu_id FROM sys_akses a 
	                                                            INNER JOIN sys_submenu b ON a.akses_submenu=b.submenu_id
	                                                            WHERE a.akses_group='".$userRow['user_group']."')
	                                ORDER BY submenu_urutan ASC";
	            $submenuQry     = mysqli_query($koneksidb, $submenuSql) or die ("Query petugas salah : ".mysqli_error());                
	            while ($submenuShow = mysqli_fetch_assoc($submenuQry)) {
	            $submenulink    =$submenuShow['submenu_link'];
	            $submenunama    =$submenuShow['submenu_nama'];
	        ?>
            <li><a href="<?php echo $submenulink ?>">
              <i class="fa fa-angle-right"></i> <?php echo $submenunama ?>
              </a>
            </li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>
      </ul>
    </div>
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
    <i class="fa fa-bars"></i></a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN TOP NAVIGATION MENU -->
	
    <div class="top-menu">
      <ul class="nav navbar-nav pull-right">
        <li class="dropdown dropdown-user">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<i class="fa fa-bell"></i>
				<span class="username">
          <?php 
          $sqlSurtug  = "SELECT 
                          COUNT(*) as total,
                          id_petugas_ukur
                          FROM ms_surtug 
                          WHERE group_id='".$userRow['user_group']."' 
                          AND NOT status_surtug='Selesai'";
          $qrySurtug  = mysqli_query($koneksidb, $sqlSurtug) or die ("Eror show notif".mysqli_error()); 
          $showSurtug = mysqli_fetch_array($qrySurtug);

          $sqlSurtug2  = "SELECT 
                          COUNT(*) as total
                          FROM ms_surtug 
                          WHERE (id_petugas_ukur='".$userRow['id_pegawai']."' OR id_petugas_grafis='".$userRow['id_pegawai']."' OR id_petugas_textual='".$userRow['id_pegawai']."' OR id_kasubsie='".$userRow['id_pegawai']."' OR id_kasie='".$userRow['id_pegawai']."')
                          AND NOT status_surtug='Selesai'";
          $qrySurtug2  = mysqli_query($koneksidb, $sqlSurtug2) or die ("Eror show notif".mysqli_error()); 
          $showSurtug2 = mysqli_fetch_array($qrySurtug2);

          if($showSurtug['total']>=1 AND $showSurtug2['total']>=1){
            $notif  = '<span class="badge badge-danger">'.$showSurtug2['total'].'</span>';
          }elseif(empty($showSurtug['id_petugas_ukur']) AND $showSurtug['total']>=1){
            $notif  = '<span class="badge badge-danger">'.$showSurtug['total'].'</span>';
          }
          else{
            $notif  = '';
          }

          ?>
				  <?php echo $notif ?>
					<?php echo $userRow['nama_pegawai']; ?>
				</span>
				<i class="fa fa-angle-down"></i>
			</a>
			<ul class="dropdown-menu">
				<!--
				<li><a href="?page=confprofile"><i class="fa fa-pencil-square"></i> Ubah Profil </a></li>
				<li><a href="#"><i class="fa fa-folder"></i> Berkas Masuk <span class="badge badge-danger">3</span></a></li>
				<li class="divider"></li>
				-->
				<li><a href="?page=confpassword"><i class="fa fa-lock"></i> Ubah Password </a></li>
				<li class="divider"></li>
				<li><a href="keluar.php"><i class="fa fa-sign-out"></i> Logout </a></li>
			</ul>
        </li>
      </ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <!-- BEGIN HORIZONTAL RESPONSIVE MENU -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
      <ul class="page-sidebar-menu" data-slide-speed="200" data-auto-scroll="true">
        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
        <!-- DOC: This is mobile version of the horizontal menu. The desktop version is defined(duplicated) in the header above -->
        <li class="sidebar-search-wrapper">
          <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
          <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
          <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
          <form class="sidebar-search sidebar-search-bordered" action="extra_search.html" method="POST">
            <a href="javascript:;" class="remove">
            <i class="icon-close"></i>
            </a>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
              <button class="btn submit"><i class="icon-magnifier"></i></button>
              </span>
            </div>
          </form>
          <!-- END RESPONSIVE QUICK SEARCH FORM -->
        </li>
        <li><a href="?page=home"><i class="font-blue icon-home"></i> Dashboard </a></li>
        <?php
            $menuSql    = "SELECT * FROM sys_menu WHERE menu_id IN (SELECT c.menu_id FROM sys_akses a 
                                                                    INNER JOIN sys_submenu b ON a.akses_submenu=b.submenu_id
                                                                    INNER JOIN sys_menu c ON b.submenu_menu=c.menu_id
                                                                    WHERE a.akses_group='".$userRow['user_group']."')
                            ORDER BY menu_urutan ASC";
            $menuQry    = mysqli_query($koneksidb, $menuSql) or die ("Query menu salah : ".mysqli_error());              
            while ($menuShow    = mysqli_fetch_assoc($menuQry)) {
                
        ?>
        <li class="nav-item">
          <a href="javascript:;" class="nav-link nav-toggle">
          <i class="<?php echo $menuShow['menu_icon'] ?>"></i> <?php echo $menuShow['menu_nama'] ?> <i class="fa fa-angle-down"></i>
          </a>
          <ul class="sub-menu">
            <?php 
	            $submenuSql     = "SELECT * FROM sys_submenu 
	                                WHERE submenu_menu='$menuShow[menu_id]' AND submenu_id IN (SELECT b.submenu_id FROM sys_akses a 
	                                                            INNER JOIN sys_submenu b ON a.akses_submenu=b.submenu_id
	                                                            WHERE a.akses_group='".$userRow['user_group']."')
	                                ORDER BY submenu_urutan ASC";
	            $submenuQry     = mysqli_query($koneksidb, $submenuSql) or die ("Query petugas salah : ".mysqli_error());                
	            while ($submenuShow = mysqli_fetch_assoc($submenuQry)) {
	            $submenulink    =$submenuShow['submenu_link'];
	            $submenunama    =$submenuShow['submenu_nama'];
	        ?>
            <li><a href="<?php echo $submenulink ?>">
                <?php echo $submenunama ?>
                </a>
            </li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>


        
      </ul>
    </div>
    <!-- END HORIZONTAL RESPONSIVE MENU -->
  </div>
  <!-- END SIDEBAR -->
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <div class="page-content">
    <?php
		if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
			echo '<div class="alert alert-success"><button class="close" data-dismiss="alert"></button><i class="icon-check"></i>&nbsp;'.$_SESSION['pesan'].'</div>';
		}
		$_SESSION['pesan'] = '';
	
		if(isset($_GET['page'])){
			include("pages.php");
		}
		else{
			include("modul/home.php");
		}
	?>	
    </div>
  </div>
  <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
  <div class="page-footer-inner">
    2020 &copy; Seksi Infrastruktur Pertanahan Kota Bandung
  </div>
  <div class="page-footer-tools">
    <span class="go-top">
    <i class="fa fa-angle-up"></i>
    </span>
  </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/plugins/respond.min.js"></script>
<script src="assets/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
<script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

<script src="assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

<script src="assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<script src="assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){setTimeout(function(){$(".alert").fadeIn('slow');}, 500);});
    setTimeout(function(){$(".alert").fadeOut('slow');}, 5000);
</script>
<script type="text/javascript">
  $(window).load(function() {
    $(".loader").fadeOut("slow");
  });
</script>
<script type="text/javascript" src="assets/scripts/my.js"></script>
<script type="text/javascript" charset="utf-8">
  function fnHitung() {
  var angka = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah(document.getElementById('inputku').value)))); //input ke dalam angka tanpa titik
  if (document.getElementById('inputku').value == "") {
    alert("Jangan Dikosongi");
    document.getElementById('inputku').focus();
    return false;
  }
  else
    if (angka >= 1) {
    alert("angka aslinya : "+angka);
    document.getElementById('inputku').focus();
    document.getElementById('inputku').value = tandaPemisahTitik(angka) ;
    return false; 
    }
  }
</script>

</body>
<!-- END BODY -->
</html>
