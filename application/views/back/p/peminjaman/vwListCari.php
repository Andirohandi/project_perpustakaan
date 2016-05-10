<?php $no = ($paging['limit']*$paging['current'])-$paging['limit']; 
	$no++; 
	if($list->num_rows() > 0 ) { ?>	
	<div class='row'>
		<div class='col-sm-12'>
			<div class="box">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<tr>
							<th style='width:5%;text-align:center'>No</th>
							<th style='width:20%;text-align:center'>No Peminjam</th>
							<th style='width:10%;text-align:center'>Tgl Pinjam</th>
							<th style='width:10%;text-align:center'>Tgl Kembali</th>
							<th style='width:15%;text-align:center'>ID Peminjam</th>
							<th style='width:15%;text-align:center'>Nama</th>
							<th style='width:10%;text-align:center'>Status Peminjam</th>
							<th style='width:10%;text-align:center'>Aksi</th>
						</tr>
						<?php foreach($list->result() as $row){ 
							$status = '';
							$id		= '';
							$nama = '';
							
							if($row->id_kategori_anggota == 1){
								$status = 'AKADEMIK';
							}else if($row->id_kategori_anggota == 2){
								$status = 'DOSEN';
							}else if($row->id_kategori_anggota == 3){
								$status = 'MAHASISWA';
							}else{
								$status = 'Error Found';
							}
							
							$terlambat	= 0;
							$denda		= 0;
							$tgl_kembali = $row->tgl_perpanjangan != '0000-00-00 00:00:00' ? $row->tgl_perpanjangan : $row->tgl_kembali;
							$tgl_perpanjangan	= $row->tgl_perpanjangan != '0000-00-00 00:00:00' ? date("d-M-Y",strtotime($row->tgl_perpanjangan)) : '-';
							
							$tgl1 = GregorianToJD(date('m',strtotime($tgl_kembali)), date('d',strtotime($tgl_kembali)), date('Y',strtotime($tgl_kembali)));
							$tgl2 = GregorianToJD(date('m'), date('d'), date('Y'));
							
							$hasil = $tgl2 - $tgl1;
							
							$getSetting = $this->m_setting->getAll();
							
							if($hasil >= 1){
								$terlambat 	= $hasil;
								$denda		= $hasil * $getSetting['denda'];
							}else{
								$terlambat 	= 0;
								$denda		= 0;
							}
							
						?>
							<tr>
								<td align='center'><?php echo $no; ?></td>
								<td><?php echo $row->nomor_peminjaman; ?></td>
								<td align='center'><?php echo date('d-M-Y',strtotime($row->tgl_peminjaman)); ?></td>
								<td align='center'><?php echo date('d-M-Y',strtotime($row->tgl_kembali)); ?></td>
								<td align='center'><?php echo $row->nip_nim_anggota ?></td>
								<td align='center'><?php echo $row->nama_anggota ?></td>
								<td align='center'><?php echo $status; ?></td>
								<td>
									<center>
										<a href="javascript:void(0)" class='btn btn-primary btn-sm' onclick="getDataPeminjaman('<?php echo encode($row->id_peminjaman); ?>','<?php echo $row->nomor_peminjaman ?>','<?php echo date("d-M-Y",strtotime($row->tgl_peminjaman)); ?>','<?php echo $row->nama_anggota ?>','<?php echo $status ?>','<?php echo $terlambat ?>', '<?php echo $denda; ?>','<?php echo date("d-M-Y",strtotime($row->tgl_kembali)); ?>','<?php echo $tgl_perpanjangan ; ?>','<?php echo $row->nip_nim_anggota; ?>')" ><i class='fa fa-check'></i> </a>
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
						
						<h3 style='font-family:callibri;text-align:center;'><i class='fa fa-warning'></i> Data tidak ditemukan</h3>
			
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