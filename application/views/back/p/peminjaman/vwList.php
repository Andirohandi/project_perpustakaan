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
							<th style='width:10%;text-align:center'>No Peminjam</th>
							<th style='width:8%;text-align:center'>Tgl Pinjam</th>
							<th style='width:8%;text-align:center'>Tgl Jth Tmpo</th>
							<th style='width:8%;text-align:center'>NIP / NIM</th>
							<th style='width:8%;text-align:center'>Nama Peminjam</th>
							<th style='width:8%;text-align:center'>Kategori Peminjam</th>
							<th style='width:8%;text-align:center'>Status</th>
							<th style='width:10%;text-align:center'>Aksi</th>
						</tr>
						<?php foreach($list->result() as $row){ 
							$status = '';
							if($row->id_kategori_anggota == 1){
								$status = 'Akademik';
							}else if($row->id_kategori_anggota == 2){
								$status = 'Dosen';
							}else if($row->id_kategori_anggota == 3){
								$status = 'Mahasiswa';
							}else{
								$status = 'Error Found';
							}
							
							$pmb = $this->m_pengembalian->getCount(array("a.id_peminjaman" => $row->id_peminjaman));
						?>
							<tr>
								<td align='center'><?php echo $no; ?></td>
								<td><?php echo $row->nomor_peminjaman; ?></td>
								<td align='center'><?php echo date('d-M-Y',strtotime($row->tgl_peminjaman)); ?></td>
								<td align='center'><?php echo date('18-M-Y',strtotime($row->tgl_kembali)); ?></td>
								<td align='center'><?php echo $row->nip_nim_anggota; ?></td>
								<td align='center'><?php echo $row->nama_anggota; ?></td>
								<td align='center'><?php echo $status; ?></td>
								<td align='center'><?php echo $pmb > 0 ? 'Sudah dikembalikan' : '-' ; ?></td>
								<td>
									<center>
										<?php if($row->status == 0){  ?>
											<a href="<?php echo site_url('p/peminjaman/add_detail/'.encode($row->id_peminjaman))?>" class='btn btn-primary btn-sm' ><i class='fa fa-warning'></i> Konfirmasi Transaksi </a>
											<a href="javascript:void(0)" class='btn btn-danger btn-sm' onclick="hapus('<?php echo encode($row->id_peminjaman); ?>')"><i class='fa fa-trash'></i> Hapus</a>
										<?php } else { ?>
											<a href="<?php echo site_url('p/peminjaman/add_detail/'.encode($row->id_peminjaman))?>" class='btn btn-warning btn-sm' ><i class='fa fa-list'></i> Detail</a>
										<?php  } ?>
										
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