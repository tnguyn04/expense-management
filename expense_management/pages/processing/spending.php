<?php
session_start();
?>
<?php

include('../../config/config.php');
$user_id = $_SESSION['user_id'];
$loaichitieu = $_POST['loaichitieu'];
if(isset($_POST['themloaichitieu'])){
    $sql_them_loaichitieu = "INSERT INTO spendingtype(name, user_id) VALUE('".$loaichitieu."', '".$user_id."')";
    mysqli_query($mysqli,$sql_them_loaichitieu);
    header('Location:../../overview.php?page=spending_type');
}elseif (isset($_POST['sualoaichitieu'])) {
    $id_loaichitieu = $_GET['id']; // Lấy id từ URL
    //$loaithunhap = $_POST['loaithunhap'];
    
    $sql_update_loaichitieu = "UPDATE spendingtype SET name = '".$loaichitieu."' WHERE id = '".$id_loaichitieu."'";
    mysqli_query($mysqli, $sql_update_loaichitieu);
    header('Location:../../overview.php?page=spending_type');

}elseif(isset($_GET['action']) && $_GET['action'] == 'delete_spendingtype'){
    $id_loaichitieu=$_GET['id'];
    $sql_xoa_loaichitieu = "DELETE FROM spendingtype WHERE id = '".$id_loaichitieu."'";
    mysqli_query($mysqli,$sql_xoa_loaichitieu);
    header('Location:../../overview.php?page=spending_type');
}
?>

<?php


$khoanchitieu = $_POST['khoanchitieu'];
$id_loaichitieu = $_POST['id_loaichitieu'];
$sotien = $_POST['sotien']; // Số tiền
$ghichu = $_POST['ghichu']; // Ghi chú
$ngay = $_POST['ngay']; // Ngày thu nhập
$gio = $_POST['gio']; // Ngày thu nhập
//$user_id = $_SESSION['user_id']; // Lấy user_id từ session
if(isset($_POST['themkhoanchitieu'])){
    $sql_them_khoanchitieu = "INSERT INTO spending(name, spendingtype_id, amount, note, date, time, user_id) 
        VALUES ('".$khoanchitieu."', '".$id_loaichitieu."', '".$sotien."', '".$ghichu."', '".$ngay."', '".$gio."', '".$user_id."')";
    mysqli_query($mysqli, $sql_them_khoanchitieu);
    header('Location:../../overview.php?page=spending');
    }
elseif(isset($_POST['suakhoanchitieu'])){
    $id_khoanchitieu = $_GET['id']; // Lấy id từ URL
  
    
    $sql_update_khoanchitieu = "UPDATE spending SET name = '".$khoanchitieu."', spendingtype_id = '".$id_loaichitieu."', amount = '".$sotien."', note = '".$ghichu."', date = '".$ngay."', time = '".$gio."' WHERE id = '".$id_khoanchitieu."'";
    mysqli_query($mysqli, $sql_update_khoanchitieu);
    header('Location:../../overview.php?page=spending');
}elseif(isset($_GET['action']) && $_GET['action'] == 'delete_spending'){
    $id_khoanchitieu=$_GET['id'];
    $sql_xoa_khoanchitieu = "DELETE FROM spending WHERE id = '".$id_khoanchitieu."'";
    mysqli_query($mysqli,$sql_xoa_khoanchitieu);
    header('Location:../../overview.php?page=spending');
}
?>

<?php

if(isset($_POST['themkhoanchitieu']) || isset($_POST['suakhoanchitieu'])){
    
}

?>


