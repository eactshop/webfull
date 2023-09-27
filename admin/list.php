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
$itemsPerPage = 4;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = intval($_GET['page']);
} else {
    $currentPage = 1;
}
$offset = ($currentPage - 1) * $itemsPerPage;
$sql = "SELECT stt, name, img, price FROM product LIMIT $offset, $itemsPerPage";
$result = $conn->query($sql);
$totalItems = $conn->query("SELECT COUNT(*) as count FROM product")->fetch_assoc()['count'];

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
    <div class="pagination">
        <?php
        $totalPages = ceil($totalItems / $itemsPerPage);

        // Xác định trang trước và trang sau
        $prevPage = max(1, $currentPage - 1);
        $nextPage = min($totalPages, $currentPage + 1);

        if ($totalPages > 1 && $totalPages < 7) {
            echo "<a class = 'pagination-item' href='?page=1'>Trang đầu</a> ";
            echo "<a class = 'pagination-item' href='?page=$prevPage'>Trang trước</a> ";
            for ($i = 1; $i <= $totalPages; $i++) {
                $class = ($i == $currentPage) ? 'pagination-item__number pagination-color' : 'pagination-item__number';
                echo "<a class = '$class' href='?page=$i'>$i</a> ";
            }
            echo "<a class = 'pagination-item' href='?page=$nextPage'>Trang sau</a> ";
            echo "<a class = 'pagination-item' href='?page=$totalPages'>Trang cuối</a>";
        }
        if ($totalPages > 6 && $currentPage <=$totalPages ) {
            echo "<a class = 'pagination-item' href='?page=1'>Trang đầu</a> ";
            echo "<a class = 'pagination-item' href='?page=$prevPage'>Trang trước</a> ";

            for ($i = $currentPage-2; $i < $currentPage+3; $i++) {
                if($i < $totalPages && $i > 0){
                    $class = ($i == $currentPage) ? 'pagination-item__number pagination-color' : 'pagination-item__number';
                    echo "<a class = '$class' href='?page=$i'>$i</a> ";
                }
            }
            echo "<div class = 'pagination-item__cl'>. . .</div>";
            for ($i = $totalPages; $i <= $totalPages; $i++) {
                $class = ($i == $currentPage) ? 'pagination-item__number pagination-color' : 'pagination-item__number';
                echo "<a class = '$class' href='?page=$i'>$i</a> ";
            }
            echo "<a class = 'pagination-item' href='?page=$nextPage'>Trang sau</a> ";
            echo "<a class = 'pagination-item' href='?page=$totalPages'>Trang cuối</a>";
        }
        ?>
    </div>
</body>
</html>

