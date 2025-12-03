import * as v from "./_variables.js";


v.addFood_change_type_btn_1?.addEventListener('click', () => {

    v.addFood_mr_type_g.classList.add('dis-none');
    v.addFood_mr_type_dish.classList.remove('dis-none');
    v.addFood_change_type_btn_1.classList.add('dis-none');
    v.addFood_change_type_btn_2.classList.remove('dis-none');

    v.addFood_nutri_type.value = "dish";
});


v.addFood_change_type_btn_2?.addEventListener('click', () => {

    v.addFood_mr_type_dish.classList.add('dis-none');
    v.addFood_mr_type_g.classList.remove('dis-none');
    v.addFood_change_type_btn_2.classList.add('dis-none');
    v.addFood_change_type_btn_1.classList.remove('dis-none');

    v.addFood_nutri_type.value = "100g";
});
