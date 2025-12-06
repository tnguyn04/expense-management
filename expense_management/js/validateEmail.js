function validateEmail() {
    // Lấy giá trị của input
    var email = document.getElementById("emailInput").value;

    // Biểu thức chính quy để kiểm tra xem email có phải là địa chỉ Gmail hay không
    var gmailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

    // Kiểm tra xem email có khớp với mẫu Gmail không
    if (gmailPattern.test(email)) {
        showToast("Xác nhận thành công!", "success");
    } else {
        showToast("Email không hợp lệ. Vui lòng nhập lại!", "error");
    }
}

function showToast(message, type) {
    // Lấy phần tử toast
    var toast = document.getElementById("toast");

    // Cập nhật nội dung thông báo
    toast.innerHTML = message;

    // Thay đổi màu nền theo loại thông báo
    if (type === "success") {
        toast.style.backgroundColor = "#4CAF50"; // Màu xanh cho thành công
    } else if (type === "error") {
        toast.style.backgroundColor = "#f44336"; // Màu đỏ cho lỗi
    }

    // Hiển thị toast
    toast.className = "toast show";

    // Ẩn toast sau 3 giây
    setTimeout(function() {
        toast.className = toast.className.replace("show", "");
    }, 3000);
}
