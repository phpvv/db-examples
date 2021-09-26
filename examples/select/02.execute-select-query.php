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
use VV\Db;

$db = MainDb::instance();

// Fetch single row or column:
$query = $db->tbl->product->select('product_id', 'title')->whereId(10);

echo "\n# ->result->row: ";
print_r($query->result->row/*($flags)*/);

echo "\n# ->result->column:\n";
echo $query->result->column/*($columnIndex[, $flags])*/;
echo "\n";
//


// Fetch all rows:
$query = $db->tbl->product->select('product_id', 'title', 'b.title brand')->join($db->tbl->brand)->limit(3);

echo "\n# while(->result()->fetch()): \n";
$result = $query->result();
while (['product_id' => $productId, 'title' => $title] = $result->fetch()) {
    echo "$productId: $title\n";
}

echo "\n# foreach(->result()): \n";
foreach ($query->result(Db::FETCH_NUM) as [$productId, $title, $brand]) {
    echo "$productId: $brand $title\n";
}

echo "\n# ->result->rows: ";
print_r($query->result()->rows/*($flags)*/);

echo "\n# ->result->assoc: ";
print_r($query->result()->assoc(keyColumn: 'product_id', valueColumn: 'title'));
//


// Fetch result directly from query:
$query = $db->tbl->product->select('product_id', 'title', 'brand_id')->limit(3);

echo "\n# ->rows: ";
print_r($query->rows);

echo "\n# ->rows(FETCH_NUM): ";
print_r($query->rows(Db::FETCH_NUM));

echo "\n# ->rows(decorator: fn): ";
print_r($query->rows(decorator: function (&$row, &$key) {
    $key = $row['product_id'] . '-' . $row['brand_id'];
    $row = array_values($row);
}));

echo "\n# ->rows(key => value): ";
print_r($query->rows(keyColumn: 'product_id', decorator: 'title'));

echo "\n# ->assoc: ";
print_r($query->assoc);

echo "\n# ->row: ";
print_r($query->row);

echo "\n# ->row(FETCH_BOTH): ";
print_r($query->row(Db::FETCH_NUM | Db::FETCH_ASSOC));

echo "\n# ->column:\n", $query->column, "\n";
echo "\n# ->column(1):\n", $query->column(1), "\n";
//
