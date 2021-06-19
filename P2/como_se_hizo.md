# Práctica 2

*Autor: José Antonio Álvarez Ocete*

### 1. Configuración de la base de datos

Empezamos la práctica configurando la base de datos. Abrimos una conexión *ssh* a `betatun.ugr.es` y ejecutamos el siguiente comando para acceder a nuestra BBDD:

```
mysql -u pw12345678 -p
```

Una vez conectados a MariaDB con nuestro usuario utilizamos el siguiente comando para seleccionar nuestra base de datos:

```
use db77553417_pw2021;
```

Necesitaremos tres tablas. Una de usuario, una de series y otra de secciones. El diagrama de la base de datos es el siguiente:

![](db_diagram/diagram.png)

Creamos la tabla de los usuarios:

```
create table if not exists user (
    username varchar(255) not null,
    name varchar(255) not null,
    password varchar(255) not null,
    email varchar(255) not null,
    phone int(9),
    profile_picture_path varchar(255) not null,
    primary key(username)
);
```

Donde la clave primaria es `username`, que tendrá que ser único por usuario. Utilizaremos el usuario para el *login* pero después mostraremos su nombre (`name`) en la parte superior derecha de la pantalla. Cabe destacar también el `profile_picture_path`, el path a la imagen de perfil que suba el usuario, que almacenaremos en el servidor.

Procedemos a crear la tabla de secciones:

```
create table if not exists section (
    section_id int auto_increment,
    name varchar(255) not null,
    primary key(section_id)
);
```

Donde hacemos uso del `auto_increment` para automatizar la asignación de ids. Y finalmente creamos la tabla de series:

```
create table if not exists serie (
    serie_id int auto_increment,
    section_id int not null,
    title varchar(255) not null,
    genre varchar(255) not null,
    n_temps int not null,
    platform varchar(255) not null,
    pegi_18 bool not null,
    premiere_date date not null,
    serie_picture_path varchar(255) not null,
    primary key(serie_id),
    foreign key(section_id)
        references section(section_id)
);
```

Donde seleccionamos como clave externa la `section_id` para saber a qué sección pertenece este elemento. Utilizaremos esta asociación para mostrar todas las series de una sección en nuestra web.

Finalmente, para verificar que las base de datos está bien configurada utilizamos el siguiente comando para ver lass tablas existentes en neustra base de datos:

```
show tables;

+-----------------------------+
| Tables_in_db77553417_pw2021 |
+-----------------------------+
| section                     |
| serie                       |
| user                        |
+-----------------------------+
```

Para verificar los campos y las restricciones de una tabla utilizamos:

```
show fields from user;

+----------------------+--------------+------+-----+---------+-------+
| Field                | Type         | Null | Key | Default | Extra |
+----------------------+--------------+------+-----+---------+-------+
| username             | varchar(255) | NO   | PRI | NULL    |       |
| name                 | varchar(255) | NO   |     | NULL    |       |
| password             | varchar(255) | NO   |     | NULL    |       |
| email                | varchar(255) | NO   |     | NULL    |       |
| phone                | int(9)       | YES  |     | NULL    |       |
| profile_picture_path | varchar(255) | NO   |     | NULL    |       |
+----------------------+--------------+------+-----+---------+-------+
```

```
show fields from serie;

+--------------------+--------------+------+-----+---------+----------------+
| Field              | Type         | Null | Key | Default | Extra          |
+--------------------+--------------+------+-----+---------+----------------+
| serie_id           | int(11)      | NO   | PRI | NULL    | auto_increment |
| section_id         | int(11)      | NO   | MUL | NULL    |                |
| title              | varchar(255) | NO   |     | NULL    |                |
| genre              | varchar(255) | NO   |     | NULL    |                |
| n_temps            | int(11)      | NO   |     | NULL    |                |
| platform           | varchar(255) | NO   |     | NULL    |                |
| pegi_18            | tinyint(1)   | NO   |     | NULL    |                |
| premiere_date      | date         | NO   |     | NULL    |                |
| serie_picture_path | varchar(255) | NO   |     | NULL    |                |
+--------------------+--------------+------+-----+---------+----------------+
```

Con esto ya tenemos nuestra base de datos configurada.


# X. Cosas pendientes

Limpito por ahora
