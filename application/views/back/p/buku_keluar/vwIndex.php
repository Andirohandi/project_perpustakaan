
<section class="content-header">
    <h1>
        Buku Keluar
        <small>Menejemen Buku Keluar</small>
    </h1>
	<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Buku Keluar</li>
</ol>
</section>
<br/>
<section class="content">
	<div class='row'>
		<div class="col-md-9">
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-book'></i> Data Buku Keluar</h3>
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
								<input type="text" name="cari" id='cari' class="form-control input-sm col-sm-4 col-xs-12" placeholder="Cari Kode / Judul Buku . . ." onchange='pageLoad(1)'>
								<div class="input-group-btn">
									<button class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>
						<div class='col-sm-3 col-xs-12 pull-right' style='margin-top:5px;margin-bottom:5px'>
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
		<div class="col-md-3">
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-book'></i> Tambah Buku Keluar</h3>
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
						<label for="kode">Kode Buku *</label>
						<div class="input-group pull-right">
							<input type="text" name="kode" id='kode' class="form-control input-sm col-sm-4 col-xs-12" placeholder="Kode buku.." readonly >
							<div class="input-group-btn">
								<button class="btn btn-default btn-sm" data-toggle='modal' data-target='#cari-buku'><i class="fa fa-search"></i></button>
							</div>
						</div>
					</div>
					<div class="form-group" style='margin-top:45px'>
						<label for="judul">Judul Buku</label>
						<input type="text" class="form-control" id="judul" name='judul' placeholder='Judul buku..' required readonly >
						<input type="hidden" class="form-control" id="id_buku" name='id_buku' readonly >
						
					</div>
					<div class="form-group">
						<label for="jumlah">Stok</label>
						<input type="text" class="form-control" id="stok" name='stok' readonly placeholder="Stok buku.." >
					</div>
					<div class="form-group">
						<label for="jumlah" id='label-jumlah'>Jumlah *</label>
						<input type="number" class="form-control" id="jumlah" name='jumlah' placeholder='Jumlah..' required onchange='changeButtonSubmit(),cekJumlahStok(this.value)' >
						<label for="jumlah" id='error-jumlah' style='color:red;display:none'><i>Jumlah tidak boleh lebih besar dari stok</i></label>
					</div>
					<div class="form-group">
						<label for="status_buku">Status Buku *</label>
						<select class="form-control" id="status_buku" name='status_buku' required onchange='changeButtonSubmit()' >
							<option value="">-- Pilih Status Buku --</option>
							<option value="1">Hilang</option>
							<option value="2">Rusak</option>
							<option value="3">Lain - Lain</option>
						</select>
					</div>
					<div class="form-group" id='reason_a'  style='display:none'>
						<label for="jumlah_sanksi">Jumlah Sanksi (ex : 10000) *</label>
						<input type="number" class="form-control" id="jumlah_sanksi" name='jumlah_sanksi' placeholder='Rp. . .' required onchange='changeButtonSubmit()' >
					</div>
					<div class="form-group" id='reason_b' id='reason_b' style='display:none'>
						<input type="text" class="form-control" id="keadaan_buku" name='keadaan_buku' placeholder='Tulis Status Buku ..' required onchange='changeButtonSubmit()' >
					</div>
				</div>
				<div class="box-footer">
					<div id='btn-aksi'>
						<a href='javascript:void(0)' class='btn btn-success pull-right disabled' id='btn-tambah' onclick='simpan()' ><i class='fa fa-check' id='icon-simpan'></i> Simpan</a>
					</div>
				</div>
			</div>
		</div>	
	</div>
</section>

<!-- modal cari buku !-->
<div id='cari-buku' class='modal custom ' tabindex='-1' role='dialog'aria-hidden='true' data-backdrop='static'>
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class='fa fa-search'></i> Cari Buku</h4>
			</div>
			<div class="modal-body" style="min-height:180px;">
				<div class='row'>
					<div class="col-md-12">
						<div class="form-group">
							<div class="input-group pull-right">
								<input type="text" name="cari_buku" id='cari_buku' class="form-control input-sm col-sm-4 col-xs-12" placeholder="Cari kode / judul buku.." onchange='pageLoadModal(1)' >
								<div class="input-group-btn">
									<button class="btn btn-default btn-sm" ><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br/>
				<div id='dataSearch'>
					<div class='row'  id='loading2'>
						<div class='col-md-12'>
							<div class="box box-info">
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
			<div class="modal-footer">
				<div class="col-md-12">
					<button type="button" class="btn btn-default pull-right" data-dismiss="modal" id='cancel-modal'><i class='fa fa-undo'></i> Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	pageLoad(1);
	pageLoadModal(1);
	$('#tanggal').daterangepicker();
	
	$('#status_buku').change(function(){
		var status = $('#status_buku').val();
		if(status == 1 || status == 2){
			$('#reason_a').fadeIn('slow');
			$('#reason_b').fadeOut('slow');
		}else if(status == 3){
			$('#reason_a').fadeOut('slow');
			$('#reason_b').fadeIn('slow');
		}else{
			$('#reason_a').fadeOut('slow');
			$('#reason_b').fadeOut('slow');
		}
	});
});

function cekJumlahStok(x){
	var stok = $('#stok').val();
	
	if ( parseInt(x) > parseInt(stok) ) {
		$('#error-jumlah').show();
		$('#jumlah').attr('style','border:1px solid red;');
		$('#label-jumlah').attr('style','color:red');
		$('#btn-tambah').addClass('disabled');
	}else{
		$('#error-jumlah').hide();
		$('#jumlah').attr('style','border:1px solid #d2d6de;');
		$('#label-jumlah').attr('style','color:black;');
		changeButtonSubmit();
	}
}

function changeButtonSubmit(){
	var jumlah	= $('#jumlah').val();
	var status	= $('#status_buku').val();
	var sanksi	= $('#jumlah_sanksi').val();
	var keadaan	= $('#keadaan_buku').val();
	
	if(jumlah != '' && status != ''){
		if(status == 1 || status == 2){
			if(sanksi != ''){
				$('#btn-tambah').removeClass('disabled');
			}else{
				$('#btn-tambah').addClass('disabled');
			}
		}else{
			if(keadaan != ''){
				$('#btn-tambah').removeClass('disabled');
			}else{
				$('#btn-tambah').addClass('disabled');
			}
		}
	}else{
		$('#btn-tambah').addClass('disabled');
	}
	
}

function pageLoad(i){
	var limit 	= $('#limit').val();
	var cari 	= $('#cari').val();
	var tanggal	= $('#tanggal').val();
	
	$.ajax({
		url		: '<?php echo base_url()?>p/arus_buku/read_buku_keluar/'+i,
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

function pageLoadModal(i){
	var cari 	= $('#cari_buku').val();
	
	$.ajax({
		url		: '<?php echo base_url()?>p/buku/read_cari/'+i,
		type	: 'post',
		dataType: 'html',
		data	: {cari:cari},
		beforeSend : function(){
			$('#loading').fadeIn('slow');
		},
		success : function(result){
			$('#loading2').attr('style','display:none');
			$('#dataSearch').html(result);
		}
	})
}

function getDataBuku(x,y,z){
	$('#id_buku').val(x);
	$('#kode').val(y);
	$('#judul').val(z);
	
	$('#jumlah').val('');
	$('#status_buku').val('');
	$('#jumlah_sanksi').val('');
	$('#keadaan_buku').val('');
	
	$('#reason_a').fadeOut();
	$('#reason_b').fadeOut();
	
	$('#cancel-modal').click();
	
	$.ajax({
		url		: '<?php echo base_url()?>p/arus_buku/cek_stok/'+x,
		type	: 'POST',
		dataType: 'JSON',
		beforeSend : function(){

		},
		success : function(rs){
			$('#stok').val(rs.stok);
		}
	});
}

function refresh(){
	$('#id_buku').val('');
	$('#kode').val('');
	$('#judul').val('');
	$('#jumlah').val('');
	$('#status_buku').val('');
	$('#reason_a').fadeOut('slow');
	$('#reason_b').fadeOut('slow');
	$('#btn-tambah').addClass('disabled');
}

function simpan(){
	
	var id_buku		= $('#id_buku').val();
	var jumlah		= $('#jumlah').val();
	var status		= $('#status_buku').val();
	var sanksi		= $('#jumlah_sanksi').val();
	var keadaan		= $('#keadaan_buku').val();

	$.ajax({
		url		: '<?php echo base_url()?>p/arus_buku/simpan_buku_keluar',
		type	: 'POST',
		dataType: 'JSON',
		data	: {id_buku:id_buku,jumlah:jumlah,status:status,sanksi:sanksi,keadaan:keadaan},
		beforeSend : function(){
			$('#icon-simpan').removeClass().addClass('fa fa-spinner fa-pulse');
			$('#btn-tambah').addClass('disabled');
		},
		success : function(rs){
			
			if(rs.result==1){
				$('#icon-simpan').removeClass().addClass('fa fa-check');
				$('#id_buku').val('');
				$('#kode').val('');
				$('#judul').val('');
				$('#jumlah').val('');
				$('#status_buku').val('');
				$('#stok').val('');
				$('#jumlah_sanksi').val('');
				$('#keadaan_buku').val('');
				alertify.success("<b><i class='fa fa-check'></i> Data berhasil disimpan<b>");
				pageLoad(1);
			}else{

				$('#icon-simpan').removeClass().addClass('fa fa-check');
				$('#btn-tambah').removeClass('disabled');
				
				alertify.error("<b><i class='fa fa-warning'></i> "+rs.message+"<b>");
			}
		}
	})
}

function hapus(x,jumlah,id_buku){
	alertify.confirm("Apakah Anda Yakin Akan Menghapus Data ini ?", function (e) {
		if (e) {
			$.ajax({
				url		: '<?php echo site_url()?>p/arus_buku/hapus_buku_keluar',
				type	: 'post',
				dataType: 'json',
				data	: {x:x,jumlah:jumlah,id_buku:id_buku},
				beforeSend : function(){

				},
				success : function(rs){
					if(rs.result == 1){
						pageLoad($('#current').val());
						alertify.success("<b><i class='fa fa-check'></i> Data berhasil dihapus</b>");
					}else{
						alertify.error("<b><i class='fa fa-warning'></i> Data gagal dihapus</b>");
					}
				}
			});
		}
	});
}

</script>