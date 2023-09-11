<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm</title>
    <link rel="stylesheet" href="/css/ad-home.css">
</head>
<body>
    <div class="list">
    <?php include "./pages/navbar.php"?>
   <?php
$conn = mysqli_connect("localhost", "root", "", "banhang");

if (!$conn) {
    die("Kết nối CSDL không thành công: " . mysqli_connect_error());
}
$sql = "SELECT stt, name, img, price FROM product";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}

?>
<div class="right">
<h1 class="title">Danh sách sản phẩm</h1>
<div class="right-table">
    <div class="right-stt">STT</div>
    <div class="right-name">Tên sản phẩm</div>
    <div class="anh">Ảnh</div>
    <div class="right-price">Giá</div>
</div>
<?php
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='right-table'>";
    echo "<div class='right-stt'>" . $row['stt'] . "</div>";
    echo "<div class='right-name'>" . $row['name'] . "</div>";
    echo '<div class="anh st-anh"><img class="up-img" src="/admin/uploads/' . $row['img'] . '" alt="' . $row['name'] . '"></div>';
    echo "<div class='right-price'>" . $row['price'] . "</div>";
    echo "</div>";
}
mysqli_close($conn);
?>
<div class="a"></div>
</div>
</body>
</html>
