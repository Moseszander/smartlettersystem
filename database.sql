use `project`;

CREATE TABLE IF NOT EXISTS department (
    department_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    head VARCHAR(225) NOT NULL
);


CREATE TABLE IF NOT EXISTS levels (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    post VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL
);

CREATE TABLE IF NOT EXISTS staffs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(10) NOT NULL,
    level_id INT NOT NULL,
    department_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (level_id) REFERENCES levels(id),
    FOREIGN KEY (department_id) REFERENCES department(department_id)
);


CREATE TABLE IF NOT EXISTS uploaded_docs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    source_person VARCHAR(255) NOT NULL,
    received_at TIMESTAMP NOT NULL,
    staff_id INT ,
    department_id INT NOT NULL,
    
    FOREIGN KEY (staff_id) REFERENCES staffs(id),
    FOREIGN KEY (department_id) REFERENCES department(department_id)
);

CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    message VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    uploaded_docs_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (sender_id) REFERENCES staffs(id),
    FOREIGN KEY (receiver_id) REFERENCES staffs(id),
    FOREIGN KEY (uploaded_docs_id) REFERENCES uploaded_docs(id)
);



