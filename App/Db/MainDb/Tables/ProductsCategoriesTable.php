<?php

/** Created by VV Db Model Generator */

declare(strict_types=1);

namespace App\Db\MainDb\Tables;

use VV\Db\Model\Column;
use App\Db\MainDb\Table;

class ProductsCategoriesTable extends Table
{
    //region Auto-generated area
    protected const NAME = 'tbl_products_categories';
    protected const PK = 'products_categories_id';
    protected const PK_COLUMNS = ['products_categories_id'];
    protected const DFLT_ALIAS = 'pc';
    protected const COLUMNS = [
        'products_categories_id' => [Column::T_INT, null, 8, 17, 0, 'nextval(\'tbl_products_categories_products_categories_id_seq\'::regclass)', true, false],
        'product_id' => [Column::T_INT, null, 8, 17, 0, null, false, false],
        'category_id' => [Column::T_INT, null, 4, 9, 0, null, true, false],
        'state' => [Column::T_INT, null, 2, 4, 0, '1', true, false],
    ];
    protected const FOREIGN_KEYS = [
        'fk_products_categories__product_id' => [['product_id'], 'tbl_product', ['product_id']],
        'fk_products_categories__category_id' => [['category_id'], 'tbl_product_category', ['category_id']],
    ];
    //endregion
}
