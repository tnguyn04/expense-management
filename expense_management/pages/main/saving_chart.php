<!-- <div class="">

                                <div class="saving-header">
                                    <span class="saving-header__text">Biểu đồ thống kê số tiền tiết kiệm từng tháng</span>
                                </div>
                                    <span class="saving-unit-vnd">Đơn vị (Triệu  VND)</span>
                                <div>
                                    <canvas id="myChart" height="100px"></canvas>
                                </div>


                            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
                            <script src="././js/saving_chart.js"></script>
                            
</div> -->
<script>
    var iconShow = document.querySelectorA('.saving-chart__show')
    var savingChart = document.querySelectorA('.saving-chart')

    // Hàm để bật/tắt hiển thị biểu đồ và thay đổi biểu tượng
function toggleChart() {
    savingChart.classList.toggle('hide'); // Thêm hoặc xóa lớp 'hide' để ẩn/hiện biểu đồ
    // Thay đổi biểu tượng giữa fa-angle-down và fa-angle-up
    if (savingChart.classList.contains('hide')) {
        iconShow.classList.remove('fa-angle-up'); // Xóa lớp fa-angle-up
        iconShow.classList.add('fa-angle-down'); // Thêm lớp fa-angle-down
    } else {
        iconShow.classList.remove('fa-angle-down'); // Xóa lớp fa-angle-down
        iconShow.classList.add('fa-angle-up'); // Thêm lớp fa-angle-up
    }
}

    iconShow.addEventListener('click', toggleChart)
</script> 
