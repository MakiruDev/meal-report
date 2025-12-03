import * as VAR from "./_variables.js";


VAR.id_un_auto?.addEventListener('click', () => {

    VAR.id_un_auto.classList.add('dis-none');
    VAR.un_auto_calculate_btn.classList.remove('dis-none');
});

VAR.un_auto_calculate_btn?.addEventListener('click', () => {

    VAR.un_auto_calculate_btn.classList.add('dis-none');
    VAR.id_un_auto.classList.remove('dis-none');
});
