
<?php

include './connect.php';

// if (isset($_POST['searchInputText'])) {
if (isset($_POST['food'])) {
    // $search = $_POST['searchInputText'];
    $food = $_POST['food'];
    $data = [];
    $data1 = [];
    $data2 = [];
    $data3 = [];

    $data4 = [];

    $data5 = [];
    $data6 = [];
    $data7 = [];

    $data8 = [];

    $sql = "SELECT * FROM foodData
            WHERE foodName LIKE '%$food%'";
            // OR unitType LIKE '%$search%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($data1, (int)$row['id_foodData']);
            array_push($data2, $row['foodName']);
            array_push($data3, $row['fileExtension']);

            array_push($data4, $row['kcal']);

            array_push($data5, (float)$row['protein']);
            array_push($data6, (float)$row['fat']);
            array_push($data7, (float)$row['carb']);

            array_push($data8, $row['unitType']);
        }
        array_push($data, $data1);
        array_push($data, $data2);
        array_push($data, $data3);

        array_push($data, $data4);

        array_push($data, $data5);
        array_push($data, $data6);
        array_push($data, $data7);

        array_push($data, $data8);
    }
}



header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://127.0.0.1:5500');
header('Access-Control-Allow-Headers: Content-Type');
echo json_encode($data);

