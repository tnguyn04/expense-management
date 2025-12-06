<?php
session_start();
?>
<?php
include('../../config/config.php');
$loaithunhap = $_POST['loaithunhap'];
$user_id = $_SESSION['user_id'];
if(isset($_POST['themloaithunhap'])){
    $sql_them_loaithunhap = "INSERT INTO incometype(name, user_id) VALUE('".$loaithunhap."', '".$user_id."')";
    mysqli_query($mysqli,$sql_them_loaithunhap);
    header('Location:../../overview.php?page=income_type');
}elseif (isset($_POST['sualoaithunhap'])) {
    $id_loaithunhap = $_GET['id']; // Lấy id từ URL
    //$loaithunhap = $_POST['loaithunhap'];
    
    $sql_update_loaithunhap = "UPDATE incometype SET name = '".$loaithunhap."' WHERE id = '".$id_loaithunhap."'";
    mysqli_query($mysqli, $sql_update_loaithunhap);
    header('Location:../../overview.php?page=income_type');

}elseif(isset($_GET['action']) && $_GET['action'] == 'delete_incometype'){
    $id_loaithunhap=$_GET['id'];
    $sql_xoa_loaithunhap = "DELETE FROM incometype WHERE id = '".$id_loaithunhap."'";
    mysqli_query($mysqli,$sql_xoa_loaithunhap);
    header('Location:../../overview.php?page=income_type');
}
?>

<?php


$khoanthunhap = $_POST['khoanthunhap'];
$id_loaithunhap = $_POST['id_loaithunhap'];
$sotien = $_POST['sotien']; // Số tiền
$ghichu = $_POST['ghichu']; // Ghi chú
$ngay = $_POST['ngay']; // Ngày thu nhập
$gio = $_POST['gio']; // Ngày thu nhập
if(isset($_POST['themkhoanthunhap'])){
    $sql_them_khoanthunhap = "INSERT INTO income(name, incometype_id, amount, note, date, time, user_id) 
        VALUES ('".$khoanthunhap."', '".$id_loaithunhap."', '".$sotien."', '".$ghichu."', '".$ngay."', '".$gio."', '".$user_id."')";
    mysqli_query($mysqli, $sql_them_khoanthunhap);
    header('Location:../../overview.php?page=income');
    }
elseif(isset($_POST['suakhoanthunhap'])){
    $id_khoanthunhap = $_GET['id']; // Lấy id từ URL
  
    
    $sql_update_khoanthunhap = "UPDATE income SET name = '".$khoanthunhap."', incometype_id = '".$id_loaithunhap."', amount = '".$sotien."', note = '".$ghichu."', date = '".$ngay."', time = '".$gio."' WHERE id = '".$id_khoanthunhap."'";
    mysqli_query($mysqli, $sql_update_khoanthunhap);
    header('Location:../../overview.php?page=income');
}elseif(isset($_GET['action']) && $_GET['action'] == 'delete_income'){
    $id_khoanthunhap=$_GET['id'];
    $sql_xoa_khoanthunhap = "DELETE FROM income WHERE id = '".$id_khoanthunhap."'";
    mysqli_query($mysqli,$sql_xoa_khoanthunhap);
    header('Location:../../overview.php?page=income');
}
?>

