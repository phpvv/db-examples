<?php

/** Created by VV Db Model Generator */

declare(strict_types=1);

namespace App\Db\MainDb\Tables;

use VV\Db\Model\Field;
use App\Db\MainDb\Table;

/**
 * Class OrderItemTable
 *
 * @package App\Db\Main\Tables
 */
class OrderItemTable extends Table
{
    //region Auto-generated area
    protected const NAME = 'tbl_order_item';
    protected const PK = 'item_id';
    protected const PK_FIELDS = ['item_id'];
    protected const DFLT_ALIAS = 'oi';
    protected const FIELDS = [
        'item_id' => [Field::T_INT, null, 8, 17, 0, 'nextval(\'tbl_order_item_item_id_seq\'::regclass)', true, false],
        'order_id' => [Field::T_INT, null, 8, 17, 0, 'nextval(\'tbl_order_item_order_id_seq\'::regclass)', true, false],
        'product_id' => [Field::T_INT, null, 8, 17, 0, 'nextval(\'tbl_order_item_product_id_seq\'::regclass)', true, false],
        'price' => [Field::T_NUM, null, null, 11, 2, null, true, false],
        'quantity' => [Field::T_INT, null, 2, 4, 0, null, true, false],
        'tmp' => [Field::T_BOOL, null, null, 0, null, null, false, false],
    ];
    protected const FOREIGN_KEYS = [
        'fk_order_item__order_id' => [['order_id'], 'tbl_order', ['order_id']],
        'fk_order_item__product_id' => [['product_id'], 'tbl_product', ['product_id']],
    ];
    //endregion
}
