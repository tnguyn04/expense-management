<?php
session_start();
?>
<?php

include('../../config/config.php');
$user_id = $_SESSION['user_id'];
$id_loaichitieu = $_POST['id_loaichitieu'];
$sotien = $_POST['hanmuc'];
$ngaybatdau = $_POST['ngaybatdau'];
$ngayketthuc = $_POST['ngayketthuc'];
if(isset($_POST['themngansach'])){
    $sql_them_ngansach = "INSERT INTO budget(spendingtype_id, amount, start_date, end_date, user_id) VALUE('".$id_loaichitieu."', '".$sotien."', '".$ngaybatdau."', '".$ngayketthuc."', '".$user_id."')";
    mysqli_query($mysqli,$sql_them_ngansach);
    header('Location:../../overview.php?page=budget');
}elseif(isset($_POST['suangansach'])){
    $id_ngansach = $_GET['id']; // Lấy id từ URL
  
    
    $sql_update_ngansach = "UPDATE budget SET spendingtype_id = '".$id_loaichitieu."', amount = '".$sotien."', start_date = '".$ngaybatdau."', end_date = '".$ngayketthuc."' WHERE id = '".$id_ngansach."'";
    mysqli_query($mysqli, $sql_update_ngansach);
    header('Location:../../overview.php?page=budget');
}elseif(isset($_GET['action']) && $_GET['action'] == 'delete_budget'){
    $id_ngansach=$_GET['id'];
    $sql_xoa_ngansach = "DELETE FROM budget WHERE id = '".$id_ngansach."'";
    mysqli_query($mysqli,$sql_xoa_ngansach);
    header('Location:../../overview.php?page=budget');
}

?>
