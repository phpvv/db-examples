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
$connection = $db->getConnection(); // or $db->getFreeConnection();
// $connection = new \VV\Db\Connection(...);

// from Connection directly:
$updateQuery = $connection->update()->table('tbl_order');
// SET and WHERE clauses are obligatory to stringify UPDATE query
echo $updateQuery->set('amount', 1000)->where('1=1')->toString(), "\n";

// from Db:
$updateQuery = $db->update()->table('tbl_order');
echo $updateQuery->set('amount', 1000)->where('1=1')->toString(), "\n";

// from Table (recommended):
$updateQuery = $db->tbl->order->update();
// $updateQuery = $connection->update()->table($db->tbl->order);
echo $updateQuery->set('amount', 1000)->whereId(1)->toString(), "\n";
