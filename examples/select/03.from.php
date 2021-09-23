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

$query = $db->tbl->product->select(/*...*/);
echo $query->toString(), "\n";
// or
$query = $db->select(/*...*/)->from($db->tbl->product); // same as above
echo $query->toString(), "\n";
// or
$query = $db->select(/*...*/)->from('tbl_product'); // not same as above regarding JOIN clause
echo $query->toString(), "\n";

// set alias
$query = $db->tbl->product->select(/*...*/)->mainTableAs('prod');
echo $query->toString(), "\n";

print_r($query->rows);
