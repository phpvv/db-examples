<?php declare(strict_types=1);

/*
 * This file is part of the phpvv package.
 *
 * (c) Volodymyr Sarnytskyi <v00v4n@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Db;

use APP\DB\MAIN as CONF;
use VV\Db\Connection;
use VV\Db\Pdo\Driver;

/**
 * @method MainDb\TableList tables()
 * @method MainDb\ViewList views()
 * @property-read MainDb\TableList $tbl
 * @property-read MainDb\TableList $vw
 */
class MainDb extends \VV\Db {

    public function createConnection(): Connection {
        $driver = new Driver(Driver::DBMS_POSTGRES);

        return new Connection($driver, CONF\HOST, CONF\USER, CONF\PASSWD, CONF\DBNAME);
    }
}
