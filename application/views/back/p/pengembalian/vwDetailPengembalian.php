
<section class="content-header">
    <h1>
        Pengembalian Buku
        <small>Menejemen  Pengembalian Buku</small>
    </h1>
	<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li><a href="<?php echo base_url('p/pengembalian')?>"> Pengembalian Buku</a></li>
    <li class="active">Detail  Pengembalian Buku</li>
</ol>
</section>
<br/>
<section class="content">
	<div class='row'>
		<div class="col-md-12">
			<div class="box box-info box-solid no-border">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-bookmark'></i> Detail Pengembalian Buku</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
				<div class="box-body">
					<br/>
					<div class='row' style='margin-top:-20px;margin-bottom:10px'>
						<div class='col-md-5'>
							<table class='table no-border'>
								<tr>
									<td>No. Pengembalian</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo $pmb['nomor_pengembalian']; ?></b></td>
								</tr>
								<tr>
									<td>Tgl Pengembalian</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo date('d-M-Y',strtotime($pmb['tgl_pengembalian'])); ?></b></td>
								</tr>
								<tr>
									<td>Terlambat (hr)</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo $pmb['keterlambatan'] != 0 ? $pmb['keterlambatan'].' hari' : '-'; ?></b></td>
								</tr>
								<tr>
									<td>Denda</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo $pmb['denda'] != 0 ? 'Rp. '.number_format($pmb['denda']) : '-'; ?></b></td>
								</tr>
							</table>
						</div>
						<div class='col-md-4'>
							<table class='table no-border'>
								<tr>
									<td>No. Peminjaman</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo $no_peminjaman; ?></b></td>
								</tr>
								<tr>
									<td>Tgl Peminjaman</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo date('d-M-Y',strtotime($tgl_peminjaman)); ?></b></td>
								</tr>
								<tr>
									<td>Tgl Jatuh Tempo</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo date('d-M-Y',strtotime($tgl_kembali)); ?></b></td>
								</tr>
							</table>
						</div>
						<div class='col-md-3'>
							<table class='table no-border'>
								<tr>
									<td>NIP / NIM Peminjam</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo $nip_nim; ?></b></td>
								</tr>
								<tr>
									<td>Nama Peminjam</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo $nama_peminjam; ?></b></td>
								</tr>
								<tr>
									<td>Kategori</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo $status; ?></b></td>
									<input type='hidden' id='status' name='status' value='<?php echo $status_pmnjmn ?>' >
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-bookmark'></i> Detail Buku</h3>
					<div class="box-tools pull-right">
						<a href="javascript:void(0)" nclick="pageLoad()" class="btn btn-box-tool"><i class='fa fa-refresh'></i> </a>
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
				
				<div class="box-body">
					<div class='row'>
						<div class='col-sm-12'>
							<div class="box-body table-responsive no-padding">
								<table class="table table-hover table-bordered">
									<tr>
										<th style='text-align:center'>No</th>
										<th style='text-align:center'>Kode Buku</th>
										<th style='text-align:center'>Judul Buku</th>
										<th style='text-align:center'>Jumlah</th>
										<th style='text-align:center'>Status</th>
										<th style='text-align:center'>Denda</th>
									</tr>
									<?php $detail = $this->m_pengembalian->getDataPmbDetail(array( "a.id_pengembalian" => $pmb['id_pengembalian'])); $no = 1;
										foreach($detail->result() as $row) { ?>
										<tr>
											<td align="center"><?php echo $no; ?></td>
											<td><?php echo $row->kode_buku; ?></td>
											<td><?php echo $row->judul_buku; ?></td>
											<td align="center"><?php echo $row->jumlah; ?></td>
											<td><?php echo $row->status_buku; ?></td>
											<td align="right"><?php echo $row->denda == 0 ? '-' : 'Rp. '.number_format($row->denda); ?></td>
										</tr>
										<?php $no++; } ?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
$(document).ready(function(){
	//pageLoad(1);
})
</script>