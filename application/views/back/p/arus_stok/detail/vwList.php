<?php $no = ($paging['limit']*$paging['current'])-$paging['limit']; 
	$no++; 
	if($list->num_rows() > 0 ) { ?>	
	<div class='row'>
		<div class='col-sm-12'>
			<div class="box">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<tr>
							<th style='width:10%;text-align:center'>No</th>
							<th style='width:30%;text-align:center'>Tanggal Trans.</th>
							<th style='width:40%;text-align:center'>Jenis Trans.</th>
							<th style='width:20%;text-align:center'>Jumlah</th>
						</tr>
						<?php foreach($list->result() as $row){ 
							$jenis = '';
							if( $row->jns_transaksi == 1 ) $jenis = "BUKU MASUK";
							else if( $row->jns_transaksi == 2 ) $jenis = "BUKU KELUAR";
							else if( $row->jns_transaksi == 3 ) $jenis = "PEMINJAMAN";
							else if( $row->jns_transaksi == 4 ) $jenis = "PENGEMBALIAN";
							else $jenis	= "Error Found";
						?>
							<tr>
								<td align='center'><?php echo $no; ?></td>
								<td><?php echo strtoupper(date("d-M-Y",strtotime($row->tgl_input))); ?></td>
								<td><?php echo $jenis; ?></td>
								<td align='center'><?php echo $row->jumlah; ?></td>
							</tr>
						<?php $no++; } ?>
					</table>
					<input type='hidden' id='current' name='current' value='<?php echo $paging['current'] ?>'>
					<input type='hidden' id='last' name='last' value='<?php echo $last ?>'>
				</div>
			</div>
		</div>
	</div>
	<div class='row'>
		<div class='col-sm-4 col-xs-12' style='margin-top:5px;margin-bottom:10px'>
			<?php echo $paging['count_row'] ?> Rows 
		</div>
		<div class='col-sm-8 col-xs-12 pull-right' style='margin-top:5px;margin-bottom:10px'>
			<?php echo $paging['list']; ?>
		</div>
	</div>
	
<?php } else { ?>

	<div class='row'>
		<div class='col-sm-12'>
			<div class="box">
				<div class="box-body">
					<br/>

						
						<h3 style='font-family:callibri;text-align:center;'><i class='fa fa-warning'></i> Data tidak tersedia</h3>
			
				</div>
			</div>
		</div>
	</div>
	
	<?php 
	} 
?>