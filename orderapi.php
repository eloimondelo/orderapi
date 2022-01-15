<?php
include_once '../order.php';


$order = new order();

// filters
$filter;

if(isset($_GET['date'])){
    $filter = $_GET['date'];
    $result = $order->getByDate($filter);
}
if(isset($_GET['company'])){
    $filter = $_GET['company'];
    $result = $order->getByCompany($filter);
} 

if(!isset($_GET['date']) && !isset($_GET['company'])){
    $result = $order->getAll();
} 
$orders = array();
if($result->rowCount()){
    while($row = $result->fetch()){
        $singleOrder= array(
            'date' => $row['date'],
            'company' => $row['company'],
            'qty' => $row['qty'],
        );
        array_push($orders, $singleOrder);
    }
    http_response_code(200);
    echo json_encode($orders,JSON_PRETTY_PRINT);
}else{
    http_response_code(404);
    echo json_encode(array('error' => 'Data not found'));
}





?>