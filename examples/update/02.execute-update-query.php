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

$query = $db->tbl->order->update()->set('amount', rand(1_00, 10000_00) * 0.01)->whereId(1);
echo $query->toString(), "\n";

$result = $query->exec();

//
$affectedRows = $result->affectedRows;
echo "affectedRows: $affectedRows\n\n";

//
$affectedRows = $query->affectedRows(); // executes Update too
echo "affectedRows: $affectedRows\n\n";
