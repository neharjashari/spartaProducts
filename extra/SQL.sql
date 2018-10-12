
create database if not exists spartaproducts;

use spartaproducts;

create table products
(
	id VARCHAR(20) PRIMARY KEY NOT NULL,
	photo VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    price DECIMAL NOT NULL
);

create table orders
(
	orderId INT PRIMARY KEY AUTO_INCREMENT,
    customerName VARCHAR(255) NOT NULL,
    customerSurname VARCHAR(255) NOT NULL,
    customerEmail VARCHAR(255) NOT NULL,
    creditCard VARCHAR(255) NOT NULL,
    dateOfOrder DATETIME NOT NULL,
    totalPrice DECIMAL(10,2) NOT NULL
);

create table orderDetails
(
	orderId INT NOT NULL, 
    productId VARCHAR(255) NOT NULL,
    CONSTRAINT fkey1 FOREIGN KEY (orderId) REFERENCES orders (orderId) ON DELETE CASCADE,
    CONSTRAINT fkey2 FOREIGN KEY (productId) references products (Id)
);

create table addressOrder
(
	orderId INT NOT NULL PRIMARY KEY,
    country VARCHAR(255) NOT NULL,
    region VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    postalCode VARCHAR(255) NOT NULL,
    addressOrder TEXT NOT NULL,
    CONSTRAINT fkey3 FOREIGN KEY (orderId) REFERENCES orders(orderId) ON DELETE CASCADE
);

create table mail
(
	firstName VARCHAR(50),
    lastName VARCHAR(50),
    mailFrom VARCHAR(100),
    telephone VARCHAR(25),
    comments TEXT, 
    topic VARCHAR(255)
);

insert into products values
('laptop1','products/laptops/images/0A.jpg','Laptop ASUS Transformer 3 Pro',820),
('laptop2','products/laptops/images/1A.jpg','Notebook Dell XPS ',1400),
('laptop3','products/laptops/images/2A.jpg','Apple MacBook 12 ',1450),
('laptop4','products/laptops/images/3A.jpg','Notebook Acer Extensa 15',450),
('laptop5','products/laptops/images/4A.jpg','Laptop Lenovo IdeaPad',380),
('laptop6','products/laptops/images/5A.jpg','Laptop Fujitsu Lifebook',530),
('laptop7','products/laptops/images/6A.jpg','Laptop HP ZBook',1260),
('laptop8','products/laptops/images/7A.jpg','Laptop ASUS UX390UA-GS031R',1400);

insert into products values
('smartphone1','products/smartphones/images/0A.jpg','ASUS ZenFone 3 Zoom',550),
('smartphone2','products/smartphones/images/1A.jpg','Google Pixel 2',730),
('smartphone3','products/smartphones/images/2A.jpg','Iphone X',1450),
('smartphone4','products/smartphones/images/3A.jpg','LG V30',819),
('smartphone5','products/smartphones/images/4A.jpg','OnePlus 5T',760),
('smartphone6','products/smartphones/images/5A.jpg','Samsung Galaxy S8+',680),
('smartphone7','products/smartphones/images/7A.jpg','Samsung Galaxy Note 8',930),
('smartphone8','products/smartphones/images/8A.jpg','Sony Xperia XZ1',580);

insert into products values
('desktop1','products/desktops/images/desktop1A.jpg','HP Elite 8000',98),
('desktop2','products/desktops/images/desktop2A.jpg','Dell OptiPlex 990',167),
('desktop3','products/desktops/images/desktop3A.jpg','Acer Veriton X',210),
('desktop4','products/desktops/images/desktop4A.jpg','Lenovo 310S',240),
('desktop5','products/desktops/images/desktop5A.jpg','HP Pavilion',290),
('desktop6','products/desktops/images/desktop6A.jpg','Premium Lenovo IdeaCentre Y900',320),
('desktop7','products/desktops/images/desktop7A.jpg','Dell Inspiron 5675 AMD',275),
('desktop8','products/desktops/images/desktop8A.jpg','Lenovo H50 Premium',400);

insert into products values
('tablet1','products/tablets/images/tablet1A.jpg','Samsung Galaxty E Lite 7',560),
('tablet2','products/tablets/images/tablet2A.jpg','Fire HD 8',390),
('tablet3','products/tablets/images/tablet3A.jpg','BlackBerry Playbook',425),
('tablet4','products/tablets/images/tablet4A.jpg','Acer Iconia',755),
('tablet5','products/tablets/images/tablet5A.jpg','NeuTab 7',890),
('tablet6','products/tablets/images/tablet6A.jpg','Yuntab Android',610),
('tablet7','products/tablets/images/tablet7A.jpg','Samsung Galaxy A',840),
('tablet8','products/tablets/images/tablet8A.jpg','Dragon Touch X10',1120);

insert into products values
('merch1','products/merchandise/images/hoodiefA.png','Hoodie for females',75),
('merch2','products/merchandise/images/duksi1A.png','Crewneck Sweatshirt for Males',49),
('merch3','products/merchandise/images/duksi2A.png','Sweatshirt for Males',37),
('merch4','products/merchandise/images/hoodieA.png','Hoodie for Males',96),
('merch5','products/merchandise/images/tshirtA.png','T-shirt for Males',18),
('merch6','products/merchandise/images/tshirtfA.png','T-shirt for Females',24),
('merch7','products/merchandise/images/zipper1A.png','Zipper for Males',76),
('merch8','products/merchandise/images/zipper2A.png','Full Zip Sweatshirt for Males',119);


select * from orders;
select * from orderdetails;
select * from addressOrder;
select * from mail;

#==========================================================================
#==========================================================================
#==========================================================================

use world;

INSERT INTO country VALUES ('KOS','Kosovo','Europe','Southeast Europe',10887,'2008','1700000',55.3,63.2,66.5,'Kosove','Republic','Hashim Thaci',null,'KS');
INSERT INTO city VALUES(4422,'Prishtina','KOS','Kosove Lindore',110000);
INSERT INTO city VALUES(4423,'Prizren','KOS','Kosove Jugore',54000);
INSERT INTO city VALUES(4424,'Gjakove','KOS','Kosove Perendimore',44000);
INSERT INTO city VALUES(4425,'Peje','KOS','Kosove Perendimore',21000);

INSERT INTO city VALUES(4426,'Shkoder','ALB','Shqiperi Veriore',135000);
INSERT INTO city VALUES(4427,'Kukes','ALB','Shqiperi Veriore',16000);
INSERT INTO city VALUES(4428,'Vlore','ALB','Shqiperi Jugore',225000);
INSERT INTO city VALUES(4429,'Berat','ALB','Shqiperi Jugore',60000);