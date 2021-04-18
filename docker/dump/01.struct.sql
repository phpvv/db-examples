CREATE TABLE tbl_user_role (
    role_id     SMALLINT
        CONSTRAINT pk_user_role PRIMARY KEY,
    title       VARCHAR(100),
    description VARCHAR(4000)
);

CREATE TABLE tbl_user (
    user_id      BIGSERIAL
        CONSTRAINT pk_user PRIMARY KEY               NOT NULL,
    name         VARCHAR(100)                        NOT NULL,
    mobile       VARCHAR(15),
    email        VARCHAR(100),
    password     VARCHAR(256),
    deleted      SMALLINT  DEFAULT 0                 NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);
CREATE INDEX idx_user_name ON tbl_user(name);
CREATE INDEX idx_user_mobile ON tbl_user(mobile);
CREATE INDEX idx_user_email ON tbl_user(email);

CREATE TABLE tbl_users_roles (
    users_roles_id SERIAL
        CONSTRAINT pk_users_roles PRIMARY KEY,
    user_id        BIGINT NOT NULL
        CONSTRAINT fk_users_roles__user_id REFERENCES tbl_user,
    role_id        INT    NOT NULL
        CONSTRAINT fk_users_roles__role_id REFERENCES tbl_user_role ON UPDATE CASCADE,
    options        BIGINT NOT NULL DEFAULT 0
);

CREATE INDEX idx_users_roles__user_id ON tbl_users_roles(user_id);
CREATE INDEX idx_users_roles__role_id ON tbl_users_roles(role_id);
CREATE INDEX idx_users_roles__options ON tbl_users_roles(options);

CREATE TABLE tbl_product_category (
    category_id SERIAL
        CONSTRAINT pk_product_category PRIMARY KEY,
    parent_id   INT
        CONSTRAINT fk_product_category__parent_id REFERENCES tbl_product_category,
    title       VARCHAR(200) NOT NULL,
    state       SMALLINT     NOT NULL DEFAULT 1
);
CREATE INDEX idx_product_category__parent_id ON tbl_product_category(parent_id);
CREATE INDEX idx_product_category__state ON tbl_product_category(state);

CREATE TABLE tbl_brand (
    brand_id SERIAL
        CONSTRAINT pk_brand PRIMARY KEY,
    title    VARCHAR(100) NOT NULL
);

CREATE TABLE tbl_color (
    color_id SERIAL
        CONSTRAINT pk_color PRIMARY KEY,
    title    VARCHAR(100) NOT NULL
);

CREATE TABLE tbl_product (
    product_id  BIGSERIAL
        CONSTRAINT pk_product PRIMARY KEY,
    brand_id    INT
        CONSTRAINT fk_product__brand_id REFERENCES tbl_brand,
    title       VARCHAR(200)   NOT NULL,
    description TEXT,
    price       DECIMAL(11, 2) NOT NULL, -- usd
    weight      INT,                     -- gram
    width       DECIMAL(7, 1),           -- mm
    height      DECIMAL(7, 1),           -- mm
    depth       DECIMAL(7, 1),           -- mm
    color_id    INT
        CONSTRAINT fk_product__color_id REFERENCES tbl_color,
    state       SMALLINT       NOT NULL DEFAULT 1
);
CREATE INDEX idx_product__brand_id ON tbl_product(brand_id);
CREATE INDEX idx_product__price ON tbl_product(price);
CREATE INDEX idx_product__color_id ON tbl_product(color_id);
CREATE INDEX idx_product__state ON tbl_product(state);


CREATE TABLE tbl_products_categories (
    products_categories_id BIGSERIAL
        CONSTRAINT pk_products_categories PRIMARY KEY,
    product_id             BIGINT
        CONSTRAINT fk_products_categories__product_id REFERENCES tbl_product,
    category_id            INT      NOT NULL
        CONSTRAINT fk_products_categories__category_id REFERENCES tbl_product_category,
    state                  SMALLINT NOT NULL DEFAULT 1
);
CREATE INDEX idx_products_categories__product_id ON tbl_products_categories(product_id);
CREATE INDEX idx_products_categories__category_id ON tbl_products_categories(category_id);
CREATE INDEX idx_products_categories__state ON tbl_products_categories(state);



CREATE TABLE tbl_order_state (
    state_id SMALLINT
        CONSTRAINT pk_order_state PRIMARY KEY,
    title    VARCHAR(100) NOT NULL
);

CREATE TABLE tbl_order (
    order_id BIGSERIAL
        CONSTRAINT pk_order PRIMARY KEY,
    state_id SMALLINT
        CONSTRAINT fk_order__state_id REFERENCES tbl_order_state,
    user_id  BIGINT NOT NULL
        CONSTRAINT fk_order__user_id REFERENCES tbl_user,
    amount   DECIMAL(11, 2),
    comment  VARCHAR(4000)
);
CREATE INDEX idx_order__state_id ON tbl_order(state_id);
CREATE INDEX idx_order__user_id ON tbl_order(user_id);

CREATE TABLE tbl_order_item (
    item_id    BIGSERIAL
        CONSTRAINT pk_order_item PRIMARY KEY,
    order_id   BIGSERIAL
        CONSTRAINT fk_order_item__order_id REFERENCES tbl_order,
    product_id BIGSERIAL
        CONSTRAINT fk_order_item__product_id REFERENCES tbl_product,
    price      DECIMAL(11, 2) NOT NULL,
    quantity   SMALLINT       NOT NULL
);
CREATE INDEX idx_order_item__order_id ON tbl_order_item(order_id);
CREATE INDEX idx_order_item__product_id ON tbl_order_item(product_id);

CREATE TABLE tbl_log (
    log_id       BIGSERIAL
        CONSTRAINT pk_log PRIMARY KEY,
    title        VARCHAR(200) NOT NULL,
    description  TEXT,
    date_created TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);
