<?php $no = ($paging['limit']*$paging['current'])-$paging['limit']; 
	$no++; 
	if($list->num_rows() > 0 ) { ?>	
	<div class='row'>
		<div class='col-sm-12'>
			<div class="box box-info">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<tr class="bg-aqua" >
							<th style='width:5%;text-align:center'>No</th>
							<th style='width:10%;text-align:center'>Kode Buku</th>
							<th style='width:25%;text-align:center'>Judul Buku</th>
							<th style='width:20%;text-align:center'>Kategori</th>
							<th style='width:15%;text-align:center'>Penulis</th>
							<th style='width:10%;text-align:center'>Status</th>
							<th style='width:20%;text-align:center'>Aksi</th>
						</tr>
						<?php foreach($list->result() as $row){ ?>
							<tr>
								<td align='center'><?php echo $no; ?></td>
								<td><?php echo $row->kode_buku; ?></td>
								<td><?php echo $row->judul_buku; ?></td>
								<td><?php echo getNamaKategori($row->id_ktgr); ?></td>
								<td><?php echo $row->penulis; ?></td>
								<td align='center'><span class="label <?php echo $row->status == '1' ? 'label-success' : 'label-danger' ?> "><?php echo $row->status == '1' ? 'AKTIF' : 'TIDAK AKTIF' ?></span></td>
								<td>
									<center>
										<a href="<?php echo site_url('p/buku/detail/'.encode($row->id_buku).'/'.$row->url_buku)?>" class='btn btn-warning btn-sm ' ><i class='fa fa-search'></i> Detail</a>
										<a href="<?php echo site_url('p/buku/edit/'.encode($row->id_buku))?>" class='btn btn-info btn-sm ' ><i class='fa fa-edit'></i> Edit</a>
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