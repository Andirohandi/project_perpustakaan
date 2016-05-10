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
    <li class="active">Tambah Buku</li>
</ol>
</section>
<br/>
<section class="content">
	<div class='row'>
		<div class="col-md-12">
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-book'></i>  Tambah Buku</h3>
					<div class="box-tools pull-right">
						<a href='<?php echo site_url('p/buku/add')?>' class="btn btn-box-tool"><i class='fa fa-refresh'></i> </a>
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
				<?php echo form_open_multipart('p/buku/simpan'); ?>
					<div class="box-body">
						<br/>
						<div class='row'>
							<div class='col-md-12'>
								<?php if($this->session->flashdata('result')==1) { ?>
									<div class='alert alert-success'>
										<button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
										<i class='fa fa-check'></i> Data Berhasil Disimpan
									</div>
								<?php } else if($this->session->flashdata('result')==2){ ?>
									<div class='alert alert-danger'>
										<button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
										<?php echo validation_errors(); ?>
									</div>
								<?php } else if($this->session->flashdata('result')==3){ ?>
									<div class='alert alert-danger'>
										<button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
										<i class='fa fa-warning'></i> Data Gagal Disimpan
									</div>
								<?php } else { }?>
							</div>
							
							<div class='col-md-3'>
								<div class='form-group'>
									<label for='kategori'>Kategori Buku</label>
									<select name='kategori' id='kategori' class='form-control' required onchange='getKodeBuku(this.value)' >
										<?php echo get_select_kategori_buku(set_value('kategori'))?>
									</select>
								</div>
							</div>
							<div class='col-md-3'>
								<div class='form-group'>
									<label for='kode'>Kode Buku</label>
									<input type='text' name='kode' id='kode' class='form-control' placeholder='Kode buku..' required readonly />
								</div>
							</div>
							<div class='col-md-3'>
								<div class='form-group'>
									<label for='tanggal'>Tanggal Input</label>
									<input type='text' name='tanggal' id='tanggal' class='form-control' placeholder='Kode buku..' value="<?php echo tgl_indo(date('Y-m-d')); ?>" readonly />
								</div>
							</div>
							<div class='col-md-3'>
								<div class='form-group'>
									<label for='tempat'>Tempat Penyimpanan Buku</label>
									<input type='text' name='tempat' id='tempat' class='form-control' placeholder='Tempat Penyimpanan Buku..'  value="<?php echo set_value('tempat'); ?>" required />
								</div>
							</div>
							<div class='col-md-9'>
								<div class='form-group'>
									<label for='judul'>Judul Buku</label>
									<input type='text' name='judul' id='judul' class='form-control' placeholder='Judul buku..' value="<?php echo set_value('judul'); ?>" required />
								</div>
							</div>
							<div class='col-md-3'>
								<div class='form-group'>
									<label for='isbn'>ISBN</label>
									<input type='text' name='isbn' id='isbn' class='form-control' placeholder='ISBN buku..' value="<?php echo set_value('isbn'); ?>"  required />
								</div>
							</div>
							<div class='col-md-3'>
								<div class='form-group'>
									<label for='penulis'>Penulis</label>
									<input type='text' name='penulis' id='penulis' class='form-control' placeholder='Penulis..'  value="<?php echo set_value('penulis'); ?>" required />
								</div>
							</div>
							<div class='col-md-3'>
								<div class='form-group'>
									<label for='penerbit'>Penerbit</label>
									<input type='text' name='penerbit' id='penerbit' class='form-control' placeholder='Penerbit..'  value="<?php echo set_value('penerbit'); ?>" required />
								</div>
							</div>
							<div class='col-md-3'>
								<div class='form-group'>
									<label for='kota'>Kota Terbit</label>
									<input type='text' name='kota' id='kota' class='form-control' placeholder='Kota terbit..'  value="<?php echo set_value('kota'); ?>"  required />
								</div>
							</div>
							<div class='col-md-3'>
								<div class='form-group'>
									<label for='tahun'>Tahun Terbit</label>
									<select name='tahun' id='tahun' class='form-control' required >
										<option value="" >-- Pilih Tahun --</option>
										<?php 
										
											for($no=date('Y');$no>=1980;$no--){ ?>
												<option value="<?php echo $no; ?>" <?php echo set_value('tahun') == $no ? 'selected' : '' ?> ><?php echo $no; ?></option>
										<?php	}
										?>
									</select>
								</div>
							</div>
							<div class='col-md-12'>
								<div class="form-group">
									<label for="deskripsi">Deskripsi</label>
									<textarea id="deskripsi"  class='col-sm-12 col-xs-12 textarea' style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name='deskripsi' > <?php echo set_value('deskripsi'); ?></textarea>
								</div>
							</div>
							<div class="form-group" style='margin-top:10px'>
								<label class="col-xs-12 col-sm-12" for="upload-image" style='margin-top:20px;'>Upload Foto</label>
								<div class='col-sm-12'>
									<input type="file" style="display:none" class="form-control" id="upload-image" name="upload-image" multiple="multiple"></input>
									<div id="upload" class="btn btn-default" style=''>
										<i id='addImage' class='glyphicon glyphicon-plus'> Add</i>
										<div id="thumbnail"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary  btn-success  pull-right" id='simpan' name='simpan'><i class='fa fa-check'></i> Simpan Buku</button>
						<a href='<?php echo site_url('p/buku')?>' class="btn btn-default   pull-right" style='margin-right:10px'><i class='fa fa-undo'></i> Kembali</a>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</section>
<script>
$(function () {
	$(".textarea").wysihtml5();
	var fileDiv = document.getElementById("upload");
	var fileInput = document.getElementById("upload-image");
	
	console.log(fileInput);
	
	fileInput.addEventListener("change",function(e){
	  var files = this.files
	  showThumbnail(files)
	},false)

	fileDiv.addEventListener("click",function(e){
	  $(fileInput).show().focus().click().hide();
	  e.preventDefault();
	},false)

	fileDiv.addEventListener("dragenter",function(e){
	  e.stopPropagation();
	  e.preventDefault();
	},false);

	fileDiv.addEventListener("dragover",function(e){
	  e.stopPropagation();
	  e.preventDefault();
	},false);

	fileDiv.addEventListener("drop",function(e){
	  e.stopPropagation();
	  e.preventDefault();

	  var dt = e.dataTransfer;
	  var files = dt.files;

	  showThumbnail(files)
	},false);
});

function showThumbnail(files){
  for(var i=0;i<files.length;i++){
	var file = files[i]
	var imageType = /image.*/

	if(!file.type.match(imageType)){
	  console.log("Not an Image");
	  continue;
	}

	var image = document.createElement("img");
	// image.classList.add("")
	var thumbnail = document.getElementById("thumbnail");
	image.file = file;
	
	while(thumbnail.hasChildNodes()) {
		thumbnail.removeChild(thumbnail.lastChild);
	}
	
	thumbnail.appendChild(image)
	
	$('#addImage').hide();
	
	var reader = new FileReader()
	reader.onload = (function(aImg){
	  return function(e){
		aImg.src = e.target.result;
	  };
	}(image))
	var ret = reader.readAsDataURL(file);
	var canvas = document.createElement("canvas");
	ctx = canvas.getContext("2d");
	image.onload= function(){
	  ctx.drawImage(image,100,100)
	}
  }
}

function getKodeBuku(kd_ktgr){
	$.ajax({
		url		: '<?php echo base_url()?>p/buku/get_kode_buku/'+kd_ktgr,
		type	: 'POST',
		dataType: 'JSON',
		data	: {},
		beforeSend : function(){
			
		},
		success : function(rs){
			$('#kode').val(rs.kode);
		}
	});
}

</script>