
<section class="content-header">
    <h1>
        Arus Stok Buku
        <small>Menejemen Arus Stok Buku</small>
    </h1>
	<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url('p/arus_buku')?>"> Arus Stok Buku</a></li>
    <li class="active">Detail Arus Buku</li>
</ol>
</section>
<br/>
<section class="content">
	<div class='row'>
		<div class="col-md-4">
			<div class="box box-info box-solid no-border">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-bookmark'></i>  Detail Buku</h3>
					<div class="box-tools pull-right">
						<a href='<?php echo site_url('p/arus_buku')?>' class="btn btn-box-tool"><i class='fa fa-refresh'></i> </a>
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
                <div class="box-body">
					<br/>
					<div class='row' style='margin-top:-20px;margin-bottom:10px'>
						<div class='col-md-12'>
							<table class='table no-border'>
								<tr>
									<td>Kode Buku</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo $buku['kode_buku']; ?></b></td>
								</tr>
								<tr>
									<td>Judul Buku</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo $buku['judul_buku']; ?></b></td>
								</tr>
								<tr>
									<td>Penulis</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo $buku['penulis']; ?></b></td>
								</tr>
								<tr>
									<td>Penerbit</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo $buku['penerbit']; ?></b></td>
								</tr>
							</table>
							<input type='hidden' name='id_buku' id='id_buku' value="<?php echo encode($buku['id_buku']); ?>" />
						</div>
					</div>
				</div>
				<div class='box-footer'>
					<a href="<?php echo site_url('p/arus_buku'); ?>" class='btn btn-primary' ><i class='fa fa-arrow-circle-left'></i> Kembali</a>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-bookmark'></i>  Detail Arus Buku</h3>
					<div class="box-tools pull-right">
						<a href='<?php echo site_url('p/arus_buku')?>' class="btn btn-box-tool"><i class='fa fa-refresh'></i> </a>
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
                <div class="box-body">
					<br/>
					<div class='row' style='margin-top:-20px;margin-bottom:10px'>
						<div class='col-sm-2 col-xs-12' style='margin-top:5px;margin-bottom:5px'>
							<select name='limit' id='limit' class="form-control input-sm col-sm-4 col-xs-12" onchange='pageLoad(1)'>
								<option value='5' >5 rows</option>
								<option value='10' >10 rows</option>
								<option value='25' selected >25 rows</option>
							</select>
						</div>
						<div class='col-sm-4 col-xs-12 pull-right' style='margin-top:5px;margin-bottom:5px'>
							<div class="input-group pull-right">
								<select name='jenis' id='jenis' class='form-control' onchange="pageLoad(1)">
									<option value='' >-- Pilih Jenis Transaksi --</option>
									<option value='1' >BUKU MASUK</option>
									<option value='2' >BUKU KELUAR</option>
									<option value='3' >PEMINJAMAN</option>
									<option value='4' >PENGELUARAN</option>
								</select>
							</div>
						</div>
					</div>
					<div id='dataList'>
						<div class='row' id='loading' style="display:none">
							<div class='col-md-12'>
								<div class="box">
									<div class="box-header">
										
									</div>
									<div class="box-body">
									 
									</div>
									<div class="overlay">
										<i class="fa fa-spinner fa-pulse fa-5x"></i>
									</div>
								</div>
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
	pageLoad(1);
});

function pageLoad(i){
	var limit 		= $('#limit').val();
	var jenis 		= $('#jenis').val();
	var id_buku		= $('#id_buku').val();
	
	$.ajax({
		url		: '<?php echo base_url()?>p/arus_buku/read_detail_arus/'+i,
		type	: 'post',
		dataType: 'html',
		data	: {limit:limit,jenis:jenis,id_buku:id_buku},
		beforeSend : function(){
			$('#loading').fadeIn('slow');
		},
		success : function(result){
			$('#loading').attr('style','display:none');
			$('#dataList').html(result);
		}
	})
}
</script>