<?php
// File name: bestreads.php
// Author: Xin Li

if ($_GET['book'] == "home") {
    showAll();
}
else {
    showBook();
}

function showAll() {
    $array = glob('./books/*');
    echo json_encode($array);
}

function showBook() {
    $bookDir = $_GET['book'];
    $result = array();
    $info = file($bookDir . '/info.txt');
    array_push($result, $bookDir . '/cover.jpg');
    $result = addToArray($info, $result);
    $description = file($bookDir . '/description.txt');
    $result = addToArray($description, $result);
    $review = file($bookDir . '/review.txt');
    $stars = $review[0] . " ";
    for ($i = 0; $i < intval($review[1]); $i++) {
        $stars .= "*";
    }
    array_push($result, $stars);
    array_push($result, $review[2]);
    echo json_encode($result);
}

function addToArray($from, $to) {
    for ($i = 0; $i < count($from); $i++) {
        if (strlen($from[$i]) > 1) {
            array_push($to, $from[$i]);
        }
    }
    return $to;
}

?>