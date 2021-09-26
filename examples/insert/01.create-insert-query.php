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
$insertQuery = $connection->insert()->into('tbl_order');
echo $insertQuery->toString(), "\n";

// from Db:
$insertQuery = $db->insert()->into('tbl_order');
echo $insertQuery->toString(), "\n";

// from Table (recommended):
$insertQuery = $db->tbl->order->insert();
// $insertQuery = $connection->insert()->from($db->tbl->order);
echo $insertQuery->toString(), "\n";
