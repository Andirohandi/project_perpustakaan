<style>
.callout-success{
	background-color:white;
}
</style>
<section class="content-header">
    <h1>
        Buku
        <small>Menejemen Buku</small>
    </h1>
	<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Buku</li>
</ol>
</section>
<br/>
<section class="content">
	<div class='row'>
		<div class="col-md-12">
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-book'></i>  Data Buku</h3>
					<div class="box-tools pull-right">
						<a href='<?php echo site_url('p/buku')?>' class="btn btn-box-tool"><i class='fa fa-refresh'></i> </a>
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
                <div class="box-body">
					<br/>
					<div class='row' style='margin-top:-20px;margin-bottom:10px'>
						<div class='col-sm-5 col-xs-12' style='margin-top:10px'>
							<a class='btn btn-success col-xs-12 col-md-4 btn-sm ' href="<?php echo site_url('p/buku/add'); ?>"><i class='fa fa-plus'></i> Tambah Buku</a>
							<br/>
						</div>
						<div class='col-sm-2 col-xs-12' style='margin-top:5px;margin-bottom:5px'>
							<select name='kategori' id='kategori' class="form-control input-sm col-sm-4 col-xs-12" onchange='pageLoad(1)'>
								<?php echo get_select_kategori_buku_all(); ?>
							</select>
						</div>
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
						<div class='row' id='loading' >
							<div class='col-md-12'>
								<div class="box">
									<div class="box-header">
											<?php echo ; ?>
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