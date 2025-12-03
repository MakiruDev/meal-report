const id_editFood_hidden_box = document.getElementById('id-editFood-hidden-box') as HTMLElement;
const id_editFood_hidden_box_btn = document.getElementById('id-editFood-hidden-box-btn') as HTMLButtonElement;
let editFoodHB_i = 0;

id_editFood_hidden_box_btn?.addEventListener('click', () => {
    if (!editFoodHB_i) {
        id_editFood_hidden_box.classList.add('dis-none');
        editFoodHB_i++;
    }
});
