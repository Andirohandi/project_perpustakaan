<style>
.callout-success{
	background-color:white;
}
</style>
<section class="content-header">
    <h1>
        Kategori
        <small>Menejemen Kategori</small>
    </h1>
	<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Kategori</li>
</ol>
</section>
<br/>
<section class="content">
	<div class='row'>
		<div class="col-md-8">
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title">Data Kategori</h3>
					<div class="box-tools pull-right">
						<a href='javascript:void(0)' class="btn btn-box-tool" onclick='pageLoad()'><i class='fa fa-refresh'></i> </a>
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
						<div class='col-sm-4 col-xs-12 pull-right' style='margin-top:5px;margin-bottom:5px'>
							<div class="input-group pull-right">
								<input type="text" name="cari" id='cari' class="form-control input-sm col-sm-4 col-xs-12" placeholder="Cari Kategori . . ." onchange='pageLoad(1)'>
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
		<div class="col-md-4">
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title">Tambah Kategori</h3>
					<div class="box-tools pull-right">
						<a href='javascript:void(0)' class="btn btn-box-tool" onclick='refresh()'><i class='fa fa-refresh'></i> </a>
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
                <div class="box-body">
					<div id='notifikasi-flag'>
						<div id='notifikasi'></div>
					</div>
					<div class="form-group">
						<label for="kode">Kode Kategori</label>
						<input type="text" class="form-control" id="kode" name='kode'  placeholder='Kode kategori..' required onchange="cekKodeKtgr(this.value)" >
						<input type="hidden" class="form-control" id="id" name='id' required readonly >
						<label style='color:red;display:none;' id='error-kode'><i><span id='error-msg-kode'></span></i></label>
					</div>
					<div class="form-group">
						<label for="nama">Nama Kategori *</label>
						<input type="text" class="form-control" id="nama" name='nama' placeholder='Nama kategori..' required onchange="cekNamaKtgr(this.value)">
						<label style='color:red;display:none;' id='error-nama'><i><span id='error-msg'></span></i></label>
					</div>
					<div class="form-group">
						<label for="status">Status Kategori</label>
						<select class="form-control" id="status" name='status' required >
							<option value='1' selected >AKTIF</optiohn>
							<option value='0' >TIDAK AKTIF</optiohn>
						</select>
					</div>
				</div>
				<div class="box-footer">
					<div id='btn-aksi'>
						<a href='javascript:void(0)' class='btn btn-success pull-right' id='btn-tambah' onclick='simpan()' ><i class='fa fa-check' id='icon-simpan'></i> Simpan</a>
					</div>
					<div id='btn-edit' style='display:none'>
						<a href='javascript:void(0)' class='btn btn-info  pull-right btn-edit-kat' onclick='edit()' ><i class='fa fa-edit' id='icon-edit' ></i> Simpan </a>
						<a href='javascript:void(0)' class='btn btn-default  pull-right btn-edit-kat' onclick="kembali()" style='margin-right:10px'><i class='fa fa-undo'></i> Kembali</a>
					</div>
				</div>
			</div>
		</div>	
	</div>
</section>

<script>
$(document).ready(function(){
	pageLoad(1);
	//getKodeKtgr();
	$('#close').click(function(){
		$('#notifikasi').hide();
	})
});

function pageLoad(i){
	var limit 	= $('#limit').val();
	var cari 	= $('#cari').val();
	
	$.ajax({
		url		: '<?php echo base_url()?>p/kategori/read/'+i,
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

function refresh(){
	getKodeKtgr();
	$('#nama').val('');
	$('#status').val(1);
	$('#btn-tambah').addClass('disabled');
}

function simpan(){
	
	var kode	= $('#kode').val();
	var nama	= $('#nama').val();
	var status	= $('#status').val();
	
	if(kode == ''){
		$('#error-kode').fadeIn('');
		$('#kode').attr('style','border:1px solid red;');
		$('#error-msg-kode').html('Kode kategori tidak boleh kosong');
	}else if(nama == ''){
		$('#error-nama').fadeIn('');
		$('#nama').attr('style','border:1px solid red;');
		$('#error-msg').html('Nama kategori tidak boleh kosong');
	}else{
		$.ajax({
			url		: '<?php echo base_url()?>p/kategori/simpan',
			type	: 'POST',
			dataType: 'JSON',
			data	: {kode:kode,nama:nama,status:status},
			beforeSend : function(){
				$('#icon-simpan').removeClass().addClass('fa fa-spinner fa-pulse');
				$('#btn-tambah').addClass('disabled');
			},
			success : function(rs){
				
				if(rs.result==1){
					$('#error-nama').fadeOut('');
					$('#nama').attr('style','border:1px solid #d2d6de;');

					$('#icon-simpan').removeClass().addClass('fa fa-check');
					$('#btn-tambah').removeClass('disabled');
					
					var sukses	=  "";
					sukses		=  "<div class='callout callout-success' id='alert-notifikasi'>";
					sukses		+= "<button type='button' class='close' onclick='close_notif()' >x</button>";
					sukses		+= "<i class='fa fa-check'></i> Data berhasil disimpan";
					sukses		+= "</div>";
					$('#notifikasi-flag').show();
					$('#notifikasi').html(sukses);
					pageLoad(1);
					//getKodeKtgr();
					$('#kode').val('');
					$('#nama').val('');
					$('#status').val(1);
					
				}else{

					$('#icon-simpan').removeClass().addClass('fa fa-check');
					$('#btn-tambah').removeClass('disabled');
					
					var gagal	=  "";
					gagal		=  "<div class='callout callout-danger' id='alert-notifikasi'>";
					gagal		+= "<button type='button' id='close' class='close' onclick='close_notif()' >x</button>";
					gagal		+= "<i class='fa fa-trash'></i> "+rs.message;
					gagal		+= "</div>";
					$('#notifikasi-flag').show();
					$('#notifikasi').html(gagal);
				}
			}
		})
	}
}

function close_notif(){
	$('#notifikasi-flag').hide();
}
function getKodeKtgr(){
	$.ajax({
		url		: '<?php echo base_url()?>p/kategori/get_kode_ktgr',
		type	: 'POST',
		dataType: 'JSON',
		beforeSend : function(){
			
		},
		success : function(rs){
			$('#kode').val(rs.result);
		}
	});
}
function cekKodeKtgr(x){
	$.ajax({
		url		: '<?php echo base_url()?>p/kategori/cek_kode_ktgr',
		type	: 'POST',
		dataType: 'JSON',
		data	: {x:x},
		beforeSend : function(){
			
		},
		success : function(rs){
			if(rs.result==0){
				$('#error-kode').fadeIn('');
				$('#kode').attr('style','border:1px solid red;');
				$('#error-msg-kode').html('Kode kategori sudah ada');
			}else{
				$('#error-kode').fadeOut('fast');
				$('#kode').attr('style','border:1px solid #d2d6de;');
			}
		}
	});
}

function cekNamaKtgr(x){
	$.ajax({
		url		: '<?php echo base_url()?>p/kategori/cek_nama_ktgr',
		type	: 'POST',
		dataType: 'JSON',
		data	: {x:x},
		beforeSend : function(){
			
		},
		success : function(rs){
			if(rs.result==0){
				$('#error-nama').fadeIn('');
				$('#nama').attr('style','border:1px solid red;');
				$('#error-msg').html('Nama kategori sudah ada');
				$('#btn-tambah').addClass('disabled');
				$('.btn-edit-kat').addClass('disabled');
			}else{
				$('#error-nama').fadeOut('fast');
				$('#nama').attr('style','border:1px solid #d2d6de;');
				$('#btn-tambah').removeClass('disabled');
				$('.btn-edit-kat').removeClass('disabled');
			}
		}
	});
}

function hapus(x){
	alertify.confirm("Apakah Anda Yakin Akan Menghapus Data ini ?", function (e) {
		if (e) {
			$.ajax({
				url		: '<?php echo site_url()?>p/kategori/hapus',
				type	: 'post',
				dataType: 'json',
				data	: {x:x},
				beforeSend : function(){

				},
				success : function(rs){
					if(rs.result == 1){
						pageLoad($('#current').val());
						getKodeKtgr();
						alertify.success("<b><i class='fa fa-check'></i> Data berhasil dihapus</b>");
					}else{
						alertify.error("<b><i class='fa fa-warning'></i> Data gagal dihapus</b>");
					}
				}
			});
		}
	});
}

function get_edit(w,x,y,z){
	$('#id').val(w);
	$('#kode').val(x);
	$('#nama').val(y);
	$('#status').val(z);
	$('#btn-tambah').hide();
	$('#btn-edit').show();
	$('.btn-edit-kat').removeClass('disabled');
}

function kembali(){
	$('#id').val('');
	$('#kode').val('');
	$('#nama').val('');
	$('#status').val('');
	$('#btn-tambah').show();
	$('#btn-edit').hide();
	getKodeKtgr();
}

function edit(){
	var id	= $('#id').val();
	var kode	= $('#kode').val();
	var nama	= $('#nama').val();
	var status	= $('#status').val();
	
	if(kode == ''){
		$('#error-kode').fadeIn('');
		$('#kode').attr('style','border:1px solid red;');
		$('#error-msg-kode').html('Kode kategori tidak boleh kosong');
	}else if(nama == ''){
		$('#error-nama').fadeIn('');
		$('#nama').attr('style','border:1px solid red;');
		$('#error-msg').html('Nama kategori tidak boleh kosong');
	}else{
		$.ajax({
			url		: '<?php echo base_url()?>p/kategori/edit',
			type	: 'POST',
			dataType: 'JSON',
			data	: {id:id,nama:nama,status:status,kode:kode},
			beforeSend : function(){
				$('#icon-edit').removeClass().addClass('fa fa-spinner fa-pulse');
				$('.btn-edit-kat').addClass('disabled');
			},
			success : function(rs){
				
				if(rs.result==1){
					$('#error-nama').fadeOut('');
					$('#nama').attr('style','border:1px solid #d2d6de;');

					$('#icon-edit').removeClass().addClass('fa fa-check');
					$('#btn-edit-kat').removeClass('disabled');
					
					var sukses	=  "";
					sukses		=  "<div class='callout callout-success' id='alert-notifikasi'>";
					sukses		+= "<button type='button' class='close' onclick='close_notif()' >x</button>";
					sukses		+= "<i class='fa fa-check'></i> Data berhasil diedit";
					sukses		+= "</div>";
					$('#notifikasi-flag').show();
					$('#notifikasi').html(sukses);
					pageLoad(1);
					//getKodeKtgr();
					$('#nama').val('');
					$('#kode').val('');
					$('#status').val(1);
					$('#btn-tambah').show();
					$('#btn-edit').hide();
				}else{

					$('#icon-edit').removeClass().addClass('fa fa-check');
					$('.btn-edit-kat').removeClass('disabled');
					
					var gagal	=  "";
					gagal		=  "<div class='callout callout-danger' id='alert-notifikasi'>";
					gagal		+= "<button type='button' id='close' class='close' onclick='close_notif()' >x</button>";
					gagal		+= "<i class='fa fa-trash'></i> "+rs.message;
					gagal		+= "</div>";
					$('#notifikasi-flag').show();
					$('#notifikasi').html(gagal);
				}
			}
		})
	}
}
</script>