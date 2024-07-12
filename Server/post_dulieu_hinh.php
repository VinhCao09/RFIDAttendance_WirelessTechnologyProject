<?php
// Kết nối tới cơ sở dữ liệu MySQL
require'connectDB.php';

// Kiểm tra và lưu trữ các tệp ảnh
$uploadDir = "uploads/";
$anh1Path = "";


if (!empty($_FILES['anh1']['name'])) {
    $anh1Path = $uploadDir . basename($_FILES['anh1']['name']);
    move_uploaded_file($_FILES['anh1']['tmp_name'], $anh1Path);
}


// Chuẩn bị và thực thi truy vấn SQL để chèn dữ liệu vào cơ sở dữ liệu
$sql = "INSERT INTO hinh_anh (anh1) 
        VALUES ('$anh1Path')";

if ($conn->query($sql) === TRUE) {
    echo "Dữ liệu đã được gửi thành công!";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

// Đóng kết nối với cơ sở dữ liệu
$conn->close();
?>
