Create table Users(
    id int Primary key NOT NULL AUTO_INCREMENT,
    username varchar(20),
    password varchar(20),
    email varchar(50),
    admin smallint
);

CREATE TABLE Recipes(
    id int Primary KEY NOT NULL AUTO_INCREMENT,
    title varchar(50),
    description varchar(255),
    time int,
    user_id int,
    foreign key (id) references Users(id) on delete cascade
);

CREATE TABLE Evaluation (
    user_id int not null,
    recipe_id int not null,
    evaluation smallint,
    Primary key (user_id, recipe_id),
    foreign key (user_id) references Users(id) on delete cascade,
    foreign key (recipe_id) references Recipes(id) on delete cascade
);

create table Confirmation (
    id int primary key not null AUTO_INCREMENT,
    username varchar(20),
    password varchar(20),
    email varchar(50),
    hash varchar(255)
);
