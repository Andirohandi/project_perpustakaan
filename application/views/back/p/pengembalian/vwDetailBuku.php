<div class="box">
	<div class="box-body table-responsive no-padding">
		<table class="table table-hover table-bordered">
			<tr>
				<th style='width:5%;text-align:center'>No</th>
				<th style='width:10%;text-align:center'>Kode Buku</th>
				<th style='width:40%;text-align:center'>Judul</th>
				<th style='width:10%;text-align:center'>Jumlah</th>
				<th style='width:20%;text-align:center'>Status Buku</th>
				<th style='width:20%;text-align:center'>Denda</th>
			</tr>
			<?php $no=1; foreach($detail_buku->result() as $row){ ?>
				<tr>
					<td align='center'><?php echo $no; ?></td>
					<td><?php echo $row->kode_buku; ?></td>
					<td  align='center'><?php echo $row->judul_buku; ?></td>
					<td><?php echo $row->jumlah; ?></td>
					<td>
						<select class='form-control' name='status_buku[]' id='status_buku[]'>
							<option value='' >OK</option>
							<option value="Hilang" >Hilang</option>
							<option value="Rusak" >Rusak</option>
						</select>
					</td>
					<td>
						<input type='text' name='denda[]' id='denda[]' class='form-control' placeholder="Rp." />
						<input type='hidden' name='id_buku[]' id='id_buku[]' class='form-control' value="<?php echo $row->id_buku; ?>" />
						<input type='hidden' name='jumlah[]' id='jumlah[]' class='form-control' value="<?php echo $row->jumlah; ?>" />
					</td>
				</tr>
			<?php $no++; } ?>
		</table>
	</div>
</div>

