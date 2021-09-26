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

$query = $db->tbl->order->insert()
    ->columns('user_id', 'comment')
    ->values(1, 'my comment');

echo $query->toString(), "\n";
var_dump($query->insertedId());

$query = $db->tbl->order->insert()
    // ->set([
    //     'user_id' => 1,
    //     'comment' => 'my comment',
    // ])
    ->set('user_id', 1)
    ->set('comment', 'my comment');

echo $query->toString(), "\n";
var_dump($query->insertedId());

$orderId = $db->tbl->order->insert([
    'user_id' => 1,
    'comment' => 'my comment',
]);
var_dump($orderId);
