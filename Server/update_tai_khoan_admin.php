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
    <title>Users</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/favicon.png">

    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/Users.css">
    <script>
      $(window).on("load resize ", function() {
        var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
        $('.tbl-header').css({'padding-right':scrollWidth});
    }).resize();
    </script>
</head>
<body>
<?php include'header.php'; ?> 
<div class="container mt-5 bg-white p-2 text-dark bg-opacity-50">
    <div class="mt-4 p-5 bg-primary text-white rounded bg-opacity-50">
      <h1>Cập nhật tài khoản Admin</h1>
      <p class="row justify-content-center">Thay đổi thông tin cho tài khoản admin</p>
    </div>  

    <form action="ac_update.php" method="POST" enctype="multipart/form-data">
      
	      	<label for="User-mail"><b>Admin Name:</b></label>
	      	<input class="form-control" type="text" name="up_name" placeholder="Enter your Name..." required/><br>
	      	<label for="User-mail"><b>Admin E-mail:</b></label>
	      	<input class="form-control" type="email" name="up_email" placeholder="Enter your E-mail..."  required/><br>
	      	<label for="User-psw"><b>Password</b></label>
	      	<input class="form-control"type="password" name="up_pwd" placeholder="Enter your Password..." required/><br>
	  
	
	        <button type="submit" name="update" class="btn-md btn-success">Save changes</button>
	        <button type="button" class="btn-md btn-secondary" data-dismiss="modal">Close</button>
	  </form>
</div>


    
</body>
</html>