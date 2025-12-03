

<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

function mainContent() { ?>
    <main class="addMeal-main-tag">

        <form class="addMeal-main-formner">


            <div class="addMeal-hidden-box dis-none" id="id-editFood-hidden-box">
                <div class="addMeal-popup-container">
                    <div class="addMeal-popup-con-nav">
                        <button type="button" id="btnGoToAddfood">Go to add food</button>
                        <input type="text" placeholder="Search..." id="addMeal-popup-search-input">
                        <div>
                            <i id="addMeal-popup-glass-i-con" class="fa-solid fa-magnifying-glass" style="color: #3a3a3a;"></i>
                        </div>
                        <div class="addMeal-hidden-box-out" id="id-addMeal-hidden-box-out"></div>
                    </div>
                    <div class="addMeal-popup-con-list" id="id-addMeal-popup-con-list">
                        <?php
                            function fetchMealINPHP() {
                                include '../backend/connect.php';

                                $sql = "SELECT * FROM foodData";
                                $result = $conn->query($sql);

                                if ($result && $result->num_rows > 0) :
                                    while ($row = $result->fetch_assoc()) : ?>

                                        <div class="addMeal-pcl-row">
                                            <img src="../img/<?php echo $row["foodName"] . '.' . $row["fileExtension"]; ?>"></img>
                                            <p class="addMeal-pcl-name"><?php echo $row["foodName"]; ?></p>
                                            <p class="addMeal-pcl-kcal"><?php echo $row["kcal"]; ?> kcal</p>
                                            <!-- <button id="addMeal-popup-add" type="button">add</button> -->
                                            <div class="addMeal-pcl-btn-box-1">
                                                <i class="fa-solid fa-circle-check addMeal-i-1"></i>
                                                <!-- <i class="fa-solid fa-circle-xmark addMeal-i-2"></i> -->
                                            </div>
                                        </div>

                                <?php
                                    endwhile;
                                endif;
                                $conn->close();
                            }
                            // fetchMealINPHP();
                        ?>

                    </div>

                    <button type="button" class="addMeal-pcl-btn-select">add to meal</button>
                </div>
            </div>


            <div class="addMeal-main-formner-grid">


                <!-- Food management bar -->
                <div class="addMeal-mfg-managebar">
                    <p class="addMeal-mfg-mbar-text">add meal</p>
                    <!-- <button type="button" class="addMeal-mfg-mbar-btn-meal">meal</button> -->
                    <button type="button" class="addMeal-mfg-mbar-btn-food" id="id-addMeal-mfg-mbar-btn-food">addfood inlist</button>
                    <div class="addMeal-mfg-mbar-datetime" id="datetime-box">datetime
                        <!-- addMeal-mfg-mbar-btn- -->
                    </div>
                </div>



                <!-- Food content -->
                <div class="addMeal-mfg-food-content">

                    <?php for ($i = 0; $i < 20; $i++) : ?>

                        <div class="addMeal-mfgc-box">
                            <p class="addMeal-mfgc-box-number">1</p>
                            <img class="addMeal-mfgc-box-img" src="../linkfile/makeup_img.png" alt="">
                            <p class="addMeal-mfgc-box-name">name76580006</p>
                            <div class="addMeal-mfgc-box-pfc">
                                <p class="addMeal-mfgc-box-pfc-text-1">Protein</p>
                                <p class="addMeal-mfgc-box-pfc-text-2">Fat</p>
                                <p class="addMeal-mfgc-box-pfc-text-3">Carb</p>

                                <p class="addMeal-mfgc-box-pfc-num-1">20</p>
                                <p class="addMeal-mfgc-box-pfc-num-2">40</p>
                                <p class="addMeal-mfgc-box-pfc-num-3">10</p>

                            </div>
                            <p class="addMeal-mfgc-box-kcal">kcal 480</p>
                            <div class="addMeal-mfgc-box-unit">unit</div>
                        </div>

                    <?php endfor; ?>

                </div>



                <!-- Total calorie && Submit button -->
                <div class="addMeal-mfg-submit">
                    <p class="addMeal-mfg-submit-text">Total calorie</p>
                    <button type="submit" class="addMeal-mfg-submit-btn">submit</button>
                </div>


            </div>
        </form>
    </main>


<?php } ?>

<?php include './template.php'; ?>
