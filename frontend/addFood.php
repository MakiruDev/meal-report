
<?php function mainContent() { ?>
    <main class="addFood-main">

        <form class="addFood-mainer" action="../backend/upload.php" method="post" enctype="multipart/form-data">
            <div class="addFood-mainer-left">
                <p class="addFood-mainer-l-text">Add Food</p>
                <div class="addFood-mainer-l-img">
                    <img id="addFood-mainer-l-img-pre" src="../linkfile/makeup_img.png" alt="">
                </div>
                <div class="addFood-mainer-l-input">
                    <input id="addFood-mainer-l-input-file" type="file" name="addFood-img-file" >
                </div>
            </div>
            <div class="addFood-mainer-right">

                <!-- mr = main-div-container-right-container -->
                <div class="addFood-mr-name">

                    <div class="addFood-mr-text-name">Name</div>
                    <div class="addFood-mr-input-name">
                        <input type="text" name="food-name" value="" placeholder="food name">
                    </div>

                    <div class="addFood-mr-btn-edit dis-none">
                        <p>Click "Edit" to fill food details.</p>
                        <div>
                            <div></div>
                            <button>Edit</button>
                        </div>
                    </div>

                    <div class="addFood-mr-unitType">
                        <p>Click "Type" to change type</p>
                        <p id="addFood-mr-type-g" class="">(nutri. per 100g)</p>
                        <p id="addFood-mr-type-dish" class="dis-none">(nutri. per dish)</p>
                        <input type="hidden" class="" name="addFood-nutri-type" id="addFood-nutri-type" value="100g">
                        <button type="button" id="addFood-change-type-btn-1" class="">Type</button>
                        <button type="button" id="addFood-change-type-btn-2" class="dis-none">Type</button>
                    </div>

                </div>

                <div class="addFood-mr-pfc-kcal">

                    <p class="addFood-mr-text-pfc">Protein</p>
                    <div class="addFood-mr-input-pfc">
                        <input id="id-protein" type="float" name="protein" value="0">
                        <p>g</p>
                    </div>

                    <p class="addFood-mr-text-pfc">Fat</p>
                    <div class="addFood-mr-input-pfc">
                        <input id="id-fat" type="float" name="fat" value="0">
                        <p>g</p>
                    </div>

                    <p class="addFood-mr-text-pfc">Carbohydrate</p>
                    <div class="addFood-mr-input-pfc">
                        <input id="id-carb" type="float" name="carb" value="0">
                        <p>g</p>
                    </div>

                    <div class="addFood-mr-text-pfc addFood-ex-div">
                        <p>Calorie</p>
                        <button id="un-auto-calculate-btn" class="dis-none" type="button">auto calculate</button>
                    </div>
                    <div class="addFood-mr-input-pfc">
                        <div>
                            <input id="id-kcal" type="float" name="kcal" value="0">
                            <div id="id-un-auto"></div>
                        </div>
                        <p>kcal</p>
                    </div>

                </div>


                <div class="addFood-mr-submit">
                    <button type="submit">Submit</button>
                    <div></div>
                </div>

            </div>
        </form>

    </main>


<?php } ?>

<?php include './template.php'; ?>
