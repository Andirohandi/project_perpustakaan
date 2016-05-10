		<div class="col-md-9">
			<br/>
			<div class="panel panel-danger" >
				<div id="panel-title">
					<h2>ERROR : 503 Forbidden Access</h2>
				</div>
				<div class="panel-body">
					<br/>
					<img src="<?php echo site_url()?>assets/front/img/503.png" class="img img-responsive">
					<br/>
					<br/>
					<br/>
					<button class="btn btn-default pull-right" id="back"><i class="fa fa-arrow-left"></i> Kembali</buuton>
				</div>
			</div>
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