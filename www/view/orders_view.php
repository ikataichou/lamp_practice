<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>カート</title>
  <link rel="stylesheet" href="<?php print h(STYLESHEET_PATH . 'orders.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>購入履歴</h1>
    <div class="container">

        <?php include VIEW_PATH . 'templates/messages.php'; ?>

      <?php if(count($orders) > 0){ ?>
        <table class="table table-bordered">
          <thead class="thead-light">
            <tr>
              <th>注文番号</th>
              <th>購入日時</th>
              <th>合計金額</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($orders as $order){ ?>
            <tr>
              <td><?php print h($order['order_id']); ?></td>
              <td><?php print h($order['created']); ?></td>
              <td><?php print h(number_format($order['sum'])); ?>円</td>
              <td>
                <form method="post" action="order_details.php">
                  <input type="submit" value="購入詳細閲覧" class="btn btn-block btn-primary">
                  <input type="hidden" name="order_id" value="<?php print h($order['order_id']); ?>">
                  <input type="hidden" name="token" value="<?php print h($token); ?>">
                </form>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else { ?>
        <p>購入履歴がありません。</p>
      <?php } ?>
    </div>
</body>
</html>