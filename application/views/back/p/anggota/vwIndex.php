<?php 

	if($id_kategori == 1){
		$kategori = "Akademik";
	}else if($id_kategori == 2){
		$kategori = "Dosen";
	}else if($id_kategori == 3){
		$kategori = "Mahasiswa";
	}else{
		$kategori = "Error Found";
	}
?>

<style>
.callout-success{
	background-color:white;
}
</style>
<section class="content-header">
    <h1>
        Anggota - <?php echo $kategori; ?>
        <small>Menejemen Anggota <?php echo $kategori; ?></small>
    </h1>
	<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Anggota <?php echo $kategori; ?></li>
</ol>
</section>
<br/>
<section class="content">
	<div class='row'>
		<div class="col-md-12">
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-book'></i>  Data Anggota <?php echo $kategori; ?></h3>
					<div class="box-tools pull-right">
						<a href='<?php echo site_url('p/anggota')?>' class="btn btn-box-tool"><i class='fa fa-refresh'></i> </a>
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
                <div class="box-body">
					<br/>
					<div class='row' style='margin-top:-20px;margin-bottom:10px'>
						<div class='col-sm-3 col-xs-12 pull-right' style='margin-top:5px;margin-bottom:5px'>
							<div class="input-group pull-right">
								<input type="text" name="cari" id='cari' class="form-control input-sm col-sm-4 col-xs-12" placeholder="Cari <?php echo $id_kategori == 3 ? 'NIM' : 'NIP' ?> / Nama Anggota . . ." onchange='pageLoad(1)'>
								<div class="input-group-btn">
									<button class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>
						<div class='col-sm-2 col-xs-12' style='margin-top:5px;margin-bottom:5px'>
							<select name='limit' id='limit' class="form-control input-sm col-sm-4 col-xs-12" onchange='pageLoad(1)'>
								<option value='5' >5 rows</option>
								<option value='10' >10 rows</option>
								<option value='25' >25 rows</option>
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
	var kategori 	= "<?php echo $id_kategori; ?>";
	
	$.ajax({
		url		: '<?php echo base_url()?>p/anggota/read/'+i,
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