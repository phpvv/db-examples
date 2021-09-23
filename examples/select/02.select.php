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
use VV\Db\Sql;

$db = MainDb::instance();

$query = $db->tbl->product->select()
    ->columns('product_id', 'brand_id')
    ->addColumns('title', 'price');

echo $query->toString(), "\n";
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

echo $query->toString($params), "\n";
print_r($params);
unset($params);
print_r($query->rows);
