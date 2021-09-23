<?php

/** Created by VV Db Model Generator */

declare(strict_types=1);

namespace App\Db\MainDb\Tables;

use VV\Db\Model\Column;
use App\Db\MainDb\Table;

class OrderStateTable extends Table
{
    //region Auto-generated area
    protected const NAME = 'tbl_order_state';
    protected const PK = 'state_id';
    protected const PK_COLUMNS = ['state_id'];
    protected const DFLT_ALIAS = 'os';
    protected const COLUMNS = [
        'state_id' => [Column::T_INT, null, 2, 4, 0, null, true, false],
        'title' => [Column::T_CHR, 100, null, 0, null, null, true, false],
    ];
    protected const FOREIGN_KEYS = [
    ];
    //endregion
}
