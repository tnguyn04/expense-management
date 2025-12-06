<?php
session_start();
include('././config/config.php');
if (isset($_POST['dangnhap'])) {
    $email = $_POST['email'];
    $matkhau = md5($_POST['matkhau']);
    $sql = "SELECT id, email FROM user WHERE email = '$email' AND password = '$matkhau' LIMIT 1";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Lưu ID và email vào session
        $_SESSION['dangnhap'] = $row['email'];
        $_SESSION['user_id'] = $row['id']; // Lấy ID người dùng

        header("Location: ././overview.php");
    } else {
        header("Location: index.php?error=wrong");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập/Đăng ký</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/FAQ.css">
    <link rel="stylesheet" href="css/Policy.css"> -->
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="font/fontawesome-free-6.5.1-web/css/all.min.css">

    <link rel="stylesheet" href="css/header.css">
</head>
<body>
    
    <div class="app">
        <?php 
        include('pages/header.php');
        include('pages/main2.php');
        include('pages/footer.php');
        ?>




        
    </div> 
    
</body>
</html>