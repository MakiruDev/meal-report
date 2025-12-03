
<?php function mainContent() { ?>
    <?php
    include '../backend/connect.php';

    $formData = $_GET['formData'];
    $sql = "SELECT * FROM foodData WHERE id_foodData LIKE '%$formData%'";
    $id_foodData;
    $foodName;
    $fileExtension;
    $protein;
    $fat;
    $carb;
    $kcal;
    $unitType;

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // echo "test text";
        while ($row = $result->fetch_assoc()) {
            $id_foodData = $row['id_foodData'];
            $foodName = $row['foodName'];
            $fileExtension = $row['fileExtension'];
            $protein = $row['protein'];
            $fat = $row['fat'];
            $carb = $row['carb'];
            $kcal = $row['kcal'];
            $unitType = $row['unitType'];
            break;
        }
    }
    ?>


    <main class="addFood-main">

        <div class="editFood-hidden-box" id="id-editFood-hidden-box">
            <button class="editFood-hidden-box-btn" id="id-editFood-hidden-box-btn" type="button">
                <!-- <i class="fa-solid fa-pen" style="color: #1d1c29;"></i> -->
                Edit Food
                <i class="fa-solid fa-pen" style="color: #1d1c29;"></i>
            </button>
        </div>

        <form class="addFood-mainer" action="../backend/edit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_foodDataHidden" value="<?php echo $id_foodData ;?>">
            <input type="hidden" name="foodNameHidden" value="<?php echo $foodName ;?>">
            <input type="hidden" name="fileExtensionHidden" value="<?php echo $fileExtension ;?>">
            <input type="hidden" name="proteinHidden" value="<?php echo $protein ;?>">
            <input type="hidden" name="fatHidden" value="<?php echo $fat ;?>">
            <input type="hidden" name="carbHidden" value="<?php echo $carb ;?>">
            <input type="hidden" name="kcalHidden" value="<?php echo $kcal ;?>">
            <input type="hidden" name="unitTypeHidden" value="<?php echo $unitType ;?>">

            <div class="addFood-mainer-left">
                <p class="addFood-mainer-l-text">Edit Food</p>
                <div class="addFood-mainer-l-img">
                    <img id="addFood-mainer-l-img-pre" src="<?php echo "../img/" . $foodName . "." . $fileExtension ?>" alt="">
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
                        <input type="text" name="food-name" value="<?php echo $foodName ;?>" placeholder="food name">
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
                        <?php if( $unitType == "100g") : ?>
                        <p id="addFood-mr-type-g" class="">(nutri. per 100g)</p>
                        <p id="addFood-mr-type-dish" class="dis-none">(nutri. per dish)</p>
                        <?php else : ?>
                        <p id="addFood-mr-type-dish">(nutri. per dish)</p>
                        <p id="addFood-mr-type-g" class="dis-none">(nutri. per 100g)</p>
                        <?php endif; ?>
                        <input type="hidden" class="" name="addFood-nutri-type" id="addFood-nutri-type" value="<?php echo $unitType ;?>">
                        <button type="button" id="addFood-change-type-btn-1" class="">Type</button>
                        <button type="button" id="addFood-change-type-btn-2" class="dis-none">Type</button>
                    </div>

                </div>

                <div class="addFood-mr-pfc-kcal">

                    <p class="addFood-mr-text-pfc">Protein</p>
                    <div class="addFood-mr-input-pfc">
                        <input id="id-protein" type="float" name="protein" value="<?php echo $protein ;?>">
                        <p>g</p>
                    </div>

                    <p class="addFood-mr-text-pfc">Fat</p>
                    <div class="addFood-mr-input-pfc">
                        <input id="id-fat" type="float" name="fat" value="<?php echo $fat ;?>">
                        <p>g</p>
                    </div>

                    <p class="addFood-mr-text-pfc">Carbohydrate</p>
                    <div class="addFood-mr-input-pfc">
                        <input id="id-carb" type="float" name="carb" value="<?php echo $carb ;?>">
                        <p>g</p>
                    </div>

                    <div class="addFood-mr-text-pfc addFood-ex-div">
                        <p>Calorie</p>
                        <button id="un-auto-calculate-btn" class="dis-none" type="button">auto calculate</button>
                    </div>
                    <div class="addFood-mr-input-pfc">
                        <div>
                            <input id="id-kcal" type="float" name="kcal" value="<?php echo $kcal ;?>">
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
