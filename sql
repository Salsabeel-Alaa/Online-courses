
create table users (user_id int not null auto_increment primary key,
                       user_name varchar(30),
                       first_name varchar(15),
                       last_name varchar(15),
                       email varchar(30),
                       password varchar(40)
                     );

create table admin (admin_id int not null auto_increment primary key,
                       admin_name varchar(50),
                       admin_email varchar(50),
                       password varchar(40)
                     );


insert into admin values (1, 'admin', 'admin@gmail.com', SHA('root'));

create table category (category_id int not null auto_increment primary key,
                       category_name varchar(30)
                     );

insert into category (category_name) values('physics');
insert into category (category_name) values('Computer Science');
insert into category (category_name) values('geophysics');


create table courses (
                      course_id int not null auto_increment primary key,
                      course_name varchar(150),
                      thumbnail varchar (64),
                      category_id int not null,
                      instructor_name varchar(50),
                      date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
