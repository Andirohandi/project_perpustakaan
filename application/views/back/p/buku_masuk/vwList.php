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
							<th style='width:10%;text-align:center'>Kode Buku</th>
							<th style='width:25%;text-align:center'>Judul</th>
							<th style='width:10%;text-align:center'>Jumlah Masuk</th>
							<th style='width:10;text-align:center'>Tanggal</th>
							<th style='width:15%;text-align:center'>Keterangan</th>
							<th style='width:25%;text-align:center'>Aksi</th>
						</tr>
						<?php foreach($list->result() as $row){ ?>
							<tr>
								<td align='center'><?php echo $no; ?></td>
								<td><?php echo $row->kode_buku; ?></td>
								<td><?php echo $row->judul_buku; ?></td>
								<td align='center'><?php echo $row->jumlah; ?></td>
								<td align='center'><?php  echo date('d-M-y', strtotime($row->tgl_input)); ?></td>
								<td><?php  echo $row->keterangan; ?></td>
								<td>
									<center>
										<a href="<?php echo site_url('p/arus_buku/cetak_label/'.encode($row->id_buku_masuk).'/'.encode($row->id_buku))?>" class="btn btn-warning btn-sm " ><i class='fa fa-print'></i> Label </a>
										<a href='javascript:void(0)' class="btn btn-danger btn-sm " onclick="hapus('<?php echo encode($row->id_buku_masuk); ?>','<?php echo $row->jumlah ?>','<?php echo encode($row->id_buku); ?>')" ><i class='fa fa-trash'></i> Hapus </a>
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
					<?php if( $key == '' ){ ?>
						
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