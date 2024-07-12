<head>
	<!-- FONT fontawesome -->
	<link rel="icon" href="href="https://dongphucvina.vn/wp-content/uploads/2022/09/Logo-DH-Su-Pham-Ky-Thuat-TP-Ho-Chi-Minh-HCMUTE-623x800.webp"">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css"></link>
	<link rel='stylesheet' type='text/css' href="css/bootstrap.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/header.css"/>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<header>
<?php include'loading.php'; ?> 
<div class="container">
  <div class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top"> 
      <div class="col-1"></div>
      <div class="col-1">
      <img style="width: 30px;" src="https://dongphucvina.vn/wp-content/uploads/2022/09/Logo-DH-Su-Pham-Ky-Thuat-TP-Ho-Chi-Minh-HCMUTE.webp" class="rounded" alt="Cinque Terre">
      </div>
  <div class="col-3"></div>
  <div class="col-2 text-info" style="font-size: 15px;">Hệ thống điểm danh - ĐHSPKT </div>
  <div class="col-5">
  	<a class="btn btn-warning" href="index.php">Trang chủ <i class="fa-solid fa-house"></i></i></a>
  	<a class="btn btn-success" href="list.php">Danh sách SV <i class="fa-solid fa-list"></i></a>
    <a class="btn btn-success" href="ManageUsers.php">Thêm dữ liệu <i class="fa-solid fa-plus"></i></a>
    <a class="btn btn-success" href="UsersLog.php">Lịch sử đăng nhập <i class="fa-solid fa-clock-rotate-left"></i></a>
    <a class="btn btn-success" href="devices.php">Quản lý thiết bị <i class="fa-solid fa-bars-progress"></i></a>
	<?php  
    	if (isset($_SESSION['Admin-name'])) {
    		echo '<a class="btn btn-success" href="update_tai_khoan_admin.php">Admin <i class="fa-solid fa-user-tie"></i></a>';
			echo '<a class="btn btn-danger" href="logout.php">Log Out <i class="fa-solid fa-right-to-bracket"></i></a>';
    	}
		else if (isset($_SESSION['user_id'])) {
    		echo '<a class="btn btn-success" href="update_tai_khoan_admin.php">Admin <i class="fa-solid fa-user-tie"></i></a>';
			echo '<a class="btn btn-danger" href="logout.php">Log Out <i class="fa-solid fa-right-to-bracket"></i></a>';
    	}
    	else{
    		echo '<a class="btn btn-success" href="login.php">Log In <i class="fa-solid fa-arrow-right-from-bracket"></i></a>';
    	}
    ?>
  </div>
</div>

<?php  
  if (isset($_GET['error'])) {
		if ($_GET['error'] == "wrongpasswordup") {
			echo '	<script type="text/javascript">
					 	setTimeout(function () {
			                $(".up_info1").fadeIn(200);
			                $(".up_info1").text("The password is wrong!!");
			                $("#admin-account").modal("show");
		              	}, 500);
		              	setTimeout(function () {
		                	$(".up_info1").fadeOut(1000);
		              	}, 3000);
					</script>';
		}
	} 
	if (isset($_GET['success'])) {
		if ($_GET['success'] == "updated") {
			echo '	<script type="text/javascript">
			 			setTimeout(function () {
			                $(".up_info2").fadeIn(200);
			                $(".up_info2").text("Tài khoản đã được cập nhật thành công!");
              			}, 500);
              			setTimeout(function () {
                			$(".up_info2").fadeOut(1000);
              			}, 3000);
					</script>';
		}
	}
	if (isset($_GET['login'])) {
	    if ($_GET['login'] == "success") {
	      echo '<script type="text/javascript">
	              
	              setTimeout(function () {
	                $(".up_info2").fadeIn(200);
	                $(".up_info2").text("Đăng nhập thành công!");
	              }, 500);

	              setTimeout(function () {
	                $(".up_info2").fadeOut(1000);
	              }, 4000);
	            </script> ';
	    }
	  }
?>
<br>
<br>
<br>
<br>

<div class="up_info1 alert-danger"></div>
<div class="up_info2 alert-success"></div>
</header>
<script>
	function navFunction() {
	  var x = document.getElementById("myTopnav");
	  if (x.className === "topnav") {
	    x.className += " responsive";
	  } else {
	    x.className = "topnav";
	  }
	}
</script>


	

	
