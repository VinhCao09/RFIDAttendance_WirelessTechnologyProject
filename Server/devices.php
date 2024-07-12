<?php
session_start();
if (!isset($_SESSION['user_id'])) {
	// Kiểm tra session Admin-name
	if (!isset($_SESSION['Admin-name'])) {
	  // Nếu không có cả 2 session, chuyển hướng đến login.php
	  header("location: login.php");
	  exit();
	}
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Devices</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--   	<link rel="icon" type="image/png" href="images/favicon.png"> -->
	<link rel="stylesheet" type="text/css" href="css/devices.css"/>

	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"
	        integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
	        crossorigin="anonymous">
	</script>
    <script type="text/javascript" src="js/bootbox.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script src="js/dev_config.js"></script>
	<script>
	  	$(window).on("load resize ", function() {
		    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
		    $('.tbl-header').css({'padding-right':scrollWidth});
		}).resize();
	</script>
	<script>
		$(document).ready(function(){
		    $.ajax({
		      	url: "dev_up.php",
		      	type: 'POST',
		      	data: {
		        'dev_up': 1,
		  		}
	      	}).done(function(data) {
	  			$('#devices').html(data);
    		});
		});
	</script>
</head>
<body>
<?php include'header.php';?>
<main>
    <div class="mt-4 p-5 bg-primary text-white rounded bg-opacity-50 ">
      <h1>Quản lý thiết bị</h1>
      <p class="row justify-content-center"></p>
    </div>  


	<section class="container py-lg-5">
		<div class="alert_dev"></div>
		<!-- devices -->
		<div class="row">
			<div class="col-lg-12 mt-4">
				<div class="panel">
			      <div class="panel-heading" style="font-size: 19px;">Danh sách thiết bị:
			      </div>
			      <div class="panel-body">
			      		<div id="devices"></div>
			      </div>
			    </div>
			</div>
		</div>

		
		<!-- New Devices -->

				<div class="panel">
					<div class="bg-danger" style="font-size: 19px; color: white"><strong>Thêm máy mới:</strong>
				</div>

		      <form action="" method="POST" enctype="multipart/form-data">
			      <div class="alert alert-success">
			      	<label class = "fs-3" for="User-mail"><b>Tên thiết bị:</b></label>
			      	<input class = "form-control" type="text" name="dev_name" id="dev_name" placeholder="Device Name..." required/><br>
			      	<label class = "fs-3" for="User-mail"><b>Bộ phận đặt máy:</b></label>
			      	<input class = "form-control" type="text" name="dev_dep" id="dev_dep" placeholder="Device Department..." required/><br>
			      </div>
			      <div class="modal-footer">
			        <button type="button" name="dev_add" id="dev_add" class="btn btn-success btn-lg">Create new Device</button>
			        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
			      </div>
			  </form>
		

		<!-- //New Devices -->
	</section>
</main>
</body>
</html>