
import { search } from './listMeal_opr.js';

// tsc --watch
// ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
// Global State

class RealSelectListClass {
    index: number[] = [];
    amount: number[] = [];

    set(idx: number, amt: number) {
        const i = this.index.indexOf(idx);

        if (i === -1) {
            this.index.push(idx);
            this.amount.push(amt);
        } else {
            this.amount[i] = amt;
        }
    }

    add(idx: number, amt: number) {
        const i = this.index.indexOf(idx);

        if (i === -1) {
            console.log("add method error : no index");
        } else {
            this.amount[i] += amt;
        }
    }

    delete(idx: number) {
        const i = this.index.indexOf(idx);

        if (i !== -1) {
            this.index.splice(i, 1);
            this.amount.splice(i, 1);
        }
    }

    has(idx: number) {
        const i = this.index.indexOf(idx);

        if (i === -1) {
            return false;
        } else {
            return true;
        }
    }

    hasAdd(idx: number, amt: number) {
        const i = this.index.indexOf(idx);

        if (i === -1) {
            this.index.push(idx);
            this.amount.push(amt);
        } else {

            this.amount[i] += amt;
        }
    }
}


const EleNowData = {

    id: [] as Array<number>,
    name: [] as Array<string>,
    ext: [] as Array<string>,

    kcal: [] as Array<number>,

    pro: [] as Array<number>,
    fat: [] as Array<number>,
    carb: [] as Array<number>,

    unittype: [] as Array<string>
};

const EleAllData: typeof EleNowData = {
    id: [],
    name: [],
    ext: [],

    kcal: [],

    pro: [],
    fat: [],
    carb: [],

    unittype: []
};

// index of id in EleAllData
const foodSelectList: Map<number, number> = new Map();


let lastSeconds: number | null = null;


const datasetMapChange: Map<string, string> = new Map();
datasetMapChange.set("see", "none");
datasetMapChange.set("none", "see");
datasetMapChange.set("add", "delete");
datasetMapChange.set("delete", "add");

type datasetType = {
    id: number,
    type: string,
    dis: string
}

type realSelectListType = {
    index: Array<number>;
    amount: Array<number>;
    set: (idx: number, amt: number) => void;
    add: (idx: number, amt: number) => void;
    has: (idx: number) => Boolean;
    delete: (idx: number) => void;
    hasAdd: (idx: number, amt: number) => void;
}

const real_select_list: realSelectListType = new RealSelectListClass();

// real_select_list.set(1, 2);
// real_select_list.add(1, 2);
// real_select_list.delete(1);

let text_temp: boolean = true;


// ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
// DOM Elements


const searchInput = document.getElementById('addMeal-popup-search-input') as HTMLInputElement | null;

const addMealPopuplist = document.getElementById('id-addMeal-popup-con-list') as HTMLDivElement | null;

const addMealHiddenBoxOut = document.getElementById("id-addMeal-hidden-box-out") as HTMLDivElement | null;


const addMealMfgMbarBtnFood = document.getElementById("id-addMeal-mfg-mbar-btn-food") as HTMLButtonElement | null;

const editFoodHiddenBox = document.getElementById("id-editFood-hidden-box") as HTMLDivElement | null;


export const datetimeBox = document.getElementById("datetime-box") as HTMLDivElement;

const btnGoToAddfood = document.getElementById('btnGoToAddfood') as HTMLButtonElement | null;



const addMealPopupAdd = document.getElementById('addMeal-popup-add') as HTMLButtonElement | null;
const addMealPopupDelete = document.getElementById('addMeal-popup-delete') as HTMLButtonElement | null;


const id_addMeal_mfg_food_content = document.getElementById("id-addMeal-mfg-food-content") as HTMLDivElement;


// ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
// Utility Functions


function setEleNow(inputParam: typeof EleNowData | [], EleNowParam: typeof EleNowData = EleNowData) {

    if (typeof (inputParam) === 'object' && !Array.isArray(inputParam)) {
        EleNowParam.name = inputParam.name;
        EleNowParam.ext = inputParam.ext;
        EleNowParam.id = inputParam.id;

        EleNowParam.kcal = inputParam.kcal;

        EleNowParam.pro = inputParam.pro;
        EleNowParam.fat = inputParam.fat;
        EleNowParam.carb = inputParam.carb;

        EleNowParam.unittype = inputParam.unittype;

        return;
    }

    EleNowParam.name = inputParam;
    EleNowParam.ext = inputParam;
    EleNowParam.id = inputParam;

    EleNowParam.kcal = inputParam;

    EleNowParam.pro = inputParam;
    EleNowParam.fat = inputParam;
    EleNowParam.carb = inputParam;

    EleNowParam.unittype = inputParam;

    return;
}


function ToSelectList(btnDataParam: datasetType, params: typeof EleNowData = EleAllData) {

    // console.log("typeof", typeof (params.id[1]));
    const index: number = params.id.indexOf(btnDataParam.id);
    // console.log(btnDataParam.id);
    // console.log(index);

    if (btnDataParam.type === 'add') {
        foodSelectList.set(index, index);
    }
    else if (btnDataParam.type === 'delete') {
        foodSelectList.delete(index);
    };

}


async function fetchMealRow(param1: number = 0) {
    if (param1 === 0) {
        const output: typeof EleNowData = await search(2);
        // console.log("check type in fetchMealRow()", typeof output.id[1]);
        setEleNow(output);
    }

    for (let i = 0; i < EleNowData.id.length; i++) {
        addMealPopuplist?.appendChild(addMealPclRow(i));
    }

    // clearMealRow();
};

async function fetchAllFood() {
    const output = await search(2);
    setEleNow(output, EleAllData);
};

function clearMealRow() {

    console.log("Clearing meal rows");

    for (let i = 0; i < EleNowData.id.length; i++) {
        // console.log(`Removing element with id: id-addMeal-pcl-row-${EleNowData.id[i]}`);
        document.getElementById(`id-addMeal-pcl-row-${EleNowData.id[i]}`)?.remove();
    }

    setEleNow([]);
};


function datasetToObj(params: string | undefined) {

    if (params !== undefined) {
        const outputArray = params.split("-")
        return {
            id: parseInt(outputArray[0]) as number,
            type: outputArray[1] as string,
            dis: outputArray[2] as string
        };
    }

    return null;
}

function addMeal_SelectList_Show() {
    const array = real_select_list.index
    for (let k = 0; k < array.length; k++) {
        id_addMeal_mfg_food_content.appendChild(addMealSelectList(real_select_list.index[k], EleAllData, k + 1));
    }

}


// ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
// Function HTML



// <?php echo $row["foodName"] . '.' . $row["fileExtension"]; ?>

// <?php echo $row["foodName"]; ?>

// <?php echo $row["kcal"]; ?>
function addMealPclRow(indexNum: number, EleDataParam: typeof EleNowData = EleNowData) {

    // console.log(EleDataParam.name[indexNum]);
    // console.log(EleDataParam.ext[indexNum]);
    // console.log(EleDataParam.kcal[indexNum]);
    return (

        <div class="addMeal-pcl-row" id={`id-addMeal-pcl-row-${EleDataParam.id[indexNum]}`}>
            <img src={`../img/${EleDataParam.name[indexNum]}.${EleDataParam.ext[indexNum]}`}></img>
            <p class="addMeal-pcl-name">{EleDataParam.name[indexNum]}</p>
            <p class="addMeal-pcl-kcal">{EleDataParam.kcal[indexNum]} kcal</p>

            <button class="addMeal-popup-btn" type="button"
                data-addmeal-popup-btn={`${EleDataParam.id[indexNum]}-add-see`}>add</button>

            <button class="addMeal-popup-btn addMeal-popup-btn-delete dis-none" type="button"
                data-addmeal-popup-btn={`${EleDataParam.id[indexNum]}-delete-none`}>delete</button>
            {/* <div class="addMeal-pcl-btn-box-1">
                <i class="fa-solid fa-circle-check addMeal-i-1"></i>
                <i class="fa-solid fa-circle-xmark addMeal-i-2"></i>
            </div> */}
        </div>
    );
}


// id_addMeal_mfg_food_content
function addMealSelectList(inputIndex: number, EleNowDataParam: typeof EleNowData = EleNowData, nums: number = 1) {
    return (
        <div class="addMeal-mfgc-box">
            <p class="addMeal-mfgc-box-number">{nums}</p>
            <img class="addMeal-mfgc-box-img" src={`../img/${EleNowDataParam.name[inputIndex]}.${EleNowDataParam.ext[inputIndex]}`} alt=""></img>
            <p class="addMeal-mfgc-box-name">{EleNowDataParam.name[inputIndex]}</p>
            <div class="addMeal-mfgc-box-pfc">
                <p class="addMeal-mfgc-box-pfc-text-1">Protein</p>
                <p class="addMeal-mfgc-box-pfc-text-2">Fat</p>
                <p class="addMeal-mfgc-box-pfc-text-3">Carb</p>

                <p class="addMeal-mfgc-box-pfc-num-1">{EleNowDataParam.pro[inputIndex]}</p>
                <p class="addMeal-mfgc-box-pfc-num-2">{EleNowDataParam.fat[inputIndex]}</p>
                <p class="addMeal-mfgc-box-pfc-num-3">{EleNowDataParam.carb[inputIndex]}</p>

            </div>
            <p class="addMeal-mfgc-box-kcal">kcal {EleNowDataParam.kcal[inputIndex]}</p>
            <div class="addMeal-mfgc-box-unit">{EleNowDataParam.unittype[inputIndex]}</div>
        </div>
    );
};




// ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
// Interval / Loop


if (datetimeBox !== null) {
    setInterval(() => {
        const now = new Date();
        // const date: string = now.toLocaleDateString();
        const timeH: number = now.getHours();
        const timeM: number = now.getMinutes();
        const timeS: number = now.getSeconds();

        if (timeS !== lastSeconds) {
            // console.log(timeH + " : " + timeM + " : " + timeS);
            datetimeBox.innerText = `${timeH} : ${timeM} : ${timeS}`;
        }
        lastSeconds = timeS;
    }, 100);
}



// ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----
// Setup Event


addMealHiddenBoxOut?.addEventListener("click", () => {
    editFoodHiddenBox?.classList.add("dis-none");

    // let i = 0;
    foodSelectList.forEach((index) => {

        const id = EleAllData.id[index];
        // console.log("k, v", k, v);
        // console.log("i :", i);
        // i++;
        const btnDelete: HTMLButtonElement | null = document.querySelector(
            `.addMeal-popup-btn[data-addmeal-popup-btn="${id}-delete-see"]`
        );

        const btnAdd: HTMLButtonElement | null = document.querySelector(
            `.addMeal-popup-btn[data-addmeal-popup-btn="${id}-add-none"]`
        );

        // console.log("log btn d", btnDelete);
        // console.log("log btn a", btnAdd);

        // i++;
        if (btnDelete === null) return;
        // i++;
        if (btnAdd === null) return;

        btnDelete.classList.add('dis-none');
        btnAdd.classList.remove('dis-none');
        // console.log("el af adClass", elDelete, elAdd);
        // console.log("el af adClass", elDelete?.classList, elAdd?.classList);

        btnDelete.dataset.addmealPopupBtn = `${id}-delete-none`;
        btnAdd.dataset.addmealPopupBtn = `${id}-add-see`;
        // console.log("raw Dataset", btnDelete.dataset.addmealPopupBtn, btnAdd.dataset.addmealPopupBtn);

        // i++
        // real_select_list.set(, 1);
        real_select_list.hasAdd(index, 1);
        // console.log("foodSelectList", foodSelectList);
        // console.log("realSelectList", realSelectList);
        // i++

    });

    foodSelectList.clear();
    console.log(foodSelectList);
    console.log("realSelectList", real_select_list);

    addMeal_SelectList_Show();
});


btnGoToAddfood?.addEventListener('click', () => {
    // console.log(1234);
    location.href = './listMeal.php';
});

searchInput?.addEventListener('input', async () => {

    console.log("input : ", searchInput.value);
    const output = await search(1, searchInput);

    clearMealRow()
    setEleNow(output);
    fetchMealRow(1);

});

searchInput?.addEventListener("keydown", (inputKey) => {
    if (inputKey.key === "Enter") {
        inputKey.preventDefault();
    }
});

addMealMfgMbarBtnFood?.addEventListener("click", () => {
    editFoodHiddenBox?.classList.remove("dis-none");
});


addMealPopupAdd?.addEventListener("click", () => {
    console.log("Add button clicked");
    addMealPopupDelete?.classList.remove("dis-none");
});

addMealPopupDelete?.addEventListener("click", () => {
    console.log("Delete button clicked");
    addMealPopupDelete?.classList.add("dis-none");
});



addMealPopuplist?.addEventListener('click', (e) => {

    // console.log('in addMealPopuplist');
    const target = e.target as HTMLElement;
    const btn = target.closest('.addMeal-popup-btn') as HTMLButtonElement | null;
    if (!btn) return;
    // console.log('af btn = target.closest');

    const rawDataset = btn.dataset.addmealPopupBtn;
    const btnData: datasetType | null = datasetToObj(rawDataset);
    // console.log('rawDataset', rawDataset);
    // console.log('btnData', btnData);
    if (btnData === null) return;
    // console.log('af datasetToObj(rawDataset)');

    const antiBtn: HTMLButtonElement | null = document.querySelector(
        `.addMeal-popup-btn.dis-none[data-addMeal-popup-btn="${btnData.id}-${datasetMapChange.get(btnData.type)}-${datasetMapChange.get(btnData.dis)}"]`
    );
    // console.log(antiBtn);
    if (!antiBtn) return;

    const rawAntiDataset = antiBtn.dataset.addmealPopupBtn;
    const antiBtnData: datasetType | null = datasetToObj(rawAntiDataset);
    if (!antiBtnData) return;

    btn?.classList.add('dis-none');
    antiBtn?.classList.remove('dis-none');

    btn.dataset.addmealPopupBtn = `${btnData.id}-${btnData.type}-${datasetMapChange.get(btnData.dis)}`;
    antiBtn.dataset.addmealPopupBtn = `${antiBtnData.id}-${antiBtnData.type}-${datasetMapChange.get(antiBtnData.dis)}`;


    // console.log(btn, rawDataset);
    // console.log(antiBtn, rawAntiDataset);

    ToSelectList(btnData);
    console.log(foodSelectList);

});



// function clearMeals() {}

if (datetimeBox !== null) {
    fetchMealRow();
    // console.log("bf", EleAllData);
    fetchAllFood();
    // console.log("af", EleAllData);
}
