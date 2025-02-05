-- Crear la base de datos
CREATE DATABASE zap_rails;

USE zap_rails;

-- Crear la tabla USUARIS
CREATE TABLE USUARIS (
    usuari VARCHAR(50) PRIMARY KEY NOT NULL,
    contrasenya VARCHAR(50) NOT NULL,
    tipus BIT NOT NULL
);

-- Crear la tabla ESTACIONS
CREATE TABLE ESTACIONS (
    ID_estacio VARCHAR(6) PRIMARY KEY NOT NULL,
    Nom VARCHAR(50) NOT NULL,
    Ciutat VARCHAR(20) NOT NULL,
    Numero_vies INT NOT NULL
);

-- Crear la tabla COTXERES
CREATE TABLE COTXERES (
    ID_cotxeres VARCHAR(6) PRIMARY KEY NOT NULL,
    Nom VARCHAR(50) NOT NULL,
    Provincia VARCHAR(20) NOT NULL,
    Capacitat INT NOT NULL
);

-- Crear la tabla TRENS
CREATE TABLE VIATGES (
    ID_viatge VARCHAR(6) PRIMARY KEY NOT NULL,
    Tren VARCHAR(10) NOT NULL,
    Origen VARCHAR(20) NOT NULL,
    Desti VARCHAR(20) NOT NULL,
    Dia_hora DATETIME NOT NULL,
	ID_estacio VARCHAR(6),
	ID_cotxeres VARCHAR(6),
    FOREIGN KEY (ID_estacio) REFERENCES ESTACIONS (ID_estacio),	
    FOREIGN KEY (ID_cotxeres) REFERENCES COTXERES (ID_cotxeres)
);

-- Crear la tabla PERSONAL
CREATE TABLE PERSONAL (
    ID_personal VARCHAR(6) PRIMARY KEY NOT NULL,
    Nom VARCHAR(50) NOT NULL,
	Cognom Varchar(50) NOT NULL,
    DNI VARCHAR(9) NOT NULL,
    Data_naixement DATE NOT NULL,
    Telefon VARCHAR(14),
    Email VARCHAR(250),
    CP VARCHAR(6),
	ID_estacio VARCHAR(6),
	ID_cotxeres VARCHAR(6),
	ID_viatge VARCHAR(6),
	usuari VARCHAR(50),
	FOREIGN KEY (usuari) REFERENCES USUARIS (usuari),
    FOREIGN KEY (ID_estacio) REFERENCES ESTACIONS (ID_estacio),	
    FOREIGN KEY (ID_cotxeres) REFERENCES COTXERES (ID_cotxeres),
	FOREIGN KEY (ID_viatge) REFERENCES VIATGES (ID_viatge)
);

-- Crear la tabla BITLLETS
CREATE TABLE BITLLETS (
    ID_billet INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    Tipus VARCHAR(15),
    Dia DATE NOT NULL,
    Estat VARCHAR(15) NOT NULL,
    Viatgers INT NOT NULL,
	ID_viatge VARCHAR(6),
	FOREIGN KEY (ID_viatge) REFERENCES VIATGES (ID_viatge)
);

-- Crear la tabla SUBSCRIPCIO
CREATE TABLE SUBSCRIPCIO (
    ID_sub VARCHAR(6) PRIMARY KEY NOT NULL,
    Pla VARCHAR(10) NOT NULL,
    Preu DECIMAL(10,2) NOT NULL
);

-- Crear la tabla CLIENTS
CREATE TABLE CLIENTS (
    ID_client INT AUTO_INCREMENT PRIMARY KEY,
    Nom VARCHAR(10) NOT NULL,
	Cognom Varchar(50) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Data_naixement DATE NOT NULL,
    CP VARCHAR(6),
    ID_billet INT,
    ID_sub VARCHAR(6),
	usuari VARCHAR(50),
	FOREIGN KEY (usuari) REFERENCES USUARIS (usuari),
    FOREIGN KEY (ID_billet) REFERENCES BITLLETS (ID_billet),
    FOREIGN KEY (ID_sub) REFERENCES SUBSCRIPCIO (ID_sub)
);

-- Inserts para la tabla USUARIS
INSERT INTO USUARIS (usuari, contrasenya, tipus) VALUES
('admin1', 'bemen3', 1),
('admin2', 'bemen3', 1),
('admin3', 'bemen3', 1),
('admin4', 'bemen3', 1),
('admin5', 'bemen3', 1),
('admin6', 'bemen3', 1),
('admin7', 'bemen3', 1),
('admin8', 'bemen3', 1),
('admin9', 'bemen3', 1),
('admin10', 'bemen3', 1),
('cliente1', 'bemen3', 0),
('cliente2', 'bemen3', 0),
('cliente3', 'bemen3', 0),
('cliente4', 'bemen3', 0),
('cliente5', 'bemen3', 0),
('cliente6', 'bemen3', 0),
('cliente7', 'bemen3', 0),
('cliente8', 'bemen3', 0),
('cliente9', 'bemen3', 0),
('cliente10', 'bemen3', 0);

-- Inserts para la tabla ESTACIONS
INSERT INTO ESTACIONS (ID_estacio, Nom, Ciutat, Numero_vies) VALUES
('EST001', 'Sants', 'Barcelona', 6),
('EST002', 'Estacion Norte', 'Madrid', 8),
('EST003', 'Santa Justa', 'Sevilla', 5),
('EST004', 'Joaquín Sorolla', 'Valencia', 4),
('EST005', 'Estacion Este', 'Bilbao', 3),
('EST006', 'Delicias', 'Zaragoza', 7),
('EST007', 'Estacion Centro', 'Malaga', 5),
('EST008', 'Terminal', 'Alicante', 4),
('EST009', 'Estacion Oriental', 'Murcia', 3),
('EST010', 'Estacion del Sur', 'Granada', 6),
('EST011', 'Los Llanos', 'Albacete', 4),
('EST012', 'Santa Ana', 'Antequera', 5),
('EST013', 'Camp de Tarragona', 'Tarragona', 6);

-- Inserts para la tabla COTXERES
INSERT INTO COTXERES (ID_cotxeres, Nom, Provincia, Capacitat) VALUES
('COT001', 'Cochera A', 'Barcelona', 100),
('COT002', 'Cochera B', 'Madrid', 120),
('COT003', 'Cochera C', 'Sevilla', 80),
('COT004', 'Cochera D', 'Valencia', 90),
('COT005', 'Cochera E', 'Bilbao', 110),
('COT006', 'Cochera F', 'Zaragoza', 95),
('COT007', 'Cochera G', 'Malaga', 75),
('COT008', 'Cochera H', 'Alicante', 85),
('COT009', 'Cochera I', 'Murcia', 105),
('COT010', 'Cochera J', 'Granada', 88);

-- Inserts para la tabla VIATGES
INSERT INTO VIATGES (ID_viatge, Tren, Origen, Desti, Dia_hora, ID_estacio, ID_cotxeres) VALUES
('VIA001', 'Tren1', 'Albacete', 'Madrid', '2024-02-20 10:00:00', 'EST001', 'COT002'),
('VIA002', 'Tren2', 'Alicante', 'Valencia', '2024-02-20 11:00:00', 'EST008', 'COT004'),
('VIA003', 'Tren3', 'Antequera', 'Sevilla', '2024-02-20 12:00:00', 'EST003', 'COT003'),
('VIA004', 'Tren4', 'Barcelona', 'Madrid', '2024-02-20 13:00:00', 'EST001', 'COT001'),
('VIA005', 'Tren5', 'Cuenca', 'Valencia', '2024-02-20 14:00:00', 'EST011', 'COT004'),
('VIA006', 'Tren6', 'Córdoba', 'Sevilla', '2024-02-20 15:00:00', 'EST012', 'COT003'),
('VIA007', 'Tren7', 'Madrid', 'Barcelona', '2024-02-20 16:00:00', 'EST002', 'COT001'),
('VIA008', 'Tren8', 'Sevilla', 'Antequera', '2024-02-20 17:00:00', 'EST003', 'COT003'),
('VIA009', 'Tren9', 'Tarragona', 'Barcelona', '2024-02-20 18:00:00', 'EST013', 'COT001'),
('VIA010', 'Tren10', 'Valencia', 'Alicante', '2024-02-20 19:00:00', 'EST004', 'COT004'),
('VIA011', 'Tren11', 'Zaragoza', 'Barcelona', '2024-02-20 20:00:00', 'EST006', 'COT001'),
('VIA012', 'Tren12', 'Albacete', 'Madrid', '2024-02-21 10:00:00', 'EST001', 'COT002'),
('VIA013', 'Tren13', 'Albacete', 'Valencia', '2024-02-21 11:00:00', 'EST001', 'COT004'),
('VIA014', 'Tren14', 'Albacete', 'Barcelona', '2024-02-21 12:00:00', 'EST001', 'COT001'),
('VIA015', 'Tren15', 'Albacete', 'Sevilla', '2024-02-21 13:00:00', 'EST001', 'COT003'),
('VIA016', 'Tren16', 'Alicante', 'Madrid', '2024-02-21 14:00:00', 'EST008', 'COT002'),
('VIA017', 'Tren17', 'Alicante', 'Valencia', '2024-02-21 15:00:00', 'EST008', 'COT004'),
('VIA018', 'Tren18', 'Alicante', 'Barcelona', '2024-02-21 16:00:00', 'EST008', 'COT001'),
('VIA019', 'Tren19', 'Alicante', 'Sevilla', '2024-02-21 17:00:00', 'EST008', 'COT003'),
('VIA020', 'Tren20', 'Antequera', 'Madrid', '2024-02-21 18:00:00', 'EST003', 'COT002'),
('VIA021', 'Tren21', 'Antequera', 'Valencia', '2024-02-21 19:00:00', 'EST003', 'COT004'),
('VIA022', 'Tren22', 'Antequera', 'Barcelona', '2024-02-21 20:00:00', 'EST003', 'COT001'),
('VIA023', 'Tren23', 'Antequera', 'Sevilla', '2024-02-21 21:00:00', 'EST003', 'COT003'),
('VIA024', 'Tren24', 'Albacete', 'Madrid', '2024-02-22 10:00:00', 'EST001', 'COT002'),
('VIA025', 'Tren25', 'Albacete', 'Valencia', '2024-02-22 11:00:00', 'EST001', 'COT004'),
('VIA026', 'Tren26', 'Albacete', 'Barcelona', '2024-02-22 12:00:00', 'EST001', 'COT001'),
('VIA027', 'Tren27', 'Albacete', 'Sevilla', '2024-02-22 13:00:00', 'EST001', 'COT003'),
('VIA028', 'Tren28', 'Alicante', 'Madrid', '2024-02-22 14:00:00', 'EST008', 'COT002'),
('VIA029', 'Tren29', 'Alicante', 'Valencia', '2024-02-22 15:00:00', 'EST008', 'COT004'),
('VIA030', 'Tren30', 'Alicante', 'Barcelona', '2024-02-22 16:00:00', 'EST008', 'COT001'),
('VIA031', 'Tren31', 'Alicante', 'Sevilla', '2024-02-22 17:00:00', 'EST008', 'COT003'),
('VIA032', 'Tren32', 'Antequera', 'Madrid', '2024-02-22 18:00:00', 'EST003', 'COT002'),
('VIA033', 'Tren33', 'Antequera', 'Valencia', '2024-02-22 19:00:00', 'EST003', 'COT004'),
('VIA034', 'Tren34', 'Antequera', 'Barcelona', '2024-02-22 20:00:00', 'EST003', 'COT001'),
('VIA035', 'Tren35', 'Antequera', 'Sevilla', '2024-02-22 21:00:00', 'EST003', 'COT003'),
('VIA036', 'Tren36', 'Barcelona', 'Madrid', '2024-02-22 22:00:00', 'EST001', 'COT002'),
('VIA037', 'Tren37', 'Barcelona', 'Valencia', '2024-02-22 23:00:00', 'EST001', 'COT004'),
('VIA038', 'Tren38', 'Barcelona', 'Alicante', '2024-02-23 10:00:00', 'EST001', 'COT001'),
('VIA039', 'Tren39', 'Barcelona', 'Sevilla', '2024-02-23 11:00:00', 'EST001', 'COT003'),
('VIA040', 'Tren40', 'Cuenca', 'Madrid', '2024-02-23 12:00:00', 'EST011', 'COT002'),
('VIA041', 'Tren41', 'Cuenca', 'Valencia', '2024-02-23 13:00:00', 'EST011', 'COT004'),
('VIA042', 'Tren42', 'Cuenca', 'Barcelona', '2024-02-23 14:00:00', 'EST011', 'COT001'),
('VIA043', 'Tren43', 'Cuenca', 'Sevilla', '2024-02-23 15:00:00', 'EST011', 'COT003'),
('VIA044', 'Tren44', 'Córdoba', 'Madrid', '2024-02-23 16:00:00', 'EST012', 'COT002'),
('VIA045', 'Tren45', 'Córdoba', 'Valencia', '2024-02-23 17:00:00', 'EST012', 'COT004'),
('VIA046', 'Tren46', 'Córdoba', 'Barcelona', '2024-02-23 18:00:00', 'EST012', 'COT001'),
('VIA047', 'Tren47', 'Córdoba', 'Sevilla', '2024-02-23 19:00:00', 'EST012', 'COT003'),
('VIA048', 'Tren48', 'Madrid', 'Barcelona', '2024-02-23 20:00:00', 'EST002', 'COT001'),
('VIA049', 'Tren49', 'Madrid', 'Valencia', '2024-02-23 21:00:00', 'EST002', 'COT004'),
('VIA050', 'Tren50', 'Madrid', 'Alicante', '2024-02-23 22:00:00', 'EST002', 'COT001'),
('VIA051', 'Tren51', 'Madrid', 'Sevilla', '2024-02-23 23:00:00', 'EST002', 'COT003'),
('VIA052', 'Tren52', 'Sevilla', 'Madrid', '2024-02-24 10:00:00', 'EST003', 'COT002'),
('VIA053', 'Tren53', 'Sevilla', 'Valencia', '2024-02-24 11:00:00', 'EST003', 'COT004'),
('VIA054', 'Tren54', 'Sevilla', 'Alicante', '2024-02-24 12:00:00', 'EST003', 'COT001'),
('VIA055', 'Tren55', 'Sevilla', 'Barcelona', '2024-02-24 13:00:00', 'EST003', 'COT003'),
('VIA056', 'Tren56', 'Tarragona', 'Madrid', '2024-02-24 14:00:00', 'EST013', 'COT002'),
('VIA057', 'Tren57', 'Tarragona', 'Valencia', '2024-02-24 15:00:00', 'EST013', 'COT004'),
('VIA058', 'Tren58', 'Tarragona', 'Alicante', '2024-02-24 16:00:00', 'EST013', 'COT001'),
('VIA059', 'Tren59', 'Tarragona', 'Sevilla', '2024-02-24 17:00:00', 'EST013', 'COT003'),
('VIA060', 'Tren60', 'Valencia', 'Madrid', '2024-02-24 18:00:00', 'EST004', 'COT002'),
('VIA061', 'Tren61', 'Valencia', 'Barcelona', '2024-02-24 19:00:00', 'EST004', 'COT001'),
('VIA062', 'Tren62', 'Valencia', 'Cuenca', '2024-02-24 20:00:00', 'EST004', 'COT003'),
('VIA063', 'Tren63', 'Valencia', 'Córdoba', '2024-02-24 21:00:00', 'EST004', 'COT003'),
('VIA064', 'Tren64', 'Zaragoza', 'Madrid', '2024-02-24 22:00:00', 'EST006', 'COT002'),
('VIA065', 'Tren65', 'Zaragoza', 'Barcelona', '2024-02-24 23:00:00', 'EST006', 'COT001'),
('VIA066', 'Tren66', 'Zaragoza', 'Alicante', '2024-02-25 10:00:00', 'EST006', 'COT003'),
('VIA067', 'Tren67', 'Zaragoza', 'Valencia', '2024-02-25 11:00:00', 'EST006', 'COT004'),
('VIA068', 'Tren68', 'Bilbao', 'Madrid', '2024-02-25 12:00:00', 'EST005', 'COT002'),
('VIA069', 'Tren69', 'Bilbao', 'Barcelona', '2024-02-25 13:00:00', 'EST005', 'COT001'),
('VIA070', 'Tren70', 'Bilbao', 'Valencia', '2024-02-25 14:00:00', 'EST005', 'COT004'),
('VIA071', 'Tren71', 'Bilbao', 'Sevilla', '2024-02-25 15:00:00', 'EST005', 'COT003'),
('VIA072', 'Tren72', 'Málaga', 'Madrid', '2024-02-25 16:00:00', 'EST007', 'COT002'),
('VIA073', 'Tren73', 'Málaga', 'Barcelona', '2024-02-25 17:00:00', 'EST007', 'COT001'),
('VIA074', 'Tren74', 'Málaga', 'Valencia', '2024-02-25 18:00:00', 'EST007', 'COT004'),
('VIA075', 'Tren75', 'Málaga', 'Alicante', '2024-02-25 19:00:00', 'EST007', 'COT001'),
('VIA076', 'Tren76', 'Murcia', 'Madrid', '2024-02-25 20:00:00', 'EST009', 'COT002'),
('VIA077', 'Tren77', 'Murcia', 'Barcelona', '2024-02-25 21:00:00', 'EST009', 'COT001'),
('VIA078', 'Tren78', 'Murcia', 'Valencia', '2024-02-25 22:00:00', 'EST009', 'COT004'),
('VIA079', 'Tren79', 'Murcia', 'Alicante', '2024-02-25 23:00:00', 'EST009', 'COT001'),
('VIA080', 'Tren80', 'Granada', 'Madrid', '2024-02-26 10:00:00', 'EST010', 'COT002'),
('VIA081', 'Tren81', 'Granada', 'Barcelona', '2024-02-26 11:00:00', 'EST010', 'COT001'),
('VIA082', 'Tren82', 'Granada', 'Valencia', '2024-02-26 12:00:00', 'EST010', 'COT004'),
('VIA083', 'Tren83', 'Granada', 'Alicante', '2024-02-26 13:00:00', 'EST010', 'COT001');

-- Inserts para la tabla PERSONAL
INSERT INTO PERSONAL (ID_personal, Nom, Cognom, DNI, Data_naixement, Telefon, Email, CP, ID_estacio, ID_cotxeres, ID_viatge, usuari) VALUES
('PER001', 'Juan', 'Gomez', '12345678A', '1990-05-15', '123456789', 'juan@gmail.com', '08001', 'EST001', 'COT001', 'VIA001', 'admin1'),
('PER002', 'Maria', 'Lopez', '87654321B', '1985-07-20', '987654321', 'maria@yahoo.com', '28002', 'EST002', 'COT002', 'VIA002', 'admin2'),
('PER003', 'Pedro', 'Rodriguez', '56789012C', '1992-02-10', '567890123', 'pedro@hotmail.com', '41003', 'EST003', 'COT003', 'VIA003', 'admin3'),
('PER004', 'Ana', 'Fernandez', '09876543D', '1988-12-05', '098765432', 'ana@gmail.com', '46004', 'EST004', 'COT004', 'VIA004', 'admin4'),
('PER005', 'Carlos', 'Martinez', '34567890E', '1995-09-18', '345678901', 'carlos@yahoo.com', '48005', 'EST005', 'COT005', 'VIA005', 'admin5'),
('PER006', 'Laura', 'Sanchez', '23456789F', '1983-04-25', '234567890', 'laura@hotmail.com', '50006', 'EST006', 'COT006', 'VIA006', 'admin6'),
('PER007', 'David', 'Perez', '67890123G', '1998-11-30', '678901234', 'david@gmail.com', '29007', 'EST007', 'COT007', 'VIA007', 'admin7'),
('PER008', 'Isabel', 'Garcia', '45678901H', '1980-08-14', '456789012', 'isabel@yahoo.com', '03008', 'EST008', 'COT008', 'VIA008', 'admin8'),
('PER009', 'Alejandro', 'Rios', '76543210I', '1993-06-22', '765432109', 'alejandro@hotmail.com', '07009', 'EST009', 'COT009', 'VIA009', 'admin9'),
('PER010', 'Elena', 'Moreno', '32109876J', '1986-03-07', '321098765', 'elena@gmail.com', '18010', 'EST010', 'COT010', 'VIA010', 'admin10');

-- Inserts para la tabla BITLLETS
INSERT INTO BITLLETS (Tipus, Dia, Estat, Viatgers, ID_viatge) VALUES
('Normal', '2024-01-24', 'Actiu', '1', 'VIA001'),
('Especial', '2024-01-25', 'Cancel·lat', '1', 'VIA002'),
('VIP', '2024-01-26', 'Actiu', '1', 'VIA003'),
('Normal', '2024-01-27', 'Actiu', '1', 'VIA004'),
('Especial', '2024-01-28', 'Cancel·lat', '1', 'VIA005'),
('VIP', '2024-01-29', 'Actiu', '1', 'VIA006'),
('Normal', '2024-01-30', 'Actiu', '1', 'VIA007'),
('Especial', '2024-01-31', 'Cancel·lat', '1', 'VIA008'),
('VIP', '2024-02-01', 'Actiu', '1', 'VIA009'),
('Normal', '2024-02-02', 'Actiu', '1', 'VIA010');

-- Inserts para la tabla SUBSCRIPCIO
INSERT INTO SUBSCRIPCIO (ID_sub, Pla, Preu) VALUES
('SUB001', 'Plus', 9.99),
('SUB002', 'Premium', 39.99),
('SUB003', 'Enterprise', 259.99);

-- Inserts para la tabla CLIENTS
INSERT INTO CLIENTS (Nom, Cognom, Email, Data_naixement, CP, ID_billet, usuari) VALUES
('Luis', 'Gutierrez', 'luis@gmail.com', '1990-05-15', '08001', '1', 'cliente1'),
('Carmen', 'Santos', 'carmen@yahoo.com', '1985-07-20', '28002', '2', 'cliente2'),
('Javier', 'Hernandez', 'javier@hotmail.com', '1992-02-10', '41003', '3', 'cliente3'),
('Raquel', 'Ruiz', 'raquel@gmail.com', '1988-12-05', '46004', '4', 'cliente4'),
('Fernando', 'Iglesias', 'fernando@yahoo.com', '1995-09-18', '48005', '5', 'cliente5'),
('Silvia', 'Vega', 'silvia@hotmail.com', '1983-04-25', '50006', '6', 'cliente6'),
('Pablo', 'Ramos', 'pablo@gmail.com', '1998-11-30', '29007', '7', 'cliente7'),
('Eva', 'Perez', 'eva@yahoo.com', '1980-08-14', '03008', '8', 'cliente8'),
('Daniel', 'Gomez', 'daniel@hotmail.com', '1993-06-22', '07009', '9', 'cliente9'),
('Natalia', 'Lopez', 'natalia@gmail.com', '1986-03-07', '18010', '10', 'cliente10');
