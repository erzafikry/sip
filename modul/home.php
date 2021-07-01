<?php 
$dataTanggal	= date('Y');

// $userSql = "SELECT * FROM ms_user WHERE kode_user='".$_SESSION['kode_user']."'";
$userSql = "SELECT * FROM ms_user WHERE id_user='".$_SESSION['id_user']."'";
$userQry = mysqli_query($koneksidb, $userSql)  or die ("Query penjualan salah : ".mysqli_error());
$userRow = mysqli_fetch_array($userQry);
?>


<div class="row">
	<div class="col-sm-6 responsive" data-tablet="span3" data-desktop="span3">
		<div class="dashboard-stat blue">
			<div class="visual">
				<i class="fa fa-qrcode"></i>
			</div>
			
			<?php
			$itemALatSql 	= "SELECT * FROM ms_berkas";
			$itemAlatQry 	= mysqli_query($koneksidb, $itemALatSql)  or die ("Query salah : ".mysqli_error());
			$totalAlat	    = mysqli_num_rows($itemAlatQry);
			
			?>
			<div class="details">
				<div class="number"><?php echo $totalAlat; ?></div>
				<div class="desc">Data Berkas</div>
			</div>
			<a class="more" >Total Data Berkas <i class="m-icon-swapright m-icon-white"></i></a>						
		</div>
	</div>
	<div class="col-sm-6 responsive" data-tablet="span3" data-desktop="span3">
		<div class="dashboard-stat green">
			<div class="visual">
				<i class="icon-user"></i>
			</div>
			<?php
			
			$itemTypeSql 	= "SELECT * FROM ms_pemohon";
			$itemTypeQry 	= mysqli_query($koneksidb, $itemTypeSql)  or die ("Query type salah : ".mysqli_error());
			$totalType		= mysqli_num_rows($itemTypeQry);
			
			?>
			<div class="details">
				<div class="number"><?php echo $totalType ?></div>
				<div class="desc">Data Pemohon</div>
			</div>
			<a class="more">Total Data Pemohon <i class="m-icon-swapright m-icon-white"></i></a>						
		</div>
	</div>
	
</div>

<div class="row">
    <div class="col-md-6">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject uppercase bold">Statistik Berkas Bulanan</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
            
            <div class="portlet-body">
                <div id='order_1'></div>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject uppercase bold">Statistik Jenis Kegiatan</span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="javascript:;" class="reload"></a>
                    <a href="javascript:;" class="remove"></a>
                </div>
            </div>
            
            <div class="portlet-body">
                <div id='order_2'></div>
            </div>
        </div>

    </div>
</div>


<div class="row">
	<div class="col-sm-12">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">Daftar Berkas Masuk</div>
				<!--
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
					<a href="javascript:;" class="reload"></a>
					<a href="javascript:;" class="remove"></a>
				</div>
				-->
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="sample_2">
                    <thead>
                        <tr class="active">
                            <th width="2%"><div align="center">NO </div></th>
                            <th width="8%"><div align="center">INFORMASI BERKAS</div></th>
                            <th width="20%">NAMA PEMOHON</th>
                            <th width="20%">LAYANAN</th>
                            <th width="24%">KETERANGAN</th>
                            <th width="20%">POSISI</th>
                            <th width="10%"><div align="left">PETUGAS</div></th>
					  		<th width="15%"><div align="center">STATUS</div></th>
                            <th width="10%"><div align="center">RIWAYAT</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
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
						        LEFT JOIN ms_pegawai f ON a.id_pegawai=f.id_pegawai
					            ORDER BY a.id_berkas DESC";
					    $query=mysqli_query($koneksidb, $sql) or die("ajax-grid-data.php: get PO");
					    $nomor =0;
					    while( $data=mysqli_fetch_array($query) ) {
					    	$kode = $data['id_berkas'];
					    	$nomor ++;
					    	if($data['status_berkas']=='Dibuat'){
						        $dataStatus     = '<label class="label label-info">Dibuat</label>';
						    }elseif($data['status_berkas']=='Diproses'){
						        $dataStatus     = '<label class="label label-warning">Diproses</label>';
						    }elseif($data['status_berkas']=='Selesai'){
						        $dataStatus     = '<label class="label label-success">Selesai</label>';
						    }elseif($data['status_berkas']=='Batal'){
						        $dataStatus     = '<label class="label label-danger">Dibatalkan</label>';
						    }
						     if($data['status_berkas']=='Selesai'){
						        $infoSU         = '<b>NO. SU :</b> '.$data['no_su'].' <b>THN. SU :</b> '.$data['thn_su'].'</br>'.'<b>NO. DI.307 : </b>'.$data['no_di_307'].' <b>THN. DI.307 :</b> '.$data['thn_di_307'];
						    }else{
						        $infoSU         = '-';
						    }
                       	?>
                        <tr class="odd gradeX">
                            <td><div align="center"><?php echo $nomor ?></div></td>
							<td><div align="left"><?php echo $data ['no_berkas']; ?><br><?php echo $data ['tahun_berkas']; ?></div></td>
							<td><?php echo $data ['nama_pemohon']; ?></td>
							<td><?php echo $data ['nama_layanan']; ?></td>
							<td><?php echo $data ['keterangan_berkas']; ?></td>
							<td><?php echo $data ['posisi_berkas']; ?></td>
							<td><div align="left"><?php echo $data['nama_pegawai']; ?></div></td>
							<td><div align="center"><?php echo $dataStatus; ?></div></td>
                            <td><div align="center"><a href="?page=historyberkas&amp;id=<?php echo $kode; ?>" class="btn btn-xs blue"><i class="fa fa-eye"></i></a></div></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>
<script src="./assets/scripts/jquery.min.js" type="text/javascript"></script>
<script src="./assets/scripts/highcharts.js" type="text/javascript"></script>
<script src="./assets/scripts/highcharts-3d.js" type="text/javascript"></script>
<script src="./assets/scripts/exporting.js"></script>
<script type="text/javascript">
$(function () {
    Highcharts.chart('order_1', {
        chart: {
            type: 'area'
        },
        title: {
            text: 'Berkas Masuk Bulanan',
            style: {
                    fontSize: '15px',
                    fontFamily: 'Abel'
                }
        },
        subtitle: {
            text: 'Tahun <?php echo date('Y'); ?>',
            style: {
                    fontFamily: 'Abel',
                    fontSize: '13px'
                },
            x: -20
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Abel'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Berkas',
                style: {
                    fontFamily: 'Abel',
                    fontSize: '13px'
                },
            }
        },

        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Berkas Masuk di <?php echo date('Y'); ?>: <b>{point.y:.1f}</b>',
            style: {
                    fontFamily: 'Abel',
                    fontSize: '13px'
                },
        },
        series: [{
            name: 'Population',
            data: [
            <?php 
           		$dataTahun		= date('Y');
            	$pilihan		= array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
                foreach ($pilihan as $nilai) {
                $tahunSql		= "SELECT
										COUNT(*) AS total_masuk
									FROM
										ms_berkas
									WHERE
										YEAR(tgl_mulai_surtug)='$dataTahun'
										AND MONTH(tgl_mulai_surtug)='$nilai'";        
                $tahunQry		= mysqli_query($koneksidb, $tahunSql) or die(mysqli_error());
                while( $dataRow = mysqli_fetch_assoc($tahunQry)){
                   $jml_pegawai = $dataRow['total_masuk'];                 
                }             
            ?>
                  
                       ['<?php echo $nilai; ?>',<?php echo format_angka2($jml_pegawai); ?>],
                  
                  <?php } ?>
                  
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#000',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Abel'
                }
            }
        }]
    });
});
</script>
<script type="text/javascript">

    Highcharts.chart('order_2', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Grafik Jenis Kegiatan',
            style: {
                fontSize: '14px',
                fontFamily: 'Abel'
            }
        },
        subtitle: {
            text: 'Setiap Kegiatan',
            style: {
                fontSize: '14px',
                fontFamily: 'Abel'
            }
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Total Berkas',
            data: [

                <?php
                    $bagSQL ="SELECT
                                    b.nama_layanan,
                                    COUNT(a.id_layanan) jml 
                                FROM
                                    ms_berkas a
                                    INNER JOIN ms_layanan b ON a.id_layanan = b.id_layanan
                                GROUP BY
                                    b.nama_layanan";
                    $bagQRY = mysqli_query($koneksidb, $bagSQL) or die ("Gagal Query Tmp".mysqli_error()); 
                    while($bagRow = mysqli_fetch_assoc($bagQRY)) {    
                ?>
                    ['<?php echo $bagRow['nama_layanan'] ?>',<?php echo $bagRow['jml'] ?>],
               
                <?php } ?>
                
            ]
        }]
    });
</script>
