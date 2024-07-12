<?php
$password = "123";
$options = [
    'cost' => 10, // Độ phức tạp của thuật toán, giá trị mặc định là 10
];
$hash = password_hash($password, PASSWORD_BCRYPT, $options);
echo $hash; // In ra chuỗi hash
?>