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

$query = $db->tbl->order->insert()->set('user_id', 1);
echo $query->toString(), "\n";

$query->exec();

//
$result = $query->initInsertedId()->exec();
$id = $result->insertedId;
$affectedRows = $result->affectedRows;

echo "id: $id\naffectedRows: $affectedRows\n\n";

//
$id = $query->insertedId();             // executes Insert
$affectedRows = $query->affectedRows(); // executes Insert too

echo "id: $id\naffectedRows: $affectedRows\n\n";
