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

$query = $db->tbl->orderItem->select(/*...*/)  // SELECT ... FROM "tbl_order_item" "oi"
    ->join($db->tbl->order)                    // JOIN "tbl_order" "o" ON "o"."order_id" = "oi"."order_id"
    ->left($db->tbl->orderState)               // LEFT JOIN "tbl_order_state" "os" ON "os"."state_id" = "o"."state_id"
    ->join($db->tbl->product, 'oi')            // JOIN "tbl_product" "p" ON "p"."product_id" = "oi"."product_id"
    ->where('o.state_id', 1);                  // WHERE "o"."state_id" = ?
echo $query->toString(), "\n\n";

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
echo $query->toString(), "\n\n";
////

$query = $db->tbl->orderItem->select(/*...*/)
    ->join($db->tbl->order)
    ->join($db->tbl->product, 'oi'); // join to tbl_order_item (not tbl_order) by product_id field
echo $query->toString(), "\n\n";

$query = $db->tbl->orderItem->select(/*...*/)
    ->join($db->tbl->order, '.foo_id'); // "o"."order_id" = "oi"."foo_id"
echo $query->toString(), "\n\n";

$query = $db->tbl->productCategory->select(/*...*/)
    ->joinParent('pc2'); // JOIN "tbl_product_category" "pc2" ON ("pc2"."category_id" = "pc"."parent_id")
echo $query->toString(), "\n\n";
