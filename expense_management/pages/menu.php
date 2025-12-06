<div class="header__fuction">
    <div class="header__function-item">
        <!-- FAQ -->
        <a class="header__function-link" href="index.php?page=faq">
            FAQ
        </a>
    </div>
    <div class="header__function-item">
        <!-- Điều khoản -->
        <a class="header__function-link" href="index.php?page=policy">
            Điều khoản
        </a>
    </div>
    <!-- LOGIN -->
    <?php
    if(isset($_SESSION['dangnhap'])){
        $user_id = $_SESSION['user_id'];
        
        // Lấy thông báo ngân sách
        $sql_lietke_ngansach = "
            SELECT 
                budget.*, 
                spendingtype.name AS spendingtype_name,
                (SELECT SUM(spending.amount) 
                FROM spending 
                WHERE spending.spendingtype_id = budget.spendingtype_id 
                AND spending.date BETWEEN budget.start_date AND budget.end_date
                ) AS total_spent
            FROM budget
            LEFT JOIN spendingtype ON budget.spendingtype_id = spendingtype.id 
            WHERE budget.user_id = '".$user_id."'";

        $query_lietke_ngansach = mysqli_query($mysqli, $sql_lietke_ngansach);
        
        // Mảng lưu thông báo
        $notifications = [];

        // Thông báo ngân sách
        while($row = mysqli_fetch_array($query_lietke_ngansach)){
            if($row['amount'] < $row['total_spent']) {
                $notifications[] = [
                    'type' => 'Ngân sách',
                    'message' => 'Loại chi tiêu "' . $row['spendingtype_name'] . '" đã vượt qua hạn mức ngân sách đề ra',
                    'img' => 'https://cdn.vietnambiz.vn/2019/10/18/157689582x327-157139907485192646971.png'
                ];
            }
        }

        // Thông báo tiết kiệm
        $sql_lietke_tietkiem = "SELECT * FROM saving WHERE saving.user_id = '".$user_id."'";
        $query_lietke_tietkiem = mysqli_query($mysqli, $sql_lietke_tietkiem);

        while ($row = mysqli_fetch_array($query_lietke_tietkiem)) {
            $sql_tiendo = "SELECT 
                (
                    SELECT SUM(amount) 
                    FROM income 
                    WHERE income.user_id = '".$user_id."' 
                    AND income.date BETWEEN '".$row['start_date']."' AND '".$row['completione_date']."'
                ) AS total_income,
                (
                    SELECT SUM(amount) 
                    FROM spending 
                    WHERE spending.user_id = '".$user_id."' 
                    AND spending.date BETWEEN '".$row['start_date']."' AND '".$row['completione_date']."'
                ) AS total_spending";

            $query_tiendo = mysqli_query($mysqli, $sql_tiendo);
            $row_tiendo = mysqli_fetch_array($query_tiendo);

            $saved_amount = $row_tiendo['total_income'] - $row_tiendo['total_spending'];
            $progress = ($saved_amount > $row['amount']) ? 100 : (($saved_amount < 0) ? 0 : round(($saved_amount / $row['amount']) * 100, 2));

            if ($progress >= 100) {
                $notifications[] = [
                    'type' => 'Tiết kiệm',
                    'message' => 'Mục tiêu tiết kiệm "' . $row['name'] . '" đã hoàn thành!',
                    'img' => 'https://png.pngtree.com/png-clipart/20230816/original/pngtree-savingsicon-bank-deposit-money-vector-picture-image_10832244.png'
                ];
            }
        }

        // Đảo ngược mảng thông báo để hiển thị thông báo mới nhất đầu tiên
        $notifications = array_reverse($notifications);

        // Lấy 5 thông báo mới nhất
        $notifications = array_slice($notifications, 0, 5);
    ?>
    <div class="header__notify">
        <div class="header__notify-icon">
            <i class="header__notify-logo fa-regular fa-bell"></i>
            <span class="header__notify-text">Thông báo</span>
        </div>
        <div class="header__notify2">
            <header class="header__notify-header">
                <h3>Thông báo mới nhận</h3>
            </header>
            <ul class="header__notify-list">
                <?php
                // Hiển thị thông báo
                foreach($notifications as $notification) {
                ?>
                <li class="header__notify-item header__notify-item--viewed">
                    <img src="<?php echo $notification['img']; ?>" alt="" class="header__notify-img">
                    <div class="header__notify-info">
                        <span class="header__notify-name"><?php echo $notification['type']; ?></span>
                        <span class="header__notify-descriotion"><?php echo $notification['message']; ?></span>
                    </div>
                </li>
                <?php
                }
                ?>
            </ul>
            <footer class="header__notify-footer">
                <a href="" class="header__notify-footer-btn">Xem tất cả</a>
            </footer>
        </div>
    </div>
    <?php
    } else {
    ?>
    <div class="header__login">
        <a href="?page=login" class="login-link">Đăng nhập</a>
        <a href="?page=register" class="login-link">Đăng ký</a>
    </div>
    <?php
    }
    ?>
</div>

