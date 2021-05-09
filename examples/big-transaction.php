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

use VV\Db\Param;

$db = \App\Db\MainDb::instance();

$userId = 1;
$cart = [
    // productId => quentity
    10 => 1,
    20 => 2,
    40 => 3,
];


$productIter = $db->tbl->product->select('product_id', 'price')
    ->whereIdIn(...array_keys($cart))
    ->result(\VV\Db::FETCH_NUM);

$txn = $db->startTransaction();
try {
    $orderId = $db->tbl->order->insert()
        ->set(['user_id' => $userId])
        ->insertedId($txn);

    $totalAmount = 0;
    $productIterExtended = (function () use ($productIter, $cart, &$totalAmount) {
        foreach ($productIter as [$productId, $price]) {
            yield [$productId, $price, $quantity = $cart[$productId]];
            $totalAmount += $price * $quantity;
        }
    })();

    // variants:
    switch (2) {
        case 1:
            // don't care about performance
            foreach ($productIterExtended as [$productId, $price, $quantity]) {
                $db->tbl->orderItem->insert()
                    ->set([
                        'order_id' => $orderId,
                        'product_id' => $productId,
                        'price' => $price,
                        'quantity' => $quantity,
                    ])
                    ->exec($txn);
            }
            break;
        case 2:
            // multi values insert
            $insertItemQuery = $db->tbl->orderItem->insert()
                ->fields('order_id', 'product_id', 'price', 'quantity');

            foreach ($productIterExtended as [$productId, $price, $quantity]) {
                $insertItemQuery->values($orderId, $productId, $price, $quantity);
            }
            $insertItemQuery->exec($txn);
            break;
        case 3:
            // prepared query
            $prepared = $db->tbl->orderItem->insert()
                ->set([
                    'order_id' => Param::int($orderId),
                    'product_id' => $productIdParam = Param::chr(size: 16),
                    'price' => $priceParam = Param::chr(size: 16),
                    'quantity' => $quantityParam = Param::chr(size: 16),
                ]);

            foreach ($productIterExtended as [$productId, $price, $quantity]) {
                $productIdParam->setValue($productId);
                $priceParam->setValue($price);
                $quantityParam->setValue($quantity);

                $prepared->exec($txn);
            }
            break;
    }

    $db->tbl->order->update()
        ->set(['amount' => $totalAmount])
        ->whereId($orderId)
        // ->exec() // throws an exception that you are trying to execute statement outside of transaction started for current connection
        ->exec($txn);

    // you can execute important statement in transaction free connection
    $db->tbl->log->insert()
        ->set(['title' => "new order #$orderId"])
        ->setConnection($db->transactionFreeConnection()) // set new conenction for query
        ->exec();

    // throw new \RuntimeException('Test transactionFreeConnection()');

    $txn->commit();
} catch (\Throwable $e) {
    $txn->rollback();
    /** @noinspection PhpUnhandledExceptionInspection */
    throw $e;
}
