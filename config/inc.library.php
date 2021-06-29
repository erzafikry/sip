<?php
date_default_timezone_set("Asia/Jakarta");

# Fungsi untuk membuat kode automatis
function kodeUnik($tabel, $field, $inisial, $panjang,$tanggal){

 	$qry	= mysqli_query("SELECT MAX(".$field.") FROM $tabel WHERE date(".$tanggal.")='".date('Y-m-d')."'");
 	$row	= mysqli_fetch_array($qry); 
 	if ($row[0]=="") {
 		$angka=0;
	}
 	else {
 		$angka		= substr($row[0], strlen($inisial));
 	}
	
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}
function buatKode($tabel, $inisial){
	$struktur	= mysql_query("SELECT * FROM $tabel");
	$field		= mysql_field_name($struktur,0);
	$panjang	= mysql_field_len($struktur,0);

 	$qry	= mysql_query("SELECT MAX(".$field.") FROM ".$tabel);
 	$row	= mysql_fetch_array($qry); 
 	if ($row[0]=="") {
 		$angka=0;
	}
 	else {
 		$angka		= substr($row[0], strlen($inisial));
 	}
	
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}

# Fungsi untuk membalik tanggal dari format Indo -> English
function InggrisTgl($tanggal){
	$tgl=substr($tanggal,0,2);
	$bln=substr($tanggal,3,2);
	$thn=substr($tanggal,6,4);
	$awal="$thn-$bln-$tgl";
	return $awal;
}

# Fungsi untuk membalik tanggal dari format English -> Indo
function IndonesiaTgl($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$awal="$tgl-$bln-$thn";
	return $awal;
}

# Fungsi untuk membuat format rupiah pada angka (uang)
function format_angka($angka) {
	$hasil =  number_format($angka,0, ".",".");
	return $hasil;
}

function format_angka2($angka) {
	$hasil =  number_format($angka,0, ",",",");
	return $hasil;
}

# Fungsi untuk menghitung umur
function umur($birthday){
	date_default_timezone_set("Asia/Jakarta");

	list($year,$month,$day) = explode("-",$birthday);
	$year_diff = date("Y") - $year;
	$month_diff = date("m") - $month;
	$day_diff = date("d") - $day;
	if ($month_diff < 0) $year_diff--;
	elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
	return $year_diff;
}

function no_acak(){
	$number = uniqid();
    $varray = str_split($number);
    $len 	= sizeof($varray);
    $otp 	= array_slice($varray, $len-10, $len);
    $otp 	= implode(",", $otp);
    $otp 	= str_replace(',', '', $otp);
    return ($otp);
}
function dateDiff($time1, $time2, $precision = 6) {
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }

    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }

    $intervals = array('Year','Month','Day','Hour','Minute','Second');
    $diffs = array();

    foreach ($intervals as $interval) {
      $diffs[$interval] = 0;
      $ttime = strtotime("+1 " . $interval, $time1);
      while ($time2 >= $ttime) {
$time1 = $ttime;
$diffs[$interval]++;
$ttime = strtotime("+1 " . $interval, $time1);
      }
    }

    $count = 0;
    $times = array();
    foreach ($diffs as $interval => $value) {
      if ($count >= $precision) {
break;
      }
      if ($value > 0) {
if ($value != 1) {
 $interval .= "s";
}
$times[] = $value . " " . $interval;
$count++;
      }
    }

    return implode(", ", $times);
  }

function get_age($birth_date){
date_default_timezone_set("Asia/Jakarta");
return floor((time() - strtotime($birth_date))/31556926);
}
function sekianLama($format, $wkt) {
    $sekarang = date("Y-m-d");
    return date($format, strtotime(date("Y-m-d", strtotime($sekarang)) . " " . $wkt));
}

?>