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

use App\DB\MAIN as CNF;
use VV\Db\Pdo\Driver;

/**
 * @method Main\TableList tables()
 * @method Main\ViewList views()
 * @property-read Main\TableList $tbl
 * @property-read Main\TableList $vw
 */
class Main extends \VV\Db {

    public function createConnection(): \VV\Db\Connection {
        $driver = new Driver(Driver::DBMS_POSTGRES);

        return new \VV\Db\Connection($driver, CNF\HOST, CNF\USER, CNF\PASSWD, CNF\DBNAME);
    }
}
