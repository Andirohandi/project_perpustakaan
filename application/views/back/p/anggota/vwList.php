<?php $no = ($paging['limit']*$paging['current'])-$paging['limit']; 
	$no++; 
	if($list->num_rows() > 0 ) { ?>	
	<div class='row'>
		<div class='col-sm-12'>
			<div class="box box-info">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<tr class="bg-aqua" >
							<th style='width:3%;text-align:center'>No</th>
							<th style='width:10%;text-align:center'><?php echo $ktgr == '3' ? 'NIM' : 'NIP' ; ?></th>
							<th style='width:15%;text-align:center'>Nama</th>
							<?php if($ktgr == 3){ ?>
								<th style='width:15%;text-align:center'>Jurusan</th>
							<?php } ?>
							
							<th style='width:15%;text-align:center'>Tmpt Tgl Lahir</th>
							<th style='width:15%;text-align:center'>Alamat Tinggal</th>
							<th style='width:10%;text-align:center'>Jenis Kelami</th>
							<th style='width:20%;text-align:center'>Aksi</th>
						</tr>
						<?php foreach($list->result() as $row){ ?>
							<tr>
								<td align='center'><?php echo $no; ?></td>
								<td><?php echo $row->nip_nim_anggota; ?></td>
								<td><?php echo $row->nama_anggota; ?></td>
								
								<?php if($ktgr == 3){ ?>
									<td><?php echo $row->nama_jurusan; ?></td>
								<?php } ?>
								
								<td ><?php echo $row->tempat_lahir.", ".date("d M Y", strtotime($row->tanggal_lahir)); ?></td>
								<td><?php echo $row->alamat_anggota; ?></td>
								<td align='center' ><?php echo $row->jk_anggota; ?></td>
								<td>
									<center>
										<a href="<?php echo site_url('p/anggota/edit/'.encode($row->id_anggota))?>" class='btn btn-info btn-sm ' ><i class='fa fa-edit'></i> Edit</a>
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
					<?php if( $key == '' && $ktgr == '' ){ ?>
						
						<h3 style='font-family:callibri;text-align:center;'><i class='fa fa-warning'></i> Data Buku masih kosong</h3>
			
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