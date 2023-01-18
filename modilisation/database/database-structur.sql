create database if not exists planet_dev;
use planet_dev;

create table if not exists admin(
    `id` int(11) primary key auto_increment,
    `first_name` varchar(255) not null,
    `last_name` varchar(255) not null,
    `email` varchar(255) not null,
    `password` varchar(255) not null
);

create table if not exists `user`(
    `id` int(11) primary key auto_increment,
    `first_name` varchar(255) not null,
    `last_name` varchar(255) not null,
    `email` varchar(255) not null,
    `password` varchar(255) not null
);

create table if not exists author(
    `id` int(11) primary key auto_increment,
    `first_name` varchar(255) not null,
    `last_name` varchar(255) not null
);

create table if not exists category(
    `id` int(11) primary key auto_increment,
    `name` varchar(255) not null
);

create table if not exists article(
    `id` int(11) primary key auto_increment,
    `title` varchar(255) not null ,
    `content` TEXT not null, -- BLOB binary large object
    `published_date` date not null,
    `category_id` int(11) not null ,
    `author_id` int(11) not null ,

    constraint fk_article_category foreign key(`category_id`) references `category` (`id`),
    constraint fk_article_author foreign key(`author_id`) references `author` (`id`)
);
