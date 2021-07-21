<!DOCTYPE html>
<html>
<head>
	<title>Menu Antrian</title>
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
		<script type="text/javascript" src="<?= base_url('assets/js/jquery.js');?>"></script>
		<style type="text/css">
			.roundedborder {
				border-radius: 10px;
				background-color: orange;
				display: flex;
				align-content: center;
				justify-content: center;
				margin-top: 5%;
				color: #fff;
			}
			.menu {
			width: 100%;
			height: 100px;
			color: #fff;
		}
		.menu:hover {
			color: #fff;
			background-color: #47f241;
		}
		</style>
</head>
<body style="padding-left: 15%; padding-right: 15%; border: 1px solid #4db2fa; height: 600px; overflow-y: scroll;">
<div class="row" style="padding-left: 6%; padding-right: 6%; height: 100px;">
	<div class="col-md-12 roundedborder">
		<h4 style="margin-top: 1%;">Menu Antrian</h4>
	</div>
</div>
<div class="row" style="padding-left: 5%; padding-right: 5%; margin-top: 2%;">
	<?php  if (! empty($layanan)) {
		# code...
	
                    foreach($layanan as $key => $data) { ?>
                    <div class="col-md-6" style="margin-top: 3%;">
                    <button class="btn btn-primary menu" onclick="getantrian(<?= $data['id'] ?>, '<?= $data['kode']?>')"><?= $data['nama'];?></button>	
                    </div>
                <?php } } ?>
</div>
</body>
</html>
<script type="text/javascript">
	function getantrian (id, kode) {
 var currentdate = new Date(); 
var datetime =  currentdate.getFullYear()  + "-"
                + (currentdate.getMonth()+1)  + "-" 
                + currentdate.getDate() + " "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
             + currentdate.getSeconds();
             console.log('id ='+id+', '+datetime)
             console.log(kode);
  var no_antrian;
  if (!localStorage.getItem(kode)) {
     
    localStorage.setItem(kode,'1');
    no_antrian = localStorage.getItem(kode);
  } else {
  	no_antrian = parseInt(localStorage.getItem(kode)) +1; 
  	localStorage.setItem(kode, no_antrian);
  }
  console.log(localStorage.getItem(kode));       
    $.ajax({
    type: 'POST',
    url: '/antrian/insert',
    dataType: 'json',
    data : {'id_pelayan':id,
            'tanggal':datetime,
            'no_antrian':kode+no_antrian
            },
    success: function(result){
      console.log(result);
      alert('nomor antrian anda : '+kode+no_antrian)
     
      
    },
    error: function(result){
      console.log(result);
    }
  });
	}
</script>