<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
	<style type="text/css">
		.menu {
			width: 100%;
			height: 300px;
			color: #fff;
		}
		.menu:hover {
			color: #fff;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Sistem Antrian</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
   
  </div>
</nav>
<div class="row" style="margin-top: 5%; padding: 5%;">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-4"><button class="btn btn-primary menu" onclick="antrian();">Ambil Antrian</button></div>
			<div class="col-md-4"><button class="btn btn-warning menu"onclick="dashboard();">Dashboard</button></div>
			<div class="col-md-4"><button class="btn btn-success menu" onclick="loket();">Loket</button></div>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
	function antrian () {
	window.location.href = "<?= base_url('antrian'); ?>";
	}
	function loket () {
	window.location.href = "<?= base_url('loket'); ?>";
	}
	function dashboard () {
	window.location.href = "<?= base_url('dashboard'); ?>";
	}
</script>