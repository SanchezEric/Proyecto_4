CREATE TABLE nivel(
	id_nivel int (11) NOT NULL AUTO_INCREMENT,
	nombre_nivel VARCHAR (10) NULL,
	descripcion_nivel TEXT,

	CONSTRAINT PK_Nivel PRIMARY KEY (id_nivel)
)

CREATE TABLE usuario(
	id_usuario int(11) NOT NULL AUTO_INCREMENT,
	password VARCHAR(50) NULL,
	nombre_usuario VARCHAR(20) NULL,
	apellidos_usuario VARCHAR(40) NULL,
	mail_usuario VARCHAR(50) NULL,
	direccion_usuario VARCHAR(60) NULL,
	telefono_usuario VARCHAR(9) NULL,
	nivel_usuario int (11) NULL,

	CONSTRAINT PK_Usuario PRIMARY KEY (id_usuario),
	CONSTRAINT FK_Nivel_Usuario FOREIGN KEY (nivel_usuario) REFERENCES nivel(id_nivel)
)

CREATE TABLE ubicacion(
	id_ubicacion int (11) NOT NULL AUTO_INCREMENT,
	casa_lat VARCHAR (30) NULL,
	casa_lon VARCHAR (30) NULL,
	trabajo_lat VARCHAR (30) NULL,
	trabajo_lon VARCHAR (30) NULL,

	CONSTRAINT PK_Ubicacion PRIMARY KEY (id_ubicacion)
)

CREATE TABLE lista(
	id_lista int (11) NOT NULL AUTO_INCREMENT,
	id_usuario int (11) NULL,
	nombre_lista VARCHAR (30) NULL,
	descripcion_lista TEXT,

	CONSTRAINT PK_Lista PRIMARY KEY (id_lista),
	CONSTRAINT FK_Usuario_Lista FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
)


CREATE TABLE contacto(
	id_contacto int (11) NOT NULL AUTO_INCREMENT,
	nombre_contacto VARCHAR (20) NULL,
	apellidos_contacto VARCHAR (40) NULL,
	id_ubicacion int (11) NULL,
	id_lista int (11) NULL,

	CONSTRAINT PK_Contacto PRIMARY KEY (id_contacto),
	CONSTRAINT FK_Ubicacion_Contacto FOREIGN KEY (id_ubicacion) REFERENCES ubicacion(id_ubicacion),
	CONSTRAINT FK_Lista_Contacto FOREIGN KEY (id_lista) REFERENCES lista(id_lista)
)