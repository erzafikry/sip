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
    6 => 'e.nama_kelurahan'  
);
// getting total number records without any search
$sql = "SELECT * FROM ms_berkas a
        INNER JOIN ms_pemohon b ON a.id_pemohon=b.id_pemohon
        INNER JOIN ms_layanan c ON a.id_layanan=c.id_layanan
        INNER JOIN ms_kecamatan d ON a.id_kecamatan=d.id_kecamatan
        INNER JOIN ms_kelurahan e ON a.id_kelurahan=e.id_kelurahan
        WHERE a.posisi_berkas='DP307'";
$query=mysqli_query($koneksidb, $sql) or die("ajax-grid-data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT * FROM ms_berkas a
            INNER JOIN ms_pemohon b ON a.id_pemohon=b.id_pemohon
            INNER JOIN ms_layanan c ON a.id_layanan=c.id_layanan
            INNER JOIN ms_kecamatan d ON a.id_kecamatan=d.id_kecamatan
            INNER JOIN ms_kelurahan e ON a.id_kelurahan=e.id_kelurahan";
    $sql.=" WHERE a.posisi_berkas='DP307' AND a.no_berkas LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
    $sql.=" OR b.nama_pemohon LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR c.nama_layanan LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR d.nama_kecamatan LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR e.nama_kelurahan LIKE '".$requestData['search']['value']."%' ";
    $query=mysqli_query($koneksidb, $sql) or die("ajax-grid-data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($koneksidb, $sql) or die("ajax-grid-data.php: get PO"); // again run query with limit
} else {    
    $sql = "SELECT * FROM ms_berkas a
            INNER JOIN ms_pemohon b ON a.id_pemohon=b.id_pemohon
            INNER JOIN ms_layanan c ON a.id_layanan=c.id_layanan
            INNER JOIN ms_kecamatan d ON a.id_kecamatan=d.id_kecamatan
            INNER JOIN ms_kelurahan e ON a.id_kelurahan=e.id_kelurahan
            WHERE a.posisi_berkas='DP307'";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($koneksidb, $sql) or die("ajax-grid-data.php: get PO");
}
$data = array();
$nomor =0;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
    $nestedData=array(); 
    $nomor++;
    $nestedData[] = '<div align="center">'.$nomor.'</div>';
    $nestedData[] = '<div align="center">'.$row["no_berkas"].'</div>';
    $nestedData[] = '<div align="center">'.$row["tahun_berkas"].'</div>';
    $nestedData[] = $row["nama_pemohon"];
    $nestedData[] = $row["nama_layanan"];
    $nestedData[] = $row["nama_kecamatan"];
    $nestedData[] = $row["nama_kelurahan"];
    $nestedData[] = '<div align="center">'.$row["posisi_berkas"].'</div>';
    $nestedData[] = $row["keterangan_berkas"];
    $nestedData[] = '<div class="btn-group">
                        <button class="btn btn-xs blue dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="?page=ubahberkas&amp;id='.($row['id_berkas']).'">Ubah</a></li>
                            <li><a href="?page=historyberkas&amp;id='.($row['id_berkas']).'">Riyawat</a></li>
                            <li><a href="?page=hapusberkas&amp;id='.($row['id_berkas']).'">Hapus</a></li>
                        </ul>
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