CREATE TABLE regions (
    id              INT             NOT NULL AUTO_INCREMENT,
    name            VARCHAR(25)     NOT NULL,
    
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

INSERT INTO regions(
    name
) VALUES 
    ("MA"),
    ("NH"),
    ("VT"),
    ("ME"),
    ("RI"),
    ("CT");
    
CREATE TABLE users(
    id              INT             NOT NULL AUTO_INCREMENT,
    username        VARCHAR(20)     NOT NULL,
    auth            VARCHAR(64)     NOT NULL,
    fur_name        VARCHAR(50)     NOT NULL DEFAULT "",
    real_name       VARCHAR(50)     NOT NULL DEFAULT "",
    
    address         VARCHAR(50)     NOT NULL DEFAULT "",
    city            VARCHAR(25)     NOT NULL DEFAULT "",
    region          INT             NOT NULL,
    hide_city       TINYINT(1)      NOT NULL DEFAULT 0,
    
    PRIMARY KEY (id),
    UNIQUE KEY (username),
    FOREIGN KEY region REFERENCES regions(id)
);

CREATE TABLE user_types
    id              INT             NOT NULL AUTO_INCREMENT,
    name            VARCHAR(20)     NOT NULL,
    
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

INSERT INTO group_roles(
    name
) VALUES 
    ("Owner"),
    ("Moderator"),
    ("User");

CREATE TABLE contact_methods (
    id              INT             NOT NULL AUTO_INCREMENT,
    name            VARCHAR(20)     NOT NULL,
    
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

INSERT INTO contact_methods(
    name
) VALUES 
    ("email"),
    ("telegram"),
    ("twitter"),
    ("furaffinity"),
    ("skype"),
    ("phone");

CREATE TABLE user_contact_methods (
    method          INT             NOT NULL,
    user            INT             NOT NULL,
    method_info     VARCHAR(40)     NOT NULL,
    
    FOREIGN KEY method_id REFERENCES contact_methods(id),
    FOREIGN KEY user_id REFERENCES users(id)
);

CREATE TABLE groups (
    id              INT             NOT NULL AUTO_INCREMENT,
    name            VARCHAR(20)     NOT NULL,
    region          INT             NOT NULL,
    description     TEXT            NOT NULL,
    
    PRIMARY KEY (id),
    UNIQUE KEY (name)
    FOREIGN KEY region REFERENCES regions(id)
);

CREATE TABLE user_group_roles (
    user            INT             NOT NULL,
    group           INT             NOT NULL,
    role            INT             NOT NULL,
    
    FOREIGN KEY user REFERENCES user(id),
    FOREIGN KEY group REFERENCES group(id),
    FOREIGN KEY role REFERENCES role(id)
);

CREATE TABLE attendee_types (
    id              INT             NOT NULL AUTO_INCREMENT,
    name            VARCHAR(20)     NOT NULL,

    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

INSERT INTO attendee_types(
    name
) VALUES 
    ("host"),
    ("attendee"),
    ("invited");