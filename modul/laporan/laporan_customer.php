<?php							
	$tglAwal		= isset($_POST['txtAwal']) ? $_POST['txtAwal'] : date('d-m-Y');
	$tglAkhir		= isset($_POST['txtAkhir']) ? $_POST['txtAkhir'] : date('d-m-Y');
 ?> 	
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="fieldset-form">
	<div class="portlet box grey-cascade">
	    <div class="portlet-title">
	        <div class="caption">
	            <span class="caption-subject uppercase bold">Laporan Customer</span>
	        </div>
	        <div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
				<a href="javascript:;" class="remove"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div class="row">
				<div class="col-lg-4">	
					<div class="form-group">
						<label>Periode Transaksi :</label>
						<div class="input-group" style="margin-top: 6px">
                            <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" placeholder="Periode Awal" name="txtAwal" value="<?php echo $tglAwal; ?>" >
                            <span class="input-group-addon">s/d</span>
                            <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" placeholder="Periode Akhir" name="txtAkhir" value="<?php echo $tglAkhir; ?>" >
						
						</div>
					</div>
				</div>
				<div class="col-lg-2">	
					<div class="form-group">
						<div class="controls" style="margin-top: 30px">
							<button type="submit" class="btn blue" name="btnTampil"><i class="icon-magnifier-add"></i> Tampilkan</button>
						</div>
					</div>
				</div>
				<div class="col-lg-6" align="right">
					<div class="form-group">
						<div class="controls" style="margin-top: 30px">
						<?php
	                    	if(isset($_POST['btnTampil'])){
	                    ?>
						 <button name="bar" type="button" onClick="cetak_pdf()" class="btn blue"><i class="icon-printer"></i> Export PDF</button>
						 <button name="bar" type="button" onClick="cetak_exl()" class="btn blue"><i class="icon-doc"></i> Export Excel</button>
	                    <?php } ?>
						</div>
					</div>
				</div>
			</div>	
			<hr>
			<table class="table table-striped table-bordered table-hover " id="sample_4">
				<thead>
                    <tr class="active">
               	  	  	<th width="2%"><div align="center">NO</div></th>
                      	<th width="20%"><div align="left">NAMA CUSTOMER</div></th>
						<th width="65%">ALAMAT</th>
		  	  	  	  	<th width="5%"><div align="center">PEMBELIAN</div></th>
		  	  	  	  	<th width="5%"><div align="center">RETUR</div></th>
                    </tr>
				</thead>
				<tbody>
                    <?php
                    if(isset($_POST['btnTampil'])){
						$tglAwal		= InggrisTgl($_POST['txtAwal']);
						$tglAkhir		= InggrisTgl($_POST['txtAkhir']);
															
						$dataSql = mysqli_query($koneksidb, "SELECT
																a.nama_customer,
																a.kode_customer,
																a.alamat_customer,
																a.status_customer,
																count(b.id_customer) as total_jual,
																count(c.id_penjualan) as total_retur_jual
															FROM
																ms_customer a
																INNER JOIN tr_penjualan b ON b.id_customer = a.id_customer AND b.tgl_penjualan BETWEEN '$tglAwal' and '$tglAkhir'
																LEFT JOIN tr_retur_jual c ON b.id_penjualan=c.id_penjualan AND c.tgl_retur_jual BETWEEN '$tglAwal' and '$tglAkhir'
															GROUP BY
																a.nama_customer,
																a.kode_customer,
																a.alamat_customer,
																a.status_customer");
					}
					$nomor  		= 0;
					$beli			= 0;
					$returbeli		= 0;
					while($dataRow	= mysqli_fetch_array($dataSql)){
						$nomor ++;
						$beli		= $beli + $dataRow['total_jual'];
						$returbeli	= $returbeli + $dataRow['total_retur_jual'];
						
                    ?>
                    <tr>
                        <td><div align="center"><?php echo $nomor;?></div></td>
						<td><?php echo $dataRow['nama_customer']; ?></td>
						<td><div align="left"><?php echo $dataRow['alamat_customer']; ?></div></td>
                        <td><div align="center"><?php echo number_format($dataRow['total_jual']); ?></div></td>
                        <td><div align="center"><?php echo number_format($dataRow['total_retur_jual']); ?></div></td>
                    </tr>
                    <?php } ?>
				</tbody>
				<tfoot>
                    <tr>
               	  	  	<th colspan="3"><b><div align="right">SUBTOTAL : </div></b></th>
			  	  	  	<th width="6%"><b><div align="center"><?php echo number_format($beli); ?></div></b></th>
			  	  	  	<th width="5%"><b><div align="center"><?php echo number_format($returbeli); ?></div></b></th>
                    </tr>
				</tfoot>
            </table>
	  </div>
  		</div>
	</div>
</div>
<script type="text/javascript"> 
    function cetak_pdf()	 
    { 
    win=window.open('./cetak/pdf_laporan_customer.php?awal=<?php echo $tglAwal; ?>&akhir=<?php echo $tglAkhir ?>','win','width=1500, height=600, menubar=0, scrollbars=1, resizable=0, status=0'); 
    } 
     function cetak_exl()	 
    { 
    win=window.open('./cetak/excel_laporan_customer.php?awal=<?php echo $tglAwal; ?>&akhir=<?php echo $tglAkhir ?>','win','width=1500, height=600, menubar=0, scrollbars=1, resizable=0, status=0'); 
    } 
</script>