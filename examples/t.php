<?php

/*
 * This file is part of the phpvv package.
 *
 * (c) Volodymyr Sarnytskyi <v00v4n@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace examples;

require __DIR__ . '/../bootstrap.php';

$db = \App\Db\MainDb::instance();

$query = $db->tbl->product->insert()
    ->set([
        'title' => 'Product ' . rand(1000, 9999),
        'tmpbool' => false,
        'tmparr = "{1, 2, 3}"' => [],
        'price' => rand(1000, 9999)
    ]);

echo $query->toString(), "\n";
$id = $query->insertedId();
var_dump($id);


$dt = (new \DateTime())->modify('-10 minute');
echo $dt->format('c'), "\n";

$query = $db->select()->from('tbl_order')->where('date_created >=', $dt);
echo $query->toString(), "\n";
$rows = $query->rows;
print_r($rows);
