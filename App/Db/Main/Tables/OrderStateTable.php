<?php declare(strict_types=1);

/** Created by VV Db Model Generator */
namespace App\Db\Main\Tables;

use VV\Db\Model\Field;

class OrderStateTable extends \App\Db\Main\Table {

    //region Auto-generated area
    protected const NAME = 'tbl_order_state';
    protected const PK = 'state_id';
    protected const PK_FIELDS = ['state_id'];
    protected const DFLT_ALIAS = 'os';
    protected const FIELDS = [
        'state_id' => [Field::T_NUM, null, 2, 4, 0, null, true, false],
        'title' => [Field::T_CHR, 100, null, 0, null, null, true, false],
    ];
    protected const FOREING_KEYS = [
    ];
    //endregion
}