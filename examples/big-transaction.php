<?php declare(strict_types=1);

/*
 * This file is part of the phpvv package.
 *
 * (c) Volodymyr Sarnytskyi <v00v4n@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace examples;

require __DIR__ . '/../bootstrap.php';

use App\Db\MainDb;
use VV\Db\Param;

$db = MainDb::instance();

$userId = 1;
$cart = [
    // productId => quantity
    10 => rand(1, 2),
    20 => rand(1, 3),
    40 => rand(1, 5),
];


$productIterator = $db->tbl->product->select('product_id', 'price')
    ->whereIdIn(...array_keys($cart))
    ->result(\VV\Db::FETCH_NUM);

$transaction = $db->startTransaction();
try {
    $orderId = $db->tbl->order->insert()
        ->set([
            'user_id' => $userId,
            'date_created' => new \DateTime(),
        ])
        ->insertedId($transaction);

    // variants:
    switch (3) {
        case 1:
            // build and execute queries for each item
            foreach ($productIterator as [$productId, $price]) {
                $db->tbl->orderItem->insert()
                    ->set([
                        'order_id' => $orderId,
                        'product_id' => $productId,
                        'price' => $price,
                        'quantity' => $cart[$productId],
                    ])
                    ->exec($transaction);
            }
            break;
        case 2:
            // build and execute one query for all items
            $insertItemQuery = $db->tbl->orderItem->insert()
                ->columns('order_id', 'product_id', 'price', 'quantity');

            foreach ($productIterator as [$productId, $price]) {
                $insertItemQuery->values($orderId, $productId, $price, $cart[$productId]);
            }
            $insertItemQuery->exec($transaction);
            break;
        case 3:
            // prepare query and execute it for each item
            $prepared = $db->tbl->orderItem->insert()
                ->set([
                    'order_id' => Param::int($orderId),
                    'product_id' => $productIdParam = Param::str(size: 16),
                    'price' => $priceParam = Param::str(size: 16),
                    'quantity' => $quantityParam = Param::str(size: 16),
                ]);

            foreach ($productIterator as [$productId, $price]) {
                $productIdParam->setValue($productId);
                $priceParam->setValue($price);
                $quantityParam->setValue($cart[$productId]);

                $prepared->exec($transaction);
            }
            break;
    }

    $db->tbl->order->update()
        ->set(
            'amount',
            $db->tbl->orderItem->select('SUM(price * quantity)')->where('order_id=o.order_id')
        )
        ->whereId($orderId)
        // ->exec() // throws an exception that you are trying to execute statement
                    // outside of transaction started for current connection
        ->exec($transaction);

    // you can execute important statement in transaction free connection
    $db->tbl->log->insert()
        ->set(['title' => "new order #$orderId"])
        ->exec($db->getFreeConnection());

    // throw new \RuntimeException('Test transactionFreeConnection()');

    $transaction->commit();
} catch (\Throwable $e) {
    $transaction->rollback();
    /** @noinspection PhpUnhandledExceptionInspection */
    throw $e;
}
