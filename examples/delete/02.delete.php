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

$query = $db->tbl->orderItem->delete()
    ->where(
        'price > ',
        $db->tbl->orderItem
            ->select('AVG(price)')
            ->mainTableAs('oi2')
            ->where('oi2.order_id=oi.order_id')
    );

echo $query->toString(), "\n";
var_dump($query->affectedRows());
