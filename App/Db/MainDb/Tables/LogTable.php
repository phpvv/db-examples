<?php

/** Created by VV Db Model Generator */

declare(strict_types=1);

namespace App\Db\MainDb\Tables;

use VV\Db\Model\Column;
use App\Db\MainDb\Table;

class LogTable extends Table
{
    //region Auto-generated area
    protected const NAME = 'tbl_log';
    protected const PK = 'log_id';
    protected const PK_COLUMNS = ['log_id'];
    protected const DFLT_ALIAS = 'l';
    protected const COLUMNS = [
        'log_id' => [Column::T_INT, null, 8, 17, 0, 'nextval(\'tbl_log_log_id_seq\'::regclass)', true, false],
        'title' => [Column::T_CHR, 200, null, 0, null, null, true, false],
        'description' => [Column::T_TEXT, null, null, 0, null, null, false, false],
        'date_created' => [Column::T_DATETIME, null, null, 0, null, 'CURRENT_TIMESTAMP', true, false],
    ];
    protected const FOREIGN_KEYS = [
    ];
    //endregion
}
