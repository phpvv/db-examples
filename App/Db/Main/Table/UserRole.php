<?php declare(strict_types=1);

/** Created by VV Db Model Generator */
namespace App\Db\Main\Table;

use VV\Db\Model\Field;

class UserRole extends \App\Db\Main\Table {

    protected const NAME = 'tbl_user_role';

    protected const PK = 'role_id';

    protected const PK_FIELDS = ['role_id'];

    protected const DFLT_ALIAS = 'ur';

    protected $fields = [
        'role_id' => [Field::T_NUM, null, 2, 4, 0, null, true, false],
        'title' => [Field::T_CHR, 100, null, 0, null, null, false, false],
        'description' => [Field::T_CHR, 4000, null, 0, null, null, false, false],
    ];

    protected $foreignKeys = [
    ];
}