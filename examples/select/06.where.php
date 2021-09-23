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

$query = $db->tbl->product->select(/*...*/)
    ->where(                                // WHERE
        Sql::condition()
            ->and('color_id')->eq(5)            // "color_id" = ?
            ->and('price')->lte(2000)           // AND "price" <= ?
            ->and('title')->isNotNull()         // AND "title" IS NOT NULL
            ->and('brand_id')->in(2, 3)         // AND "brand_id" IN (?, ?)
            ->and('width')->between(250, 350)   // AND "width" BETWEEN ? AND ?
            ->and('state=1')->custom()          // AND state=1 -- w/o quotes: custom query not changed
    );

echo $query->toString(), "\n";
print_r($query->rows);

$query = $db->tbl->product->select()
    ->where('color_id', 5)      // same: `->where('color_id =', 5)`
    ->where('price <=', 2000)   // supported operators: = | != | <> | < | > | <= | >=
    ->where('title !=', null);

echo $query->toString(), "\n";
print_r($query->rows);


$query = $db->tbl->product->select()
    ->where('`width` BETWEEN ? AND ?', [250, 350])  // custom sql with binding parameters
    ->where('state=1');                             // custom sql w/o binding parameters

echo $query->toString(), "\n";
print_r($query->rows);


$query = $db->tbl->product->select()
    ->where([
        'color_id' => 5,
        'price <=' => 2000,
        'title !=' => null,
        Sql::condition('brand_id')->eq(2)->or->eq(3),   // AND ("brand_id" = ? OR "brand_id" = ?)
        '`width` BETWEEN ? AND ?' => [250, 350],
        'state=1',
    ]);

echo $query->toString(), "\n";
print_r($query->rows);
