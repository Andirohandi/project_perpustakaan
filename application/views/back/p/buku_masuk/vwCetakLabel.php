<html>
<head><title>Cetak Label</title>
<script>
	function printContent(el){
		var restorepage = document.body.innerHTML;
		var printcontent = document.getElementById(el).innerHTML;
		document.body.innerHTML = printcontent;
		window.print();
		document.body.innerHTML = restorepage;
	}
</script>


</head>
<link rel="stylesheet" href="<?php echo http_b ?>bootstrap/css/bootstrap.min.css">
<body style='background-color:#808080;'>

<div class='container-fluid'>
<?php 
	if($data_label->num_rows() > 0 ) { ?>	
	<div class='row' >
		<div class='col-sm-3'></div>
		<div class='col-sm-6'  style='background-color:white;min-height:650px;padding-left:40px' >
			<button onclick="printContent('cetak')" class='btn btn-primary btn-sm pull-right' style='margin-top:20px'><i class='glyphicon glyphicon-print'></i> Print</button>
			<div id='cetak'>
				<h2 style='font-family:callibri'>Cetak Label</h2>
				<p style='font-weight:bold;font-size:15px'><?php echo $data_buku['kode_buku']." | ".$data_buku['judul_buku'] ?> </p>
				<?php 
				foreach($data_label->result() as $row){ ?>
					<span style='font-family:callibri;font-size:12px;width:150px'><br/>
					<?php echo $data_buku['kode_buku']." <br/> ".$data_buku['judul_buku'] ?> </span>
					<?php echo bar128($row->id_label_buku); 
				} ?>
			</div>
			
		</div>
		<div class='col-sm-3'></div>
	</div>
	
<?php } ?>
</div>

</body>
</html>