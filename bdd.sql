


CREATE TABLE admin (
    id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(180) NOT NULL UNIQUE,
    roles LONGTEXT NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
) ENGINE = InnoDB  DEFAULT CHARSET=utf8;


CREATE TABLE categories (
    id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
) ENGINE = InnoDB  DEFAULT CHARSET=utf8;


CREATE TABLE dishes (
    id INT AUTO_INCREMENT NOT NULL,
    admin_id INT,
    categories_id INT,
    title VARCHAR(80) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (admin_id) REFERENCES admin(id),
    FOREIGN KEY (categories_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE = InnoDB  DEFAULT CHARSET=utf8;



CREATE INDEX idx_admin_id_ondishes ON dishes (admin_id);


CREATE INDEX idx_categories_id_ondishes ON dishes (categories_id);


CREATE TABLE menu (
    id INT AUTO_INCREMENT NOT NULL,
    admin_id INT,
    menu_title VARCHAR(80) NOT NULL,
    description VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (admin_id) REFERENCES admin(id)
) ENGINE = InnoDB  DEFAULT CHARSET=utf8;



CREATE INDEX idx_admin_id_onmenu ON menu (admin_id);


CREATE TABLE dishes_menu (
    dishes_id INT NOT NULL,
    menu_id INT NOT NULL,
    PRIMARY KEY(dishes_id, menu_id),
    FOREIGN KEY (dishes_id) REFERENCES dishes(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_id) REFERENCES menu(id) ON DELETE CASCADE
) ENGINE = InnoDB  DEFAULT CHARSET=utf8;



CREATE INDEX idx_dishes_id_ondishes_menu ON dishes_menu (dishes_id);


CREATE INDEX idx_menu_id_ondishes_menu ON dishes_menu (menu_id);



CREATE TABLE picdishes (
    id INT AUTO_INCREMENT NOT NULL,
    admin_id INT,
    title VARCHAR(80) NOT NULL,
    image LONGTEXT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (admin_id) REFERENCES admin(id)
) ENGINE = InnoDB  DEFAULT CHARSET=utf8;



CREATE INDEX idx_admin_id_onpicdishes ON picdishes (admin_id);


CREATE TABLE user (
    id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(180) NOT NULL,
    roles LONGTEXT NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
) ENGINE = InnoDB  DEFAULT CHARSET=utf8;


CREATE TABLE visitor (
    id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(180) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
) ENGINE = InnoDB  DEFAULT CHARSET=utf8;


CREATE TABLE reservation (
    id INT AUTO_INCREMENT NOT NULL,
    user_id INT,
    visitor_id INT,
    flatware INT NOT NULL,
    reservation_date DATE NOT NULL,
    reservation_hour TIME NOT NULL,
    allergy LONGTEXT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (visitor_id) REFERENCES visitor(id)
) ENGINE = InnoDB  DEFAULT CHARSET=utf8;



CREATE INDEX idx_user_id_onreservation ON reservation (user_id);


CREATE INDEX idx_visitor_id_onreservation ON reservation (visitor_id);



CREATE TABLE schedule (
    id INT AUTO_INCREMENT NOT NULL,
    admin_schedule_id INT,
    opening_noon TIME NOT NULL,
    closing_noon TIME NOT NULL,
    opening_evening TIME NOT NULL,
    closing_evening TIME NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (admin_schedule_id) REFERENCES admin(id)
) ENGINE = InnoDB  DEFAULT CHARSET=utf8;


CREATE INDEX idx_admin_schedule_id_onschedule ON schedule (admin_schedule_id);





-- Insertion d'enregistrements dans la table admin
INSERT INTO admin (email, roles, password)
VALUES
    ('admin1@example.com', '["ROLE_ADMIN"]', '$2y$10$mdPNh9muFWL1UeUq8Bt60ukuiFh1vuNdGCBO/1gb.FSBU5apZqf2q');
    


INSERT INTO picdishes (admin_id, title, image)
VALUES
    (1, 'Pizza', 'https://img.cuisineaz.com/660x660/2021/02/25/i159373-pizza-margherita.jpeg'),
    (1, 'Riz Cantonais', 'https://assets.afcdn.com/recipe/20200907/114005_w1024h1024c1cx540cy960.webp');

    

SELECT `picdishes`.`title` AS `Nom du plat`, `admin`.`id` AS `Id de l'admin`
FROM `picdishes` 
LEFT JOIN `admin` ON `picdishes`.`admin_id` = `admin`.`id`;