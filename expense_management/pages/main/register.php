<div class="middle">
            <div class="middle-content">
                <div class="middle__banner">
                    <div class="middle__banner--center">
                        <label class="middle__banner-text">Tạo tài khoản mới !</label>
                        <img src="https://static.vecteezy.com/system/resources/previews/025/441/323/non_2x/budget-management-personal-financial-control-cash-flow-tiny-people-is-planning-the-personal-budget-online-modern-flat-cartoon-style-illustration-on-white-background-vector.jpg" alt="" class="middle__banner-img">
                    </div>
                </div>
                <div class="middle__form">
                    <div class="middle-form--center">
                        <form action="" method="post">
                            <div class="form-login">
                                <span class="form-login-text">Đăng ký</span>
                                <div class="form-login-input">
                                    <div class="form-input__detail">
                                        <i class="form-input__detail--icon fa-regular fa-envelope"></i>
                                        <input type="email" class="form-input__detail--text" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="form-input__detail">
                                        <i class="form-input__detail--icon fa-regular fa-user"></i>
                                        <input type="text" class="form-input__detail--text" name="ten" placeholder="Tên" required>
                                    </div>
                                    <div class="form-input__detail ">
                                        <i class="form-input__detail--icon fa-solid fa-lock"></i>
                                        <input type="password" class="form-input__detail--text" name="matkhau" placeholder="Mật khẩu" required>
                                    </div>
                                    <div class="form-input__detail ">
                                        <i class="form-input__detail--icon fa-solid fa-lock"></i>
                                        <input type="password" class="form-input__detail--text" name="laimatkhau" placeholder="Nhập lại mật khẩu" required>
                                    </div>
                                </div>
                                <?php
                                include('././config/config.php');
                                if(isset($_POST['dangky'])) {
                                    $email = $_POST['email'];
                                    $ten = $_POST['ten'];
                                    $matkhau = md5($_POST['matkhau']);
                                    $laimatkhau = md5($_POST['laimatkhau']);
                            
                                    if($matkhau != $laimatkhau){
                                        echo '<span style="color: red; display: block; font-size: 1.4rem; margin-top: 20px; margin-bottom: -18px;">Mật khẩu không khớp. Vui lòng nhập lại!</span>';
                                    }
                                    else{
                                        $sql_dangky = mysqli_query($mysqli,"INSERT INTO user(email,fullname,password,created_at) VALUE('".$email."','".$ten."','".$matkhau."',NOW())");
                                        if($sql_dangky){
                                            $user_id = mysqli_insert_id($mysqli);
                                            $sql_insert_incometype = mysqli_query($mysqli,"INSERT INTO incometype(name,user_id) VALUES('Lương',$user_id),('Đầu tư',$user_id),('Kinh doanh',$user_id),('Buôn bán',$user_id)");
                                            $sql_insert_spendingtype = mysqli_query($mysqli,"INSERT INTO spendingtype(name,user_id) VALUES('Nhà cửa',$user_id),('Ăn uống',$user_id),('Di chuyển',$user_id),('Giải trí',$user_id)");
                                            echo '<span style="color: green; display: block; font-size: 1.4rem; margin-top: 20px; margin-bottom: -18px;">Bạn đã đăng ký thành công! Tự động chuyển đến trang đăng nhập trong 3 giây</span>';
                                            echo '<meta http-equiv="refresh" content="3;url=././index.php">';
                                        }
                                    }
                                    
                                }
                                
                                ?>
                                <button class="form-login-btn" name="dangky">Đăng ký</button>
                                
                                <div class="forget-pass">
                                    <p class="forget-pass-text">Bằng việc đăng ký, bạn đã đồng ý về
                                        <a href="?page=policy" class="forget-pass-link">điều khoản và bảo mật</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="contact">
            <div class="contact-area">
                <div class="contact__text">Liên hệ với chúng tôi nếu bạn cần hỗ trợ</div>
                <span class="contact__success contact__success--hide">Gửi thành công</span>
                    <div class="contact__input">
                        <div class="contact__input-area">
                            <div class="contact__input-user">
                                <input type="text" class="contact__input-text contact__input-textd" placeholder="Tên">
                                <input type="text" class="contact__input-text contact__input-texts" placeholder="Email">
                            </div>
                            <textarea class="contact__input-cmt" rows="1" placeholder="Bạn cần hỗ trợ gì?"></textarea>
                        </div>
                    </div>
                    <input type="submit" class="contact__btn" value="Gửi tin nhắn">
                    <script>
                        var btnContact = document.querySelector('.contact__btn')
                        var showSendHelp = document.querySelector('.contact__success')
                        function toggleHelpSuccess() {
                            showSendHelp.classList.toggle('contact__success--hide')
                        }
                        btnContact.addEventListener('click', toggleHelpSuccess)
                    </script>
            </div>
        </div>