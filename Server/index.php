<?php
session_start();
// Kiểm tra session user_id
if (!isset($_SESSION['user_id'])) {
  // Kiểm tra session Admin-name
  if (!isset($_SESSION['Admin-name'])) {
    // Nếu không có cả 2 session, chuyển hướng đến login.php
    header("location: login.php");
    exit();
  }
}

// Nếu có một trong hai session, người dùng đã đăng nhập hợp lệ
// Tiếp tục với phần code còn lại của trang web
?>
<!DOCTYPE html>
<html>
<head>
    <title>Trang chủ</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/favicon.png">

    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/Users.css">
</head>
<body>
<?php include'header.php'; ?> 
<main>



<div class="container mt-5 bg-white p-2 text-dark bg-opacity-50">
  <div class="row">
    <div class="col-sm-4">
              <!-- Get realtime from js -->
            <body onload="startTime()">
              <center>
                <p class="fs-3 fw-bold">⏰Bây giờ là</p>
                <strong><div  style="font-size:30px" id="txt"></div></strong>
              </center>
            </body>
          <!-- Get realtime -->
      <h2></h2>
      <h5>Hình ảnh của sản phẩm:</h5>
      <!-- img-thumbnail -->
      <img src="img/sanpham_removebg.png" class="" alt="Sản phẩm">

      <p class="h4">Phát triển bởi: <br>Cao Văn Vinh - Nguyễn Văn Lân - Dương Trung Kiên <br>Trường ĐH Sư phạm Kỹ thuật TPHCM</p>
      <h3 class="mt-4">Liên kết mạng xã hội <i class="fa-solid fa-square-share-nodes"></i></h3>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item" style="margin-bottom: 3px;">
          <a class="nav-link text-dark" style="font-size: 20px" href="https://www.facebook.com/vcao.vn">Facebook <i class="fa-brands fa-facebook"></i></a>
        </li>
        <li class="nav-item" style="margin-bottom: 3px;">
          <a class="nav-link text-dark" style="font-size: 20px" href="#">Youtube <i class="fa-brands fa-youtube"></i></a>
        </li>
        <li class="nav-item" style="margin-bottom: 3px;">
          <a class="nav-link text-dark" style="font-size: 20px" href="#">Instagram <i class="fa-brands fa-instagram"></i></a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>
    <div class="col-sm-8">
    <marquee width="100%" direction="right">
    <!-- <img src="img/dog_run.gif"  width="48" height="31" alt="dog gif"> -->
    <img src="img/dog.gif"  width="70" height="70" alt="dog gif">
</marquee>
    <marquee class="h3">✌️Chào mừng bạn đến với trang quản lý cho admin - Hệ thống điểm danh sinh viên bằng RFID. Chúc bạn một ngày tốt lành!💝💝 </marquee>
    <div id="ww_529fe7d640e51" v='1.3' loc='id' a='{"t":"responsive","lang":"vi","sl_lpl":1,"ids":["wl1802"],"font":"Arial","sl_ics":"one_a","sl_sot":"celsius","cl_bkg":"#1976D2","cl_font":"#FFFFFF","cl_cloud":"#FFFFFF","cl_persp":"#FFFFFF","cl_sun":"#FFC107","cl_moon":"#FFC107","cl_thund":"#FF5722","cl_odd":"#0000000a"}'><a href="https://weatherwidget.org/" id="ww_529fe7d640e51_u" target="_blank">Free weather widget</a></div><script async src="https://app2.weatherwidget.org/js/?id=ww_529fe7d640e51"></script>
    <h2>CHÀO MỪNG!   </h2>
    <iframe src="https://lumalabs.ai/embed/7d4ceb71-c665-4bfe-a3b1-e6237127a84f?mode=sparkles&background=%23ffffff&color=%23000000&showTitle=true&loadBg=true&logoPosition=bottom-left&infoPosition=bottom-right&cinematicVideo=undefined&showMenu=false" width="892" height="500" frameborder="0" title="luma embed" style="border: none;"></iframe>

      <p class="h2">
      🌟 Chào mừng đến với giải pháp điểm danh hiện đại và tiện ích của chúng tôi! 🌟
      </p>
      <p class="h4">
      Bạn đang tìm kiếm một giải pháp điểm danh hiệu quả, đáng tin cậy và dễ sử dụng cho trường học? Hãy để hệ thống điểm danh sinh viên bằng công nghệ RFID của chúng tôi giúp bạn!

    Với sự kết hợp hoàn hảo giữa công nghệ RFID tiên tiến và hệ thống quản lý cơ sở dữ liệu thông minh, chúng tôi mang đến cho bạn một cách tiếp cận mới mẻ và hiệu quả trong việc quản lý thời gian của sinh viên.
      </p>
      <p class="h2">
      🚀 Đặc điểm nổi bật của hệ thống điểm danh của chúng tôi:
      </p>
      <p class="h4">
      - Sử dụng công nghệ RFID: Loại bỏ hoàn toàn việc điểm danh truyền thống, hệ thống điểm danh RFID của chúng tôi sử dụng các thẻ RFID hoặc các thiết bị di động tương thích để nhận dạng và ghi nhận thời gian làm việc một cách tự động và chính xác.
      </p>
      <p class="h4">
      - Cơ sở dữ liệu trực tuyến: Dữ liệu điểm danh của bạn được lưu trữ một cách an toàn và dễ dàng truy cập thông qua website hoặc ứng dụng di động. Bạn có thể theo dõi và quản lý từ bất kỳ đâu, bất kỳ khi nào.
      </p>

      <h2 class="mt-5"> SẢN PHẨM</h2>
      <h5>April 13, 2024</h5>
      
    </div>
  </div>
</div>



</main>
</body>
</html>
<!-- Script nhận thời gian thực online -->
<script>
  // Inside your Javascript file
  function startTime() {
        var today = new Date();

        var day = today.getDate();
        var month = today.getMonth()+1; // January is 0!
        var year = today.getFullYear();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        day = checkTime(day);
        month = checkTime(month);
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('txt').innerHTML =
        day + "/" + month + "/" + year + "<br> " + h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
</script>
<!-- Script chạy thay titile-->
