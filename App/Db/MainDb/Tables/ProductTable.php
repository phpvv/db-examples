<?php

/** Created by VV Db Model Generator */

declare(strict_types=1);

namespace App\Db\MainDb\Tables;

use VV\Db\Model\Field;
use App\Db\MainDb\Table;

class ProductTable extends Table
{
    //region Auto-generated area
    protected const NAME = 'tbl_product';
    protected const PK = 'product_id';
    protected const PK_FIELDS = ['product_id'];
    protected const DFLT_ALIAS = 'p';
    protected const FIELDS = [
        'product_id' => [Field::T_INT, null, 8, 17, 0, 'nextval(\'tbl_product_product_id_seq\'::regclass)', true, false],
        'brand_id' => [Field::T_INT, null, 4, 9, 0, null, false, false],
        'title' => [Field::T_CHR, 200, null, 0, null, null, true, false],
        'description' => [Field::T_TEXT, null, null, 0, null, null, false, false],
        'price' => [Field::T_NUM, null, null, 11, 2, null, true, false],
        'weight' => [Field::T_INT, null, 4, 9, 0, null, false, false],
        'width' => [Field::T_NUM, null, null, 7, 1, null, false, false],
        'height' => [Field::T_NUM, null, null, 7, 1, null, false, false],
        'depth' => [Field::T_NUM, null, null, 7, 1, null, false, false],
        'color_id' => [Field::T_INT, null, 4, 9, 0, null, false, false],
        'state' => [Field::T_INT, null, 2, 4, 0, '1', true, false],
        'tmpbool' => [Field::T_BOOL, null, null, 0, null, null, false, false],
        'tmparr' => [Field::T_CHR, null, null, 0, null, null, false, false],
    ];
    protected const FOREIGN_KEYS = [
        'fk_product__brand_id' => [['brand_id'], 'tbl_brand', ['brand_id']],
        'fk_product__color_id' => [['color_id'], 'tbl_color', ['color_id']],
    ];
    //endregion
}
