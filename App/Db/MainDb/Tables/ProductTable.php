<?php

/** Created by VV Db Model Generator */

declare(strict_types=1);

namespace App\Db\MainDb\Tables;

use VV\Db\Model\Column;
use App\Db\MainDb\Table;

class ProductTable extends Table
{
    //region Auto-generated area
    protected const NAME = 'tbl_product';
    protected const PK = 'product_id';
    protected const PK_COLUMNS = ['product_id'];
    protected const DFLT_ALIAS = 'p';
    protected const COLUMNS = [
        'product_id' => [Column::T_INT, null, 8, 17, 0, 'nextval(\'tbl_product_product_id_seq\'::regclass)', true, false],
        'brand_id' => [Column::T_INT, null, 4, 9, 0, null, false, false],
        'title' => [Column::T_CHR, 200, null, 0, null, null, true, false],
        'description' => [Column::T_TEXT, null, null, 0, null, null, false, false],
        'price' => [Column::T_NUM, null, null, 11, 2, null, true, false],
        'weight' => [Column::T_INT, null, 4, 9, 0, null, false, false],
        'width' => [Column::T_NUM, null, null, 7, 1, null, false, false],
        'height' => [Column::T_NUM, null, null, 7, 1, null, false, false],
        'depth' => [Column::T_NUM, null, null, 7, 1, null, false, false],
        'color_id' => [Column::T_INT, null, 4, 9, 0, null, false, false],
        'state' => [Column::T_INT, null, 2, 4, 0, '1', true, false],
    ];
    protected const FOREIGN_KEYS = [
        'fk_product__brand_id' => [['brand_id'], 'tbl_brand', ['brand_id']],
        'fk_product__color_id' => [['color_id'], 'tbl_color', ['color_id']],
    ];
    //endregion
}
