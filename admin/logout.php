<?php
session_start(); // Bắt đầu phiên làm việc

// Hủy bỏ tất cả các biến phiên làm việc
session_unset();

// Hủy bỏ phiên làm việc
session_destroy();

// Chuyển hướng người dùng đến trang đăng nhập hoặc trang chính
header("Location: ./"); // Điều hướng đến trang đăng nhập
exit; // Dừng kịch bản
?>
