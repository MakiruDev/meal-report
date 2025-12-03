<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    // -------------------------------
    $food_name = trim($_POST['food-name']);
    $protein = $_POST['protein'];
    $fat = $_POST['fat'];
    $carb = $_POST['carb'];
    $kcal = $_POST['kcal'];
    $unitType = $_POST['addFood-nutri-type'];

    // -------------------------------


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
    $clean_name = strtolower(preg_replace('/[^a-zA-Z0-9ก-ฮะ-๙]+/u', '_', $food_name));
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
    $sql = "SELECT MAX(id_foodData) AS max_id FROM foodData";
    $result = $conn->query($sql);
    $next_id = 1;
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $next_id = $row['max_id'] + 1;
    }

    // -------------------------------
    // save to db
    // -------------------------------
    $sql = "INSERT INTO foodData (id_foodData, foodName, protein, fat, carb, kcal, unitType, fileExtension)
            VALUES ('$next_id', '$food_name', '$protein', '$fat', '$carb', '$kcal', '$unitType', '$fileActualExt')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('successfully!'); window.location.href='../frontend/addFood.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
