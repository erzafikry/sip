<?php
/* Database connection start */
include_once "../config/inc.connection.php";
include_once "../config/inc.library.php";
/* Database connection end */
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
$columns = array( 
// datatable column index  => database column name
    0 => 'a.id_berkas',
    1 => 'a.no_berkas',
    2 => 'a.tahun_berkas', 
    3 => 'b.nama_pemohon',
    4 => 'c.nama_layanan',
    5 => 'd.nama_kecamatan',
    6 => 'e.nama_kelurahan',
    7 => 'f.nama_pegawai',
    8 => 'a.status_berkas',
);
// getting total number records without any search
$sql = "SELECT 
        a.id_berkas,
        a.no_berkas,
        a.tahun_berkas,
        b.nama_pemohon,
        c.nama_layanan,
        d.nama_kecamatan,
        e.nama_kelurahan,
        a.posisi_berkas,
        a.keterangan_berkas,
        f.nama_pegawai,
        a.status_berkas,
        a.no_su,
        a.thn_su,
        a.no_di_307,
        a.thn_di_307
        FROM ms_berkas a
        INNER JOIN ms_pemohon b ON a.id_pemohon=b.id_pemohon
        INNER JOIN ms_layanan c ON a.id_layanan=c.id_layanan
        INNER JOIN ms_kecamatan d ON a.id_kecamatan=d.id_kecamatan
        INNER JOIN ms_kelurahan e ON a.id_kelurahan=e.id_kelurahan
        LEFT JOIN ms_pegawai f ON a.id_pegawai=f.id_pegawai";
$query=mysqli_query($koneksidb, $sql) or die("ajax-grid-data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT 
            a.id_berkas,
            a.no_berkas,
            a.tahun_berkas,
            b.nama_pemohon,
            c.nama_layanan,
            d.nama_kecamatan,
            e.nama_kelurahan,
            a.posisi_berkas,
            a.keterangan_berkas,
            f.nama_pegawai,
            a.status_berkas,
            a.no_su,
            a.thn_su,
            a.no_di_307,
            a.thn_di_307
            FROM ms_berkas a
            INNER JOIN ms_pemohon b ON a.id_pemohon=b.id_pemohon
            INNER JOIN ms_layanan c ON a.id_layanan=c.id_layanan
            INNER JOIN ms_kecamatan d ON a.id_kecamatan=d.id_kecamatan
            INNER JOIN ms_kelurahan e ON a.id_kelurahan=e.id_kelurahan
            LEFT JOIN ms_pegawai f ON a.id_pegawai=f.id_pegawai";
    $sql.=" WHERE a.no_berkas LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR b.nama_pemohon LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR c.nama_layanan LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR d.nama_kecamatan LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR e.nama_kelurahan LIKE '".$requestData['search']['value']."%' ";
    $query=mysqli_query($koneksidb, $sql) or die("ajax-grid-data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($koneksidb, $sql) or die("ajax-grid-data.php: get PO"); // again run query with limit
} else {    
    $sql = "SELECT 
            a.id_berkas,
            a.no_berkas,
            a.tahun_berkas,
            b.nama_pemohon,
            c.nama_layanan,
            d.nama_kecamatan,
            e.nama_kelurahan,
            a.posisi_berkas,
            a.keterangan_berkas,
            f.nama_pegawai,
            a.status_berkas,
            a.no_su,
            a.thn_su,
            a.no_di_307,
            a.thn_di_307
            FROM ms_berkas a
            INNER JOIN ms_pemohon b ON a.id_pemohon=b.id_pemohon
            INNER JOIN ms_layanan c ON a.id_layanan=c.id_layanan
            INNER JOIN ms_kecamatan d ON a.id_kecamatan=d.id_kecamatan
            INNER JOIN ms_kelurahan e ON a.id_kelurahan=e.id_kelurahan
            LEFT JOIN ms_pegawai f ON a.id_pegawai=f.id_pegawai";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($koneksidb, $sql) or die("ajax-grid-data.php: get PO");
}
$data = array();
$nomor =0;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
    $nestedData=array(); 
    $nomor++;

    if($row['status_berkas']=='Dibuat'){
        $tombol ='<a class="btn btn btn-xs green" href="?page=prosesberkas&amp;id='.($row['id_berkas']).'"><i class="fa fa-check"></i></a>
                    <a class="btn btn btn-xs red" href="?page=hapusberkas&amp;id='.($row['id_berkas']).'"><i class="fa fa-trash"></i></a></li>';
    }elseif($row['status_berkas']=='Batal' OR $row['status_berkas']=='Selesai'){
        $tombol ='<a class="btn btn btn-xs yellow"><i class="fa fa-edit"></i></a>
                    <a class="btn btn btn-xs red"><i class="fa fa-trash"></i></a></li>';
    }else{
        $tombol ='<a class="btn btn btn-xs yellow" href="?page=ubahberkas&amp;id='.($row['id_berkas']).'"><i class="fa fa-edit"></i></a>
                            <a class="btn btn btn-xs red" href="?page=hapusberkas&amp;id='.($row['id_berkas']).'"><i class="fa fa-trash"></i></a>';
    }
    if($row['status_berkas']=='Dibuat'){
        $dataStatus     = '<label class="label label-info">Dibuat</label>';
    }elseif($row['status_berkas']=='Diproses'){
        $dataStatus     = '<label class="label label-warning">Diproses</label>';
    }elseif($row['status_berkas']=='Selesai'){
        $dataStatus     = '<label class="label label-success">Selesai</label>';
    }elseif($row['status_berkas']=='Batal'){
        $dataStatus     = '<label class="label label-danger">Dibatalkan</label>';
    }

    if($row['status_berkas']=='Selesai'){
        $infoSU         = '<b>NO. SU :</b> '.$row['no_su'].' <b>THN. SU :</b> '.$row['thn_su'].'</br>'.'<b>NO. DI.307 : </b>'.$row['no_di_307'].' <b>THN. DI.307 :</b> '.$row['thn_di_307'];
    }else{
        $infoSU         = '-';
    }
    $nestedData[] = '<div align="center">'.$nomor.'</div>';
    $nestedData[] = '<b>NOMOR : </b>'.$row["no_berkas"].'<br> <b>TAHUN : </b>'.$row["tahun_berkas"];
    $nestedData[] = $row["nama_pemohon"];
    $nestedData[] = $row["nama_layanan"];
    $nestedData[] = '<b>Kecamatan :</b>'.$row["nama_kecamatan"].'</br> <b>Kelurahan :</b>'.$row["nama_kelurahan"];
    $nestedData[] = '<div align="left">'.$row["posisi_berkas"].'</div>';
    $nestedData[] = $row["nama_pegawai"];
    $nestedData[] = $row["keterangan_berkas"];
    $nestedData[] = $infoSU;
    $nestedData[] = '<div align="center">'.$dataStatus.'</div>';
    $nestedData[] = '<div align="center">
                            '.$tombol.'
                    </div>';        
    $data[] = $nestedData;
}
$json_data = array(
            "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal"    => intval( $totalData ),  // total number of records
            "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
echo json_encode($json_data);  // send data as json format
?>