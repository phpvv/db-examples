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
$deleteQuery = $connection->delete()->from('tbl_order');
// WHERE clauses are obligatory to stringify DELETE query
echo $deleteQuery->where('1=1')->toString(), "\n";

// from Db:
$deleteQuery = $db->delete()->from('tbl_order');
echo $deleteQuery->where('1=1')->toString(), "\n";

// from Table (recommended):
$deleteQuery = $db->tbl->order->delete();
// $deleteQuery = $connection->delete()->from($db->tbl->order);
echo $deleteQuery->whereId(1)->toString(), "\n";
