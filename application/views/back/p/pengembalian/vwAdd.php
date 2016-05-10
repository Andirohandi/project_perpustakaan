
<section class="content-header">
    <h1>
        Pengembalian Buku
        <small>Menejemen Pengembalian Buku</small>
    </h1>
	<ol class="breadcrumb">
    <li><a href="<?php echo base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url('p/pengembalian')?>"> Pengembalian Buku</a></li>
    <li class="active">Tambah Pengembalian Buku</li>
</ol>
</section>
<br/>
<section class="content">
	<div class='row'>
		<div class="col-md-12">
			<div class="box box-info">
                <div class="box-header with-border">
					<h3 class="box-title"><i class='fa fa-bookmark'></i> Tambah Pengembalian Buku</h3>
					<div class="box-tools pull-right">
						<a href='javascript:void(0)' onclick='pageLoad(1)' class="btn btn-box-tool"><i class='fa fa-refresh'></i> </a>
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
                </div>
                <?php echo form_open_multipart('p/pengembalian/simpan'); ?>
					<div class="box-body">
						<br/>
						<div class='row' style='margin-top:-20px;margin-bottom:10px'>
							<div class='col-md-6'>
								<div class="form-horizontal">
									<div class="form-group">
										<label for="no_pengembalian" class="col-sm-4 control-label">Nomor Pengembalian</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="no_pengembalian" name='no_pengembalian' value="<?php echo getNomorPengembalian(); ?>" readonly >
										</div>
									</div>
									<div class="form-group">
										<label for="tgl_pengembalian" class="col-sm-4 control-label" >Tanggal Pengembalian</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="tgl_pengembalian" name='tgl_pengembalian' value="<?php echo date('d-M-Y')?>" readonly >
										</div>
									</div>
									<div class="form-group">
										<label for="terlambat" class="col-sm-4 control-label">Terlambat (hr)</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="terlambat" name='terlambat' readonly >
										</div>
									</div>
									<div class="form-group">
										<label for="denda" class="col-sm-4 control-label">Denda</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="denda_terlambat" name='denda_terlambat' readonly >
										</div>
									</div>
								</div>
							</div>
							<div class='col-md-6'>
								<div class="form-horizontal">
									<div class="form-group">
										<label for="no_peminjaman" class="col-sm-4 control-label">Nomor Peminjaman</label>
										<div class="col-sm-8">
											<div class="input-group pull-right" >
												<input type="text" class="form-control" id="no_peminjaman" name='no_peminjaman' readonly placeholder="Cari Nomor Peminjaman.." required >
												<input type="hidden" class="form-control" id="id_peminjaman" name='id_peminjaman' required >
												<div class="input-group-btn">
													<a href="javascript:void(0)" class="btn btn-warning btn-sm" style='padding-top:8px;padding-bottom:5px' data-toggle="modal" data-target="#cari-peminjaman" ><i class="fa fa-search"></i></a>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="tgl_peminjaman" class="col-sm-4 control-label" >Tanggal Peminjaman</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="tgl_peminjaman" name='tgl_peminjaman' value="" readonly required >
										</div>
									</div>
									<div class="form-group">
										<label for="tgl_kembali" class="col-sm-4 control-label" >Tanggal Pengembalian</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="tgl_kembali" name='tgl_kembali' value="" readonly required >
										</div>
									</div>
									<div class="form-group">
										<label for="tgl_perpanjangan" class="col-sm-4 control-label" >Tanggal Perpanjangan</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="tgl_perpanjangan" name='tgl_perpanjangan' value="" readonly required >
										</div>
									</div>
									<div class="form-group">
										<label for="nip_nim" class="col-sm-4 control-label" >NIP / NIM Peminjam</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="nip_nim" name='nip_nim' value="" readonly required >
										</div>
									</div>
									<div class="form-group">
										<label for="nama_peminjam" class="col-sm-4 control-label" >Nama Peminjam</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="nama_peminjam" name='nama_peminjam' value="" readonly required >
										</div>
									</div>
									<div class="form-group">
										<label for="status" class="col-sm-4 control-label" >Kategori Anggota</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="status" name='status'  readonly required >
										</div>
									</div>
								</div>
							</div>
							<div class='col-md-12'>
								<div id="dataBuku"></div>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<a class='btn btn-success pull-right disabled' id='simpan-input' name='simpan-input' onclick='simpan()' ><i class='fa fa-check'></i> Proses Pengembalian</a>
						<button type='submit' class='btn btn-success pull-right hide' id='simpan-input2' name='simpan-input2' ><i class='fa fa-check'></i> Proses Pengembalian </button>
						<a href="<?php echo site_url('p/pengembalian')?>" class='btn btn-default pull-right' style='margin-right:10px' ><i class='fa fa-undo'></i> Kembali</a>
					</div>
				<?php echo form_close()?>
			</div>
		</div>
	</div>
</section>

<!-- modal cari peminjaman !-->
<div id='cari-peminjaman' class='modal custom ' tabindex='-1' role='dialog'aria-hidden='true' data-backdrop='static'>
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class='fa fa-bookmark'></i> Cari Peminjaman</h4>
			</div>
			<div class="modal-body" style="min-height:180px;">
				<div class='row'>
					<div class="col-md-4">
						<select class="form-control" name="level" id="level" onchange='pageLoadModal(1)'  >
							<?php echo get_select_kategori_anggota()?>
						</select>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<div class="input-group pull-right">
								<input type="text" name="cari_pnj" id='cari_pnj' class="form-control col-sm-4 col-xs-12" placeholder="Cari nomor peminjaman / nama .." onchange='pageLoadModal(1)' >
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
	search_user();
	pageLoadModal(1)
	<?php if($this->session->flashdata('result') == 1 ){ ?>
		alertify.success("<b><i class='fa fa-check'></i> Transaksi berhasil disimpan</b>");
	<?php } else if($this->session->flashdata('result') == 2 ) {?>
		alertify.error("<b><i class='fa fa-remove'></i> Transaksi gagal disimpan</b>")
	<?php } else { } ?>
	
	$('#tanggal').daterangepicker();
	$("#simpan-input").click(function(){
		$('#simpan-input2').click();
	});
});

function pageLoadModal(i){
	var cari 	= $('#cari_pnj').val();
	var level 	= $('#level').val();
	
	$.ajax({
		url		: '<?php echo base_url()?>p/peminjaman/read_cari/'+i,
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

function getDataBuku(x){
	$.ajax({
		url		: '<?php echo base_url()?>p/peminjaman/get_detail_buku/'+x,
		type	: 'post',
		dataType: 'html',
		beforeSend : function(){
			
		},
		success : function(result){
			$('#dataBuku').html(result);
		}
	})
}

function search_user(){
	var cari 	= $('#cari_pnj').val();
	var level 	= $('#level').val();
	
	if(level == ''){
		$('#dataSearch').html("<h3 style='text-align:center;'><i class='fa fa-warning'></i> Silahkan pilih status peminjam untuk mencari peminjaman</h3>");
	}else{
		pageLoadModal(1)
	}
}

function getDataPeminjaman(id_peminjaman,no_peminjaman,tgl_peminjaman,nama_peminjam,status,terlambat,denda, tgl_kembali, tgl_perpanjangan,nip_nim){
	$("#id_peminjaman").val(id_peminjaman);
	$("#no_peminjaman").val(no_peminjaman);
	$("#tgl_peminjaman").val(tgl_peminjaman);
	$("#nama_peminjam").val(nama_peminjam);
	$("#status").val(status);
	$("#terlambat").val(terlambat);
	$("#denda_terlambat").val(denda);
	$("#tgl_kembali").val(tgl_kembali);
	$("#tgl_perpanjangan").val(tgl_perpanjangan);
	$("#nip_nim").val(nip_nim);
	$('#cancel-modal').click();
	$('#simpan-input').removeClass('disabled');
	getDataBuku(id_peminjaman);
}

</script>