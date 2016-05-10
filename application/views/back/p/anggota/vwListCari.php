<?php $no = ($paging['limit']*$paging['current'])-$paging['limit']; 
	$no++; 
	if($list->num_rows() > 0 ) { ?>	
	<div class='row'>
		<div class='col-sm-12'>
			<div class="box box-info">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<tr>
							<th style='width:5%;text-align:center'>No</th>
							<th style='width:10%;text-align:center'>Kode Anggota</th>
							<th style='width:35%;text-align:center'>Nama</th>
							<th style='width:20%;text-align:center'>Status</th>
							<th style='width:10%;text-align:center'>Aksi</th>
						</tr>
						<?php foreach($list->result() as $row){ ?>
							<tr>
								<td align='center'><?php echo $no; ?></td>
								<td><?php echo $row->nip_nim_anggota; ?></td>
								<td><?php echo $row->nama_anggota; ?></td>
								<td><?php echo $row->nama_kategori_anggota; ?></td>
								<td>
									<center>
										<a href="javascript:void(0)" class='btn btn-info btn-sm' onclick="getDataUser('<?php echo encode($row->id_anggota)?>','<?php echo $row->nip_nim_anggota; ?>','<?php echo $row->nama_anggota; ?>','<?php echo $row->id_kategori_anggota; ?>','<?php echo $row->nama_kategori_anggota; ?>')" data-dismis='modal'><i class='fa fa-check'></i></a>
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
						
						<h3 style='font-family:callibri;text-align:center;'><i class='fa fa-warning'></i> Data peminjam masih kosong</h3>
			
					<?php } else { ?>
					
						<h3 style='font-family:callibri;text-align:center;'><i class='fa fa-warning'></i> Data peminjam anda cari tidak ada</h3>
						
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	<?php 
	} 
?>