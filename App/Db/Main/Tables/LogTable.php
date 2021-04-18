<?php declare(strict_types=1);

/** Created by VV Db Model Generator */
namespace App\Db\Main\Tables;

use VV\Db\Model\Field;

class LogTable extends \App\Db\Main\Table {

    //region Auto-generated area
    protected const NAME = 'tbl_log';
    protected const PK = 'log_id';
    protected const PK_FIELDS = ['log_id'];
    protected const DFLT_ALIAS = 'l';
    protected const FIELDS = [
        'log_id' => [Field::T_NUM, null, 8, 17, 0, 'nextval(\'tbl_log_log_id_seq\'::regclass)', true, false],
        'title' => [Field::T_CHR, 200, null, 0, null, null, true, false],
        'description' => [Field::T_TEXT, null, null, 0, null, null, false, false],
        'date_created' => [Field::T_DATETIME, null, null, 0, null, 'CURRENT_TIMESTAMP', true, false],
    ];
    protected const FOREING_KEYS = [
    ];
    //endregion
}