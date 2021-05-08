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

use App\DB\MAIN as CONF;
use VV\Db\Connection;
use VV\Db\Pdo\Driver;

// $driver = new \VV\Db\Oci\Driver;
// $driver = new \VV\Db\Mysqli\Driver;
$driver = new Driver(Driver::DBMS_POSTGRES);

$connection = new Connection($driver, CONF\HOST, CONF\USER, CONF\PASSWD, CONF\DBNAME);
// $connection->connect(); // auto connect on first query is enabled by default

// all variants do same job:
$queryString = 'SELECT product_id, title FROM tbl_product WHERE price > :price';
$result = $connection->query($queryString, ['price' => 100]);
// or
$result = $connection->prepare($queryString)->bind(['price' => 100])->result();
// or
$result = $connection->select('product_id', 'title')->from('tbl_product')->where('price > ', 100)->result();

print_r($result->rows);
