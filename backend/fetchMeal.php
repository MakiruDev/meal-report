
<?php

include './connect.php';

if (isset($_POST['food'])) {
    $food = $_POST['food'];
    $data = [];
    $name = [];
    $ext = [];
    $id = [];


    $sql = "SELECT * FROM foodData";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($id, $row["id_foodData"]);
            array_push($name, $row["foodName"] );
            array_push($ext, $row["fileExtension"] );
        }
        array_push($data, $id, $name, $ext);
    }
}


header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://127.0.0.1:5500');
header('Access-Control-Allow-Headers: Content-Type');
echo json_encode($data);

