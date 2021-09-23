<?php

/** Created by VV Db Model Generator */

declare(strict_types=1);

namespace App\Db\MainDb\Tables;

use VV\Db\Model\Column;
use App\Db\MainDb\Table;

class ColorTable extends Table
{
    //region Auto-generated area
    protected const NAME = 'tbl_color';
    protected const PK = 'color_id';
    protected const PK_COLUMNS = ['color_id'];
    protected const DFLT_ALIAS = 'c';
    protected const COLUMNS = [
        'color_id' => [Column::T_INT, null, 4, 9, 0, 'nextval(\'tbl_color_color_id_seq\'::regclass)', true, false],
        'title' => [Column::T_CHR, 100, null, 0, null, null, true, false],
    ];
    protected const FOREIGN_KEYS = [
    ];
    //endregion
}
