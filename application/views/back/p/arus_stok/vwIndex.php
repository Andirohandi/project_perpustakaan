<style>
.callout-success{
	background-color:white;
}
</style>
<section class="content-header">
    <h1>
        Arus Stok Buku
        <small>Menejemen Arus Stok Buku</small>
    </h1>
	<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Arus Stok Buku</li>
</ol>
</section>
<br/>
<section class="content">
	<div class='row'>
		<div class="col-md-12">
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-gear'></i>  Data Arus Stok Buku</h3>
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
	
	$.ajax({
		url		: '<?php echo base_url()?>p/arus_buku/read_arus/'+i,
		type	: 'post',
		dataType: 'html',
		data	: {limit:limit,cari:cari},
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