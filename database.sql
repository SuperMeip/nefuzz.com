
CREATE TABLE users(
    id              INT             NOT NULL AUTO_INCREMEMNT,
    username        VARCHAR(20)     NOT NULL,
    auth            VARCHAR(64)     NOT NULL,
    fur_name        VARCHAR(50)     NOT NULL DEFAULT "",
    real_name       VARCHAR(50)     NOT NULL DEFAULT "",
    
    address         VARCHAR(50)     NOT NULL DEFAULT "",
    city            VARCHAR(25)     NOT NULL DEFAULT "",
    state           VARCHAR(2)      NOT NULL,
    hide_city       TINYINT(1)      NOT NULL DEFAULT 0,
    
    PRIMARY KEY (id)
);

CREATE TABLE contact_methods (
    id              INT             NOT NULL AUTO_INCREMEMNT,
    contact_method  VARCHAR(20)     NOT NULL,
    
    PRIMARY KEY (id)
);

CREATE TABLE user_contact_methods (
    method_id       INT             NOT NULL,
    user_id         INT             NOT NULL,
    method_info     VARCHAR(40)     NOT NULL,
    
    FOREIGN KEY method_id REFERENCES contact_methods(id),
    FOREIGN KEY user_id REFERENCES users(id)
);

INSERT INTO contact_methods(
    contact_method
) VALUES 
    ("email"),
    ("telegram"),
    ("twitter"),
    ("furaffinity"),
    ("skype"),
    ("phone");
    
