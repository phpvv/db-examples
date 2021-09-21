<?php

/** Created by VV Db Model Generator */

declare(strict_types=1);

namespace App\Db\MainDb\Tables;

use VV\Db\Model\Field;
use App\Db\MainDb\Table;

class ProductCategoryTable extends Table
{
    //region Auto-generated area
    protected const NAME = 'tbl_product_category';
    protected const PK = 'category_id';
    protected const PK_FIELDS = ['category_id'];
    protected const DFLT_ALIAS = 'pc';
    protected const FIELDS = [
        'category_id' => [Field::T_INT, null, 4, 9, 0, 'nextval(\'tbl_product_category_category_id_seq\'::regclass)', true, false],
        'parent_id' => [Field::T_INT, null, 4, 9, 0, null, false, false],
        'title' => [Field::T_CHR, 200, null, 0, null, null, true, false],
        'state' => [Field::T_INT, null, 2, 4, 0, '1', true, false],
    ];
    protected const FOREIGN_KEYS = [
        'fk_product_category__parent_id' => [['parent_id'], 'tbl_product_category', ['category_id']],
    ];
    //endregion
}
