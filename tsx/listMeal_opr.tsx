

const listMeal_mdg = document.getElementById('listMeal-main-divner-gridner') as HTMLElement;
let EleNowId: Array<number> = [];
let EleNowName: Array<string> = [];
let EleNowExt: Array<string> = [];

let EleNowkcal: Array<number> = [];

let EleNowPro: Array<number> = [];
let EleNowFat: Array<number> = [];
let EleNowCarb: Array<number> = [];
// const glassIcon = document.getElementById('glass-i-con') as HTMLButtonElement | null;
const searchInput = document.getElementById('searchInput') as HTMLInputElement | null;

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


function deleteElement(id: number) {
    document.getElementById(`listMeal-mdg-1-${id}`)?.remove();
    document.getElementById(`listMeal-mdg-2-${id}`)?.remove();
    document.getElementById(`listMeal-mdg-3-${id}`)?.remove();
    document.getElementById(`listMeal-mdg-4-${id}`)?.remove();
    document.getElementById(`listMeal-mdg-5-${id}`)?.remove();
}

function clearMeals() {
    if (!EleNowId) { console.log(111); return; }
    for (let i = 0; i < EleNowId.length; i++) {
        console.log("delete");
        deleteElement(EleNowId[i]);
    }
    EleNowId = []
    EleNowName = []
    EleNowExt = []
}


export default function showFood(id: number, name: string, ext: string) {
    return (

        <div class="listMeal-main-divner-gridner-box" id={`listMeal-mdg-1-${id}`}>
            {/* https://example.com */}
            <form action="../frontend/editFood.php" id={`form-${id}`} method="get" class="dis-none">
                <input type="hidden" name="formData" value={`${id}`}></input>
            </form>

            <img class="listMeal-gridner-box-img-1" src={"../img/" + name + "." + ext} id={`listMeal-mdg-2-${id}`} onClick={() => {
                // console.log(12013);
                // location.href = 'https://example.com'
                const formElement = document.getElementById(`form-${id}`) as HTMLFormElement;
                formElement.submit();
            }}></img>
            <p id={`listMeal-mdg-3-${id}`}>{name}</p>
            <img class="listMeal-gridner-box-img-2" src={"../img/" + name + "." + ext} id={`listMeal-mdg-4-${id}`} ></img>
            <div id={`listMeal-mdg-5-${id}`}></div>
        </div>

    );
}


function updateRowsOnce() {
    if (!listMeal_mdg || !EleNowId) return;
    const { width } = listMeal_mdg.getBoundingClientRect();
    let cols = 4;
    if (width <= 1260) cols = 3;
    if (width <= 980) cols = 2;
    if (width <= 720) cols = 1;

    const amount = EleNowId.length;
    const rows = Math.ceil(amount / cols);
    listMeal_mdg.setAttribute('style', `grid-template-rows: repeat(${rows}, 300px);`);
}




async function fetchMeal() {

    console.log("send : ", searchInput?.value);

    await fetch('../backend/fetchMeal.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'food=' + 'fetchMeal'
    })
        .then(res => res.json())
        .then(data => {
            console.log('PHP res:', data);
            // data -> id name ext
            EleNowId = (data[0]);
            EleNowName = (data[1]);
            EleNowExt = (data[2]);
            for (let i = 0; i < data[0].length; i++) {
                listMeal_mdg!.appendChild(showFood(data[0][i], data[1][i], data[2][i]));
            }

            updateRowsOnce();
        });
}

if (listMeal_mdg !== null) {
    fetchMeal();
};


export async function search(page: number = 0, searchInputParam: HTMLInputElement | null = searchInput) {

    // let searchValue = () => {
    //     if (page === 5877) {
    //         return '';
    //     }
    //     return searchInputParam?.value;
    // };

    console.log("send : ", searchInputParam?.value);

    await fetch('../backend/search.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'food=' + encodeURIComponent(searchInputParam?.value ?? '')
    })
        .then(res => res.json())
        .then(data => {
            console.log('PHP res :', data);
            clearMeals();
            // data -> id name ext
            EleNowId = (data[0]);
            EleNowName = (data[1]);
            EleNowExt = (data[2]);

            EleNowData.id = data[0];
            EleNowData.name = data[1];
            EleNowData.ext = data[2];

            EleNowData.kcal = data[3];

            EleNowData.pro = data[4];
            EleNowData.fat = data[5];
            EleNowData.carb = data[6];

            EleNowData.unittype = data[7];

            if (page === 0) {
                if (EleNowId.length === 0) { updateRowsOnce(); return; }
                for (let i = 0; i < data[0].length; i++) {
                    listMeal_mdg!.appendChild(showFood(EleNowId[i], EleNowName[i], EleNowExt[i]));
                }

                updateRowsOnce();
            }
        });
    return EleNowData;
}

searchInput?.addEventListener('input', () => {
    search();
});


if (listMeal_mdg) {
    const resizeObserver = new ResizeObserver(entries => {
        for (const entry of entries) {
            const { width, height } = entry.contentRect;
            console.log(`box size: ${width} x ${height}`);
            let cols = 4;
            if (width <= 1260) cols = 3;
            if (width <= 980) cols = 2;
            if (width <= 720) cols = 1;

            const amount = EleNowId.length;
            const rows = Math.ceil(amount / cols);
            listMeal_mdg.setAttribute('style', `grid-template-rows: repeat(${rows}, 300px);`);
        }
    });

    resizeObserver.observe(listMeal_mdg);
}


