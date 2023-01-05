CREATE TABLE Users (
  username VARCHAR PRIMARY KEY,               -- unique username
  password VARCHAR,                           -- password stored in sha-1
  name VARCHAR,                               -- real name
  phone VARCHAR[9],                           -- phone number
  adress VARCHAR,                             -- adress of the user
  restaurant_owner BOOLEAN                    -- if is a owner
);

CREATE TABLE Customer(
  username VARCHAR REFERENCES Users           -- user that is a customer
);

CREATE TABLE Owner(
  username VARCHAR REFERENCES Users           -- user that is a customer
);

CREATE TABLE Restaurant (
  id INTEGER PRIMARY KEY,                     -- restaurant unique id
  name VARCHAR,                               -- name of the restaurant
  adress VARCHAR,                             -- adress of the restaurant
  category VARCHAR,                           -- category of the restaurant
  owner_username VARCHAR REFERENCES Users     -- owner of the restaurant
);

CREATE TABLE Dishes (
  name VARCHAR PRIMARY KEY,                   -- dish unique name
  photo INTEGER,                              -- photo of the dish
  category VARCHAR                            -- category of the dish
);

CREATE TABLE Orders (
  id INTEGER PRIMARY KEY,                     -- unique id of the order
  date INTEGER,                               -- date when the order was placed in epoch format
  price FLOAT,                                -- total price of the order
  state VARCHAR,                              -- state of the order (e.g., received, preparing, ready, delivered)
  customer VARCHAR REFERENCES Users           -- customer that placed the order
);

CREATE TABLE Review (
  id INTEGER PRIMARY KEY,                     -- unique id of the review
  date INTEGER,                               -- date when the review was made in epoch format
  content VARCHAR,                            -- text with the review
  rating INTEGER,                             -- rating of the review (1 - 5)
  customer VARCHAR REFERENCES Users,          -- customer that wrote the review
  restaurant INTEGER REFERENCES Restaurant    -- id of restaurant that received the review
);

CREATE TABLE Comment (
  id INTEGER PRIMARY KEY,                     -- unique id of the comment
  date INTEGER,                               -- date when the comment was made in epoch format
  content VARCHAR,                            -- text with the comment
  review INTEGER REFERENCES Review            -- id of the review that the owner is responding
);

CREATE TABLE FavDishes (
  customer VARCHAR REFERENCES Users,          -- customer name
  dish VARCHAR REFERENCES Dishes,             -- dish name
  PRIMARY KEY (customer,dish)
);

CREATE TABLE FavRestaurants (
  customer VARCHAR REFERENCES Users,          -- customer name
  restaurant INTEGER REFERENCES Restaurant,   -- restaurant id
  PRIMARY KEY (customer,restaurant)
);

CREATE TABLE OrderDishes (
  orderid INTEGER REFERENCES Orders,          -- order id
  dish VARCHAR REFERENCES Dishes,             -- dish
  restaurant INTEGER REFERENCES Restaurant,   -- id of restaurant that received the order
  quantity INTEGER,                           -- quantity of the dish ordered
  text VARCHAR,                               -- ingredients to remove or special requests
  PRIMARY KEY (orderid,dish)
);

CREATE TABLE Menu (
  dish VARCHAR REFERENCES Dishes,             -- dish
  restaurant INTEGER REFERENCES Restaurant,   -- restaurant id
  price FLOAT,                              -- price of the dish in euros
  PRIMARY KEY ( dish,restaurant)
);

INSERT INTO Users VALUES ("tiago", "7110eda4d09e062aa5e4a390b0a572ac0d2c0220", "Tiago Barbosa", "961234567", "Rua da Alegria 254",true);
INSERT INTO Users VALUES ("ruben", "7110eda4d09e062aa5e4a390b0a572ac0d2c0220", "Ruben Viana", "927654321", "Rua da Tristeza 521",false);
INSERT INTO Users VALUES ("martim", "7110eda4d09e062aa5e4a390b0a572ac0d2c0220", "Martim Henriques", "919876543", "Rua da Depressao 198",true);

INSERT INTO Restaurant VALUES (
  1,
  "Oporto Café",
  "Avenida D. Carlos I 8",
  "Portuguesa",
  "tiago"
);

INSERT INTO Restaurant VALUES (
  2,
  "Restaurante Portucale",
  "Rua da Alegria 598",
  "Portuguesa",
  "tiago"
);

INSERT INTO Restaurant VALUES (
  3,
  "Árvore Restaurante",
  "Rua Azevedo de Albuquerque 1",
  "Portuguesa",
  "tiago"
);

INSERT INTO Restaurant VALUES (
  4,
  "Casa Aleixo",
  "Rua da Estação 216",
  "Regional",
  "tiago"
);

INSERT INTO Restaurant VALUES (
  5,
  "Kyoto na Baixa",
  "Praça Guilherme Gomes Fernandes 56",
  "Japonesa",
  "tiago"
);

INSERT INTO Restaurant VALUES (
  6,
  "A Cozinha do Manel",
  "Rua do Heroísmo 215",
  "Portuguesa",
  "tiago"
);

INSERT INTO Restaurant VALUES (
  7,
  "Al Forno Foz",
  "Rua Adro da Foz 4",
  "Italiana",
  "tiago"
);

INSERT INTO Restaurant VALUES (
  8,
  "Gull",
  "Rua Cais das Pedras 15",
  "Japonesa",
  "tiago"
);

INSERT INTO Restaurant VALUES (
  9,
  "Pedro Lemos",
  "Rua Padre Luis Cabral 974",
  "Portuguesa",
  "tiago"
);

INSERT INTO Restaurant VALUES (
  10,
  "100 Montaditos Porto S. João",
  "Estrada da Circunvalação 7612",
  "Espanhola",
  "tiago"
);

INSERT INTO Restaurant VALUES (
  11,
  "Tia Orlanda Sabores",
  "Rua das Taipas 113",
  "Moçambicana",
  "tiago"
);

INSERT INTO Dishes VALUES (
  "Francesinha",
  1,
  "Carne"
);

INSERT INTO Dishes VALUES (
  "Bacalhau",
  2,
  "Peixe"
);

INSERT INTO Dishes VALUES (
  "Arroz de gambas",
  3,
  "Marisco"
);

INSERT INTO Dishes VALUES (
  "Moelas",
  4,
  "Entrada"
);

INSERT INTO Dishes VALUES (
  "Mousse de chocolate",
  5,
  "Sobremesa"
);

INSERT INTO Orders VALUES (
  1,
  1651243703,
  10.0,
  "received",
  "martim"
);

INSERT INTO Orders VALUES (
  2,
  1651230703,
  15.0,
  "delivered",
  "ruben"
);

INSERT INTO Review VALUES (
  1,
  1651228490,
  "Este restaurante é mid",
  4,
  "martim",
  1
);

INSERT INTO Review VALUES (
  2,
  1651290393,
  "Este restaurante é o pior do Porto",
  1,
  "ruben",
  2
);

INSERT INTO Review VALUES (
  3,
  1651228799,
  "Este restaurante é o melhor do Porto",
  5,
  "martim",
  2
);

INSERT INTO Comment VALUES (
  1,
  1651237683,
  "Obrigado pela crítica construtiva",
  1
);

INSERT INTO FavDishes VALUES (
  "martim",
  "francesinha"
);

INSERT INTO FavDishes VALUES (
  "ruben",
  "Moelas"
);

INSERT INTO FavRestaurants VALUES (
  "martim",
  1
);

INSERT INTO OrderDishes VALUES (
  1,
  "francesinha",
  1,
  1,
  "sem linguiça"
);

INSERT INTO OrderDishes VALUES (
  2,
  "Moelas",
  2,
  1,
  " "
);

INSERT INTO OrderDishes VALUES (
  2,
  "Francesinha",
  1,
  1,
  "sem ovo"
);

INSERT INTO Menu VALUES (
  "Francesinha",
  1,
  10.0
);

INSERT INTO Menu VALUES (
  "Moelas",
  2,
  5.0
);

INSERT INTO Menu VALUES (
  "Bacalhau",
  1,
  8.0
);

INSERT INTO Menu VALUES (
  "Bacalhau",
  2,
  7.5
);

INSERT INTO Menu VALUES (
  "Arroz de gambas",
  2,
  11.0
);

INSERT INTO Menu VALUES (
  "Mousse de chocolate",
  2,
  3.0
);




