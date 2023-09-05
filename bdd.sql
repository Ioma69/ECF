CREATE TABLE admin (
    id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(180) NOT NULL,
    roles LONGTEXT NOT NULL,
    password VARCHAR(255) NOT NULL,
    UNIQUE INDEX UNIQ_880E0D76E7927C74 (email),
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

CREATE TABLE categories (
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

CREATE TABLE dishes (
    id INT AUTO_INCREMENT NOT NULL,
    admin_id INT,
    categories_id INT,
    title VARCHAR(80) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    INDEX IDX_584DD35D642B8210 (admin_id),
    INDEX IDX_584DD35DA21214B7 (categories_id),
    PRIMARY KEY(id),
    FOREIGN KEY (admin_id) REFERENCES admin(id),
    FOREIGN KEY (categories_id) REFERENCES categories(id) ON DELETE CASCADE
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

CREATE TABLE dishes_menu (
    dishes_id INT NOT NULL,
    menu_id INT NOT NULL,
    INDEX IDX_DE629E4AA05DD37A (dishes_id),
    INDEX IDX_DE629E4ACCD7E912 (menu_id),
    PRIMARY KEY(dishes_id, menu_id),
    FOREIGN KEY (dishes_id) REFERENCES dishes(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_id) REFERENCES menu(id) ON DELETE CASCADE
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

CREATE TABLE menu (
    id INT AUTO_INCREMENT NOT NULL,
    admin_id INT,
    menu_title VARCHAR(80) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    INDEX IDX_7D053A93642B8210 (admin_id),
    PRIMARY KEY(id),
    FOREIGN KEY (admin_id) REFERENCES admin(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

CREATE TABLE picdishes (
    id INT AUTO_INCREMENT NOT NULL,
    admin_id INT,
    title VARCHAR(80) NOT NULL,
    image LONGTEXT NOT NULL,
    INDEX IDX_8ADF486D642B8210 (admin_id),
    PRIMARY KEY(id),
    FOREIGN KEY (admin_id) REFERENCES admin(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

CREATE TABLE reservation (
    id INT AUTO_INCREMENT NOT NULL,
    user_id INT,
    visitor_id INT,
    flatware INT NOT NULL,
    reservation_date DATE NOT NULL,
    reservation_hour TIME NOT NULL,
    allergy LONGTEXT NOT NULL,
    INDEX IDX_42C84955A76ED395 (user_id),
    INDEX IDX_42C8495570BEE6D (visitor_id),
    PRIMARY KEY(id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (visitor_id) REFERENCES visitor(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

CREATE TABLE schedule (
    id INT AUTO_INCREMENT NOT NULL,
    admin_schedule_id INT,
    opening_noon TIME NOT NULL,
    closing_noon TIME NOT NULL,
    opening_evening TIME NOT NULL,
    closing_evening TIME NOT NULL,
    INDEX IDX_5A3811FB39118BDC (admin_schedule_id),
    PRIMARY KEY(id),
    FOREIGN KEY (admin_schedule_id) REFERENCES admin(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

CREATE TABLE user (
    id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(180) NOT NULL,
    roles LONGTEXT NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

CREATE TABLE visitor (
    id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(180) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;
