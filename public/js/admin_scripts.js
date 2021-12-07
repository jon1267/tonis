
function confirmDelete(id, PartIdDeleteForm) {
    console.log(id, PartIdDeleteForm);
    event.preventDefault();
    Swal.fire({
        title: 'Вы уверены?',
        icon: 'warning',
        text: "Вы точно хотите это удалить?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да, удалить!'
    }).then((result) => {
        console.log(result.value);
        if(result.value) {
            document.getElementById(PartIdDeleteForm + id).submit()
        }
    })
}


// удаление старого изображения. Тут model: Ларина модель ('Product')
// field: название поля mysql с изобр.('img' или 'header_mobile')
// id: записи из к-рой удаляется изобр. part_id - часть строки id скрытых инпутов
// нужно в категориях, где на одной странице 2 блока удаления изображения
function imageDelete(model, field ,id, part_id) {
    console.log(model, field ,id);

    Swal.fire({
        title: 'Вы уверены?',
        icon: 'warning',
        text: "Вы точно хотите это удалить?",
        //type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да, удалить!'
    }).then((result) => {
        if(result.value) {

            let deletedImageModel = document.getElementById(part_id + '_model');
            deletedImageModel.value = model;
            let deletedImageField = document.getElementById(part_id + '_field');
            deletedImageField.value = field;
            let deletedImageId = document.getElementById(part_id + '_id');
            deletedImageId.value = id;
            console.log(deletedImageModel.value, deletedImageField.value, deletedImageId.value);
            document.getElementById('old_div_' + part_id).remove();

        }
    })

}
