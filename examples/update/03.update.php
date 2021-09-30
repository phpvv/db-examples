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

$db = MainDb::instance();

$query = $db->tbl->order->update()
    // ->set([
    //     'amount' => 1000,
    //     'state_id' => 1,
    // ])
    ->set('amount', rand(1_00, 10000_00) * 0.01)
    ->set('state_id', rand(1, 3))
    ->whereId(2);

echo $query->toString(), "\n";
var_dump($query->affectedRows());

//
$affectedRows = $db->tbl->order->update(
    [
        'amount' => rand(1_00, 10_000_00) * 0.01,
        'state_id' => rand(1, 3),
    ],
    3
    // ['order_id' => 3]
    // Sql::condition()->and('order_id')->eq(3)
);
var_dump($affectedRows);

//
$query = $db->tbl->order->update()
    ->set(
        'amount',
        $db->tbl->orderItem
            ->select('SUM(price * quantity)')
            ->where('order_id=o.order_id')
    )
    ->where('amount', null);

echo $query->toString(), "\n";
var_dump($query->affectedRows());
