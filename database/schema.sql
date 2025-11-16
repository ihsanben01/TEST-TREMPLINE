CREATE TABLE contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    civilite VARCHAR(10) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(50)   NOT NULL,
    type_message VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE disponibilites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contact_id INT,
    jour VARCHAR(20),
    heur VARCHAR(10),
    minute VARCHAR(10),
    FOREIGN KEY (contact_id) REFERENCES contact(id) ON DELETE CASCADE
);
