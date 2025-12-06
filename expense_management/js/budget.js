var btnAdd = document.querySelector('.thrifty-add__btn')
var modal = document.querySelector('.modal-edit')
var iconClose = document.querySelector('.auth-form__close-icon')
var btnClose = document.querySelector('.saving-add__btn')
var btnEdit = document.querySelectorAll('.budget-btn--edit')
var modalTitle = document.querySelector('.auth-form__heading');

var inputSpendingType = document.querySelector('[name="id_loaichitieu"]')
var inputMoney = document.querySelector('[name="hanmuc"]')
var inputStartDate = document.querySelector('[name="ngaybatdau"]')
var inputEndDate = document.querySelector('[name="ngayketthuc"]')
//var hiddenIdInput = document.querySelector('input[name="id"]'); // Trường ẩn để lưu ID
var form = document.querySelector('form[action="pages/processing/budget.php"]');

function clearModalFields() {
    inputSpendingType.value = '';
    inputMoney.value = '';
    inputStartDate.value = '';
    inputEndDate.value = '';
    modalTitle.textContent = 'Thêm mới'; // Đặt lại tiêu đề modal
    var saveButton = document.querySelector('.saving-add__btn[name="suangansach"]');
    if (saveButton) {
        saveButton.name = "themngansach"; // Đặt lại nút thành thêm mới
    }
}

function toggleModal(){
    modal.classList.toggle('hide')
    if (modal.classList.contains('hide')) {
        clearModalFields(); // Xóa dữ liệu khi đóng modal
    }
}



btnEdit.forEach(function(button) {
    button.addEventListener('click', function() {
        
         

        var budgetId = button.getAttribute('data-budget-id');
        var spendingType = button.getAttribute('data-spendingtype');
        var money = button.getAttribute('data-money');
        var startDate = button.getAttribute('data-start-date');
        var endDate = button.getAttribute('data-end-date');

        inputSpendingType.value = spendingType;
        inputMoney.value = money;
        inputStartDate.value = startDate;
        inputEndDate.value = endDate;

        var saveButton = document.querySelector('.saving-add__btn[name="themngansach"]');
            if (saveButton) {
                saveButton.name = "suangansach"; // Đổi tên thuộc tính name
            }
            form.action = `./pages/processing/budget.php?action=edit_budget&id=${budgetId}`;
        
        

        

        modalTitle.textContent = 'Cập nhật'; // Đổi tiêu đề thành "Cập nhật"
        
        
        toggleModal();
        
    });
});


btnAdd.addEventListener('click', toggleModal)
btnClose.addEventListener('click', toggleModal)
iconClose.addEventListener('click', toggleModal)
