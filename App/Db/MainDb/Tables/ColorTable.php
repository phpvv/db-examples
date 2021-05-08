<?php declare(strict_types=1);

/** Created by VV Db Model Generator */
namespace App\Db\MainDb\Tables;

use VV\Db\Model\Field;

class ColorTable extends \App\Db\MainDb\Table {

    //region Auto-generated area
    protected const NAME = 'tbl_color';
    protected const PK = 'color_id';
    protected const PK_FIELDS = ['color_id'];
    protected const DFLT_ALIAS = 'c';
    protected const FIELDS = [
        'color_id' => [Field::T_NUM, null, 4, 9, 0, 'nextval(\'tbl_color_color_id_seq\'::regclass)', true, false],
        'title' => [Field::T_CHR, 100, null, 0, null, null, true, false],
    ];
    protected const FOREING_KEYS = [
    ];
    //endregion
}
