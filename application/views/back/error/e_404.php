		<div class="col-md-12">
			<br/>
			<div class="panel" >
				<div id="panel-title">
					<center><h3> ERROR : 404 Page Not Found</h3></center>
				</div>
				<div class="panel-body">
					<br/>
					<center><img src="<?php echo site_url()?>assets/img/404.png" class="img img-responsive"></center>
					<br/>
					<br/>
					<br/>
					<button class="btn btn-default pull-right" id="back"><i class="fa fa-arrow-left"></i> Kembali</buuton>
				</div>
			</div>
		</div>

<script>
$(document).ready(function(){
	$('#back').click(function(){
		window.history.go(-1);
	})
});
</script>