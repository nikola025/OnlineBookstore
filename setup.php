<?php 
require_once "functions.php";
createTable('users',
    'id INT UNSIGNED AUTO_INCREMENT,
     username VARCHAR(30) NOT NULL,
     password VARCHAR(255) NOT NULL,
     PRIMARY KEY(id)'
);

createTable('accounts',
    'id INT UNSIGNED AUTO_INCREMENT,
     user_id INT UNSIGNED UNIQUE,
     kname VARCHAR(255) NOT NULL,
     kaddress VARCHAR(255) NOT NULL,
     post VARCHAR(255) NOT NULL,
     town VARCHAR(255) NOT NULL,
     phone VARCHAR(255) NOT NULL,
     email VARCHAR(255) NOT NULL,
     PRIMARY KEY(id),
     FOREIGN KEY(user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE NO ACTION
     '
);

createTable('books',
    'id INT UNSIGNED AUTO_INCREMENT,
    bname VARCHAR(255) NOT NULL,
    bauthor VARCHAR(255) NOT NULL,
    bprice VARCHAR(255) NOT NULL,
    bdesc TEXT NOT NULL,
    PRIMARY KEY(id)'
);

createTable('cart',
    'id INT UNSIGNED AUTO_INCREMENT,
    buyer_id INT UNSIGNED NOT NULL,
    book_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(buyer_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE NO ACTION,
    FOREIGN KEY(book_id) REFERENCES books(id) ON UPDATE CASCADE ON DELETE NO ACTION
    '
);

createTable('orders',
    'id INT UNSIGNED AUTO_INCREMENT,
    buyer_id INT UNSIGNED NOT NULL,
    book_id INT UNSIGNED NOT NULL,
    vreme TEXT,
    PRIMARY KEY(id),
    FOREIGN KEY(buyer_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE NO ACTION,
    FOREIGN KEY(book_id) REFERENCES books(id) ON UPDATE CASCADE ON DELETE NO ACTION
    '
);

createTable('messages',
    'id INT UNSIGNED AUTO_INCREMENT,
    auth_id INT UNSIGNED NOT NULL,
    recip_id INT UNSIGNED NOT NULL,
    message VARCHAR(4096) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(auth_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE NO ACTION,
    FOREIGN KEY(recip_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE NO ACTION
    '
);

