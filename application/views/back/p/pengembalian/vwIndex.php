
<section class="content-header">
    <h1>
        Pengembalian Buku
        <small>Menejemen Pengembalian Buku</small>
    </h1>
	<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Pengembalian Buku</li>
</ol>
</section>
<br/>
<section class="content">
	<div class='row'>
		<div class="col-md-12">
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-book'></i> Data Pengembalian Buku</h3>
					<div class="box-tools pull-right">
						<a href='javascript:void(0)' onclick='pageLoad(1)' class="btn btn-box-tool"><i class='fa fa-refresh'></i> </a>
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
                <div class="box-body">
					<br/>
					<div class='row' style='margin-top:-20px;margin-bottom:10px'>
						<div class='col-sm-5 col-xs-12' style='margin-top:10px'>
						<a class='btn btn-success col-xs-12 col-md-4 btn-sm' href="<?php echo site_url('p/pengembalian/add'); ?>"><i class='fa fa-plus'></i> Tambah Pengembalian</a>
							<br/>
						</div>
						<div class='col-sm-3 col-xs-12 pull-right' style='margin-top:5px;margin-bottom:5px'>
							<div class="input-group pull-right">
								<input type="text" name="cari" id='cari' class="form-control input-sm col-sm-5 col-xs-12" placeholder="Cari nomor pengembalian/peminjaman . . ." onchange='pageLoad(1)'>
								<div class="input-group-btn">
									<button class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>
						<div class='col-sm-2 col-xs-12 pull-right' style='margin-top:5px;margin-bottom:5px'>
							<select name='limit' id='limit' class="form-control input-sm col-sm-4 col-xs-12" onchange='pageLoad(1)'>
								<option value='5' >5 rows</option>
								<option value='10' >10 rows</option>
								<option value='25' >25 rows</option>
							</select>
						</div>
						<div class='col-sm-2 col-xs-12 pull-right' style='margin-top:5px;margin-bottom:5px'>
							<input type='text' name='tanggal' id='tanggal' class="form-control input-sm " onchange='pageLoad(1)' value="<?php echo date('m/01/Y').' - '.date('m/t/Y')?>">
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
	$('#tanggal').daterangepicker();
});

function pageLoad(i){
	var limit 		= $('#limit').val();
	var cari 		= $('#cari').val();
	var tanggal		= $('#tanggal').val();
	
	$.ajax({
		url		: '<?php echo base_url()?>p/pengembalian/read/'+i,
		type	: 'post',
		dataType: 'html',
		data	: {limit:limit,cari:cari,tanggal:tanggal},
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