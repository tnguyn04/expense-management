var btnAdd = document.querySelector('.thrifty-add__btn')
var modal = document.querySelector('.modal-edit')
var iconClose = document.querySelector('.auth-form__close-icon')
var btnClose = document.querySelector('.saving-add__btn')
var btnEdit = document.querySelectorAll('.budget-btn--edit')
var inputName = document.querySelector('.icome-type__input');
var modalTitle = document.querySelector('.auth-form__heading');

var inputSpending = document.querySelector('[name="khoanchitieu"]')
var inputSpendingType = document.querySelector('[name="id_loaichitieu"]')
var inputMoney = document.querySelector('[name="sotien"]')
var inputNote = document.querySelector('[name="ghichu"]')
var inputDate = document.querySelector('[name="ngay"]')
var inputTime = document.querySelector('[name="gio"]')
//var hiddenIdInput = document.querySelector('input[name="id"]'); // Trường ẩn để lưu ID
var form = document.querySelector('form[action="pages/processing/spending.php"]');


function clearModalFields() {
    if (inputName) {
        inputName.value = ''; // Xóa giá trị của input
        var saveButton = document.querySelector('.saving-add__btn[name="sualoaichitieu"]');
        if (saveButton) {
            saveButton.name = "themloaichitieu"; // Đặt lại nút thành thêm mới
        }
    }else{
        inputSpending.value = ''; // Xóa tên khoản thu nhập
        inputSpendingType.value = ''; // Xóa loại thu nhập
        inputMoney.value = ''; // Xóa số tiền
        inputNote.value = ''; // Xóa ghi chú
        inputDate.value = ''; // Xóa ngày
        inputTime.value = ''; // Xóa thời gian
        var saveButton = document.querySelector('.saving-add__btn[name="suakhoanchitieu"]');
        if (saveButton) {
            saveButton.name = "themkhoanchitieu"; // Đặt lại nút thành thêm mới
        }

    }




    modalTitle.textContent = 'Thêm mới'; // Đặt lại tiêu đề modal

}

function toggleModal(){
    modal.classList.toggle('hide')
    if (modal.classList.contains('hide')) {
        clearModalFields(); // Xóa dữ liệu khi đóng modal
    }
}



btnEdit.forEach(function(button) {
    button.addEventListener('click', function() {
        var spendingTypeId = button.getAttribute('data-id'); // Lấy id từ data-id
        var spendingId = button.getAttribute('data-spending-id');

        var spendingTypeName = button.getAttribute('data-name');
        if (inputName) {  // Kiểm tra xem inputName có tồn tại không
            inputName.value = spendingTypeName; // Đặt giá trị vào trường nhập liệu
            var saveButton = document.querySelector('.saving-add__btn[name="themloaichitieu"]');
            if (saveButton) {
                saveButton.name = "sualoaichitieu"; // Đổi tên thuộc tính name
            }
            form.action = `./pages/processing/spending.php?action=edit_spendingtype&id=${spendingTypeId}`;
        }
        else{
        var spending = button.getAttribute('data-spending');
        var spendingType = button.getAttribute('data-spendingtype');
        var money = button.getAttribute('data-money');
        var note = button.getAttribute('data-note');
        var date = button.getAttribute('data-date');
        var time = button.getAttribute('data-time');

        inputSpending.value = spending;
        inputSpendingType.value = spendingType;
        inputMoney.value = money;
        inputNote.value = note;
        inputDate.value = date;
        inputTime.value = time;

        var saveButton = document.querySelector('.saving-add__btn[name="themkhoanchitieu"]');
            if (saveButton) {
                saveButton.name = "suakhoanchitieu"; // Đổi tên thuộc tính name
            }
            form.action = `./pages/processing/spending.php?action=edit_spendingtype&id=${spendingId}`;
        }
        

        

        modalTitle.textContent = 'Cập nhật'; // Đổi tiêu đề thành "Cập nhật"
        
        
        toggleModal();
        
    });
});


btnAdd.addEventListener('click', toggleModal)
btnClose.addEventListener('click', toggleModal)
iconClose.addEventListener('click', toggleModal)
