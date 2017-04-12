CREATE DATABASE the_fuzz
    CHARACTER SET utf8
    COLLATE utf8_general_ci;
    
USE the_fuzz;
SET sql_mode='NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE regions (
    id              INT             NOT NULL AUTO_INCREMENT,
    name            VARCHAR(25)     NOT NULL,
    state           VARCHAR(25)     NOT NULL,
    
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

INSERT INTO regions (
    name,               state
) VALUES 
    ("Massachusetts",   "MA"),
    ("New Hampshire",   "NH"),
    ("Vermont",         "VT"),
    ("Maine",           "ME"),
    ("Rhode Island",    "RI"),
    ("Conneticut",      "CT");

CREATE TABLE contact_methods (
    id              INT             NOT NULL AUTO_INCREMENT,
    name            VARCHAR(20)     NOT NULL,
    
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

INSERT INTO contact_methods (
    name
) VALUES 
    ("Email"),
    ("Telegram"),
    ("Twitter"),
    ("Furaffinity"),
    ("Skype"),
    ("Phone Number");

CREATE TABLE users (
    id              INT             NOT NULL AUTO_INCREMENT,
    username        VARCHAR(20)     NOT NULL,
    auth            VARCHAR(64)     NOT NULL,
    has_icon        TINYINT(1)      NOT NULL DEFAULT 0,
    fur_name        VARCHAR(50)     NOT NULL DEFAULT "",
    real_name       VARCHAR(50)     NOT NULL DEFAULT "",
    contact_method  INT             NOT NULL,
    is_admin        TINYINT(1)      NOT NULL DEFAULT 0,
    
    address         VARCHAR(50)     NOT NULL DEFAULT "",
    city            VARCHAR(25)     NOT NULL DEFAULT "",
    region          INT             NOT NULL,
    hide_city       TINYINT(1)      NOT NULL DEFAULT 0,
    
    joined_time     DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY (id),
    UNIQUE KEY (username),
    FOREIGN KEY (contact_method) REFERENCES contact_methods(id),
    FOREIGN KEY (region) REFERENCES regions(id)
);

CREATE TABLE emergency_info (
    user            INT             NOT NULL,

    em_name_1       VARCHAR(50)     NOT NULL DEFAULT "",
    em_name_2       VARCHAR(50)     NOT NULL DEFAULT "",
    em_phone_1      VARCHAR(50)     NOT NULL DEFAULT "",
    em_phone_2      VARCHAR(50)     NOT NULL DEFAULT "",
    
    allergies       VARCHAR(50)     NOT NULL DEFAULT "",
    medical_issues  VARCHAR(50)     NOT NULL DEFAULT "",
    bee_allergy     TINYINT(1)      NOT NULL DEFAULT 0,
    food_allergy    TINYINT(1)      NOT NULL DEFAULT 0,
    
    FOREIGN KEY (user) REFERENCES users(id)
);

CREATE TABLE group_roles (
    id              INT             NOT NULL AUTO_INCREMENT,
    name            VARCHAR(20)     NOT NULL,
    
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

INSERT INTO group_roles (
    name
) VALUES 
    ("Owner"),
    ("Moderator"),
    ("User");

CREATE TABLE user_contact_methods (
    method          INT             NOT NULL,
    user            INT             NOT NULL,
    method_info     VARCHAR(40)     NOT NULL,
    
    FOREIGN KEY (method) REFERENCES contact_methods(id),
    FOREIGN KEY (user) REFERENCES users(id)
);

CREATE TABLE groups (
    id              INT             NOT NULL AUTO_INCREMENT,
    name            VARCHAR(20)     NOT NULL,
    region          INT             NOT NULL,
    description     TEXT            NOT NULL,
    
    PRIMARY KEY (id),
    UNIQUE KEY (name),
    FOREIGN KEY (region) REFERENCES regions(id)
);

CREATE TABLE user_group_roles (
    user            INT             NOT NULL,
    `group`         INT             NOT NULL,
    role            INT             NOT NULL,
    
    FOREIGN KEY (user) REFERENCES users(id),
    FOREIGN KEY (`group`) REFERENCES groups(id),
    FOREIGN KEY (role) REFERENCES group_roles(id)
);

CREATE TABLE attendee_types (
    id              INT             NOT NULL AUTO_INCREMENT,
    name            VARCHAR(20)     NOT NULL,

    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

INSERT INTO attendee_types (
    name
) VALUES 
    ("host"),
    ("attendee"),
    ("invited");

CREATE TABLE event_details (
    id              INT             NOT NULL AUTO_INCREMENT,
    description     TEXT            NOT NULL,
    short_info      VARCHAR(20)     NOT NULL DEFAULT "",
    url             VARCHAR(20)     NOT NULL DEFAULT "",
    tag_bitwise     INT             NOT NULL DEFAULT 0,
    
    location_name   VARCHAR(50)     NOT NULL,
    address         VARCHAR(50)     NOT NULL,
    city            VARCHAR(25)     NOT NULL,
    region          INT             NOT NULL,
    zip             VARCHAR(5)      NOT NULL,
    country         VARCHAR(30)     DEFAULT "United States",
    
    has_alt_host    TINYINT(1)      NOT NULL DEFAULT 0,
    alt_name        VARCHAR(30)     NOT NULL DEFAULT "",
    alt_contact     VARCHAR(30)     NOT NULL DEFAULT "",
    alt_method      INT             NOT NULL DEFAULT 0,
    
    must_rsvp       TINYINT(1)      NOT NULL DEFAULT 0,
    max_attendees   INT             NOT NULL DEFAULT 0,
    
    PRIMARY KEY (id),
    FOREIGN KEY (region) REFERENCES regions(id),
    FOREIGN KEY (alt_method) REFERENCES contact_methods(id)
);

CREATE TABLE meets (
    id              INT             NOT NULL AUTO_INCREMENT,
    `group`         INT             DEFAULT NULL,
    details         INT             NOT NULL,
    
    name            VARCHAR(30)     NOT NULL,
    rrule           TEXT            NOT NULL DEFAULT "",
    overview        TEXT            NOT NULL DEFAULT "",
    is_con          TINYINT(1)      NOT NULL DEFAULT 0,
    
    created_time    DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    FOREIGN KEY (`group`) REFERENCES groups(id),
    FOREIGN KEY (details) REFERENCES event_details(id)
);

CREATE TABLE events (
    id              INT             NOT NULL AUTO_INCREMENT,
    meet            INT             NOT NULL,
    
    edition         VARCHAR(20)     NOT NULL DEFAULT "",
    details         INT             NOT NULL,
    is_draft        TINYINT(1)      NOT NULL DEFAULT 0,
    
    start_time      DATETIME        NOT NULL,
    end_time        DATETIME        DEFAULT NULL,
    created_time    DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_time   DATETIME        DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    posted_time     DATETIME        DEFAULT NULL,
    canceled_time   DATETIME        DEFAULT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (details) REFERENCES event_details(id),
    FOREIGN KEY (meet) REFERENCES meets(id)
);

CREATE TABLE event_attendees (
    `event`         INT             NOT NULL,
    user            INT             NOT NULL,
    attendee_type   INT             NOT NULL,
    
    FOREIGN KEY (user) REFERENCES users(id),
    FOREIGN KEY (`event`) REFERENCES events(id),
    FOREIGN KEY (attendee_type) REFERENCES attendee_types(id)
);

CREATE TABLE event_tags (
    id              INT             NOT NULL AUTO_INCREMENT,
    name            VARCHAR(20)     NOT NULL,
    bitwise         INT             NOT NULL,
    
    PRIMARY KEY (id),
    UNIQUE KEY (name),
    UNIQUE KEY (bitwise)
);

INSERT INTO event_tags (
    name,           bitwise
) VALUES 
    ("18 Plus",     1),
    ("Furbowl",     2),
    ("Food",        4),
    ("Mini-Golf",   8),
    ("Movie",       16),
    ("No Fursuits", 32),
    ("Outdoors",    64),
    ("RSVP",        128),
    ("Party",       256),
    ("Convention",  512);
    
CREATE TABLE announcements (
    id              INT             NOT NULL AUTO_INCREMENT,
    title           VARCHAR(30)     NOT NULL,
    user            INT             NOT NULL,
    posted_time     DATETIME        DEFAULT NULL,
    submitted_time  DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    text            TEXT            NOT NULL DEFAULT "",
    image           TEXT            NOT NULL DEFAULT "",
    `group`         INT             DEFAULT NULL,
    `event`         INT             DEFAULT NULL,
    
    PRIMARY KEY (id),
    FOREIGN KEY (user) REFERENCES users(id),
    FOREIGN KEY (`event`) REFERENCES events(id),
    FOREIGN KEY (`group`) REFERENCES groups(id)
);