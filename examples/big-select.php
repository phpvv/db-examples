<?php declare(strict_types=1);

/*
 * This file is part of the phpvv package.
 *
 * (c) Volodymyr Sarnytskyi <v00v4n@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace examples;

require __DIR__ . '/../bootstrap.php';

use App\Db\MainDb;
use VV\Db\Param;
use VV\Db\Sql;

$db = MainDb::instance();

$categoryId = 102;
$stateParam = Param::int(value: 1, name: 'state');

$query = $db->tbl->product
    ->select('title', 'b.title brand', 'price', 'c.title as color') // SELECT p.title, ... FROM tbl_product as p
    ->join($db->tbl->brand)                                         // INNER JOIN tbl_brand as b ON b.brand_id = p.brand_id
    ->left($db->tbl->color, 'p')                                    // LEFT JOIN tbl_color as c ON c.color_id = p.color_id
    // ->left($db->tbl->color, on: 'c.color_id = p.color_id', alias: 'c') // same as above
    ->where( // WHERE ...
        Sql::condition()
            ->exists(                                               // WHERE EXISTS (
                $db->tbl->productsCategories->select('1')               // SELECT 1 FROM tbl_products_categories pc
                ->where('`pc`.`product_id`=`p`.`product_id`')           // WHERE ("pc"."product_id"="p"."product_id")
                ->where([
                    'category_id' => $categoryId,                       // AND pc.category_id = :p1
                    'state' => $stateParam                              // AND pc.state = :state
                ])
            )                                                       // )
            ->and('state')->eq($stateParam)                         // AND p.state = :state
            // ->and('title')->like('Comp%')
            ->and('title')->startsWith('Comp')                      // AND p.title LIKE :p2 -- 'Comp%'
            ->and('price')
                ->gte(1000)                                         // AND p.price >= :p3
                ->and
                ->lte(2000)                                         // AND p.price <= :p4
            ->and('weight')->between(7000, 15000)                   // AND p.weight BETWEEN :p5 AND :p6
            ->and(                                                  // AND (
                Sql::condition('width') // nested condition
                    ->lt(500)                                           // p.width > :p7
                    ->or                                                // OR
                    ->isNull()                                          // p.width IS NULL
            )                                                       // )
            ->and('c.color_id')->in(1, 5, null)                     // AND (c.color_id IN (:p8, :p9) OR c.color_id IS NULL)
            ->and('brand_id')->not->in(3, 4)                        // AND (p.brand_id NOT IN (:p10, :p11) OR p.brand_id IS NULL)
            ->and('height')->isNotNull()                            // AND p.height IS NOT NULL
    )
    // ->groupBy(...)
    // ->having(...)
    ->orderBy(                                                      // ORDER BY
        Sql::case('p.color_id')
            ->when(5)->then(1)                                      // color_id = 5 - first
            ->when(1)->then(2)                                      // color_id = 1 - second
            ->else(3),                                              // other colors at the end - first
        // Sql::case()
        //     ->when(Sql::condition('p.color_id')->eq(5))->then(1)    // same CASE as above
        //     ->when(['p.color_id' => 1])->then(2)
        //     ->else(3),
        '-price',                                                   // price DESC,
        'title'                                                     // title ASC
    )
    ->limit(10);                                                    // LIMIT 10


echo "SQL:\n", $query->toString(), "\n\n";

// $rows = $query->rows;
// $rows = $query->rows(\VV\Db::FETCH_NUM);
// $rows = $query->rows(null, keyColumn: 'product_id', decorator: function (&$row, &$key) => { /*...*/ });
// $row = $query->row;
// $row = $query->row(\VV\Db::FETCH_NUM | \VV\Db::FETCH_LOB_NOT_LOAD);
// $title = $query->column;
// $brand = $query->column(1);

/*
$statement = $query->prepare();
print_r($statement->result()->rows);
$stateParam->setValue(0);
print_r($statement->result()->rows);
$statement->close();
*/

echo "rows:\n";
foreach ($query->result as $row) {
    print_r($row);
}
