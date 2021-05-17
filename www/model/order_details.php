<?php 
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function insert_order_details($db,$order_id,$item_id,$purchase_price,$amount){
    
    $sql = "
    INSERT INTO
      order_details(
        order_id,
        item_id,
        purchase_price,
        amount
      )
    VALUES(?,?,?,?)
    ";
    $params = array($order_id,$item_id,$purchase_price,$amount);
    
    return execute_query($db, $sql, $params);
}