<?php

include './connect.php';

$id = $_POST['id_foodDataHidden'];
$old_ext = $_POST['fileExtensionHidden'];

$old_foodName = $_POST['foodNameHidden'];
$old_protein = $_POST['proteinHidden'];
$old_fat = $_POST['fatHidden'];
$old_carb = $_POST['carbHidden'];
$old_kcal = $_POST['kcalHidden'];
$old_unitType = $_POST['unitTypeHidden'];

// ['addFood-img-file']
$new_foodName = $_POST['food-name'];
$new_protein = $_POST['protein'];
$new_fat = $_POST['fat'];
$new_carb = $_POST['carb'];
$new_kcal = $_POST['kcal'];
$new_unitType = $_POST['addFood-nutri-type'];


$condi_N = $new_foodName == $old_foodName;
$condi_P = $new_protein == $old_protein;
$condi_F = $new_fat == $old_fat;
$condi_C = $new_carb == $old_carb;
$condi_K = $new_kcal == $old_kcal;
$condi_U = $new_unitType == $old_unitType;



$tabel_col_name = array('foodName', 'protein', 'fat', 'carb', 'kcal', 'unitType');
$tabel_col_new = array($new_foodName, $new_protein, $new_fat, $new_carb, $new_kcal, $new_unitType);
$condi_array = array($condi_N, $condi_P, $condi_F, $condi_C, $condi_K, $condi_U);
$UPDATE_log = array();


for ($i = 1; $i < 6; $i++) { // protein fat carb kcal unitType ( not have foodName )

    $sql = "UPDATE foodData SET " . $tabel_col_name[$i] . "=? WHERE id_foodData=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $tabel_col_new[$i], $id);
    $stmt->execute();
    // $sql = "UPDATE foodData SET foodName=?, fileExtension=? WHERE id_foodData=?";
    // $stmt->bind_param("ssi", $new_foodName, $fileActualExt, $id);

    // if ($stmt->execute()) {
    //     array_push($UPDATE_log, 1);
    // }
    // else {
    //     // echo "error : " . $stmt->error;
    //     array_push($UPDATE_log, 0);
    // }
}

if (isset($_FILES['addFood-img-file'])) {


    // delete old file
    // ----------------------------------------------------------------------------------------



    $filePath = '../img/' . $old_foodName . '.' . $old_ext;

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo "deleted";
        } else {
            echo "error";
        }
    } else {
        echo "not_found";
    }



    // upload
    // ----------------------------------------------------------------------------------------

    $food_name = trim($_POST['food-name']);

    $file = $_FILES['addFood-img-file'];
    $filename = $file['name'];
    $filetmp = $file['tmp_name'];
    $fileerror = $file['error'];
    $filesize = $file['size'];

    $fileExt = explode('.', $filename);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'webp');

    if (!in_array($fileActualExt, $allowed)) {
        die("file type error, need : jpg, jpeg, png, webp");
    }

    if ($fileerror !== 0) {
        die("error upload");
    }

    if ($filesize > 10000000) {
        die("too big");
    }

    // -------------------------------
    // make name file like name food
    // -------------------------------
    $clean_name = strtolower(preg_replace('/[^a-zA-Z0-9ก-ฮะ-๙]+/u', '_', $new_foodName));
    $newFileName = $clean_name . '.' . $fileActualExt;
    $uploadDir = "../img/";
    $fileDestination = $uploadDir . $newFileName;

    $counter = 1;
    while (file_exists($fileDestination)) {
        $newFileName = $clean_name . '_' . $counter . '.' . $fileActualExt;
        $fileDestination = $uploadDir . $newFileName;
        $counter++;
    }

    // move input file to img/
    if (!move_uploaded_file($filetmp, $fileDestination)) {
        die("move input file error");
    }

    // -------------------------------
    // find next id
    // -------------------------------
    // $sql = "SELECT MAX(id_foodData) AS max_id FROM foodData";
    // $result = $conn->query($sql);
    // $next_id = 1;
    // if ($result && $result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    //     $next_id = $row['max_id'] + 1;
    // }

    // -------------------------------
    // save to db
    // -------------------------------

    // $sql = "UPDATE foodData SET " . $tabel_col_name[$i] . "=? WHERE id_foodData=?";

    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("si", $tabel_col_new[$i], $id);
    // $stmt->execute();


    $sql = "UPDATE foodData SET foodName=?, fileExtension=? WHERE id_foodData=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $new_foodName, $fileActualExt, $id);
    $stmt->execute();

}


$stmt->close();
$conn->close();

header('location: ../frontend/editFood.php?formData=' . $id);
exit();
