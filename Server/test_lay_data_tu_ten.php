<?php
// 	$servername = "localhost";
//     $username = "root";		//put your phpmyadmin username.(default is "root")
//     $password = "";			//if your phpmyadmin has a password put it here.(default is "root")
//     $dbname = "rfidattendance";
    
// 	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

// $sql = "SELECT id, username, serialnumber, timein FROM users_logs WHERE username LIKE '%Cao Van Vinh%' ORDER BY id DESC LIMIT 1";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     echo "id: " . $row["id"]. " - Name: " . $row["username"]. " - " . $row["serialnumber"]. " -Time in" .$row["timein"]."<br>";
//   }
// } else {
//   echo "0 results";
// }
// $conn->close();



$servername = "localhost";
$username = "mvg65saklnbm_vinhcao"; // put your phpmyadmin username.(default is "root")
$password = "Vinh02012003@"; // if your phpmyadmin has a password put it here.(default is "root")
$dbname = "mvg65saklnbm_vinhcao";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = mysqli_real_escape_string($conn, $_POST['search']);
$search = "%$search%"; // Thêm ký tự % vào trước và sau chuỗi tìm kiếm

$sql = "SELECT id, username, serialnumber, timein, timeout FROM users_logs WHERE username LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();



// echo '<table class="table table-condensed table-hover">';
// echo '<tr class="table-info "> 
//         <td>ID</td> 
//         <td>Tên NV</td> 
//         <td>Mã số thẻ</td>
//         <td>Thời gian vào</td>
//         <td>Thời gian ra</td>
//       </tr>';


if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Name: " . $row["username"] . " - " . $row["serialnumber"] . " -Time in" . $row["timein"] . " -Time out" . $row["timeout"] . "<br>";
    }
} else {
    echo "Không tìm thấy kết quả nào trên hệ thống";
}
$conn->close();


?>

