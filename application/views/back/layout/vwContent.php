<section class="content-header">
    <h1>
        Dashboard
        <small>Menejemen Dashboard</small>
    </h1>
	<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"></li>
</ol>
</section>
<br/>


<section class="content">
	
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?php echo $buku; ?></h3>
					<p>Buku</p>
				</div>
				<div class="icon">
					<i class="fa fa-book"></i>
				</div>
				<a href="<?php echo site_url('p/buku')?>" class="small-box-footer">
					Selengkapnya <i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-purple">
				<div class="inner">
					<h3><?php echo $anggota; ?></h3>
					<p>Anggota</p>
				</div>
				<div class="icon">
					<i class="fa fa-users"></i>
				</div>
				<a href="javascript:void(0)" class="small-box-footer">
					Selengkapnya <i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-orange">
				<div class="inner">
					<h3><?php echo $pnj; ?></h3>
					<p>Transaksi Peminjaman</p>
				</div>
				<div class="icon">
					<i class="fa fa-gears"></i>
				</div>
				<a href="<?php echo site_url('p/peminjaman')?>" class="small-box-footer">
					Selengkapnya <i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-red">
				<div class="inner">
					<h3><?php echo $pmb; ?></h3>
					<p>Transaksi Pengembalian</p>
				</div>
				<div class="icon">
					<i class="fa fa-gear"></i>
				</div>
				<a href="<?php echo site_url('p/booking/data/'.encode(1))?>" class="small-box-footer">
					Selengkapnya <i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
	</div>
	
	<div class='row'>
		<div class="col-md-12">
			<br/><br/>
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-search'></i>  Cari Buku</h3>
					<div class="box-tools pull-right">
						<a href='<?php echo site_url('p/buku')?>' class="btn btn-box-tool"><i class='fa fa-refresh'></i> </a>
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
								<option value='25' >25 rows</option>
							</select>
						</div>
						<div class='col-sm-3 col-xs-12 pull-right' style='margin-top:5px;margin-bottom:5px'>
							<div class="input-group pull-right">
								<input type="text" name="cari" id='cari' class="form-control input-sm col-sm-4 col-xs-12" placeholder="Cari Buku . . ." onchange='pageLoad(1)'>
								<div class="input-group-btn">
									<button class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>
						<div class='col-sm-3 col-xs-12 pull-right' style='margin-top:5px;margin-bottom:5px'>
							<select name='kategori' id='kategori' class="form-control input-sm col-sm-4 col-xs-12" onchange='pageLoad(1)'>
								<?php echo get_select_kategori_buku_all(); ?>
							</select>
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
	var cari 		= $('#cari').val();
	var kategori 	= $('#kategori').val();
	
	$.ajax({
		url		: '<?php echo base_url()?>p/buku/read_dashboard/'+i,
		type	: 'post',
		dataType: 'html',
		data	: {limit:limit,cari:cari,kategori:kategori},
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