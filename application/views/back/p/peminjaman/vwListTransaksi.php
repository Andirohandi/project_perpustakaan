<?php $no = 0; 
	$no++; 
	if($list->num_rows() > 0 ) { ?>	
	<div class='row'>
		<div class='col-sm-12'>
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover table-bordered">
					<tr>
						<th style='width:10%;text-align:center'>No</th>
						<th style='width:20%;text-align:center'>Kode Buku</th>
						<th style='width:35;text-align:center'>Judul Buku</th>
						<th style='width:15%;text-align:center'>Jumlah</th>
						<?php if($status_pmnjmn['status'] !=1){ ?>
						<th style='width:20%;text-align:center'>Aksi </th>
						<?php } ?>
					</tr>
						
						<?php foreach($list->result() as $row ){ ?>
						<tr>
							<td align='center'><?php echo $no; ?></td>
							<td><?php echo $row->kode_buku; ?></td>
							<td><?php echo $row->judul_buku; ?></td>
							<td align='center'><?php echo $row->jumlah; ?></td>
							<?php if($status_pmnjmn['status'] !=1){ ?>
							<td>
								<center>
									<a href="javascript:void(0)" class='btn btn-danger btn-sm ' onclick="hapus('<?php echo encode($row->id_peminjaman_detail_transit); ?>')"><i class='fa fa-trash'></i> Hapus</a>
								</center>
							</td>
							<?php } ?>
						</tr>
						<?php $no++; } ?>
				</table>
			</div>
		</div>
	</div>
	<?php if($status_pmnjmn['status'] !=1){ ?>
	<div class='row'>
		<div class='col-sm-12'>
			<div class="box-footer">
				<br/>
				<a href="<?php echo site_url('p/peminjaman/simpan_detail/'.encode($status_pmnjmn['id_peminjaman'])) ?>" class='btn btn-success pull-right' id='simpan' name='simpan' ><i class='fa fa-check'></i> Simpan</a>
			</div>
		</div>
	</div>
	
	<?php } } else { ?>
	<table class="table table-hover table-bordered">
		<tr>
			<th style='width:10%;text-align:center'>No</th>
			<th style='width:20%;text-align:center'>Kode Buku</th>
			<th style='width:35;text-align:center'>Judul Buku</th>
			<th style='width:15%;text-align:center'>Jumlah</th>
			<th style='width:20%;text-align:center'>Aksi</th>
		</tr>
	</table>
<?php } ?>