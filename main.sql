CREATE TABLE IF NOT EXISTS departments (
    id INT AUTO_INCREMENT,
    name varchar(255) not null,
    post varchar(255) not null,
    created_at timestamp not null default now(),

    PRIMARY KEY (id)
);

create table if not exists staffs (
    id INT,
    name varchar(255) not null,
    email varchar(255) not null,
    password varchar(255) not null,
    department_id int not null,
    created_at timestamp not null default now(),

    PRIMARY KEY (id),
    FOREIGN KEY (department_id) references departments(id)
);

create table if not exists uploaded_docs (
    id INT AUTO_INCREMENT,
    title varchar(255) not null,
    file_path varchar(255) not null,
    source_person varchar(255) not null,
    received_at timestamp not null,
    staff_id int null,
    created_at timestamp not null default now(),

    PRIMARY KEY (id),
    FOREIGN KEY (staff_id) references staffs(id)
);

create table if not exists notification(
    id INT AUTO_INCREMENT,
    sender_id int not null,
    receiver_id int not null,
    message varchar(255) not null,
    file_path varchar(255) not null,
    created_at timestamp not null default now(),

    PRIMARY KEY (id),
    FOREIGN KEY (sender_id) references staffs(id),
    FOREIGN KEY (receiver_id) references staffs(id)
);