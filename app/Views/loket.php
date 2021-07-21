<!DOCTYPE html>
<html>
<head>
	<title>Loket</title>
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/datatable.css'); ?>">
		<script type="text/javascript" src="<?= base_url('assets/js/jquery.js');?>"></script>

		<script type="text/javascript" src="<?= base_url('assets/js/datatable.js');?>"></script>

		<script type="text/javascript" src="<?= base_url('assets/js/datatable.bootstrap.js');?>"></script>
		<style type="text/css">
			body {
				padding-left: 5%;
				padding-right: 5%;
				padding-top: 1%;
				margin: 0;
			}
			.header {
				background-color: #4287f5;
				]
				color:#fff;
				height: 100px;
			}
			.luar {
				border: 1px solid #1767e6;
			}
			.screen1 {
				
				height: 300px;
				padding-left:5%;
				padding-right:5%;
			}
			.screen2 {
		    
		     height: 400px;
				padding-left:5%;
				padding-right:5%;

			}
			.luar2{
				padding: 5%;
			}
			.box-panggil {
				background-color: #28fa40;
				height: 200px;

			}
			.btn {
				width: 100%;
			}
			.but-grp {
				margin-top:3%; 
			}
			.header-table {
				margin-top: 0%;
				padding-left: 5%;
				padding-right: 5%;
			}
			.header-table-text {
				background-color: orange;
				color:#fff;
				padding: 2%;
				border-radius: 5px;
			}
			.table-box {
				height: 300px;
				overflow-y: scroll; }
		</style>
</head>
<body onload="detail_layanan();">
<div class="row luar">
	<div class="col-md-12 header">
		<select class="form-control" id="selectloket" style="width: 100px;float: left; margin-top: 1%;">
				<?php  if (! empty($loket)) {
                    foreach($loket as $key => $data) { ?>
                    	<option value="<?= $data['id'];?>"><?= $data['nama'] ?></option>
                    <?php }} ?>
		</select>
		<h2 id="layananloket" style="margin-top: 2%; width: 100%; color: #fff; text-align: center;">Pelayanan Loket</h2>
	</div>
	<div class="col-md-12">
		<div class="row luar2">
			<div class="col-md-6 screen1">
				<div class="row">
					<div class="col-md-12">
						<div class="box-panggil">
					<div  style="width: 100%; background-color: orange; color:#fff;  height: 50px; padding-top: 1%;
					"><h4 style="text-align: center;" id="status">--</h4></div>
					<h1 style="text-align: center; margin-top:10%; " id="no_antrian">--</h1>
				</div>
					</div>
					<div class="col-md-12">
				      <!-- btn group -->
				      <div class="row but-grp">
				      	
				      	<div class="col-md-6">
				      		<button class="btn btn-success" onclick="selesai();">Selesai</button>
				      	</div>
				      	<div class="col-md-6">
				      		<button class="btn btn-danger" onclick="tidakada();">Tidak Ada</button>
				      	</div>
				      </div>
				      <!-- endbtn -->
					</div>
				</div>
				
				
			</div>
			<div class="col-md-6 screen2">
				<div class="row">
					<div class="col-md-12 header-table">
						<div class="header-table-text">
							<h3 style="text-align: center;">Daftar Antrian Selanjutnya</h3>
						</div>
					</div>
					<div class="col-md-12 table-box" style="margin-top: 5%;">
						  <table id="example2" class="table table-bordered table-striped" style="width: 100%!important">
                 <thead>
            <tr>
                <th width="100">no antrian</th>
                <th width="100">panggil</th>
                <th width="100">status</th>

               </tr>
                  </thead> 
                  <tbody>
                    
                  </tbody>
                   
          
                  
          </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
<audio id="audio" src="<?= base_url('assets/sound/bell.mp3'); ?>"></audio>
</body>
</html>
<script type="text/javascript">
	err = false;
	var table = $('#example2').DataTable({
  	pagging: false,
  	searching: false,
  	 lengthChange: false,
  	 bPaginate: false,
  	 bInfo: false,
  	 ajax:  {
    type: 'GET',
    url: "/loket/getAntrianloket",
    cache: true,
    dataType: 'json',
    success: function(result){  
    	err = false;
      var obj = result;
       if (obj.length !== 0) {
       	  for(var i=0; i < obj.length ;i++){
       	  	var btn;
       	  	if (obj[i].status === "tidak_ada") {
               btn = '<button class="btn btn-warning" onclick="panggil_data(this)" data-value="'+obj[i].pelayanan_id+' " data-value2="'+obj[i].id+'" data-value3="'+obj[i].no_antrian+'">Panggil lagi</button>';
       	  	} else {
       	  		btn ='<button class="btn btn-primary" onclick="panggil_data(this)" data-value="'+obj[i].pelayanan_id+' " data-value2="'+obj[i].id+'" data-value3="'+obj[i].no_antrian+'">Panggil</button>';
       	  	}

table.row.add([
  obj[parseInt(i)].no_antrian, btn , obj[i].status
]).draw();  }
} else {
	table.row.add(['','','']).draw();
}
    },
    error: function(result){
      console.log("read data error");
      err = true; 

    }
  }
  });
  
  function panggil_data(obj) {
  	var audio = document.getElementById('audio');
  	 audio.play();
  	val = obj.getAttribute('data-value');
  	id_antrian = obj.getAttribute('data-value2');
  	localStorage.setItem('id_antrian', id_antrian);
    loket_id = document.getElementById("selectloket").value
    no_antrian = obj.getAttribute('data-value3');
 
  	 $.ajax({
    type: 'POST',
    url: '/loket/insert',
    dataType: 'json',
    data : {'pelayan_id':val,
            'loket_id':loket_id,
            'id_antrian':id_antrian
            },
    success: function(result){
    	       document.getElementById("no_antrian").innerHTML  = no_antrian;
               document.getElementById("status").innerHTML  = 'Sedang Dilayani';  
    },
    error: function(result){
      console.log(result);
    }
  });
  }
 
setInterval( function () {
	if (err) {
		table.rows().remove();
	}else {table.rows().remove();
    table.ajax.reload();
    detail_layanan();
    
}    
}, 300 );

function detail_layanan(){
	loket_id = document.getElementById("selectloket").value
	$.ajax({
    type: 'GET',
    url: "/loket/getdetail/"+loket_id,
    dataType: 'json',
    success: function(result){  
    	
      	if (result) {
      		document.getElementById("layananloket").innerHTML ="Pelayanan Loket ("+result.nama_layanan+")";
      	} else {
      		document.getElementById("layananloket").innerHTML ="Pelayanan Loket (Tidak Ada)";
      	}
      
    },
    error: function(result){

      console.log(result);       
    }
  });
}

function selesai(){
	
	loket_id = document.getElementById("selectloket").value;
	id_antrian = localStorage.getItem('id_antrian');
	console.log(id_antrian)
	$.ajax({
    type: 'POST',
    url: '/loket/selesai',
    dataType: 'json',
    data : {'loket_id':loket_id,
            'id_antrian':id_antrian
            },
    success: function(result){
    	       document.getElementById("no_antrian").innerHTML  = "--";
               document.getElementById("status").innerHTML  = '--';  
    },
    error: function(result){
      console.log(result);
    }
  });

}

function tidakada(){
	loket_id = document.getElementById("selectloket").value;
	id_antrian = localStorage.getItem('id_antrian');
	console.log(id_antrian)
	$.ajax({
    type: 'POST',
    url: '/loket/tidakada',
    dataType: 'json',
    data : {'loket_id':loket_id,
            'id_antrian':id_antrian
            },
    success: function(result){
    	       document.getElementById("no_antrian").innerHTML  = "--";
               document.getElementById("status").innerHTML  = '--';  
    },
    error: function(result){
      console.log(result);
    }
  });
}
</script>