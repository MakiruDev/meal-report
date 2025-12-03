<?php function mainContent() { ?>

    <main class="listMeal-main">

        <form class="listMeal-main-divner">
            <div class="listMeal-main-divner-text">
                <p>list food</p>
                <a href="./addFood.php">+</a>
                <a href="./addFood.php">add food</a>

                <div class="listMeal-mdt-search">
                    <input type="text" placeholder="Search..." id="searchInput">
                    <div>
                        <i id="glass-i-con" class="fa-solid fa-magnifying-glass" style="color: #3a3a3a;"></i>
                    </div>
                </div>
            </div>
            <div class="listMeal-main-divner-gridner" id="listMeal-main-divner-gridner">
            </div>
        </form>

    </main>

<?php } ?>

<?php include './template.php'; ?>
