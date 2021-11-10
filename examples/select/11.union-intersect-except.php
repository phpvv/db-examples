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

$query = $db->select()
    ->unionAll(
        $db->tbl->product->select('product_id', 'title')->orderBy('product_id')->limit(2),
        $db->tbl->product->select('product_id', 'title')->orderBy('-product_id')->limit(2),
    )
    ->except(
        $db->tbl->product->select('product_id', 'title')->orderBy('product_id')->limit(5, 1),
    )
    ->orderBy('product_id');

echo $query->toString(), "\n\n";
print_r($query->rows);
