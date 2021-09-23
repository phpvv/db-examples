<?php

/** Created by VV Db Model Generator */

declare(strict_types=1);

namespace App\Db\MainDb\Tables;

use VV\Db\Model\Column;
use App\Db\MainDb\Table;

class OrderTable extends Table
{
    //region Auto-generated area
    protected const NAME = 'tbl_order';
    protected const PK = 'order_id';
    protected const PK_COLUMNS = ['order_id'];
    protected const DFLT_ALIAS = 'o';
    protected const COLUMNS = [
        'order_id' => [Column::T_INT, null, 8, 17, 0, 'nextval(\'tbl_order_order_id_seq\'::regclass)', true, false],
        'state_id' => [Column::T_INT, null, 2, 4, 0, null, false, false],
        'user_id' => [Column::T_INT, null, 8, 17, 0, null, true, false],
        'amount' => [Column::T_NUM, null, null, 11, 2, null, false, false],
        'comment' => [Column::T_CHR, 4000, null, 0, null, null, false, false],
        'date_created' => [Column::T_DATETIME_TZ, null, null, 0, null, 'CURRENT_TIMESTAMP', true, false],
    ];
    protected const FOREIGN_KEYS = [
        'fk_order__state_id' => [['state_id'], 'tbl_order_state', ['state_id']],
        'fk_order__user_id' => [['user_id'], 'tbl_user', ['user_id']],
    ];
    //endregion
}
