<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    <link rel="stylesheet" href="/css/ad-home.css">
</head>
<body>
<div class="add">
   <?php include "./pages/navbar.php"?>
   <div class="add-right">
    <h1 class="add-title">Thêm Sản Phẩm</h1>
   <form action="add.php" method="POST" enctype="multipart/form-data">
        <input placeholder="Tên sản phẩm" class="add-ip mgb-15" type="text" name="name" required><br>
        <label for="img">Ảnh sản phẩm</label><br>
        <input placeholder="Ảnh sản phẩm" class="add-img" type="file" name="img" accept="image/*" required><br>
        <input placeholder="Giá sản phẩm" class="add-ip" type="text" name="price" required><br>
        <input class="add-ip w335" type="submit" value="Thêm sản phẩm">
    </form>
   
   <?php
// Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối cho phù hợp)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banhang";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối có thành công không
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Xử lý dữ liệu từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];

    // Xử lý hình ảnh
    $img_name = $_FILES["img"]["name"];
    $img_tmp = $_FILES["img"]["tmp_name"];
    $img_dir = "uploads/"; // Thư mục lưu trữ hình ảnh

    // Di chuyển hình ảnh vào thư mục lưu trữ
    move_uploaded_file($img_tmp, $img_dir . $img_name);

    // Thêm dữ liệu vào cơ sở dữ liệu
    $sql = "INSERT INTO product (name, img, price) VALUES ('$name', '$img_name', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='tb-add'>Sản phẩm đã được thêm thành công!</div>";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>
</div>
</div>
</body>
</html>
