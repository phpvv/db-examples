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

$query = $db->tbl->product->select('b.title brand', 'p.title product', 'price')
    ->left($db->tbl->brand)
    ->orderBy(      // ORDER BY
        'b.title',  //     "b"."title" NULLS FIRST,
        '-price'    //     "price" DESC NULLS LAST
    );

echo $query->toString(), "\n\n";
print_r($query->rows);

$query = $db->tbl->product->select('p.title product', 'color_id')
    ->orderBy(                  // ORDER BY
        Sql::case('color_id')   //     CASE "color_id"
            ->when(5)->then(1)  //         WHEN 5 THEN 1
            ->when(1)->then(2)  //         WHEN 1 THEN 2
            ->else(100)         //         ELSE 100 END
    );

echo $query->toString(), "\n\n";
print_r($query->rows);
