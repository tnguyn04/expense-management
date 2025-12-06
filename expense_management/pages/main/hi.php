<?php
$user_id = $_SESSION['user_id'];
$sql_ten = "SELECT fullname FROM user where id = '".$user_id."'";
$query_ten = mysqli_query($mysqli, $sql_ten);
$row = mysqli_fetch_assoc($query_ten);

?>

<div class="overview-hi">
                            <div class="overview-hi-region">
                                <span class="overview-hi__text">Chào mừng trở lại, <?php echo $row['fullname']; ?></span>
                                <p class="overview-hi__date">Hôm nay là <span id="current-date"></span>
                                <script>
                                    // JavaScript để lấy ngày hiện tại
                                    const today = new Date();
                                    const date = today.getDate();
                                    const month = today.getMonth() + 1; // Tháng bắt đầu từ 0 nên cần +1
                                    const year = today.getFullYear();

                                    // Mảng tên các tháng bằng tiếng Việt
                                    const monthNames = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];

                                    // Tạo chuỗi định dạng "ngày X tháng Y năm Z"
                                    const currentDate = `ngày ${date} tháng ${monthNames[month - 1]} năm ${year}`;

                                    // Hiển thị trong phần tử HTML có id là "current-date"
                                    document.getElementById('current-date').innerText = currentDate;
                                </script>

                            </div>
                        </div>