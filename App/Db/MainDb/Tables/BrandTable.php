<?php

/** Created by VV Db Model Generator */

declare(strict_types=1);

namespace App\Db\MainDb\Tables;

use VV\Db\Model\Column;
use App\Db\MainDb\Table;

class BrandTable extends Table
{
    //region Auto-generated area
    protected const NAME = 'tbl_brand';
    protected const PK = 'brand_id';
    protected const PK_COLUMNS = ['brand_id'];
    protected const DFLT_ALIAS = 'b';
    protected const COLUMNS = [
        'brand_id' => [Column::T_INT, null, 4, 9, 0, 'nextval(\'tbl_brand_brand_id_seq\'::regclass)', true, false],
        'title' => [Column::T_CHR, 100, null, 0, null, null, true, false],
    ];
    protected const FOREIGN_KEYS = [
    ];
    //endregion
}
