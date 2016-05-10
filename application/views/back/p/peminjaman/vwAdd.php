
<section class="content-header">
    <h1>
        Peminjaman Buku
        <small>Menejemen Peminjaman Buku</small>
    </h1>
	<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li><a href="<?php echo base_url('p/peminjaman')?>">Peminjaman Buku</a></li>
    <li class="active">Tambah Peminjaman Buku</li>
</ol>
</section>
<br/>
<section class="content">
	<div class='row'>
		<div class="col-md-8">
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-book'></i> Tambah Peminjaman Buku</h3>
					<div class="box-tools pull-right">
						<a href="<?php echo site_url('p/peminjaman/add')?>" class="btn btn-box-tool"><i class='fa fa-refresh'></i> </a>
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
				<?php echo form_open_multipart('p/peminjaman/simpan'); ?>
					<div class="box-body">
						<br/>
						<div class='row' style='margin-top:-20px;margin-bottom:10px'>
							<div class='col-md-6'>
								<div class="form-horizontal">
									<div class="form-group">
										<label for="no_peminjaman" class="col-sm-4 control-label">Nomor Peminjaman</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="no_peminjaman" name='no_peminjaman' value="<?php echo getNomorPeminjaman(); ?>" readonly >
										</div>
									</div>
									<div class="form-group">
										<label for="tgl_peminjaman" class="col-sm-4 control-label" style="float:left">Tanggal Peminjaman</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="tgl_peminjaman" name='tgl_peminjaman' value="<?php echo date('d-M-Y')?>" readonly >
										</div>
									</div>
									<div class="form-group">
										<label for="tgl_kembali" class="col-sm-4 control-label" style="float:left">Tanggal Kembali</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="tgl_kembali" name='tgl_kembali' value="<?php echo getTglKembali(); ?>" readonly >
										</div>
									</div>
								</div>
							</div>
							<div class='col-md-6'>
								<div class="form-horizontal">
									<div class="form-group">
										<label for="nip_nim" class="col-sm-3 control-label">ID Peminjam</label>
										<div class="col-sm-9">
											<div class="input-group pull-right" >
												<input type="text" class="form-control" id="nip_nim" name='nip_nim' readonly placeholder="Cari ID Peminjam.." required >
												<div class="input-group-btn">
													<a href="javascript:void(0)" class="btn btn-warning btn-sm" style='padding-top:8px;padding-bottom:5px' data-toggle="modal" data-target="#cari-user" ><i class="fa fa-search"></i></a>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="tgl_peminjaman" class="col-sm-3 control-label" style="float:left">Nama</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="nama_peminjam" name='nama_peminjam' value="" readonly required >
											<input type="hidden" class="form-control" id="id_peminjam" name='id_peminjam' value="" readonly >
											<input type="hidden" class="form-control" id="level-simpan" name='level-simpan' value="" readonly >
										</div>
									</div>
									<div class="form-group">
										<label for="tgl_peminjaman" class="col-sm-3 control-label" style="float:left" >Status</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="status" name='status'  readonly required >
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<a class='btn btn-success pull-right disabled' id='simpan-input' name='simpan-input' onclick='simpan()' ><i class='fa fa-check'></i> Proses Peminjaman</a>
						<button type='submit' class='btn btn-success pull-right hide' id='simpan-input2' name='simpan-input2' ><i class='fa fa-check'></i> Proses Peminjaman </button>
						<a href="<?php echo site_url('p/peminjaman')?>" class='btn btn-default pull-right' style='margin-right:10px' ><i class='fa fa-undo'></i> Kembali</a>
					</div>
				<?php echo form_close()?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-info box-solid">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-list-alt'></i> Catatan :</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>

				<div class="box-body">
					
				</div>
				<div class="box-footer">
					
				</div>
			</div>
		</div>
	</div>
</section>

<!-- modal cari user !-->
<div id='cari-user' class='modal custom ' tabindex='-1' role='dialog'aria-hidden='true' data-backdrop='static'>
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class='fa fa-users'></i> Cari Peminjam</h4>
			</div>
			<div class="modal-body" style="min-height:180px;">
				<div class='row'>
					<div class="col-md-4">
						<select class="form-control" name="level" id="level" onchange='search_user()'  >
							<?php echo get_select_kategori_anggota() ?>
						</select>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<div class="input-group pull-right">
								<input type="text" name="cari_user" id='cari_user' class="form-control col-sm-4 col-xs-12" placeholder="Cari nama .." onchange='search_user()' >
								<div class="input-group-btn">
									<button class="btn btn-default btn-sm" style="padding-top:9px;padding-bottom:5px;" ><i class="fa fa-search"></i></button>
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
				
				<button type="button" class="btn btn-default pull-right" data-dismiss="modal" id='cancel-modal'><i class='fa fa-undo'></i> Cancel</button>
				
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	pageLoadModal(1)
	<?php if($this->session->flashdata('result') == 2){ ?>
		alertify.error("<b><i class='fa fa-remove'></i> Data gagal ddisimpan</b>")
	<?php } else {} ?>
})

function getDataUser(id,nim,nama,level,status){
	$("#id_peminjam").val(id);
	$("#nip_nim").val(nim);
	$("#nama_peminjam").val(nama);
	$("#level-simpan").val(level);
	$("#status").val(status);
	$('#cancel-modal').click();
	$('#simpan-input').removeClass('disabled')
}

function simpan(){
	var nip_nim = $("#nip_nim").val();
	if(nip_nim == ''){
		alertify.alert("Silahkan lengkapi inputan anda");
	}else{
		$('#simpan-input2').click();
	}
}

function pageLoadModal(i){
	var cari 	= $('#cari_user').val();
	var level 	= $('#level').val();
	
	$.ajax({
		url		: '<?php echo base_url()?>p/anggota/read_cari/'+i,
		type	: 'post',
		dataType: 'html',
		data	: {cari:cari,level:level},
		beforeSend : function(){
			$('#loading').fadeIn('slow');
		},
		success : function(result){
			$('#loading2').attr('style','display:none');
			$('#dataSearch').html(result);
		}
	})
}
</script>