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

function get_order_details($db,$user,$order_id){

  if(is_admin($user) === TRUE){
    return get_all_details($db,$order_id);
  }
  else {
    return get_user_details($db,$user['user_id'],$order_id);
  }
}

function  get_all_details($db,$order_id){

  $sql = "
  SELECT
    order_details.purchase_price AS price,
    order_details.amount AS amount,
    items.name AS name
  FROM
    order_details
  INNER JOIN
    items
  ON
    order_details.item_id = items.item_id
  WHERE
    order_id = ?
  ";

  $params = array($order_id);

  return fetch_all_query($db, $sql, $params);
}

function  get_user_details($db,$user_id,$order_id){

  $sql = "
  SELECT
    order_details.item_id,
    order_details.purchase_price AS price,
    order_details.amount AS amount,
    items.name AS name
  FROM
    order_details
  INNER JOIN
    items
  ON
    order_details.item_id = items.item_id
  INNER JOIN
    orders
  ON
    order_details.order_id = orders.order_id
  WHERE
    order_details.order_id = ?
  AND
    orders.user_id = ?
  ";

  $params = array($order_id,$user_id);

  return fetch_all_query($db, $sql, $params);
}