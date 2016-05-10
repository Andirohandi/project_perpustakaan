
<section class="content-header">
    <h1>
        Peminjaman Buku
        <small>Menejemen Peminjaman Buku</small>
    </h1>
	<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li><a href="<?php echo base_url('p/peminjaman')?>">Peminjaman Buku</a></li>
    <li class="active">Detail Peminjaman Buku</li>
</ol>
</section>
<br/>
<section class="content">
	<div class='row'>
		<div class="col-md-12">
			<div class="box box-info box-solid no-border">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-bookmark'></i> Detail Peminjaman</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
				<div class="box-body">
					<br/>
					<div class='row' style='margin-top:-20px;margin-bottom:10px'>
						<div class='col-md-4'>
							<table class='table no-border'>
								<tr>
									<td>No. Peminjaman</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo $no_peminjaman; ?></b></td>
								</tr>
								<tr>
									<td>Tgl Peminjaman</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo date('d-M-Y',strtotime($tgl_peminjaman)); ?></b></td>
								</tr>
								<tr>
									<td>Tgl Kembali</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo date('d-M-Y',strtotime($tgl_kembali)); ?></b></td>
								</tr>
							</table>
						</div>
						<div class='col-md-3'>
							<table class='table no-border'>
								<tr>
									<td>ID Peminjaman</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo $nip_nim; ?></b></td>
								</tr>
								<tr>
									<td>Nama</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo $nama_peminjam; ?></b></td>
								</tr>
								<tr>
									<td>Status</td><td style='text-align:center;width:20px'> : </td><td><b><?php echo $status; ?></b></td>
									<input type='hidden' id='status' name='status' value='<?php echo $status_pmnjmn ?>' >
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="<?php echo $status_pmnjmn == 1 ? 'col-md-12' : 'col-md-8' ?> ">
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-bookmark'></i> Detail Buku</h3>
					<div class="box-tools pull-right">
						<a href="javascript:void(0)" nclick="pageLoad()" class="btn btn-box-tool"><i class='fa fa-refresh'></i> </a>
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
				
				<div class="box-body">
					<div id='dataList'>
						<div class='row' id='loading' style="display:none">
							<div class='col-md-12'>
								<div class="overlay">
									<i class="fa fa-spinner fa-pulse fa-5x"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" class="form-control" id="id_peminjaman" name="id_peminjaman" value="<?php echo $id_peminjaman; ?>" />
		<?php if($status_pmnjmn == 1){ }else{ ?>
		<div class="col-md-4">
			<div class="box box-info ">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-bookmark'></i> Tambah Buku </h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>

				<div class="box-body">
					<div class="form-group">
						<label for="kode">Kode Buku *</label>
						<div class="input-group pull-right">
							<input type="text" name="kode" id='kode' class="form-control input-sm col-sm-4 col-xs-12" placeholder="Kode buku.." readonly >
							<div class="input-group-btn">
								<button class="btn btn-default btn-sm"  data-toggle='modal' data-target='#cari-buku'><i class="fa fa-search"></i></button>
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
						<select onchange='cekJumlahStok(this.value)' id='jumlah' name='jumlah' class='form-control' >
							<option value=''></option>
							<option value='1'>1</option>
							<option value='2'>2</option>
						</select>
						<label for="jumlah" id='error-jumlah' style='color:red;display:none'><i>Jumlah tidak boleh lebih besar dari stok</i></label>
					</div>
				</div>
				
				<div class="box-footer">
					<div id='btn-aksi'>
						<a href='javascript:void(0)' class='btn btn-info pull-right disabled' id='btn-tambah' onclick='simpan()' ><i class='fa fa-plus' id='icon-simpan'></i> Tambah</a>
					</div>
				</div>
				
			</div>
		</div>
		<?php } ?>
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
	pageLoadModal(1);
	pageLoad(1);
	
	<?php if($this->session->flashdata('result') == 1 ){ ?>
		alertify.success("<b><i class='fa fa-check'></i> Transaksi berhasil disimpan</b>");
	<?php } else if($this->session->flashdata('result') == 2 ) {?>
		alertify.error("<b><i class='fa fa-remove'></i> Transaksi gagal disimpan</b>")
	<?php } else { } ?>
})

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


function cekJumlahStok(x){
	var stok = $('#stok').val();
	
	if(x==''){
		$('#error-jumlah').hide();
		$('#jumlah').attr('style','border:1px solid #d2d6de;');
		$('#label-jumlah').attr('style','color:black;');
		$('#btn-tambah').addClass('disabled');
	}else{
		if ( parseInt(x) > parseInt(stok) ) {
			$('#error-jumlah').show();
			$('#jumlah').attr('style','border:1px solid red;');
			$('#label-jumlah').attr('style','color:red');
			$('#btn-tambah').addClass('disabled');
		}else{
			$('#error-jumlah').hide();
			$('#jumlah').attr('style','border:1px solid #d2d6de;');
			$('#label-jumlah').attr('style','color:black;');
			$('#btn-tambah').removeClass('disabled');
		}
	}
}

function pageLoad(){
	
	var id_peminjaman = $("#id_peminjaman").val();
	var status = $("#status").val();
	
	$.ajax({
		url		: '<?php echo base_url()?>p/peminjaman/read_transit/'+id_peminjaman,
		type	: 'post',
		dataType: 'html',
		data	: {status:status},
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
	$('#id_buku').val('');
	$('#kode').val('');
	$('#judul').val('');
	$('#jumlah').val('');
	$('#stok').val('');
}

function simpan(){
	var id_buku			= $('#id_buku').val();
	var jumlah			= $('#jumlah').val();
	var id_peminjaman	= $('#id_peminjaman').val();
	
	$.ajax({
		url		: '<?php echo base_url()?>p/peminjaman/simpan_detail_transit',
		type	: 'POST',
		dataType: 'JSON',
		data	: {id_buku:id_buku,jumlah:jumlah,id_peminjaman:id_peminjaman},
		beforeSend : function(){
			$('#icon-simpan').removeClass().addClass('fa fa-spinner fa-pulse');
			$('#btn-tambah').addClass('disabled');
		},
		success : function(rs){
			
			if(rs.result==1){
				$('#icon-simpan').removeClass().addClass('fa fa-check');
				refresh();
				alertify.success("<b><i class='fa fa-check'></i> Data berhasil disimpan<b>");
				pageLoad();
			}else if(rs.result==2){

				$('#icon-simpan').removeClass().addClass('fa fa-check');
				$('#btn-tambah').removeClass('disabled');
				
				alertify.error("<b><i class='fa fa-warning'></i> "+rs.msg+"<b>");
			}else if(rs.result==3){

				$('#icon-simpan').removeClass().addClass('fa fa-check');
				$('#btn-tambah').removeClass('disabled');
				
				alertify.alert("<b><i class='fa fa-warning'></i> "+rs.msg+"<b>");
			}
		}
	})
	
}

function hapus(x){
	alertify.confirm("Apakah Anda Yakin Akan Menghapus Data ini ?", function (e) {
		if (e) {
			$.ajax({
				url		: '<?php echo site_url()?>p/peminjaman/hapus_transit',
				type	: 'post',
				dataType: 'json',
				data	: {x:x},
				beforeSend : function(){

				},
				success : function(rs){
					if(rs.result == 1){
						pageLoad();
						refresh();
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