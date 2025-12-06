<?php
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
        echo "<script>
                alert('Mật khẩu cũ không đúng, mật khẩu mới không khớp. Vui lòng nhập lại!');
                window.location.href='../../quanlychitieu/overview.php?page=profile';
              </script>";
    }elseif($matkhaumoi != $matkhaumoi2){
        echo "<script>
                alert('Mật khẩu mới không khớp. Vui lòng nhập lại!');
                window.location.href='../../quanlychitieu/overview.php?page=profile';
              </script>";
    }elseif($matkhaucu != $row['password']){
        echo "<script>
                alert('Mật khẩu cũ không đúng. Vui lòng nhập lại!');
                window.location.href='../../quanlychitieu/overview.php?page=profile';
              </script>";
    }
    else{
        mysqli_query($mysqli,"UPDATE user SET password = '".$matkhaumoi."' WHERE id = '".$user_id."'");
        echo "<script>
                alert('Đổi mật khẩu thành công!');
                window.location.href='../../quanlychitieu/overview.php?page=profile';
              </script>";
    }
}

?>
    <style>
        h2 {
            font-size: 2.2rem;
        }
        /* CSS để định dạng form */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            /* display: flex;
            justify-content: center;  */
            /* align-items: flex-start; */
            width: 800px;
            margin: 0px auto;
            /* padding: 20px;
            flex-direction: column;  */
        }

        .top-section {
            display: flex;
            margin-top: 20px;
            /* width: 100%; */
            justify-content: space-between; /* Căn giữa giữa hai khung */
        }

        .left-section {
            width: 20%;
            padding-right: 20px;
            white-space: nowrap; 
            display: flex;
            flex-direction: column; /* Đặt theo chiều dọc */
            align-items: flex-start; /* Đặt nội dung về phía bên trái */
        }

        .form-container {
            flex-direction: column; /* Đặt theo chiều dọc */
            width: 90%; /* Chiếm 75% chiều rộng */
        }

        .right-section,
        .password-section {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            margin-top: 20px; /* Khoảng cách giữa hai khung */
            flex: 1; /* Đảm bảo cả hai khung bằng nhau */
        }

        .form-group {
            margin-bottom: 15px;
            margin-top: 15px;
        }

        button {
            font-size: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 1.5rem;
        }

        .input-profile {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            font-size: 1.5rem;
        }

        .button-group {
            display: flex;
            justify-content: flex-start;
            gap: 10px; /* Khoảng cách giữa hai nút */
        }


        /* Nút Lưu thay đổi */
        .save-btn {
            background-color: #008CBA;
            color: white;
            font-size: 1.5rem;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .save-btn:hover {
            background-color: #007B9A;
        }

        /* Nút Hủy bỏ */
        .cancel-btn {
            background-color: #f44336;
            color: white;
        }

        .cancel-btn:hover {
            background-color: #e53935;
        }

        /* Định dạng cho phần thông tin bên trái */
        .left-section h2 {
            margin: 0;
        }

        .left-section h3 {
            margin: 40px 0 0; /* Cách 2 hàng */
        }

        /* Định dạng cho tiêu đề trong khung bên phải */
        .right-section h3, .password-section h3 {
         
            font-size: 2rem;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }

        /* Đặt số điện thoại cùng hàng với email */
        .form-row {
            display: flex;
            gap: 30px; /* Khoảng cách giữa hai trường (có thể điều chỉnh) */
        }

        .password-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .password-description {
            width: 70%;
        }

        .change-password-btn {
            background-color: #008CBA;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .change-password-btn:hover {
            background-color: #007B9A;
        }

        .icon-back-profile:hover {
            cursor: pointer;
            background-color: var(--border-color);
            border-radius: 50%;
        }
        .change-password-result {
        
            font-size: 1.4rem;
            margin-top: 20px;
            
            display: block;
        }
    </style>


<?php
$user_id = $_SESSION['user_id'];
$sql_profile = "SELECT * FROM user where user.id = '".$user_id."'";
$query_profile = mysqli_query($mysqli, $sql_profile);
$row = mysqli_fetch_assoc($query_profile);

?>

    
    <div class="container">
        
        <div class="top-section">
            <!-- Phần bên trái với "Thông tin chung" và "Thông tin tài khoản" -->
            
                <div style="font-size: 2.2rem; font-size: 2.4rem;
    font-weight: 600;
    width: 40%; margin-top: 22px;">Thông tin tài khoản</div>
                
            

            <!-- Khung chứa hồ sơ cá nhân và mật khẩu -->
            <div class="form-container form-container-profile">
                <!-- Khung chứa form "Hồ sơ cá nhân" -->
                <form action="" method="post" autocomplete="off">
                <div class="right-section">
                    <h3>Hồ sơ cá nhân</h3>
                    <div class="form-group">
                        <label for="fullname">Họ và tên</label>
                        <input class="input-profile" type="text" id="fullname" name="ten" value="<?php echo $row['fullname'] ?>">
                    </div>

                    <div class="form-group form-row">
                        <div style="flex: 1;">
                            <label for="email">Email</label>
                            <input class="input-profile" type="email" id="email" name="email" value="<?php echo $row['email'] ?>">
                        </div>
                        <div style="flex: 1;">
                            <label for="phone">Số điện thoại</label>
                            <input class="input-profile" type="number" id="phone" name="sodienthoai" value="<?php echo $row['phone_number'] ?>">
                        </div>
                    </div>

                    <!-- Hàng chứa hai nút -->
                    <div class="button-group">
                        
                        <input type="submit" class="save-btn" value="Lưu thay đổi" name="luuthaydoi">
                    </div>
                </div>
                </form>

                <!-- Khung dưới cùng "Mật khẩu" -->
                <div class="password-section">
                    <h3>Mật khẩu</h3>
                    <div class="password-group">
                        <div class="password-description">
                            <label>Đổi mật khẩu bạn dùng để đăng nhập vào hệ thống</label>
                        </div>
                        <button class="change-password-btn" name="doimatkhau">Đổi mật khẩu</button>
                    </div>
                </div>
            </div>

            <!-- Đổi mật khẩu -->
            <div class="form-container form-change_password hide">
                <!-- Khung chứa form "Hồ sơ cá nhân" -->
                <form action="" method="post" autocomplete="off">
                <div class="right-section" style="width: 400px;">
                    <h3><i class="icon-back-profile fa-solid fa-arrow-left" style="margin-right: 10px; padding: 2px;"></i>Đổi mật khẩu</h3>
                    <div class="form-group">
                        <label for="fullname">Mật khẩu cũ</label>
                        <input class="input-profile" type="password" name="matkhaucu" value="">
                    </div>

                        <div style="flex: 1;">
                            <label>Mật khẩu mới</label>
                            <input class="input-profile" type="password" name="matkhaumoi" value=>
                        </div>
                        <div style="flex: 1;">
                            <label style="margin-top: 10px;">Nhập lại mật khẩu mới</label>
                            <input class="input-profile" type="password" id="phone" name="matkhaumoi2" value="">
                        </div>

                    <!-- <span class="change-password-result" style="color: <?php //echo $message === 'Đổi mật khẩu thành công!' ? 'green' : 'red'; ?>"><?php //echo $message; ?></span> -->
                    <!-- Hàng chứa hai nút -->
                    <div class="button-group" style="
    margin-top: 20px;">
                        
                        <input type="submit" class="save-btn" value="Đổi mật khẩu" name="luumatkhau">
                    </div>
                </div>
                </form>

             
            </div>
        </div>
    </div>

<script>
    var btnChangePassword = document.querySelector('[name="doimatkhau"]')
    var modalChangePassword = document.querySelector('.form-change_password')
    var modalProfile = document.querySelector('.form-container-profile')
    var iconBack = document.querySelector('.icon-back-profile')

    function toggleChangePassword(){
        modalChangePassword.classList.toggle('hide')
        modalProfile.classList.toggle('hide')
    }

    btnChangePassword.addEventListener('click', toggleChangePassword)
    iconBack.addEventListener('click', toggleChangePassword)


</script>

