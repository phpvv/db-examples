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

use App\Db\MainDb;

$db = MainDb::instance();

$products = $db->tbl->product
    ->select('product_id', 'b.title brand', 'title', 'price')
    ->join($db->tbl->brand)
    ->where('brand_id', 1)
    ->where('price >', 100)
    ->rows;

print_r($products);
