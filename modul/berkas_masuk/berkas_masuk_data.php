

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
	<div class="portlet box green">
		<div class="portlet-title">
		<div class="caption"><span class="caption-subject uppercase bold">Daftar Berkas Masuk</span></div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
				<a href="javascript:;" class="reload"></a>
				<a href="javascript:;" class="remove"></a>
			</div>
		</div>
		<div class="portlet-body"> 
            <table class="table table-striped table-bordered table-hover table-advanced" id="list_berkas">
				<thead>
                    <tr class="active">
                      	<th width="2%"><div align="center">NO </div></th>
                      	<th width="5%"><div align="center">NO BERKAS </div></th>
                      	<th width="5%"><div align="center">TAHUN</div></th>
						<th width="15%">NAMA PEMOHON</th>
						<th width="25%">JENIS KEGIATAN</th>
						<th width="15%">KECAMATAN</th>
						<th width="15%">KELURAHAN</th>
					  	<th width="8%">POSISI BERKAS</th>
                        <th width="24%">KETERANGAN BERKAS</th>
					  	<th width="15%"><div align="center">AKSI</div></th>
                    </tr>
				</thead>
				
            </table>
		</div>
	</div>
</form>
<script src="./assets/js/jquery-1.12.3.min.js"></script>
<script src="./assets/js/jquery.dataTables.min.js"></script>
<script src="./assets/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
        var dataTable = $('#list_berkas').DataTable( {
            "processing": true,
            "serverSide": true,
            "order": [
                [0, 'desc']
            ],
            "ajax":{
                url :"./ajax/data_berkas_masuk.php", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                    $(".list_berkas-error").html("");
                    $("#list_berkas").append('<tbody class="employee-grid-error"><tr><th colspan="8">No data found in the server</th></tr></tbody>');
                    $("#list_berkas_processing").css("display","none");
                    
                }
            }
        } );
    } );
</script>