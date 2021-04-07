CREATE TABLE tbl_user_role (
    role_id     SMALLINT
        CONSTRAINT pk_user_role PRIMARY KEY NOT NULL,
    title       VARCHAR(100),
    description VARCHAR(4000)
);

CREATE TABLE tbl_user (
    user_id          BIGSERIAL
        CONSTRAINT pk_user PRIMARY KEY                   NOT NULL,
    name             VARCHAR(100),
    mobile           VARCHAR(15),
    email            VARCHAR(100),
    password         VARCHAR(256)                        NOT NULL,
    deleted          SMALLINT  DEFAULT 0                 NOT NULL,
    date_created     TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
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
