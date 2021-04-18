<?php declare(strict_types=1);

/** Created by VV Db Model Generator */
namespace App\Db\Main\Tables;

use VV\Db\Model\Field;

class OrderTable extends \App\Db\Main\Table {

    //region Auto-generated area
    protected const NAME = 'tbl_order';
    protected const PK = 'order_id';
    protected const PK_FIELDS = ['order_id'];
    protected const DFLT_ALIAS = 'o';
    protected const FIELDS = [
        'order_id' => [Field::T_NUM, null, 8, 17, 0, 'nextval(\'tbl_order_order_id_seq\'::regclass)', true, false],
        'state_id' => [Field::T_NUM, null, 2, 4, 0, null, false, false],
        'user_id' => [Field::T_NUM, null, 8, 17, 0, null, true, false],
        'amount' => [Field::T_NUM, null, 4, 9, 0, null, true, false],
        'comment' => [Field::T_CHR, 4000, null, 0, null, null, false, false],
    ];
    protected const FOREING_KEYS = [
        'fk_order__state_id' => [['state_id'], 'tbl_order_state', ['state_id']],
        'fk_order__user_id' => [['user_id'], 'tbl_user', ['user_id']],
    ];
    //endregion
}