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

$db = \App\Db\MainDb::instance();

$query = $db->tbl->product->select('product_id', 'price', 'weight')
    ->addNestedColumns('brand', 'b.brand_id', 'b.title')
    ->addNestedColumns(['nested', 'color'], 'c.color_id', 'c.title')
    ->addNestedColumns(['nested', 'size'], 'width', 'height', 'depth')
    ->join($db->tbl->brand)
    ->join($db->tbl->color, 'p');

print_r($query->row);


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
