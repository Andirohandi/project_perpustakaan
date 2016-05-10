<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo http_b ?>bootstrap/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" >
        
        <link rel="stylesheet" href="<?php echo http_b ?>plugins/iCheck/all.css">
        <link rel="stylesheet" href="<?php echo http_b ?>plugins/select2/select2.min.css">
        <link rel="stylesheet" href="<?php echo http_b ?>plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="<?php echo http_b ?>plugins/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="<?php echo http_b ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
		<link rel="stylesheet" href="<?php echo http_b ?>dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo http_b ?>dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="<?php echo http_b ?>dist/css/skins/skin-purple.min.css">
		<link rel="shortcut icon" href="<?php echo http_f ?>img/logo.ico">
        <script src="<?php echo http_b ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!--script src="<?php echo http_b ?>plugins/jQuery/jquey_validate.js"></script!-->
        <script src="<?php echo http_b ?>plugins/jQueryUI/jquery-ui.min.js"></script>
		
		<link href="<?php echo base_url();?>assets/alertify/css/alertify.core.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/alertify/css/alertify.default.css" rel="stylesheet">
		<script src="<?php echo base_url();?>assets/alertify/js/alertify.min.js"></script>
		
		<script src="<?php echo http_b ?>dist/js/app.min.js"></script>
		<script src="<?php echo http_b ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
		
		<style>
			.modal.custom .modal-dialog {
				/*width:70%;*/
				/*margin:0 auto;
				add what you want here*/
				border: 10px solid rgba(0, 0, 0, .5);
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
			}
			.modal.custom .modal-content{
				-webkit-border-radius: 0px;
				-moz-border-radius: 0px;
				border-radius: 0px;
			}
		</style>
    </head>
    <body class="hold-transition skin-purple sidebar-mini fixed">
        <div class="wrapper">
			<?php 
				$setting = $this->m_setting->getAll();
			?>
            <!-- Navbar header --!-->
            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo site_url('')?>" class="logo">
					<?php if($setting['logo_perpustakaan']){ ?>
                    <span class="logo-mini"><img src="<?php echo base_url($setting['logo_perpustakaan']) ?>" class="user-image"  /></span>
					<?php } ?>
					<span class="logo-lg" >
						<img src="<?php echo base_url($setting['logo_perpustakaan']) ?>" class="user-image"  /> <?php echo $setting['nama_perpustakaan']?>
					
					</span>
                </a>
                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="hidden-xs"><?php echo $this->session->userdata('nama_admin')?></span> &nbsp;<i class="fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu">
									<li class="user-header">
										<img src="<?php echo base_url() ?>assets/img/no_poto.png" class="img-circle" alt="User Image">
										<p>
											<?php echo $this->session->userdata('nama_admin')?>
											<small>Admin</small>
										</p>
									</li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="javascript:void(0)" onclick="getIdUsergantiPassword('<?php echo $this->session->userdata('id') ?>')" data-toggle="modal" data-target="#ganti-password" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Ganti Passwprd</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo site_url('admin/logout');?>" class="btn btn-default btn-flat">Sign out <i class="fa fa-sign-out"></i> </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
			
			<!-- modal ganti password !-->
			<div id='ganti-password' class='modal custom fade' tabindex='-1' role='dialog'aria-hidden='true' data-backdrop='static'>
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title"><i class='fa fa-gear'></i> Form Ganti Password</h4>
						</div>
						<?php echo form_open('p/anggota/ganti_password')?>
						<div class="modal-body" style="min-height:180px;">
							<div id='msg' class='alert alert-danger msg'></div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="password_baru">Password Baru</label>
									<input type="password" class="form-control" id="password_baru" name='password_baru' placeholder='Masukan Password Baru..' required value=" " >
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="password_ulang">Konfirmasi Password</label>
									<input type="password" class="form-control" id="password_ulang" name='password_ulang' placeholder='Masukan Ulang Password..' required >
								</div>
							</div>
							<input type="hidden" class="form-control" id="url_pass" name='url_pass' value="<?php echo $this->uri->segment(1)?>" required >
							<input type="hidden" class="form-control" id="id_user_pass" name='id_user_pass' required >
						</div>
						<div class="modal-footer">
							<div class="col-md-12">
								<button type="button" class="btn btn-primary pull-right" onclick='check_pass()'><i class='fa fa-edit'></i> Simpan</button>
								<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class='fa fa-remove'></i> Cancel</button>
								<button type="submit" class="btn btn-primary hide" name='simpan' id="simpan" ><i class='fa fa-check'></i> Ya</button>
							</div>
						</div>
						<?php echo form_close()?>
					</div>
				</div>
			</div>
			
			<script type='text/javascript'>
			$.fn.ready(function() {
				$('#msg').hide();
				$("#password_baru").val("");
				<?php if($this->session->flashdata('ganti_password')==2) { ?>
					alertify.error("<b>Password gagal diubah</b>");
				<?php } else if($this->session->flashdata('ganti_password')==1) {?>
					alertify.success("<b>Password berhasil diubah</b>");
				<?php } else {} ?>
			});

			function getIdUsergantiPassword(x){
				$('#id_user_pass').val(x);
			}
			
			function check_pass() {
				$('.msg').hide();
				if($('#password_baru').val() != $('#password_ulang').val()) {
					$('#msg').html("<i class='fa fa-remove'></i> Password Baru & Konfirmasi Password Harus Sesuai");
					$('#msg').show();
				} else {
					$('#simpan').click();
				}
			}
			
			$('html').bind('keypress', function(e){
				if(e.keyCode == 13){
					return false;
				}
			});
			</script>