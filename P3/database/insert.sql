USE SIBW;

INSERT INTO Actividad(photo, title, price, date, autor, descr)
    VALUES("../images/ruta1.jpeg", 'Excursion por las cuevas de granada', 20.5, NOW(), 'Alejandro Soriano Morante',
        '¡Explorar las cuevas en Granada es una experiencia fascinante que te sumerge en la historia y la geología 
        de esta región única! Al aventurarte por las profundidades de estas cavernas milenarias, te adentras en un 
        mundo subterráneo lleno de maravillas naturales y secretos ocultos.
        El recorrido comienza con la emocionante entrada a las cuevas, donde te reciben las impresionantes formaciones rocosas 
        que se han ido moldeando a lo largo de incontables años. Con cada paso que das, te encuentras con estalactitas y estalagmitas 
        que parecen talladas por la mano de un artista paciente. La atmósfera en el interior es fresca y tranquila, envolviéndote en un 
        silencio casi místico que contrasta con el bullicio del mundo exterior.
        A medida que avanzas, tu guía te llevará a través de pasajes estrechos y salas cavernosas, compartiendo contigo la historia detrás 
        de cada formación y revelando los misterios que encierran estas antiguas cuevas. Descubrirás cómo han sido utilizadas por diferentes
        culturas a lo largo de los siglos, desde refugios prehistóricos hasta escenarios de rituales religiosos.
        Entre las maravillas que encontrarás en tu camino se encuentran antiguas pinturas rupestres que narran historias de tiempos pasados, 
        así como impresionantes galerías iluminadas por la luz filtrada que se cuela desde la superficie. En ciertos momentos, te sentirás como 
        si estuvieras explorando un mundo completamente ajeno, sumergido en la oscuridad y la grandeza de la naturaleza.
        Al final de tu excursión, emergirás de las profundidades de la tierra con una nueva apreciación por la belleza y la majestuosidad de las 
        cuevas de Granada. Esta experiencia única te dejará con recuerdos inolvidables y una profunda conexión con el increíble mundo subterráneo que yace 
        justo debajo de tus pies.');


INSERT INTO Actividad(photo, title, price, date, autor)
    VALUES("../images/foto_act2.jpg", 'Excursion por los senderos de la sierra', 20.5, NOW()+1, 'Alejandro Soriano Morante');
INSERT INTO Actividad(photo, title, price, date, autor)
    VALUES("../images/foto_act3.jpeg", 'Picnic en los lagos de la sierra', 20.5, NOW()+1, 'Alejandro Soriano Morante');
INSERT INTO Actividad(photo, title, price, date, autor)
    VALUES("../images/foto_act4.jpeg", 'Actividad en los montes de los pueblos de la sierra', 20.5, NOW()+1, 'Alejandro Soriano Morante');
INSERT INTO Actividad(photo, title, price, date, autor)
    VALUES("../images/foto_act5.jpeg", 'Caminata por los jatdines de la Alhambra', 20.5, NOW()+1, 'Alejandro Soriano Morante');
INSERT INTO Actividad(photo, title, price, date, autor)
    VALUES("../images/foto_act6.jpeg", 'Visitia a los lagos de la sierra', 20.5, NOW()+1, 'Alejandro Soriano Morante');
INSERT INTO Actividad(photo, title, price, date, autor)
    VALUES("../images/foto_act7.jpeg", 'Caminata por los senderos entre los montes', 20.5, NOW()+1, 'Alejandro Soriano Morante');
INSERT INTO Actividad(photo, title, price, date, autor)
    VALUES("../images/foto_act8.jpeg", 'Visita a los rios de Granada', 20.5, NOW()+1, 'Alejandro Soriano Morante');
INSERT INTO Actividad(photo, title, price, date, autor)
    VALUES("../images/foto_act9.jpeg", 'Visita a las cataratas de Granada', 20.5, NOW()+1, 'Alejandro Soriano Morante');





INSERT INTO Palabras_prohibidas(palabra) VALUES ('tonto');
INSERT INTO Palabras_prohibidas(palabra) VALUES ('estafa');
INSERT INTO Palabras_prohibidas(palabra) VALUES ('mierda');
INSERT INTO Palabras_prohibidas(palabra) VALUES ('puto');
INSERT INTO Palabras_prohibidas(palabra) VALUES ('imbecil');
INSERT INTO Palabras_prohibidas(palabra) VALUES ('callate');
INSERT INTO Palabras_prohibidas(palabra) VALUES ('aaaaaa');
INSERT INTO Palabras_prohibidas(palabra) VALUES ('bbbbbb');
INSERT INTO Palabras_prohibidas(palabra) VALUES ('cccccc');
INSERT INTO Palabras_prohibidas(palabra) VALUES ('ddddd');


INSERT INTO Galeria(Id_Actividad, photo) VALUES (1, "../images/cuevas2.jpeg");


INSERT INTO Usuarios(nombre, email, contraseña, role)
    VALUES("Alex", "alex@gmail.com", "alex", "SUPER");