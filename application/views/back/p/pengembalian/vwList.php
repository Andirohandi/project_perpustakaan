<?php $no = ($paging['limit']*$paging['current'])-$paging['limit']; 
	$no++; 
	if($list->num_rows() > 0 ) { ?>	
	<div class='row'>
		<div class='col-sm-12'>
			<div class="box box-info">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<tr class="bg-aqua">
							<th style='width:5%;text-align:center'>No</th>
							<th style='text-align:center'>No Pengembalian</th>
							<th style='text-align:center'>Tgl Pengembalian</th>
							<th style='text-align:center'>No Peminjaman</th>
							<th style='text-align:center'>Tgl Peminjaman</th>
							<th style='text-align:center'>Denda</th>
							<th style='text-align:center'>Aksi</th>
						</tr>
						<?php foreach($list->result() as $row){ ?>
							<tr>
								<td align='center'><?php echo $no; ?></td>
								<td><?php echo $row->nomor_pengembalian; ?></td>
								<td align='center' ><?php echo date("d-M-Y",strtotime($row->tgl_pengembalian)); ?></td>
								<td><?php echo $row->nomor_peminjaman; ?></td>
								<td align='center'><?php echo date("d-M-Y",strtotime($row->tgl_peminjaman)); ?></td>
								<td align="center"><?php echo $row->denda > 0 ? 'Rp. '.number_format($row->denda) : '-' ; ?></td>
								<td>
									<center>
										<a href="<?php echo site_url('p/pengembalian/detail/'.encode($row->id_pengembalian))?>" class='btn btn-primary btn-sm' ><i class='fa fa-search'></i> Detail</a>
										<a href="<?php echo site_url('p/pengembalian/detail/'.encode($row->id_pengembalian))?>" class='btn btn-danger btn-sm hide' ><i class='fa fa-remove'></i> Batal</a>
									</center>
								</td>
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
					<?php if( $key == ''){ ?>
						
						<h3 style='font-family:callibri;text-align:center;'><i class='fa fa-warning'></i> Data masih kosong</h3>
			
					<?php } else { ?>
					
						<h3 style='font-family:callibri;text-align:center;'><i class='fa fa-warning'></i> Data yang anda cari tidak ada</h3>
						
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	<?php 
	} 
?>