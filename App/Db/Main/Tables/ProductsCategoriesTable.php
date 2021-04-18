<?php declare(strict_types=1);

/** Created by VV Db Model Generator */
namespace App\Db\Main\Tables;

use VV\Db\Model\Field;

class ProductsCategoriesTable extends \App\Db\Main\Table {

    //region Auto-generated area
    protected const NAME = 'tbl_products_categories';
    protected const PK = 'products_categories_id';
    protected const PK_FIELDS = ['products_categories_id'];
    protected const DFLT_ALIAS = 'pc';
    protected const FIELDS = [
        'products_categories_id' => [Field::T_NUM, null, 8, 17, 0, 'nextval(\'tbl_products_categories_products_categories_id_seq\'::regclass)', true, false],
        'product_id' => [Field::T_NUM, null, 8, 17, 0, null, false, false],
        'category_id' => [Field::T_NUM, null, 4, 9, 0, null, true, false],
        'state' => [Field::T_NUM, null, 2, 4, 0, '1', true, false],
    ];
    protected const FOREING_KEYS = [
        'fk_products_categories__product_id' => [['product_id'], 'tbl_product', ['product_id']],
        'fk_products_categories__category_id' => [['category_id'], 'tbl_product_category', ['category_id']],
    ];
    //endregion
}