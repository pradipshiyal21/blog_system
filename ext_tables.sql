CREATE TABLE tx_blog_domain_model_post (
	title varchar(255) NOT NULL DEFAULT '',
	description text
);

CREATE TABLE tx_blog_domain_model_comment (
    uid INT AUTO_INCREMENT PRIMARY KEY,
    pid INT DEFAULT 0,

    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    comment TEXT,

    is_approved TINYINT(1) DEFAULT 0,

    post INT DEFAULT 0,

    tstamp INT,
    crdate INT,
    deleted TINYINT DEFAULT 0,
    hidden TINYINT DEFAULT 0
);

ALTER TABLE tx_blog_domain_model_post ADD slug VARCHAR(2048) NOT NULL DEFAULT '';