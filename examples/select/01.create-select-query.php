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

$columns = ['product_id', 'brand_id', 'title', 'price'];

// from `Connection` directly:
$selectQuery = $connection->select(...$columns)->from('tbl_product');
echo $selectQuery->toString(), "\n";

// from `Db`:
$selectQuery = $db->select(...$columns)->from('tbl_product');
echo $selectQuery->toString(), "\n";

// from `Table` (recommended):
$selectQuery = $db->tbl->product->select(...$columns);
echo $selectQuery->toString(), "\n";
print_r($selectQuery->rows);
