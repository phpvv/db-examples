<?php declare(strict_types=1);

/** Created by VV Db Model Generator */
namespace App\Db\Main\Table;

use VV\Db\Model\Field;

class UsersRoles extends \App\Db\Main\Table {

    protected const NAME = 'tbl_users_roles';

    protected const PK = 'users_roles_id';

    protected const PK_FIELDS = ['users_roles_id'];

    protected const DFLT_ALIAS = 'ur';

    protected $fields = [
        'users_roles_id' => [Field::T_NUM, null, 4, 9, 0, 'nextval(\'tbl_users_roles_users_roles_id_seq\'::regclass)', true, false],
        'user_id' => [Field::T_NUM, null, 8, 17, 0, null, true, false],
        'role_id' => [Field::T_NUM, null, 4, 9, 0, null, true, false],
        'options' => [Field::T_NUM, null, 8, 17, 0, '0', true, false],
    ];

    protected $foreignKeys = [
        'fk_users_roles__user_id' => [['user_id'], 'tbl_user', ['user_id']],
        'fk_users_roles__role_id' => [['role_id'], 'tbl_user_role', ['role_id']],
    ];
}