<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'orders.php';
require_once MODEL_PATH . 'order_details.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

iframe_defence();

$db = get_db_connect();
$user = get_login_user($db);

$items = get_open_items($db);

$ranking_items = get_open_ranking($db);

$ranking_number = RANKING_START_NUMBER;

$token = get_onetime_token();

include_once VIEW_PATH . 'index_view.php';