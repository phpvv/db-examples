<?php

/** Created by VV Db Model Generator */

declare(strict_types=1);

namespace App\Db\MainDb\Tables;

use VV\Db\Model\Column;
use App\Db\MainDb\Table;

class UserTable extends Table
{
    //region Auto-generated area
    protected const NAME = 'tbl_user';
    protected const PK = 'user_id';
    protected const PK_COLUMNS = ['user_id'];
    protected const DFLT_ALIAS = 'u';
    protected const COLUMNS = [
        'user_id' => [Column::T_INT, null, 8, 17, 0, 'nextval(\'tbl_user_user_id_seq\'::regclass)', true, false],
        'name' => [Column::T_CHR, 100, null, 0, null, null, true, false],
        'mobile' => [Column::T_CHR, 15, null, 0, null, null, false, false],
        'email' => [Column::T_CHR, 100, null, 0, null, null, false, false],
        'password' => [Column::T_CHR, 256, null, 0, null, null, false, false],
        'deleted' => [Column::T_INT, null, 2, 4, 0, '0', true, false],
        'date_created' => [Column::T_DATETIME, null, null, 0, null, 'CURRENT_TIMESTAMP', true, false],
    ];
    protected const FOREIGN_KEYS = [
    ];
    //endregion
}
