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


//region FROM
$query = $db->tbl->product->select(/*...*/);
// or
$query = $db->select(/*...*/)->from($db->tbl->product); // same as above
// or
$query = $db->select(/*...*/)->from('tbl_product'); // not same as above regarding JOIN clause


$query = $db->tbl->product->select(/*...*/)->mainTableAs('prod');
//endregion

//region JOIN
$query = $db->tbl->orderItem->select(/*...*/)  // SELECT ... FROM "tbl_order_item" "oi"
    ->join($db->tbl->order)                    // JOIN "tbl_order" "o" ON "o"."order_id" = "oi"."order_id"
    ->left($db->tbl->orderState)               // LEFT JOIN "tbl_order_state" "os" ON "os"."state_id" = "o"."state_id"
    ->join($db->tbl->product, 'oi')            // JOIN "tbl_product" "p" ON "p"."product_id" = "oi"."product_id"
    ->where('o.state_id', 1);                  // WHERE "o"."state_id" = ?

////
$query = $db->tbl->orderItem->select(/*...*/)
    ->join(
        $db->tbl->order,
        'order.order_id=oi.order_id', // string
        'order'
    )
    ->left(
        $db->tbl->orderState,
        Sql::condition()              // Condition object
            ->and('os.state_id')->eq(Sql::expression('o.state_id'))
            ->and('os.state_id')->eq(1)
    );
////

$query = $db->tbl->orderItem->select(/*...*/)
    ->join($db->tbl->order)
    ->join($db->tbl->product, 'oi'); // join to tbl_order_item (not tbl_order) by product_id field

$query = $db->tbl->orderItem->select(/*...*/)
    ->join($db->tbl->order, '.foo_id'); // "o"."order_id" = "oi"."foo_id"


$query = $db->tbl->productCategory->select(/*...*/)
    ->joinParent('pc2'); // JOIN "tbl_product_category" "pc2" ON ("pc2"."category_id" = "pc"."parent_id")
//endregion

//region NESTED COLUMNS
$query = $db->tbl->product->select('product_id', 'price', 'weight')
    ->addNestedColumns('brand', 'b.brand_id', 'b.title') // first argument is nesting path: string|string[]
    ->addNestedColumns(['nested', 'color'], 'c.color_id', 'c.title')
    ->addNestedColumns(['nested', 'size'], 'width', 'height', 'depth')
    ->join($db->tbl->brand)
    ->join($db->tbl->color, 'p');

print_r($query->row);

////
$query = $db->tbl->orderItem->select('item_id', 'price', 'quantity')
    ->joinNestedColumns(
        $db->tbl->order->select('order_id', 'amount', 'comment'), // sub query
        'oi.order_id',                                            // ON condition (see above)
        ['my', 'nested', 'order']                                // nesting path
    )
    ->joinNestedColumns(
        $db->tbl->product->select('product_id', 'title')          // sub query
        ->joinNestedColumns(
            $db->tbl->brand->select('brand_id', 'title'),     // sub sub query
            'p.brand_id'
        )
            ->joinNestedColumns($db->tbl->color, 'p', 'color'),   // just join table - select all its columns
        'oi.product_id',
        'product'
    );

print_r($query->row);
//endregion
