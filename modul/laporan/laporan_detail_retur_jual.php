<?php							
	$tglAwal		= isset($_POST['txtAwal']) ? $_POST['txtAwal'] : date('d-m-Y');
	$tglAkhir		= isset($_POST['txtAkhir']) ? $_POST['txtAkhir'] : date('d-m-Y');
 ?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="fieldset-form">
	<div class="portlet box grey-cascade">
	    <div class="portlet-title">
	        <div class="caption">
	            <span class="caption-subject uppercase bold">Laporan Detail Retur Penjualan Barang</span>
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
						 <button name="bar" type="button" onClick="cetak_excel()" class="btn blue"><i class="icon-printer"></i> Export Excel</button>
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
                        <th width="15%"><div align="center">TGL. RETUR</div></th>
                        <th width="10%"><div align="center">NO. RETUR</div></th>
                        <th width="10%"><div align="center">NO. TRANS</div></th>
						<th width="12%"><div align="center">KODE</div></th>
						<th width="40%">NAMA BARANG</th>
						<th width="5%"><div align="center">DISKON</div></th>
					  	<th width="10%"><div align="right">HARGA</div></th>
						<th width="5%"><div align="center">JUMLAH</div></th>
						<th width="10%"><div align="right">SUBTOTAL</div></th>
                    </tr>
				</thead>
				<tbody>
					<?php
                    if(isset($_POST['btnTampil'])){
						$tglAwal		= InggrisTgl($_POST['txtAwal']);
						$tglAkhir		= InggrisTgl($_POST['txtAkhir']);
															
						$dataSql 		= mysqli_query($koneksidb, "SELECT * FROM tr_retur_jual_item a 
														INNER JOIN tr_retur_jual b ON a.id_retur_jual=b.id_retur_jual
														INNER JOIN ms_barang c ON a.id_barang=c.id_barang
														INNER JOIN tr_penjualan d ON b.id_penjualan=d.id_penjualan
														WHERE date(b.tgl_retur_jual) BETWEEN '$tglAwal' AND '$tglAkhir' 
														ORDER BY b.tgl_retur_jual DESC");
					}
					$nomor  		= 0;
					$subtotal 		= 0;
					$total			= 0;
					$harga			= 0;
					$jumlah			= 0;
					while($dataRow	= mysqli_fetch_array($dataSql)){	
						$nomor ++;
						$total		= intval($dataRow ['jumlah_retur_jual']*($dataRow['harga_retur_jual']-($dataRow['harga_retur_jual']*$dataRow['diskon_retur_jual']/100)));
						$subtotal 	= $subtotal + $total;
						$jumlah 	= $jumlah + $dataRow ['jumlah_retur_jual'];
						$harga	 	= $harga + $dataRow ['harga_retur_jual'];
                    ?>
                    <tr>
                        <td><div align="center"><?php echo $nomor;?></div></td>
						<td><div align="center"><?php echo date('d/m/Y H:i', strtotime($dataRow ['tgl_retur_jual'])); ?> </div></td>
						<td><div align="center"><?php echo $dataRow ['kode_retur_jual']; ?></div></td>
						<td><div align="center"><?php echo $dataRow ['kode_penjualan']; ?></div></td>
						<td><div align="center"><?php echo $dataRow ['kode_barcode']; ?></div></td>
						<td><?php echo $dataRow ['nama_barang']; ?></td>
						<td><div align="center"><?php echo number_format($dataRow ['diskon_retur_jual']); ?>%</div></td>
						<td><div align="right"><?php echo number_format($dataRow ['harga_retur_jual']); ?></div></td>
						<td><div align="center"><?php echo number_format($dataRow ['jumlah_retur_jual']); ?></div></td>
						<td><div align="right"><?php echo number_format($total); ?></div></td>
                    </tr>
                    <?php } ?>
				</tbody>
				<thead>
                    <tr>
                        <th colspan="7"><div align="right">SUBTOTAL : </div></th>
						<th width="10%"><div align="right"><?php echo number_format($harga) ?></div></th>
						<th width="8%"><div align="center"><?php echo number_format($jumlah) ?></div></th>
						<th width="8%"><div align="right"><?php echo number_format($subtotal) ?></div></th>
                    </tr>
				</thead>
            </table>
	 
	</div>
</div>
<script type="text/javascript"> 
    function cetak_pdf()	 
    { 
    win=window.open('./cetak/pdf_laporan_detail_retur_jual.php?awal=<?php echo $tglAwal; ?>&akhir=<?php echo $tglAkhir ?>','win','width=1500, height=600, menubar=0, scrollbars=1, resizable=0, status=0'); 
    } 
    function cetak_excel()	 
    { 
    win=window.open('./cetak/excel_laporan_detail_retur_jual.php?awal=<?php echo $tglAwal; ?>&akhir=<?php echo $tglAkhir ?>','win','width=1500, height=600, menubar=0, scrollbars=1, resizable=0, status=0'); 
    } 
</script>