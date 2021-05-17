<?php 
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function insert_orders($db,$user_id){
    
    $sql = "
    INSERT INTO
      orders(
        user_id
      )
    VALUES(?)
    ";
    $params = array($user_id);
    
    return execute_query($db, $sql, $params);
}