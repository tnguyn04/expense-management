
<div class="middle">
            <div class="middle-content">
                <div class="middle__banner">
                    <div class="middle__banner--center">
                        <label class="middle__banner-text">Chào mừng quay trở lại !</label>
                        <img src="https://static.vecteezy.com/system/resources/previews/025/441/323/non_2x/budget-management-personal-financial-control-cash-flow-tiny-people-is-planning-the-personal-budget-online-modern-flat-cartoon-style-illustration-on-white-background-vector.jpg" alt="" class="middle__banner-img">
                    </div>
                </div>
                <div class="middle__form">
                    <div class="middle-form--center">
                        <form action="" method="post">
                            <div class="form-login">
                                <span class="form-login-text">Đăng nhập</span>
                                <div class="form-login-input">
                                    <div class="form-input__detail">
                                        <i class="form-input__detail--icon fa-regular fa-envelope"></i>
                                        <input type="email" class="form-input__detail--text" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="form-input__detail ">
                                        <i class="form-input__detail--icon fa-solid fa-lock"></i>
                                        <input type="password" class="form-input__detail--text" name="matkhau" placeholder="Mật khẩu" required>
                                    </div>
                                </div>
                                <span id="error-message" class="login_error"></span>
                                <input type="submit" class="form-login-btn" name="dangnhap" value="Đăng nhập">
                                
                                <div class="forget-pass">
                                    <p class="forget-pass-text">Bạn quên mật khẩu?
                                        <a href="" class="forget-pass-link">Lấy lại mật khẩu</a>
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

        <script>
        // Lấy URL hiện tại
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');

        // Kiểm tra tham số 'error' và hiển thị thông báo
        if (error === 'wrong') {
            const errorMessageDiv = document.getElementById('error-message');
            errorMessageDiv.style.display = 'block';
            errorMessageDiv.textContent = 'Email hoặc mật khẩu không đúng. Vui lòng thử lại!';
        }
    </script>  