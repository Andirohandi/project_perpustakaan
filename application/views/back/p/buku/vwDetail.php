<link rel="stylesheet" href="<?php echo base_url()?>assets/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url()?>assets/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<style>
.drop-area{
  width:100px;
  height:45px;
  border: 1px solid #999;
  text-align: center;
  padding:10px;
  cursor:pointer;
}
#thumbnail img{
  width:100px;
  height:100px;
  margin:5px;
}
canvas{
  border:1px solid red;
}
</style>

<section class="content-header">
    <h1>
        Buku
        <small>Menejemen Buku</small>
    </h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('p/buku')?>"> Buku</a></li>
    <li class="active">Detail Buku</li>
</ol>
</section>
<br/>
<section class="content">
	<div class='row'>
		<div class="col-md-12">
			<div class="box box-info">
                <div class="box-header">
					<i class="fa fa-book"></i>
					<h3 class="box-title">Detail Buku</h3>
					<div class="box-tools pull-right">
						<div class="btn-group" >
							<a href="<?php echo site_url('p/buku/detail/'.$this->uri->segment(4).'/'.$this->uri->segment(5))?>" class="btn btn-box-tool"><i class='fa fa-refresh'></i> </a>
							<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
                </div>
                <div class="box-body chat" id="chat-box">
					<div class="item">
						<img src="<?php echo $list['thumbnail'] != '' ? site_url($list['thumbnail']) : base_url('assets/img/no_image.png') ?>" alt="book image" class="online"/>
						<p class="message">
							<a href="<?php echo site_url('p/buku/detail/'.$this->uri->segment(4).'/'.$this->uri->segment(5))?>" class="name">
							<small class="text-muted pull-right">Publish : <?php echo date('d-M-y',strtotime($list['tgl_input']))?> </small>
								<?php echo $list['judul_buku'] ?>
							</a>
							<span class="label <?php echo $list['status'] == '1' ? 'label-success' : 'label-danger' ?> "><i class="fa <?php echo $list['status'] == '1' ? 'fa-check' : 'fa-remove' ?>"></i> <?php echo $list['status'] == '1' ? 'AKTIF' : 'TIDAK AKTIF' ?></span>
						</p>
						<div class="attachment">
							<div class='col-md-4' style='margin-bottom:20px;'>
								<center><a href="<?php echo $list['image'] != '' ? site_url($list['image']) : base_url('assets/img/no_image.png') ?>"><img src="<?php echo $list['image'] != '' ? site_url($list['image']) : base_url('assets/img/no_image.png') ?>" alt="book image" class="img img-responsive img-thumbnail"/></a></center>
							</div>
							
							<div class='col-md-8'>
								<label style='width:100px'>Kode </label>: <?php echo $list['kode_buku']; ?><br/>
								<label style='width:100px'>Judul </label>: <?php echo $list['judul_buku']; ?><br/>
								<label style='width:100px'>ISBN </label>: <?php echo $list['isbn']; ?><br/>
								<label style='width:100px'>Kategori </label>: <?php echo getNamaKategori($list['id_ktgr']); ?><br/>
								<label style='width:100px'>Tempat </label>: <?php echo $list['tempat_buku']; ?><br/>
								<label style='width:100px'>Penulis </label>: <?php echo $list['penulis']; ?><br/>
								<label style='width:100px'>Penerbit </label>: <?php echo $list['penerbit']; ?><br/>
								<label style='width:100px'>Kota Terbit </label>: <?php echo $list['kota_terbit']; ?><br/>
								<label style='width:100px'>Tahun Terbit </label>: <?php echo $list['tahun_terbit']; ?><br/><br/>
								<label style='width:100px'>Deskripsi </label><br/>
								<?php echo $list['deskripsi_buku']; ?>
							</div>
						</div>
					</div>
                </div>
                <div class="box-footer">
					<a href="<?php echo site_url('p/buku/edit/'.encode($list['id_buku'])); ?>" class="btn btn-primary pull-right btn-sm " >Go Edit <i class='fa  fa-arrow-circle-right'></i></button>
                    <a href='<?php echo site_url('p/buku')?>' class="btn btn-default pull-right btn-sm " style='margin-right:10px'><i class='fa  fa-undo'></i> Kembali</a>
                </div>
            </div>
		</div>
	</div>
</section>
