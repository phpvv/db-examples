<?php

/*
 * This file is part of the VV package.
 *
 * (c) Volodymyr Sarnytskyi <v00v4n@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace examples;

require __DIR__ . '/../../bootstrap.php';

use App\Db\MainDb;

use VV\Db;

use function VV\mapIterable;

$db = MainDb::instance();

$userId = 1;
$orderId = $db->tbl->order->insert([
    'user_id' => $userId,
    'comment' => 'my comment',
]);

// Insert values list:
$products = $db->tbl->product->select('product_id', 'price')->result(Db::FETCH_NUM);
$valuesList = mapIterable(
    $products,
    fn ($row) => [$orderId, $row[0], $row[1], rand(1, 5)],
);

$query = $db->tbl->orderItem->insert()->columns('order_id', 'product_id', 'price', 'quantity');
foreach ($valuesList as $values) {
    $query->values(...$values);
}

echo $query->toString(), "\n";
$affectedRows = $query->affectedRows();
echo "affectedRows: $affectedRows\n\n";
//


// Insert from Select:
// copy order
$newOrderId = $db->tbl->order->insert([
    'user_id' => $userId,
    'date_created' => new \DateTime(),
]);

$query = $db->tbl->orderItem->insert()
    ->columns('order_id', 'product_id', 'price', 'quantity')
    ->values(
        $db->tbl->orderItem
            ->select((string)$newOrderId, 'product_id', 'price', 'quantity')
            ->where('order_id', $orderId)
    );

echo $query->toString(), "\n";
$affectedRows = $query->affectedRows();
echo "affectedRows: $affectedRows\n\n";
//


// Insert values list executing statement per N rows:
$query = $db->tbl->orderItem->insert()
    ->columns('order_id', 'product_id', 'price', 'quantity')
    ->execPer(2);
foreach ($valuesList as $values) {
    $query->values(...$values);
}
$query->execPerFinish(); // exec last
//
