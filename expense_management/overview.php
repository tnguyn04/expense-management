<?php
session_start();
if(!isset($_SESSION['dangnhap'])){
    header('Location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tổng quan</title>
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
        <?php include('config/config.php'); ?>
        <?php include('pages/header.php'); ?>
        <div class="middle--overview">
            <div class="overview">
                <?php
                
                include('pages/sidebar.php');
                include('pages/main.php');
                
                ?>
                
            </div>
        </div>
        <?php include('pages/footer.php'); ?>

        
    </div> 
    
</body>
</html>

