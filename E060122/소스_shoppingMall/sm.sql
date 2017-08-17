-- 데이터베이스 생성시에 문자 셋팅 방법
-- create database  DB명 character set utf8 collate utf8_general_ci;
create database sm character set utf8 collate utf8_general_ci;

use sm;

/*--고객 테이블---------------------------------*/
create table customers
(
    custom_id int unsigned not null auto_increment primary key,
    name varchar(20) not null,
    address varchar(100) not null,
    zipcode varchar(10)
) 

#--주문 테이블----------------------------------
create table orders
(
    order_id int unsigned not null auto_increment primary key,
    custom_id int unsigned not null references customers(custom_id),
    amount int unsigned,
    date date not null,
    order_status varchar(10),
    ship_name varchar(50) not null,
    ship_address varchar(100) not null,
    ship_zipcode varchar(10)
)

#--상품(책) 테이블---------------------------------
create table books
(
    isbn varchar(10) not null primary key,
    author varchar(50),
    title varchar(100),
    cat_id int unsigned,
    price int unsigned not null,
    description varchar(255)
)

#--카테고리 테이블------------------------------------
create table categories
(
    cat_id int unsigned not null auto_increment primary key,
    cat_name varchar(50) not null
)

#--주문 항목 테이블------------------------------------
create table order_items
(
    order_id int unsigned not null references orders(order_id),
    isbn varchar(10) not null references books(isbn),
    item_price int unsigned not null,
    quantity tinyint unsigned not null,
    primary key (order_id, isbn)
)

#--관리자 테이블---------------------------------------
create table admin
(
    username varchar(20) not null primary key,
    password varchar(40) not null
)





