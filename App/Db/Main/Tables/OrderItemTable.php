<?php declare(strict_types=1);

/** Created by VV Db Model Generator */
namespace App\Db\Main\Tables;

use VV\Db\Model\Field;

/**
 * Class OrderItemTable
 *
 * @package App\Db\Main\Tables
 */
class OrderItemTable extends \App\Db\Main\Table {

    //region Auto-generated area
    protected const NAME = 'tbl_order_item';
    protected const PK = 'item_id';
    protected const PK_FIELDS = ['item_id'];
    protected const DFLT_ALIAS = 'oi';
    protected const FIELDS = [
        'item_id' => [Field::T_NUM, null, 8, 17, 0, 'nextval(\'tbl_order_item_item_id_seq\'::regclass)', true, false],
        'order_id' => [Field::T_NUM, null, 8, 17, 0, 'nextval(\'tbl_order_item_order_id_seq\'::regclass)', true, false],
        'product_id' => [Field::T_NUM, null, 8, 17, 0, 'nextval(\'tbl_order_item_product_id_seq\'::regclass)', true, false],
        'price' => [Field::T_NUM, null, null, 11, 2, null, true, false],
        'quantity' => [Field::T_NUM, null, 2, 4, 0, null, true, false],
    ];
    protected const FOREING_KEYS = [
        'fk_order_item__order_id' => [['order_id'], 'tbl_order', ['order_id']],
        'fk_order_item__product_id' => [['product_id'], 'tbl_product', ['product_id']],
    ];
    //endregion
}