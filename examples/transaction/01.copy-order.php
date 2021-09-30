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
$valuesList = $db->tbl->product->select('product_id', 'price')
    ->rows(Db::FETCH_NUM, decorator: function (&$row) use ($orderId) {
        $row = [$orderId, $row[0], $row[1], rand(1, 5)];
    });

$query = $db->tbl->orderItem->insert()->columns('order_id', 'product_id', 'price', 'quantity');
foreach ($valuesList as $values) {
    $query->values(...$values);
}
$query->exec();


// copy order
$transaction = $db->startTransaction();
try {
    $newOrderId = $db->tbl->order->insert()
        ->set([
            'user_id' => $userId,
            'date_created' => new \DateTime(),
        ])
        ->insertedId($transaction);

    echo "new Order ID: $newOrderId\n";

    $affectedRows = $db->tbl->orderItem->insert()
        ->columns('order_id', 'product_id', 'price', 'quantity')
        ->values(
            $db->tbl->orderItem
                ->select((string)$newOrderId, 'product_id', 'price', 'quantity')
                ->where('order_id', $orderId)
        )
        ->affectedRows($transaction);

    echo "copied Order items: $affectedRows\n";

    $db->tbl->order->update()
        ->set(
            'amount',
            $db->tbl->orderItem->select('SUM(price * quantity)')->where('order_id=o.order_id')
        )
        ->whereId($newOrderId)
        ->exec($transaction);

    // you can execute important statement in transaction free connection
    $db->tbl->log->insert()
        ->set(['title' => "new order copy #$newOrderId"])
        ->exec($db->getFreeConnection());

    // throw new \RuntimeException('Test transactionFreeConnection()');

    $transaction->commit();
} catch (\Throwable $e) {
    $transaction->rollback();
    /** @noinspection PhpUnhandledExceptionInspection */
    throw $e;
}
