<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa Sản Phẩm</title>
    <link rel="stylesheet" href="/css/ad-home.css">
</head>
<body>
    <div class="delete">
    <?php include "./pages/navbar.php"?>
    <div class="delete-form">
    <h1 class="add-title mgt-0">Xóa Sản Phẩm</h1>
   <form class="dflex" action="delete.php" method="POST">
   <input class="fix-ip" placeholder="Nhập STT sản phẩm cần xóa" type="number" name="product_id">
   <input class="add-ip w335" type="submit" value="Xóa sản phẩm">
   <?php
// Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối cho phù hợp)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banhang";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["product_id"];
    $sql_check_existence = "SELECT * FROM product WHERE stt = $id";
    $result = $conn->query($sql_check_existence);
    if ($result->num_rows == 0) {
        echo "Không có sản phẩm này.";
    } else {
        // Nếu ID tồn tại, thực hiện câu lệnh DELETE
        $sql_delete_product = "DELETE FROM product WHERE stt = $id";

        if ($conn->query($sql_delete_product) === true) {
            echo "Sản phẩm đã được xóa thành công.";
        } else {
            echo "Lỗi khi xóa sản phẩm: " . $conn->error;
        }
    }
}
// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>
    </form>
    </div>
    </div>

</body>
</html>
