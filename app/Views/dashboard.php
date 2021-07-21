<!DOCTYPE html>
<html>
<head>
	<title>Loket</title>
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
		<script type="text/javascript" src="<?= base_url('assets/js/jquery.js');?>"></script>
		<style type="text/css">
			body {
				padding-left: 5%;
				padding-right: 5%;
				padding-top: 1%;
				margin: 0;
			}
			.header {
				background-color: #4287f5;
				display: flex;
				align-content: center;
				justify-content: center;
				color:#fff;
				vertical-align: center;
				height: 100px;
			}
			.luar {
				border: 1px solid #1767e6;
			}
			.screen1 {
				
				height: 300px;
			}
			.screen2 {
		   
		     height: 200px;
			}
			.luar2{
				padding: 5%;
			}
		</style>
</head>
<body onload="list2()">
<div class="row luar">
	<div class="col-md-12 header">
		<h2 style="margin-top: 2%;">Info Pemanggilan</h2>
	</div>
	<div class="col-md-12">
		<div class="row luar2">
			<div class="col-md-12 screen1" style="padding-left:5%; padding-right: 5%; padding-top: 0%;">
				<div class="row" style="padding-top: 0%;" >
					<div class="col-md-4" style="background-color: #42f554;
					 height:250px; padding: 0;">
					 <div style="width: 100%; background-color: orange; padding:5%; " >
					 	<h6 style="width: 100%; text-align: center; color: #fff;">Panggilan Antrian</h6>
					 </div>
						<div style="width: 100%; padding: 10%;">
							<h1 style="width:100%; text-align: center;" id="utamano">--</h1>
						</div>
						 <div style="width: 100%; background-color: orange; padding:5%; " >
					 	<h4 style="width: 100%; text-align: center; color: #fff;" id="utamaloket">--</h4>
					 </div>
					</div>
					<div class="col-md-7 offset-md-1" style="background-color: orange; height:250px; padding: 0;">
						<iframe style="width: 100%; height: 100%;" 
src="https://www.youtube.com/embed/tgbNymZ7vqY">
</iframe>
						
					</div>
				</div>
			</div>
			<div class="col-md-12 screen2">
				<div class="row" id="list">
					
					
				</div>
				
			</div>
		</div>
	</div>
</div>	

</body>
</html>
<script type="text/javascript">

     err = false;
	var angka;
	function list() {
		$('#list').html("").fadeIn().delay(2000);
		$.ajax({
    type: 'GET',
    url: "/loket/getdashboard",
    cache: true,
    dataType: 'json',
    success: function(result){  
    	err = false;
      var obj = result;
      angka = result.length;
       	  for(var i=0; i < obj.length ;i++){
                             $("#list").append("<div class='col-md-2' style=' height:200px; margin-top: 1%; '><div style='width:100%; height: 100%; background-color: #34c0eb; '><div style='width: 100%; height:75%; padding-top:30%; '><h3 style='width: 100%; color: #fff; text-align: center;'>"+obj[i].no_antrian+"</h3></div><div style='width: 100%; background-color: blue; height:50px; '><h2 style='width: 100%; text-align: center; color: #fff;'>"+obj[i].nama_loket+"</h2></div></div></div>");

                    
       	  	
       	    
       	    }
    },
    error: function(result){
      console.log("read data error");
      err = true; 

    }
  });
	}

	function list2() {
		 
		 if (err == true) {
		 	$("#utamano").html("")
       	  $("#utamaloket").html("")
       		$("#utamano").html("--")
       	  $("#utamaloket").html("--")
       	} else {}
		$.ajax({
    type: 'GET',
    url: "/loket/getdashboard",
    cache: true,
    dataType: 'json',
    success: function(result){  
    	
      var obj = result;
      angka = result.length -1;
       	  console.log(obj[angka]);
       	 if (obj.length != null) {
       	 	err = false;
       	 	 $("#utamano").html(obj[angka].no_antrian)
       	  $("#utamaloket").html(obj[angka].nama_loket)
       	} else {
           err = true;
       		
       	}
    },
    error: function(result){
    	$("#utamano").html("")
       	  $("#utamaloket").html("")
       		$("#utamano").html("--")
       	  $("#utamaloket").html("--")
      console.log("read data error");
      err = true; 

    }
  });
	}
setInterval(function () {
		console.log("test")
		list();
		list2();
		
	}, 2000);
</script>