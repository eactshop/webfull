<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="/css/ad.css">
  </head>
  <body>
    <div class="container">
        <div class="login-title">Login</div>
        <form class="login-form" action="" method="post">
            <input class="ip-login" placeholder="Username" type="text" id="username" name="username" required><br>
            <input class="ip-login" placeholder="Password" type="password" id="password" name="password" required><br>
            <input class="ip-login ip-submit" type="submit" value="SIGN IN">
        </form>
        <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banhang";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Xử lý đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Kiểm tra thông tin đăng nhập trong cơ sở dữ liệu
    $sql = "SELECT * FROM user WHERE username ='$username' AND password ='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Đăng nhập thành công
        session_start();
        $_SESSION["username"] = $username;
        header("Location: list.php");
    } else {
        // Đăng nhập không thành công
        echo "<div class='erro'>Tên đăng nhập hoặc mật khẩu không đúng!</div>";
    }
}

$conn->close();
?>
    </div>
  </body>
</html>