USE SIBW;



CREATE TABLE Usuarios
(
    Id_Usuario INT AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(100) NOT NULL,
    role ENUM('REGISTRADO', 'MODERADOR', 'SUPER') NOT NULL DEFAULT ('REGISTRADO'),
    PRIMARY KEY(Id_Usuario)
);


CREATE TABLE Actividad
(
    Id_Actividad INT AUTO_INCREMENT,
    photo VARCHAR(50),
    title VARCHAR(100) NOT NULL,
    price FLOAT,
    date DATE NOT NULL,
    autor VARCHAR(100) REFERENCES Usuarios(email),
    descr VARCHAR(3000),
    PRIMARY KEY(Id_Actividad)
);



CREATE TABLE Palabras_prohibidas
(
    Id_Palabra INT AUTO_INCREMENT,
    palabra VARCHAR(30) NOT NULL UNIQUE,
    PRIMARY KEY(Id_Palabra)
);


CREATE TABLE Comentarios
(
    Id_Comentario INT AUTO_INCREMENT,
    Id_Actividad INT NOT NULL,
    comment VARCHAR(300) NOT NULL,
    date DATE NOT NULL,
    author VARCHAR(100) NOT NULL,
    FOREIGN KEY (Id_Actividad) REFERENCES Actividad (Id_Actividad) on delete CASCADE,
    FOREIGN KEY (author) REFERENCES Usuarios (email) on delete CASCADE,
    PRIMARY KEY(Id_Comentario)
);


CREATE TABLE Galeria
(
 Id INT AUTO_INCREMENT,
 Id_Actividad INT NOT NULL,
 photo VARCHAR(100) NOT NULL,
 PRIMARY KEY(Id),
FOREIGN KEY (Id_Actividad) REFERENCES Actividad (Id_Actividad) on delete CASCADE
);