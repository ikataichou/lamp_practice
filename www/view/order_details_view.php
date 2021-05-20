<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>カート</title>
  <link rel="stylesheet" href="<?php print h(STYLESHEET_PATH . 'order_details.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>購入詳細</h1>
    <div class="container">

      <?php include VIEW_PATH . 'templates/messages.php'; ?>

      <p>注文番号：<?php print h($orders['order_id']); ?></p>
      <p>購入日時：<?php print h($orders['created']); ?></p>
      <p>合計金額：<?php print h(number_format($orders['sum'])); ?>円</p>

      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>商品名</th>
            <th>購入時価格</th>
            <th>購入数</th>
            <th>小計</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($order_details as $order_detail){ ?>
          <tr>
            <td><?php print h($order_detail['name']); ?></td>
            <td><?php print h($order_detail['price']); ?></td>
            <td><?php print h($order_detail['amount']); ?></td>
            <td><?php print h(number_format($order_detail['price'] * $order_detail['amount'])); ?>円</td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

    </div>
</body>
</html>
