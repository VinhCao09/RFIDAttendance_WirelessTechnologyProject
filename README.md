# RFID Attendance - Wireless Technology Project
Hệ thống điểm danh sinh viên sử dụng công nghệ RFID. Đồ án môn công nghệ không dây, bao gồm website quản lý, cơ sở dữ liệu SQL với các chức năng CRUD cơ bản, sử dụng vi điều khiển ESP8266 và Module đọc thẻ RC522. Có chức năng bảo mật thẻ (Key A, Sector 3). Có chức năng đăng nhập với QR.

## Introduction
Dự án này là một hệ thống IoT có khả năng điểm danh tự động với RFID. Giúp dễ dàng quản lý cho các trường học.
- Đề tài có thể lưu trữ thông tin cơ bản của sinh viên như Họ tên, Giới tính, Email, MSSV trên cơ sở dữ liệu SQL. Đồng thể có thể thao tác CRUD (Create, Read, Update & Delete).
- Đề tài bao gồm một website để xem, quản lý, có khả năng truy cập từ xa.
- Có chức năng bảo mật thẻ, chống sao chép thẻ (bảo mật với Key A, Sector 3)

*Giao diện website:*
![images](https://github.com/VinhCao09/RFIDAttendance_WirelessTechnologyProject/blob/main/images/1.jpg)
![images](https://github.com/VinhCao09/RFIDAttendance_WirelessTechnologyProject/blob/main/images/2.jpg)

*Bo mạch thực tế:*

![images](https://github.com/VinhCao09/RFIDAttendance_WirelessTechnologyProject/blob/main/images/5.jpg)

## Deloy
https://diemdanhsinhvien.vinhcaodatabase.com/login.php

Email trải nghiệm: caovanvinh2003@gmail.com - Password: 123

## Software - Programming language & Framework
- Programming for microcontroller: Arduino IDE (2.3.2)
- Server: PHP - Javascript
- Website: HTML5, CSS, Bootstrap 5
- Environment: Apache (XAMPP 3.3.0), PHP 8.2, ESP 8266 2.6.1

## Components:
- ESP8266 Node MCU
- OLED SSD1306 0.96 inch 128x64 & OLED SSD1106 1.3 inch 128x64
- Reader: RC522
- Tag: MIFARE Classic

## Schematic:
![images](https://github.com/VinhCao09/RFIDAttendance_WirelessTechnologyProject/blob/main/images/7.jpg)

## Printed Circuit Board (Design on EasyEDA):
![images](https://github.com/VinhCao09/RFIDAttendance_WirelessTechnologyProject/blob/main/images/6.jpg)

## Intruduction RFID

Công nghệ RFID sử dụng sóng vô tuyến để nhận dạng một cách tự động những đối tượng vật lý như những vật thể sống và vật thể thụ động… vì thế phạm vi mà RFID sẽ nhận dạng bao gồm toàn bộ vật thể sống và không sống trên trái đất và ở xa hơn. Do đó có thể xem công nghệ RFID là một trường hợp của kỹ thuật nhận dạng tự động (Auto-ID) như: mã vạch, sinh trắc, nhận dạng giọng nói…

*Thẻ TAG - Mifare Classic thực tế của dự án:*

![images](https://github.com/VinhCao09/RFIDAttendance_WirelessTechnologyProject/blob/main/images/4.jpg)

## Recommend version

XAMPP

```bash
version 3.3.0
```
PHP Version:

```bash
version 8.2
```

ESP8266 Board:
```bash
version 2.6.1
```

# 💫About Me :
Hello 👋I am Vinh. I'm studying HCMC University of Technology and Education

**Major:** Electronics and Telecommunication

**Skill:** 

*- Microcontroller:* ESP32/8266 - ARDUINO - PIC - Raspberry Pi - PLC Rockwell Allen Bradley

*- Programming languages:* C/C++/HTML/CSS/PHP/SQL and
related Frameworks (Bootstrap)

*- Communication Protocols:* SPI, I2C, UART, CAN

*- Data Trasmissions:* HTTP, TCP/IP, MQTT

## Authors

- [@my_fb](https://www.facebook.com/vcao.vn)
- [@my_email](contact@vinhcaodatabase.com)
