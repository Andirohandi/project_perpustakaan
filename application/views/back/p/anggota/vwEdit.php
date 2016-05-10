
<section class="content-header">
    <h1>
        Edit Anggota
        <small>Menejemen Edit Anggota</small>
    </h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Edit Anggota</li>
</ol>
</section>
<br/>
<section class="content">
	<div class='row'>
		<div class="col-md-6">
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-users'></i>  Edit Anggota</h3>
					<div class="box-tools pull-right">
						<a href='<?php echo site_url('p/buku/add')?>' class="btn btn-box-tool"><i class='fa fa-refresh'></i> </a>
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
				<?php echo form_open_multipart('p/anggota/ubah'); ?>
					<div class="box-body">
						<br/>
						<div class='row'>
							<div class='col-md-12'>
								<?php if($this->session->flashdata('result')==1) { ?>
									<div class='alert alert-success'>
										<button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
										<i class='fa fa-check'></i> Data Berhasil Diedit
									</div>
								<?php } else if($this->session->flashdata('result')==2){ ?>
									<div class='alert alert-danger'>
										<button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
										<?php echo validation_errors(); ?>
									</div>
								<?php } else if($this->session->flashdata('result')==3){ ?>
									<div class='alert alert-danger'>
										<button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
										<i class='fa fa-warning'></i> Data Gagal Diedit
									</div>
								<?php } else { }?>
							
							
								<div class="form-horizontal">
									<div class="form-group">
										<label for="kategori" class="col-sm-4 control-label">Kategori Anggota</label>
										<div class="col-sm-8">
											<select name='kategori' id='kategori' class='form-control' required onchange="getJurusan(this.value)" >
												<?php echo get_select_kategori_anggota($agt['id_kategori_anggota']);?>
											</select>
										</div>
									</div>
									<div class="form-group jurusan" style="display:none" >
										<label for="jurusan" class="col-sm-4 control-label">Jurusan</label>
										<div class="col-sm-8">
											<select name='jurusan' id='jurusan' class='form-control' >
												<?php echo get_select_jurusan($agt['id_jurusan']);?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="nip_nim" class="col-sm-4 control-label">NIP / NIM</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" placeholder="NIP / NIM.." id="nip_nim" name="nip_nim" required value="<?php echo $agt['nip_nim_anggota']?>" />
											<input type="hidden" class="form-control" placeholder="NIP / NIM.." id="idanggota" name="idanggota" required value="<?php echo encode($agt['id_anggota'])?>" />
										</div>
									</div>
									<div class="form-group">
										<label for="nama" class="col-sm-4 control-label">Nama</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" placeholder="Nama.." id="nama" name="nama" required value="<?php echo $agt['nama_anggota']?>"  />
										</div>
									</div>
									<div class="form-group">
										<label for="tempat" class="col-sm-4 control-label">Tempat & Tanggal Lahir</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" placeholder="Tempat Lahir.." id="tempat" name="tempat" required value="<?php echo $agt['tempat_lahir']?>"   />
										</div>
									</div>
									<div class='form-group'>
										<label for='' class="col-sm-4 control-label"></label>
										<div class="col-sm-2">
											<select name='tgl' id='tgl' class='form-control' required >
												<option value="" >Tgl</option>
												<?php 
												
													for($no=1;$no<=31;$no++){ 
													
														if($no <= 9){  ?>
															<option value="<?php echo "0".$no; ?>" <?php echo date("d",strtotime($agt['tanggal_lahir'])) == $no ? 'selected' : '' ?> ><?php echo "0".$no; ?></option>
														<?php }else{?>
															<option value="<?php echo $no; ?>" <?php echo date("d",strtotime($agt['tanggal_lahir'])) == $no ? 'selected' : '' ?>  ><?php echo $no; ?></option>
													<?php	} }
												?>
											</select>
										</div>
										<div class="col-sm-2">
											<select name='bln' id='bln' class='form-control' required >
												<option value="" >Bln</option>
												<?php 
												
													for($no=1;$no<=12;$no++){ 
														
														if($no <= 9){ ?>
															<option value="<?php echo "0".$no; ?>" <?php echo date("m",strtotime($agt['tanggal_lahir'])) == $no ? 'selected' : '' ?>  ><?php echo "0".$no; ?></option>
														<?php }else{?>
															<option value="<?php echo $no; ?>" <?php echo date("m",strtotime($agt['tanggal_lahir'])) == $no ? 'selected' : '' ?>  ><?php echo $no; ?></option>
													<?php	} }
												?>
											</select>
										</div>
										<div class="col-sm-2">
											<select name='tahun' id='tahun' class='form-control' required >
												<option value="" >Thn</option>
												<?php 
												
													for($no=date('Y');$no>=1980;$no--){ ?>
														<option value="<?php echo $no; ?>" <?php echo date("Y",strtotime($agt['tanggal_lahir'])) == $no ? 'selected' : '' ?> ><?php echo $no; ?></option>
												<?php	}
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="jk" class="col-sm-4 control-label">Jenis Kelamin</label>
										<div class="col-sm-6">
											<select name='jk' id='jk' class='form-control' required >
												<option value="" >-- Pilih Jenis Kelamin --</option>
												<option value="Laki-Laki" <?php echo $agt['jk_anggota'] == "Laki-Laki" ? 'selected' : '' ?> >Laki - Laki</option>
												<option value="Perempuan" <?php echo $agt['jk_anggota'] == "Perempuan" ? 'selected' : '' ?> >Perempuan</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="alamat" class="col-sm-4 control-label">Alamat</label>
										<div class="col-sm-8">
											<textarea name="alamat" id="alamat" placeholder="Alamat.." class="form-control" ><?php echo $agt['alamat_anggota'] ?></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary  btn-info  pull-right" id='simpan' name='simpan'><i class='fa fa-check'></i> Edit</button>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</section>
<script>
$(function () {
	
});

function getJurusan(x){
	if(x == 3){
		$(".jurusan").fadeIn();
	}else{
		$(".jurusan").fadeOut();
	}
}
</script>