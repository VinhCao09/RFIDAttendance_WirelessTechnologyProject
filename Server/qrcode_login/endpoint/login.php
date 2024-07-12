<?php
include ('../conn/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $qrCode = $_POST['qr-code'];

    $stmt = $conn->prepare("SELECT `generated_code`, `name`, `tbl_user_id` FROM `taikhoan_qrcode` WHERE `generated_code` = :generated_code");
    $stmt->bindParam(':generated_code', $qrCode);
    $stmt->execute();

    $accountExist = $stmt->fetch();

    if ($accountExist) {
        session_start();
        $_SESSION['user_id'] = $accountExist['tbl_user_id'];

        $name = $accountExist['name'];
        $user_id = $accountExist['tbl_user_id'];

        echo "
        <script>
            alert('Đăng nhập với QR Code thành công!');
            window.location.href = '/index.php';
        </script>
        "; 
    } else {
        echo "
        <script>
            alert('QR code này không hợp lệ'); 
            window.location.href = '/qrcode_login/';
        </script>
        "; 
    }
}

?>
