import * as VAR from "./_variables.js";


let auto_cal = 1;


function zero(str: string) {
    const chars = str.split("");
    const array_result = [];
    let str_result = "";
    let end = true;

    if (chars.length == 1) {
        return str;
    }

    if (chars[0] == "0" && chars[1] == ".") {
        return str;
    }

    if (chars[0] == ".") {
        return "0" + str;
    }

    for (let i = 0; i < chars.length; i++) {

        if (!(chars[i] === "0" && end)) {
            end = false;
            array_result.push(chars[i]);
        }
    }

    if (array_result[0] == ".") {
        array_result.splice(0, 0, "0");
    }

    for (let i = 0; i < array_result.length; i++) {
        str_result = str_result + array_result[i].toString();
    }

    return str_result;
}

function strange_fix(str: string) {
    const chars = str.split("");
    const array_result = [];
    const check_set = new Map();
    check_set.set("0", "0"); check_set.set("1", "1"); check_set.set("2", "2");
    check_set.set("3", "3"); check_set.set("4", "4"); check_set.set("5", "5");
    check_set.set("6", "6"); check_set.set("7", "7"); check_set.set("8", "8");
    check_set.set("9", "9"); check_set.set(".", ".");
    let str_result: string = "";

    for (let i = 0; i < chars.length; i++) {

        if (check_set.has(chars[i])) {
            if (chars[i] == ".") { check_set.delete("."); }
            array_result.push(chars[i]);
        }
    }

    for (let i = 0; i < array_result.length; i++) {
        str_result = str_result + array_result[i].toString();
    }

    return str_result;
}


// console.log("none zero : 000098974230");
// console.log("have zero : " + zero("000098974230"));
// console.log("none strange_fix : 989lk;np74230ougkuh");
// console.log("have strange_fix : " + strange_fix("989lk;np74230ougkuh"));
// console.log("have strange_fix : " + strange_fix("989lk;np742.30ougkuh"));
// console.log("have strange_fix : " + strange_fix("98.9lk;np74.230ougkuh"));

function only_number(target: HTMLInputElement) {
    ['input', 'focusout'].forEach(event => {
        target.addEventListener(event, () => {
            const __NaN__ = isNaN(parseFloat(target.value));
            const negative = parseFloat(target.value) < 0;
            const strange = strange_fix(target.value) != target.value;
            const __zero__ = (target.value != zero(target.value));

            if (negative) {
                target.value = (parseFloat(target.value) * (-1)).toString();
            }

            if (strange) {
                target.value = strange_fix(target.value);
            }

            if (__NaN__) {
                target.value = "0";
            }

            if (auto_cal && (target != VAR.id_kcal)) {
                VAR.id_kcal.value = ((parseFloat(VAR.id_protein.value) * 4) + (parseFloat(VAR.id_fat.value) * 9) + (parseFloat(VAR.id_carb.value) * 4)).toString();
            }

            if (__zero__) {
                target.value = zero(target.value)
            }
        });
    });
}


VAR.id_un_auto?.addEventListener('click', () => {
    auto_cal = 0;
});

VAR.un_auto_calculate_btn?.addEventListener('click', () => {
    auto_cal = 1;
    VAR.id_kcal.value = ((parseFloat(VAR.id_protein.value) * 4) + (parseFloat(VAR.id_fat.value) * 9) + (parseFloat(VAR.id_carb.value) * 4)).toString();
});


if (VAR.id_protein !== null) {
    only_number(VAR.id_protein);
    only_number(VAR.id_fat);
    only_number(VAR.id_carb);
    only_number(VAR.id_kcal);
}

