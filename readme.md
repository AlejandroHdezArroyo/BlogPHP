# Patrón Modelo Vista Controlador

1. Todas las peticiones van a ir a index.php
2. Recoger las urls y enviar la responsabilidad de qué hacer a los controladores
3. Controladores harán preguntas BBDD y cargaran las vistas



CASCADA
    DELETE PEPE --> DELETE ARTICULOS 
                --> DELETE COMENTARIOS

RESTRICT
    DELETE PEPE --> DELETE ARTICULOS 
                --> DELETE COMENTARIOS   

NULL
    


PEPE

    Articulo 1
        titulo
        texto
        img_1
        img_2
        img_2

    Articulo 2
    Articulo 3
    Articulo 4
    Articulo 5









INDEX.PHP (Controlador principal)

    /profesor/1   -->
                        1. GET * FROM PROFESOR WHERE id = 1
                        2. Require_once(profesor.php)

    /home/          --> require_once(home.php)

    /contacto


    /profesor/edit/1  ---> edit_profesor.php...



CRUD : CREATE READ UPDATE DELETE
    CREATE          POST  /profesor                 --> ProfesorController create()
    READ ONE        GET   /profesor/{id}            --> ProfesorController show() 
                                                            { Obtener profesor y mostrar vista }
    READ LIST       GET   /profesores
    UPDATE          POST  /profesor/{id}
    DELETE          POST  /profesor/delete/{id}

    VIEWS
        UPDATE     GET     /profesor/edit/{id}
        CREATE     GET     /profesor/create



WEB CONTROLLER
    --> ProfesorController
    --> HomeController  
    --> ContactController 


05/05/2022
WEB
    GET     / o /home       --> home.php
    GET     /servicios      --> servicios.php
    GET     /quienes-somos  --> about.php
    GET     /login          --> login.php
    GET     /register       --> sigunp.php

ARTICULOS  (CRUD)

    READ        GET     /articulo/1     
                                        Articulo::getByID(1)
                                    --> articulo.php
                GET     /articulo/create     
                            --> views/article/create.php
    CREATE      POST    /articulo
                        Article::create();

    DELETE      POST    /articulo/delete/2
                        $articulo = Articulo::findByID(2)
                        $articulo->delete();

    UPDATE      POST    /articulo/edit/2
                        $articulo = Articulo::findByID(2)
                        $articulo->edit();

GET     /servicios
        --> require_once("views/servicios.php");

GET     /user/1
    1. Ir a buscar el usuario número
        $user = User::findByID(1);

    2. Cargar una vista, con la info de $user
        require_once("views/user.php")
        
POST    /user/1


06/05/2022
1. Como pediríamos datos a un modelo desde el controlador

2. Registro de Usuario
    2.1 GET     /signup     --> maquetación de formulario views/user/create.php
    2.2 POST    /signup     -->
                        ruta en Controlodar 
                        método create() en UserController
                        método create() en User
                        redirigir al /login

3. Login 
    3.1 Vista /login --> formulario login.php
    3.2 POST /login   --> Comprobar en BBDD el login
    3.3 CREAR SESSION
    3.4 Preguntar por la session



TAREAS PARA PROYECTO:
1. hacer el logout
    POST/logout 

2. no acceder a /signup si estamos logueados

3. blog
    - artículos
        - titulo
        - descripcion
        - imagen
        - autor

        CRUD completo de los artículos:
            - creación (formulario de creacion)
                --> imagen
            - edición (formulario de edición)
            - vista
            - borrado (si eres el autor)
    
    - listado de artículos con paginación

    ESTO OPCIONAL:
    - página de perfil del usuario
        - artículos creados
        - información de usuario: nombre, apellidos, imagen de perfil, descipción...
    - página de edición de ususario
    - boton de borrar usuario


    Ideas:
    - comentarios en artículos
    - categorías en artículos
    - filtrado de artículos en la home en base a categorías
    - buscador de artículos
    - listado de artículos favoritos...






    PARA CRUD DEL BLOG
    - Un usuario tiene que estar registrado y logueado para escribir un artículo
    - Un usuario puede escribir muchos articulos
    - Un artículo los escribe un usuario
    - Un artículo tiene: tiítulo, subtitulo, texto, autor, imágen(de portada), imagen (en cuerpo), creado_en, categoría...
    - Usuario tiene: email, password, nombre, apellidos, imagen...
