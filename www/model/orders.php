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

function get_orders($db,$user){

  if(is_admin($user) === TRUE){
    return get_all_orders($db);
  }
  else {
    return get_user_orders($db,$user['user_id']);
  }
}

function get_all_orders($db){

  $sql = "
  SELECT 
    orders.order_id,
    orders.created,
    SUM(order_details.purchase_price * order_details.amount) AS sum
  FROM
    orders
  JOIN
    order_details
  ON
    orders.order_id = order_details.order_id
  GROUP BY
    order_id
  ORDER BY
    created DESC
  ";

  return fetch_all_query($db, $sql);
}

function get_user_orders($db,$user_id){

  $sql = "
  SELECT 
    orders.order_id,
    orders.created,
    SUM(order_details.purchase_price * order_details.amount) AS sum
  FROM
    orders
  INNER JOIN
    order_details
  ON
    orders.order_id = order_details.order_id
  WHERE
    orders.user_id = ?
  GROUP BY
    order_id
  ORDER BY
    created DESC
  ";

  $params = array($user_id);

  return fetch_all_query($db, $sql, $params);
}

function get_orders_title($db,$order_id){

  $sql = "
  SELECT 
    orders.order_id AS order_id,
    orders.created AS created,
    SUM(order_details.purchase_price * order_details.amount) AS sum
  FROM
    orders
  INNER JOIN
    order_details
  ON
    orders.order_id = order_details.order_id
  WHERE
    orders.order_id = ?
  GROUP BY
    order_id
  ";

  $params = array($order_id);

  return fetch_query($db, $sql, $params);
}
