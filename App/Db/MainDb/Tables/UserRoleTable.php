<?php

/** Created by VV Db Model Generator */

declare(strict_types=1);

namespace App\Db\MainDb\Tables;

use VV\Db\Model\Field;
use App\Db\MainDb\Table;

class UserRoleTable extends Table
{
    //region Auto-generated area
    protected const NAME = 'tbl_user_role';
    protected const PK = 'role_id';
    protected const PK_FIELDS = ['role_id'];
    protected const DFLT_ALIAS = 'ur';
    protected const FIELDS = [
        'role_id' => [Field::T_INT, null, 2, 4, 0, null, true, false],
        'title' => [Field::T_CHR, 100, null, 0, null, null, false, false],
        'description' => [Field::T_CHR, 4000, null, 0, null, null, false, false],
    ];
    protected const FOREIGN_KEYS = [
    ];
    //endregion
}
