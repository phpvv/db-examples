<?php declare(strict_types=1);

/** Created by VV Db Model Generator */
namespace App\Db\Main\Tables;

use VV\Db\Model\Field;

class ProductCategoryTable extends \App\Db\Main\Table {

    //region Auto-generated area
    protected const NAME = 'tbl_product_category';
    protected const PK = 'category_id';
    protected const PK_FIELDS = ['category_id'];
    protected const DFLT_ALIAS = 'pc';
    protected const FIELDS = [
        'category_id' => [Field::T_NUM, null, 4, 9, 0, 'nextval(\'tbl_product_category_category_id_seq\'::regclass)', true, false],
        'parent_id' => [Field::T_NUM, null, 4, 9, 0, null, false, false],
        'title' => [Field::T_CHR, 200, null, 0, null, null, true, false],
        'state' => [Field::T_NUM, null, 2, 4, 0, '1', true, false],
    ];
    protected const FOREING_KEYS = [
        'fk_product_category__parent_id' => [['parent_id'], 'tbl_product_category', ['category_id']],
    ];
    //endregion
}