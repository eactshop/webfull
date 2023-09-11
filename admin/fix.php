<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản Phẩm</title>
    <link rel="stylesheet" href="/css/ad-home.css">
</head>
<body>
    <div class="fix">
        <?php include "./pages/navbar.php"?>
        <form class="fix-form" method="POST" action="fix.php" enctype="multipart/form-data">
            <h1 class="fix-title">Sửa Sản Phẩm</h1>
            <input class="fix-ip" placeholder="STT" type="number" name="product_id"><br>
            <input class="fix-ip" placeholder="Tên sản phẩm" type="text" id="name" name="name"><br>
            <input class="fix-ip pd0 w335" type="file" name="img" accept="image/*"><br>
            <input class="fix-ip" placeholder="Giá" type="number" id="price" name="price"><br>
            <input class="fix-ip w335" type="submit" value="Cập nhật">
            <?php
// Kết nối đến CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banhang";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Lấy dữ liệu từ biểu mẫu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ biểu mẫu
$product_id = $_POST["product_id"];
$new_name = $_POST["name"];
$new_price = $_POST["price"];
// Xử lý hình ảnh
$img_name = $_FILES["img"]["name"];
$img_tmp = $_FILES["img"]["tmp_name"];
$img_dir = "uploads/"; // Thư mục lưu trữ hình ảnh

// Di chuyển hình ảnh vào thư mục lưu trữ
move_uploaded_file($img_tmp, $img_dir . $img_name);
$sql = "UPDATE product SET name = '$new_name', img = '$img_name', price = $new_price WHERE stt = $product_id";

if ($conn->query($sql) === TRUE) {
    echo "Thông tin sản phẩm đã được cập nhật thành công";
    
} else {
    echo "Lỗi khi cập nhật thông tin sản phẩm: " . $conn->error;
}

}
// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>

        </form>
    </div>
</body>
</html>
