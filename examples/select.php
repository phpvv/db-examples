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

require __DIR__ . '/../bootstrap.php';

use App\Db\MainDb;
use VV\Db\Sql;

//region create SelectQuery
$db = MainDb::instance();
$connection = $db->getConnection(); // or $db->getFreeConnection();
// $connection = new \VV\Db\Connection(...);

$columns = ['product_id', 'b.title brand', 'title', 'price'];

// from Connection directly
$selectQuery = $connection->select(...$columns)->from('tbl_product');

// from Db
$selectQuery = $db->select(...$columns)->from('tbl_product');

// from Table
$selectQuery = $db->tbl->product->select(...$columns);
//endregion


//region create SelectQuery
$query = $db->tbl->product->select()
    ->columns('product_id', 'brand_id')
    ->addColumns('title', 'price');

print_r($query->rows);


$query = $db->tbl->product->select(
    'product_id',
    'title product',
    $db->tbl->brand
        ->select('title')
        ->where('b.brand_id = p.brand_id')
        ->as('brand'),
    'price',
    Sql::case()
        ->when(['price >= ' => 1000])->then(1)
        ->else(0)
        ->as('is_expensive'),
);

print_r($query->rows);
//endregion
