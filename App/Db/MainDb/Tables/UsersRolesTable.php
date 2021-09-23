<?php

/** Created by VV Db Model Generator */

declare(strict_types=1);

namespace App\Db\MainDb\Tables;

use VV\Db\Model\Column;
use App\Db\MainDb\Table;

class UsersRolesTable extends Table
{
    //region Auto-generated area
    protected const NAME = 'tbl_users_roles';
    protected const PK = 'users_roles_id';
    protected const PK_COLUMNS = ['users_roles_id'];
    protected const DFLT_ALIAS = 'ur';
    protected const COLUMNS = [
        'users_roles_id' => [Column::T_INT, null, 4, 9, 0, 'nextval(\'tbl_users_roles_users_roles_id_seq\'::regclass)', true, false],
        'user_id' => [Column::T_INT, null, 8, 17, 0, null, true, false],
        'role_id' => [Column::T_INT, null, 4, 9, 0, null, true, false],
        'options' => [Column::T_INT, null, 8, 17, 0, '0', true, false],
    ];
    protected const FOREIGN_KEYS = [
        'fk_users_roles__user_id' => [['user_id'], 'tbl_user', ['user_id']],
        'fk_users_roles__role_id' => [['role_id'], 'tbl_user_role', ['role_id']],
    ];
    //endregion
}
