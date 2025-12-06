var btnAdd = document.querySelector('.thrifty-add__btn')
var modal = document.querySelector('.modal-edit')
var iconClose = document.querySelector('.auth-form__close-icon')
var btnClose = document.querySelector('.saving-add__btn')
var btnEdit = document.querySelectorAll('.budget-btn--edit')
var inputName = document.querySelector('.icome-type__input');
var modalTitle = document.querySelector('.auth-form__heading');

var inputIncome = document.querySelector('[name="khoanthunhap"]')
var inputIncomeType = document.querySelector('[name="id_loaithunhap"]')
var inputMoney = document.querySelector('[name="sotien"]')
var inputNote = document.querySelector('[name="ghichu"]')
var inputDate = document.querySelector('[name="ngay"]')
var inputTime = document.querySelector('[name="gio"]')
//var hiddenIdInput = document.querySelector('input[name="id"]'); // Trường ẩn để lưu ID
var form = document.querySelector('form[action="pages/processing/income.php"]');

function clearModalFields() {
    if (inputName) {
        inputName.value = ''; // Xóa giá trị của input
        var saveButton = document.querySelector('.saving-add__btn[name="sualoaithunhap"]');
        if (saveButton) {
            saveButton.name = "themloaithunhap"; // Đặt lại nút thành thêm mới
        }
    }else{
        inputIncome.value = ''; // Xóa tên khoản thu nhập
        inputIncomeType.value = ''; // Xóa loại thu nhập
        inputMoney.value = ''; // Xóa số tiền
        inputNote.value = ''; // Xóa ghi chú
        inputDate.value = ''; // Xóa ngày
        inputTime.value = ''; // Xóa thời gian
        var saveButton = document.querySelector('.saving-add__btn[name="suakhoanthunhap"]');
        if (saveButton) {
            saveButton.name = "themkhoanthunhap"; // Đặt lại nút thành thêm mới
        }

    }




    modalTitle.textContent = 'Thêm mới'; // Đặt lại tiêu đề modal

}

function toggleModal(){
    modal.classList.toggle('hide');
    if (modal.classList.contains('hide')) {
        clearModalFields(); // Xóa dữ liệu khi đóng modal
    }
}




btnEdit.forEach(function(button) {
    button.addEventListener('click', function() {
        var incomeTypeId = button.getAttribute('data-id'); // Lấy id từ data-id
        var incomeId = button.getAttribute('data-income-id');

        var incomeTypeName = button.getAttribute('data-name');
        if (inputName) {  // Kiểm tra xem inputName có tồn tại không
            inputName.value = incomeTypeName; // Đặt giá trị vào trường nhập liệu
            var saveButton = document.querySelector('.saving-add__btn[name="themloaithunhap"]');
            if (saveButton) {
                saveButton.name = "sualoaithunhap"; // Đổi tên thuộc tính name
            }
            form.action = `./pages/processing/income.php?action=edit_incometype&id=${incomeTypeId}`;
        }
        else{
        var income = button.getAttribute('data-income');
        var incomeType = button.getAttribute('data-incometype');
        var money = button.getAttribute('data-money');
        var note = button.getAttribute('data-note');
        var date = button.getAttribute('data-date');
        var time = button.getAttribute('data-time');

        inputIncome.value = income;
        inputIncomeType.value = incomeType;
        inputMoney.value = money;
        inputNote.value = note;
        inputDate.value = date;
        inputTime.value = time;

        var saveButton = document.querySelector('.saving-add__btn[name="themkhoanthunhap"]');
            if (saveButton) {
                saveButton.name = "suakhoanthunhap"; // Đổi tên thuộc tính name
            }
            form.action = `./pages/processing/income.php?action=edit_incometype&id=${incomeId}`;
        }
        

        

        modalTitle.textContent = 'Cập nhật'; // Đổi tiêu đề thành "Cập nhật"
        
        
        toggleModal();
        
    });
});


btnAdd.addEventListener('click', toggleModal)
btnClose.addEventListener('click', toggleModal)
iconClose.addEventListener('click', toggleModal)

