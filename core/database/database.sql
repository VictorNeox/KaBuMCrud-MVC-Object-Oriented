CREATE TABLE users(
    id int NOT NULL AUTO_INCREMENT,
    login varchar(30) NOT NULL,
    password varchar(255) NOT NULL,
    name varchar(100) NOT NULL,
    access boolean DEFAULT 0,
    email varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE clients(
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    cpf varchar(11),
    rg varchar(9),
    telephone1 varchar(9),
    telephone2 varchar(9),
    birth date,
    email varchar(255),
    isActive boolean DEFAULT TRUE,
    user_id int NOT NULL,
    FOREIGN KEY(user_id) REFERENCES users(id),
    PRIMARY KEY (id)
);

CREATE TABLE addresses(
    id int NOT NULL AUTO_INCREMENT,
    neighbourhood varchar(255) NOT NULL,
    street varchar(255) NOT NULL,
    number varchar(10) NOT NULL,
    complement varchar(255),
    zipcode varchar(8) NOT NULL,
    city varchar(100) NOT NULL,
    uf varchar(2) NOT NULL,
    client_id int NOT NULL,
    main_address boolean DEFAULT FALSE,
    FOREIGN KEY(client_id) REFERENCES clients(id),
    PRIMARY KEY (id)
);