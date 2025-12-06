<?php
session_start();
?>
<?php

include('../../config/config.php');
$user_id = $_SESSION['user_id'];
$ten = $_POST['muctieu'];
$sotien = $_POST['sotien'];
$ngaybatdau = $_POST['ngaybatdau'];
$ngayhoanthanh = $_POST['ngayhoanthanh'];
if(isset($_POST['themtietkiem'])){
    // $sql_them_tietkiem = "INSERT INTO saving(name, amount, start_date, completione_date, user_id) VALUE('".$ten."', '".$sotien."', '".$ngaybatdau."', '".$ngayhoanthanh."', '".$user_id."')";
    // mysqli_query($mysqli,$sql_them_tietkiem);
    // header('Location:../../overview.php?page=saving');
    $sql_kiemtra = "
        SELECT * 
        FROM saving 
        WHERE user_id = '".$user_id."' 
        AND (
            ('".$ngaybatdau."' BETWEEN start_date AND completione_date) 
            OR 
            ('".$ngayhoanthanh."' BETWEEN start_date AND completione_date) 
            OR 
            (start_date BETWEEN '".$ngaybatdau."' AND '".$ngayhoanthanh."') 
            OR 
            (completione_date BETWEEN '".$ngaybatdau."' AND '".$ngayhoanthanh."')
        )
    ";
    $query_kiemtra = mysqli_query($mysqli, $sql_kiemtra);

    if (mysqli_num_rows($query_kiemtra) > 0) {
        // Trùng ngày, không cho phép thêm
        echo "<script>
                alert('Khoảng thời gian đã trùng với mục tiết kiệm khác. Vui lòng chọn thời gian khác!');
                window.location.href='../../overview.php?page=saving';
              </script>";
    } else {
        // Không trùng, thực hiện thêm mới
        $sql_them_tietkiem = "
            INSERT INTO saving(name, amount, start_date, completione_date, user_id) 
            VALUES('".$ten."', '".$sotien."', '".$ngaybatdau."', '".$ngayhoanthanh."', '".$user_id."')
        ";
        mysqli_query($mysqli, $sql_them_tietkiem);
        header('Location:../../overview.php?page=saving');
    }
}elseif(isset($_POST['suatietkiem'])){
    // $id_tietkiem = $_GET['id']; // Lấy id từ URL
  
    
    // $sql_update_tietkiem = "UPDATE saving SET name = '".$ten."', amount = '".$sotien."', start_date = '".$ngaybatdau."', completione_date = '".$ngayhoanthanh."' WHERE id = '".$id_tietkiem."'";
    // mysqli_query($mysqli, $sql_update_tietkiem);
    // header('Location:../../overview.php?page=saving');
    $id_tietkiem = $_GET['id']; // Lấy id từ URL

    // Kiểm tra sự trùng lặp ngày
    $sql_kiemtra = "
        SELECT * 
        FROM saving 
        WHERE user_id = '".$user_id."' 
        AND id != '".$id_tietkiem."' -- Loại bỏ mục tiết kiệm đang cập nhật
        AND (
            ('".$ngaybatdau."' BETWEEN start_date AND completione_date) 
            OR 
            ('".$ngayhoanthanh."' BETWEEN start_date AND completione_date) 
            OR 
            (start_date BETWEEN '".$ngaybatdau."' AND '".$ngayhoanthanh."') 
            OR 
            (completione_date BETWEEN '".$ngaybatdau."' AND '".$ngayhoanthanh."')
        )
    ";
    $query_kiemtra = mysqli_query($mysqli, $sql_kiemtra);

    if (mysqli_num_rows($query_kiemtra) > 0) {
        // Trùng ngày, không cho phép cập nhật
        echo "<script>
                alert('Khoảng thời gian đã trùng với mục tiết kiệm khác. Vui lòng chọn thời gian khác!');
                window.location.href='../../overview.php?page=saving';
              </script>";
    } else {
        // Không trùng, thực hiện cập nhật
        $sql_update_tietkiem = "
            UPDATE saving 
            SET name = '".$ten."', 
                amount = '".$sotien."', 
                start_date = '".$ngaybatdau."', 
                completione_date = '".$ngayhoanthanh."' 
            WHERE id = '".$id_tietkiem."'
        ";
        mysqli_query($mysqli, $sql_update_tietkiem);
        header('Location:../../overview.php?page=saving');
    }
}elseif(isset($_GET['action']) && $_GET['action'] == 'delete_saving'){
    $id_tietkiem=$_GET['id'];
    $sql_xoa_tietkiem = "DELETE FROM saving WHERE id = '".$id_tietkiem."'";
    mysqli_query($mysqli,$sql_xoa_tietkiem);
    header('Location:../../overview.php?page=saving');
}

?>
