# Práctica 1

*Autor: José Antonio Álvarez Ocete*

### 1. Configuración de la base de datos

Empezamos la práctica configurando la base de datos. Abrimos una conexión *ssh* a `betatun.ugr.es` y ejecutamos el siguiente comando para acceder a nuestra BBDD:

```
mysql -u pw12345678 -p
```
Necesitaremos tres tablas. Una de usuario, una de series y otra de secciones. El diagrama de la base de datos es el siguiente:

TODO: Insertar diagrama

Creamos la tabla de los usuarios:

```
create table if not exists user (ç
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
    section_id int autoincrement,
    name varchar(255) not null,
    primary key(section_id)
);
```

Y finalmente creamos la tabla de series:

```
create table if not exists show (
    section_id int autoincrement,
    title varchar(255) not null,
    genre varchar(255) not null,
    n_temps int not null,
    platform varchar(255) not null,
    pegi_18 bool not null,
    premiere_date date not null,
    show_picture_path varchar(255) not null,
    primary key(section_id),
    foreign key(section_id)
        references section(section_id)
);
```

Donde seleccionamos como clave externa la `section_id` para saber a qué sección pertenece este elemento. Utilizaremos esta asociación para mostrar todas las series de una sección en nuestra web.



# X. Cosas pendientes

TODO: Hacer diagrama de la BBDD
