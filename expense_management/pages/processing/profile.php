<?php
session_start();
?>

<?php

include('../../config/config.php');
$user_id = $_SESSION['user_id'];

if(isset($_POST['luuthaydoi'])){
    $ten = $_POST['ten'];
    $email = $_POST['email'];
    $sodienthoai = $_POST['sodienthoai'];
    $sql_update_profile = "UPDATE user SET fullname = '".$ten."', email = '".$email."', phone_number = '".$sodienthoai."' where id = '".$user_id."'";
    mysqli_query($mysqli,$sql_update_profile);
    header('Location:../../overview.php?page=profile');
}

?>

<?php
if(isset($_POST['luumatkhau'])){
    $matkhaucu = md5($_POST['matkhaucu']);
    $matkhaumoi = md5($_POST['matkhaumoi']);
    $matkhaumoi2 = md5($_POST['matkhaumoi2']);

    $sql = "SELECT * FROM user WHERE id = '".$user_id."'";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($result);
    if($matkhaucu != $row['password'] && $matkhaumoi != $matkhaumoi2){
        echo '<span style="color: red; display: block; font-size: 1.4rem; margin-top: 20px; margin-bottom: -18px;">Mật khẩu cũ không đúng, mật khẩu mới không khớp. Vui lòng nhập lại!</span>';
    }elseif($matkhaumoi != $matkhaumoi2){
        echo '<span style="color: red; display: block; font-size: 1.4rem; margin-top: 20px; margin-bottom: -18px;">Mật khẩu mới không khớp. Vui lòng nhập lại!</span>';
    }elseif($matkhaucu != $row['password']){
        echo '<span style="color: red; display: block; font-size: 1.4rem; margin-top: 20px; margin-bottom: -18px;">Mật khẩu cũ không đúng. Vui lòng nhập lại!</span>';
    }
    else{
        mysqli_query($mysqli,"UPDATE user SET password = '".$matkhaumoi."' WHERE id = '".$user_id."'");
        echo '<span style="color: green; display: block; font-size: 1.4rem; margin-top: 20px; margin-bottom: -18px;">Đổi mật khẩu thành công!</span>';
    }
}

?>