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

$query = $db->tbl->product->select('b.title brand', 'COUNT(*) cnt')
    ->join($db->tbl->brand)
    ->groupBy('b.title')
    ->having('COUNT(*) > ', 1);

echo $query->toString(), "\n\n";
print_r($query->rows);
