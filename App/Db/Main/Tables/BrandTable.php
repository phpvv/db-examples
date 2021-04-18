<?php declare(strict_types=1);

/** Created by VV Db Model Generator */
namespace App\Db\Main\Tables;

use VV\Db\Model\Field;

class BrandTable extends \App\Db\Main\Table {

    //region Auto-generated area
    protected const NAME = 'tbl_brand';
    protected const PK = 'brand_id';
    protected const PK_FIELDS = ['brand_id'];
    protected const DFLT_ALIAS = 'b';
    protected const FIELDS = [
        'brand_id' => [Field::T_NUM, null, 4, 9, 0, 'nextval(\'tbl_brand_brand_id_seq\'::regclass)', true, false],
        'title' => [Field::T_CHR, 100, null, 0, null, null, true, false],
    ];
    protected const FOREING_KEYS = [
    ];
    //endregion
}