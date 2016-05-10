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
							<th style='width:20%;text-align:center'>Kode Kategori</th>
							<th style='width:35%;text-align:center'>Nama Kategori</th>
							<th style='width:15%;text-align:center'>Status</th>
							<th style='width:25%;text-align:center'>Action</th>
						</tr>
						<?php foreach($list->result() as $row){ ?>
							<tr>
								<td align='center'><?php echo $no; ?></td>
								<td><?php echo strtoupper($row->kode_ktgr); ?></td>
								<td><?php echo strtoupper($row->nama_ktgr); ?></td>
								<td align='center'><span class="label <?php echo $row->status == '1' ? 'label-success' : 'label-danger' ?> "><?php echo $row->status == '1' ? 'AKTIF' : 'TIDAK AKTIF' ?></span></td>
								<?php $jumlah = getCountBookOnCategory($row->id_ktgr)?>
								<td>
									<center>
										<a href='javascript:void(0)' class='btn btn-info btn-sm ' onclick="get_edit('<?php echo encode($row->id_ktgr); ?>','<?php echo $row->kode_ktgr; ?>','<?php echo $row->nama_ktgr; ?>','<?php echo $row->status; ?>')"><i class='fa fa-edit'></i> Edit</a>
										
										<?php if($jumlah > 0) { ?>
											<span  data-toggle="tooltip" data-placement='top' title='Pastikan tidak ada buku dalam kategori ini' >
										<?php } ?>
											<a href='javascript:void(0)' class="btn btn-danger btn-sm  <?php echo $jumlah > 0 ? 'disabled' : ''; ?>" onclick="hapus('<?php echo encode($row->id_ktgr); ?>')" ><i class='fa fa-trash'></i> Hapus </a>
										<?php if($jumlah > 0) { ?>
											</span>
										<?php } ?>
										
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