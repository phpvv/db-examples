<?php declare(strict_types=1);

/*
 * This file is part of the phpvv package.
 *
 * (c) Volodymyr Sarnytskyi <v00v4n@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
require __DIR__ . '/../bootstrap.php';

$db = \App\Db\Main::instance();
$fields = $db->tbl->user->fields();

$db->tbl->user->insert([
    // 'name' => 'Vasya',
]);
