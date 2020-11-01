
<?php							
	$tglAwal		= isset($_POST['txtAwal']) ? $_POST['txtAwal'] : date('d-m-Y');
	$tglAkhir		= isset($_POST['txtAkhir']) ? $_POST['txtAkhir'] : date('d-m-Y');
 ?>
     	
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="fieldset-form">
	<div class="portlet box grey-cascade">
	    <div class="portlet-title">
	        <div class="caption">
	            <span class="caption-subject uppercase bold">Laporan Barang & Produk</span>
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
                      	<th width="7%">KODE</th>
						<th width="19%">KATEGORI</th>
                      	<th width="42%"><div align="left">NAMA BARANG</div></th>
						<th width="19%">MERK & BRAND</th>
			  	  	  	<th width="5%"><div align="center">STATUS</div></th>
			  	  	  	<th width="5%"><div align="center">JUAL</div></th>
			  	  	  	<th width="5%"><div align="center">RETUR</div></th>
                    </tr>
				</thead>
				<tbody>
                    <?php
                    if(isset($_POST['btnTampil'])){
						
						$tglAwal		= InggrisTgl($_POST['txtAwal']);
						$tglAkhir		= InggrisTgl($_POST['txtAkhir']);
															
						$dataSql = mysqli_query($koneksidb, "SELECT * FROM (SELECT
												a.kode_barcode,
												a.nama_barang,
												b.kode_kategori,
												b.nama_kategori,
												c.nama_merk,
												a.status_barang,
												(SELECT SUM(jumlah_penjualan) FROM tr_penjualan_item a1
												INNER JOIN tr_penjualan b1 ON a1.id_penjualan=b1.id_penjualan
												WHERE a1.id_barang=a.id_barang
												AND date(b1.tgl_penjualan) BETWEEN '$tglAwal' AND '$tglAkhir'
												) AS total_jual,
												(SELECT SUM(jumlah_retur_jual) FROM tr_retur_jual_item a1
												INNER JOIN tr_retur_jual b1 ON a1.id_retur_jual=b1.id_retur_jual
												WHERE a1.id_barang=a.id_barang
												AND date(b1.tgl_retur_jual) BETWEEN '$tglAwal' AND '$tglAkhir'
												) AS total_retur_jual
												FROM ms_barang a
												LEFT JOIN ms_kategori b ON a.id_kategori=b.id_kategori
												LEFT JOIN ms_merk c ON a.id_merk=c.id_merk) as tbl order by total_jual DESC ")
						or die ("gagal tampil".mysqli_error());
					}
					$nomor  		= 0;
					$jual			= 0;
					$returjual		= 0;
					while($dataRow	= mysqli_fetch_array($dataSql)){
						$nomor ++;
						$jual		= $jual + $dataRow['total_jual'];
						$returjual	= $returjual + $dataRow['total_retur_jual'];
						
                    ?>
                    <tr>
                        <td><div align="center"><?php echo $nomor;?></div></td>
						<td><?php echo $dataRow['kode_barcode']; ?></td>
						<td><?php echo $dataRow['nama_kategori']; ?></td>
						<td><div align="left"><?php echo $dataRow['nama_barang']; ?></div></td>
						<td><?php echo $dataRow['nama_merk']; ?></td>
						<td><div align="center">
					        <?php 
							if($dataRow['status_barang']=='Active'){
								echo "<label class='label label-success'>Active</label>";
							}else{
								echo "<label class='label label-danger'>Non Active</label>";
							}
							?>						
			            </div></td>
                        <td><div align="center"><?php echo number_format($dataRow['total_jual']); ?></div></td>
                        <td><div align="center"><?php echo number_format($dataRow['total_retur_jual']); ?></div></td>
                    </tr>
                    <?php } ?>
				</tbody>
				<tfoot>
                    <tr>
               	  	  	<th colspan="6"><div align="right"><b>SUBTOTAL : </b></div></th>
					  	<th width="7%"><b><div align="center"><?php echo number_format($jual); ?></div></b></th>
					  	<th width="8%"><b><div align="center"><?php echo number_format($returjual); ?></div></b></th>
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
    win=window.open('./cetak/pdf_laporan_barang.php?awal=<?php echo $tglAwal; ?>&akhir=<?php echo $tglAkhir ?>','win','width=1500, height=600, menubar=0, scrollbars=1, resizable=0, status=0'); 
    } 
     function cetak_exl()	 
    { 
    win=window.open('./cetak/excel_laporan_barang.php?awal=<?php echo $tglAwal; ?>&akhir=<?php echo $tglAkhir ?>','win','width=1500, height=600, menubar=0, scrollbars=1, resizable=0, status=0'); 
    } 
</script>