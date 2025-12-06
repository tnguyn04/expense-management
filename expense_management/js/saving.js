var btnAdd = document.querySelector('.thrifty-add__btn')
var modal = document.querySelector('.modal-edit')
var iconClose = document.querySelector('.auth-form__close-icon')
var btnClose = document.querySelector('.saving-add__btn')
var btnEdit = document.querySelectorAll('.budget-btn--edit')
var modalTitle = document.querySelector('.auth-form__heading');

var inputSaving = document.querySelector('[name="muctieu"]')
var inputMoney = document.querySelector('[name="sotien"]')
var inputStartDate = document.querySelector('[name="ngaybatdau"]')
var inputCompletioneDate = document.querySelector('[name="ngayhoanthanh"]')
//var hiddenIdInput = document.querySelector('input[name="id"]'); // Trường ẩn để lưu ID
var form = document.querySelector('form[action="pages/processing/saving.php"]');

function clearModalFields() {
    inputSaving.value = '';
    inputMoney.value = '';
    inputStartDate.value = '';
    inputCompletioneDate.value = '';
    modalTitle.textContent = 'Thêm mới'; // Đặt lại tiêu đề modal
    var saveButton = document.querySelector('.saving-add__btn[name="suatietkiem"]');
    if (saveButton) {
        saveButton.name = "themtietkiem"; // Đặt lại nút thành thêm mới
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
        
         
        var savingId = button.getAttribute('data-saving-id');
        var savingName = button.getAttribute('data-name');
        var money = button.getAttribute('data-money');
        var startDate = button.getAttribute('data-start-date');
        var completioneDate = button.getAttribute('data-completione-date');

        inputSaving.value = savingName;
        inputMoney.value = money;
        inputStartDate.value = startDate;
        inputCompletioneDate.value = completioneDate;

        var saveButton = document.querySelector('.saving-add__btn[name="themtietkiem"]');
            if (saveButton) {
                saveButton.name = "suatietkiem"; // Đổi tên thuộc tính name
            }
            form.action = `./pages/processing/saving.php?action=edit_saving&id=${savingId}`;
        
        

        

        modalTitle.textContent = 'Cập nhật'; // Đổi tiêu đề thành "Cập nhật"
        
        
        toggleModal();
        
    });
});


btnAdd.addEventListener('click', toggleModal)
btnClose.addEventListener('click', toggleModal)
iconClose.addEventListener('click', toggleModal)
