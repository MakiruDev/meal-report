

<?php function navbar() { ?>
    <style>
        .genaral-navbar-div {
            display: flex;
            justify-content: center;
            gap: 32px;
            background: #1e1e2f;
            color: #fff;
            padding: 14px 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .2);
        }

        .genaral-navbar-div a {
            color: #ffffff;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
            transition: color 0.3s ease, transform 0.2s ease;
        }

        .genaral-navbar-div a:hover {
            color: #ffc675;
            /* highlight color */
            transform: translateY(-2px);
            /* subtle hover lift */
        }

        /* Responsive for mobile */
        @media (max-width: 768px) {
            .genaral-navbar-div {
                flex-direction: column;
                gap: 16px;
                padding: 12px 0;
            }

            .genaral-navbar-div a {
                font-size: 1rem;
            }
        }
    </style>
    <header>
        <div class="genaral-navbar-div">

            <a href="./listMeal.php">listMeal</a>
            <a href="./addFood.php">addFood</a>
            <a href="./addMeal.php">addMeal</a>

        </div>
    </header>


<?php } ?>

<?php function footer() { ?>
    <footer>

        <div class="index-footer-div">
            <!-- <i class="fa-solid fa-burger fa-spin index-footer-div-icon" style="color: #ffc675;"></i> -->
            <p class="index-footer-div-p">2025 Copyright, RcDav.</p>
            <!-- <i class="fa-solid fa-burger fa-spin index-footer-div-icon" style="color: #ffc675;"></i> -->
        </div>

    </footer>
<?php } ?>

<?php function linkCSS() { ?>
    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />

    <!-- font awesome cdn link -->
    <!-- https://fontawesome.com/icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Page Link -->
    <link rel="stylesheet" href="../css/index_page.css">
    <link rel="stylesheet" href="../css/listMeal_page.css">
    <link rel="stylesheet" href="../css/addFood_page.css">
    <link rel="stylesheet" href="../css/addMeal_page.css">


    <!-- Genaral Component -->
    <style>
        .dis-none {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="../css/genaral_component.css">

<?php } ?>

<?php function linkJS() { ?>
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>


    <script type="importmap">
        {
            "imports": {
                "tsx-dom": "../web_modules/tsx-dom/index.js",
                "tsx-dom/jsx-runtime": "../web_modules/tsx-dom/jsx-runtime.js"
            }
        }
    </script>


    <!-- module -->
    <script type="module" src="../js/ts/_variables.js"></script>

    <!-- addFood page -->
    <script type="module" src="../js/ts/calculateAutoBtn.js"></script>
    <script type="module" src="../js/ts/calculateAutoInput.js"></script>
    <script type="module" src="../js/ts/imgUploading.js"></script>
    <script type="module" src="../js/ts/changeTypeUnit.js"></script>
    <script type="module" src="../js/ts/editFoodBtn.js"></script>

    <!-- listMeal page -->
    <script type="module" src="../js/tsx/listMeal_opr.js"></script>

    <!-- addMeal page -->
    <script type="module" src="../js/tsx/addMeal_opr.js"></script>

<?php } ?>




<!doctype html>
<html lang="en">

<head>
    <link rel="icon" type="image/svg" href="../linkfile/burger_new.svg">
    <title>MealReport</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php linkCSS(); ?>
</head>

<body>
    <?php
        navbar();


        mainContent();


        footer();
        linkJS();
    ?>
</body>

</html>
