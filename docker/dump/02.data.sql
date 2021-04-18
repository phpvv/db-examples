INSERT INTO tbl_user (user_id, name, mobile, email) VALUES (1, 'John Doe', '+1 111-11-11', 'john.doe@example.com');
INSERT INTO tbl_user (user_id, name, mobile, email) VALUES (2, 'Yamada Hanako', '+22 2-22-222', 'yamada.hanako@example.com');
INSERT INTO tbl_user (user_id, name, mobile, email) VALUES (3, 'Taras Shevchenko', '+380 12 345-67-89', 't.shevchenko@example.com');
INSERT INTO tbl_user (user_id, name, mobile, email) VALUES (4, 'Mario Rossi', '+4 12345-67', 'mario@example.com');
INSERT INTO tbl_user (user_id, name, mobile, email) VALUES (5, 'Jean Dupont', '+5 555 55 55', 'dupont@example.com');
SELECT setval('tbl_user_user_id_seq', 1000, false);


INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (1, null, 'Computers');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (100, 1, 'Computer Accessories & Peripherals');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (101, 1, 'Computer Components');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (102, 1, 'Computers & Tablets');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (103, 1, 'Data Storage');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (104, 1, 'External Components');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (105, 1, 'Laptop Accessories');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (106, 1, 'Monitors');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (107, 1, 'Networking Products');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (108, 1, 'Printers');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (109, 1, 'Scanners');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (2, null, 'Electronics');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (200, 2, 'Camera & Photo');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (201, 2, 'Cell Phones');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (202, 2, 'Computers');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (203, 2, 'GPS & Navigation');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (204, 2, 'Headphones');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (205, 2, 'Office Electronics');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (206, 2, 'Portable Audio & Video');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (207, 2, 'Television & Video');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (208, 2, 'Video Game Consoles');
INSERT INTO tbl_product_category (category_id, parent_id, title) VALUES (209, 2, 'Wearable Technology');
SELECT setval('tbl_product_category_category_id_seq', 10000, false);


INSERT INTO tbl_brand (brand_id, title) VALUES (1, 'Brand 1');
INSERT INTO tbl_brand (brand_id, title) VALUES (2, 'Brand 2');
INSERT INTO tbl_brand (brand_id, title) VALUES (3, 'Brand 3');
SELECT setval('tbl_brand_brand_id_seq', 100, false);


INSERT INTO tbl_color (color_id, title) VALUES (1, 'Black');
INSERT INTO tbl_color (color_id, title) VALUES (2, 'Red');
INSERT INTO tbl_color (color_id, title) VALUES (3, 'Green');
INSERT INTO tbl_color (color_id, title) VALUES (4, 'Blue');
INSERT INTO tbl_color (color_id, title) VALUES (5, 'White');
SELECT setval('tbl_color_color_id_seq', 100, false);


INSERT INTO tbl_product (product_id, brand_id, title, price, weight, width, height, depth, color_id)
VALUES (10, 1, 'Computer 10', 1000, 10000, 250, 500, 500, 1);
INSERT INTO tbl_product (product_id, brand_id, title, price, weight, width, height, depth, color_id)
VALUES (11, 1, 'Computer 11', 1500, 12000, 300, 600, 655, 1);
INSERT INTO tbl_product (product_id, brand_id, title, price, weight, width, height, depth, color_id)
VALUES (20, 2, 'Mouse 20', 50.25, NULL, NULL, NULL, NULL, 5);
INSERT INTO tbl_product (product_id, brand_id, title, price, weight, width, height, depth, color_id)
VALUES (30, 3, 'Phone 30', 999.99, 172, 74, 158, 7.9, 2);
INSERT INTO tbl_product (product_id, brand_id, title, price, weight, width, height, depth, color_id)
VALUES (40, NULL, 'HDMI Cable 40', 10.99, NULL, NULL, NULL, 2000, NULL);
INSERT INTO tbl_product (product_id, brand_id, title, price, weight, width, height, depth, color_id)
VALUES (50, NULL, 'TV 50', 500, 8300, 936, 627.3, 192.5, 1);
SELECT setval('tbl_product_product_id_seq', 1000, false);


INSERT INTO tbl_products_categories (product_id, category_id) VALUES (10, 102);
INSERT INTO tbl_products_categories (product_id, category_id) VALUES (10, 202);
INSERT INTO tbl_products_categories (product_id, category_id) VALUES (11, 102);
INSERT INTO tbl_products_categories (product_id, category_id) VALUES (11, 202);
INSERT INTO tbl_products_categories (product_id, category_id) VALUES (20, 100);
INSERT INTO tbl_products_categories (product_id, category_id) VALUES (30, 201);
INSERT INTO tbl_products_categories (product_id, category_id) VALUES (40, 100);
INSERT INTO tbl_products_categories (product_id, category_id) VALUES (50, 207);
