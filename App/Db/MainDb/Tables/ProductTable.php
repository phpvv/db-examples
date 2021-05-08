<?php declare(strict_types=1);

/** Created by VV Db Model Generator */
namespace App\Db\MainDb\Tables;

use VV\Db\Model\Field;

class ProductTable extends \App\Db\MainDb\Table {

    //region Auto-generated area
    protected const NAME = 'tbl_product';
    protected const PK = 'product_id';
    protected const PK_FIELDS = ['product_id'];
    protected const DFLT_ALIAS = 'p';
    protected const FIELDS = [
        'product_id' => [Field::T_NUM, null, 8, 17, 0, 'nextval(\'tbl_product_product_id_seq\'::regclass)', true, false],
        'brand_id' => [Field::T_NUM, null, 4, 9, 0, null, false, false],
        'title' => [Field::T_CHR, 200, null, 0, null, null, true, false],
        'description' => [Field::T_TEXT, null, null, 0, null, null, false, false],
        'price' => [Field::T_NUM, null, null, 11, 2, null, true, false],
        'weight' => [Field::T_NUM, null, 4, 9, 0, null, false, false],
        'width' => [Field::T_NUM, null, null, 7, 1, null, false, false],
        'height' => [Field::T_NUM, null, null, 7, 1, null, false, false],
        'depth' => [Field::T_NUM, null, null, 7, 1, null, false, false],
        'color_id' => [Field::T_NUM, null, 4, 9, 0, null, false, false],
        'state' => [Field::T_NUM, null, 2, 4, 0, '1', true, false],
    ];
    protected const FOREING_KEYS = [
        'fk_product__brand_id' => [['brand_id'], 'tbl_brand', ['brand_id']],
        'fk_product__color_id' => [['color_id'], 'tbl_color', ['color_id']],
    ];
    //endregion
}
