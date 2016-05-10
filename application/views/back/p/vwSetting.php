<?php 
	$set 	= $this->m_setting->getAll();
?>

<section class="content-header">
    <h1>
        Setting
        <small>Setting Perpustakaan</small>
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
					<h3 class="box-title"><i class='fa fa-gear'></i> Setting Perpustakaan</h3>
					<div class="box-tools pull-right">
						<a href='<?php echo site_url('p/buku')?>' class="btn btn-box-tool"><i class='fa fa-refresh'></i> </a>
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
                <div class="box-body">
					<br/>
						<div class='col-md-12'>
							<?php if($this->session->flashdata('rs')==1) { ?>
								<div class='alert alert-success'>
									<button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
									<i class='fa fa-check'></i> Data Berhasil Disimpan
								</div>
							<?php } else if($this->session->flashdata('rs')==2){ ?>
								<div class='alert alert-danger'>
									<button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
									<i class='fa fa-warning'></i> Data Gagal Disimpan
								</div>
							<?php } else { }?>
						</div>
						<div class="col-md-12">
							<form class="form-horizontal" action="<?php echo site_url('setting/simpan'); ?>" method="POST" >
							  	<div class="form-group">
							    <label for="nama" class="col-sm-3 control-label">Nama Perpustakaan</label>
								    <div class="col-sm-8">
								    	<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Perpustakaan" required="required" value="<?php echo $set['nama_perpustakaan'] ?>">
								    </div>
							 	 </div>
							  	<div class="form-group">
								    <label for="lama" class="col-sm-3 control-label">Lama Peminjaman (hr)</label>
								    <div class="col-sm-8">
								     	<input type="number" class="form-control" id="lama" name="lama" placeholder="Lama Peminjaman.." required="required" value="<?php echo $set['lama_peminjaman'] ?>" >
								    </div>
							  	</div>
							  	<div class="form-group">
								    <label for="denda" class="col-sm-3 control-label">Denda Keterlambatan / hari</label>
								    <div class="col-sm-8">
								     	<input type="number" class="form-control" id="denda" name="denda" placeholder="Lama Keterlambatan.." required="required" value="<?php echo $set['denda'] ?>" >
								    </div>
							  	</div>
							 	<div class="form-group">
								    <div class="col-sm-offset-3 col-sm-8">
								      	<button type="submit" class="btn btn-success" name="simpan"><i class="fa fa-check"></i> Simpan</button>
								    </div>
							  	</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
