<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'orders.php';
require_once MODEL_PATH . 'order_details.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

iframe_defence();

$token = get_onetime_token();

$db = get_db_connect();
$user = get_login_user($db);

$orders = get_orders($db,$user);

include_once VIEW_PATH . 'orders_view.php';