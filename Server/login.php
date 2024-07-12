<?php
session_start();
if (isset($_SESSION['Admin-name'])) {
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="js/jquery-2.2.3.min.js"></script>
    <script>
      $(window).on("load resize ", function() {
          var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
          $('.tbl-header').css({'padding-right':scrollWidth});
      }).resize();
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(document).on('click', '.message', function(){
          $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
          $('h1').animate({height: "toggle", opacity: "toggle"}, "slow");
        });
      });
    </script>
<!-- CSS https://www.ludiflex.com/responsive-login-page-created-with-bootstrap-5/ -->
<!-- ************************* -->
    <style>
          @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');
    body{
        font-family: 'Poppins', sans-serif;
        background: #ececec;
    }
    /*------------ Login container ------------*/
    .box-area{
        width: 930px;
    }
    /*------------ Right box ------------*/
    .right-box{
        padding: 40px 30px 40px 40px;
    }
    /*------------ Custom Placeholder ------------*/
    ::placeholder{
        font-size: 16px;
    }
    .rounded-4{
        border-radius: 20px;
    }
    .rounded-5{
        border-radius: 30px;
    }
    /*------------ For small screens------------*/
    @media only screen and (max-width: 768px){
        .box-area{
            margin: 0 10px;
        }
        .left-box{
            height: 100px;
            overflow: hidden;
        }
        .right-box{
            padding: 20px;
        }
    }
        </style>
</head>
<body>
<?php include'header.php'; ?> 
<main>
  <marquee  style="background-color: white;   font-size: 30px " class="slideInDown animated">Hệ thống quản lý & điểm danh sinh viên sử dụng công nghệ RFID - Tác giả: Cao Văn Vinh - Nguyễn Văn Lân - Dương Trung Kiên</marquee>


  <!----------------------- Main Container -------------------------->
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <!----------------------- Login Container -------------------------->
       <div class="row border rounded-5 p-3 bg-white shadow box-area">
    <!--------------------------- Left Box ----------------------------->
       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="">
           <div class="featured-image mb-3">
            <img src="https://dongphucvina.vn/wp-content/uploads/2022/09/Logo-DH-Su-Pham-Ky-Thuat-TP-Ho-Chi-Minh-HCMUTE.webp" class="img-fluid" style="width: 250px;">
           </div>
           </div> 
    <!-------------------- ------ Right Box ---------------------------->
        
       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-4">
                     <h2>HỆ THỐNG ĐIỂM DANH SINH VIÊN SỬ DỤNG RFID</h2>
                     <p>Nhóm 6 - Cao Văn Vinh - Nguyễn Văn Lân - Dương Trung Kiên.</p>
                      <?php  
                        if (isset($_GET['error'])) {
                          if ($_GET['error'] == "invalidEmail") {
                              echo '<div class="alert alert-danger">
                                      Email không hợp lệ!!
                                    </div>';
                          }
                          elseif ($_GET['error'] == "sqlerror") {
                              echo '<div class="alert alert-danger">
                                      Không thể truy cập vào CSDL!!
                                    </div>';
                          }
                          elseif ($_GET['error'] == "wrongpassword") {
                              echo '<div class="alert alert-danger">
                                      Sai mật khẩu! Vui lòng thử lại
                                    </div>';
                          }
                          elseif ($_GET['error'] == "nouser") {
                              echo '<div class="alert alert-danger">
                                      Email không tồn tại trong hệ thống.
                                    </div>';
                          }
                        }
                        if (isset($_GET['reset'])) {
                          if ($_GET['reset'] == "success") {
                              echo '<div class="alert alert-success">
                                      Check your E-mail!
                                    </div>';
                          }
                        }
                        if (isset($_GET['account'])) {
                          if ($_GET['account'] == "activated") {
                              echo '<div class="alert alert-success">
                                      Please Login
                                    </div>';
                          }
                        }
                        if (isset($_GET['active'])) {
                          if ($_GET['active'] == "success") {
                              echo '<div class="alert alert-success">
                                      The activation like has been sent!
                                    </div>';
                          }
                        }
                      ?>
                </div>
                <form class="login-form" action="ac_login.php" method="post" enctype="multipart/form-data">

                    <input  type="email" name="email" id="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address">
                    
                    <input  type="password" name="pwd" id="pwd" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                
                    <button type="submit" name="login" id="login"  class="btn btn-primary w-100 fs-6" style="font-size:20px;"> Login</button>

                    <a class="btn btn-warning w-100 p-3" style="font-size:20px;" href="qrcode_login/index.php">Hoặc đăng nhập bằng mã QR CODE <i class="fa-solid fa-qrcode"></i></a>
                </form>
       </div> 
      </div>
    </div>
     



<!-- Log In -->
       



        <!-- <form class="login-form" action="ac_login.php" method="post" enctype="multipart/form-data">
          <input type="email" name="email" id="email" placeholder="E-mail..." required/>
          <input type="password" name="pwd" id="pwd" placeholder="Password" required/>
          <button type="submit" name="login" id="login">login</button>
          <p class="message">Quên mật khẩu? <a href="#">Reset mật khẩu</a></p>
        </form> -->
        

</main>

</body>
</html>