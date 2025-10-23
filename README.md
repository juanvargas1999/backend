Bienvenido a JEFT_J!!!

El proyecto esta desarrollado en PHP como backend y en ReactJS como front
mas MySQL como base de datos para lo cual:


(LEA EL PASO NUMERO 4, ES EL MAS IMPORTANTE):::::::::::::::::::::::::::::::::::::::::::::::::::
INCLUSIVE LEALO PRIMERO COMO RECOMENDACION PARA PODER VER CORRECTAMENTE EL FRONT CON EL BACKEND

1. Importa el archivo SQL a tu base de datos MYSQL y cambiar en los php de conexion
pues los datos de conexion de la base a la que tenga su usuario.

2. Ya que se usa php como back, es necesario tener un servidor que pueda ejecutarlo,
en mi caso uso XAMMPP y ejecuto APACHE, aunque tambien se puede instalar directamente
PHP desde consola y ejecutarlo mas esto va en preferencias, sugiero xammpp por su agilidad
y sencilles en un ambiente de pruebas.

3. Node necesario para ejectuar REACTJS, aunque mi Proyecto no necesita que el 
servidor de prueba de node esté corriendo, si es necesario en caso de querer modificar las
el codigo para que coincidan las rutas del backend php, yo aplico el comando "npm run dev"
para correr el servidor de prueba, pero uso tambien "npm run build" para solo tener
el servidor php iniciado sin usar el de node, entonces ese comando se usa en caso de 
modificar el codigo del front para cambiar las rutas para leer el backend.
para poder visualizar todo correctamente.
Una ves hecho esto puede ir al link: 

http://localhost/(RUTA DONDE GUARDÓ EL PROYECTO)/frontend1/dist/Home

PARA VISUALIZAR LA PAGINA INICIAL EN DESARROLLO, cabe recordar que esto es cuando tambien 
tenga el frontend, en caso de no tenerlo y querer probar los archivos PHP
es similar, por ejemplo este es para testear la conexion a la base:

http://(RUTA DONDE SE GUARDO EL PROYECTO)/backend/php/conex/database_check.php


4. PARA EJECUTAR LA PAGINA SIN MODIFICAR NADA DEL CODIGO:::::::::::::::::::::::::::::::::::::::

LA CARPETA FRONTEND Y BACKEND deben estar en la misma carpeta por cuestiones
de enlazado del back con el front, ¿por que?, ya que las rutas del front al back NO SON RELATIVAS sino
absolutas en mi proyecto, por lo cual se debe escribir la ruta completa, en caso de no querer modificar el codigo claro esta.
simplemente cree estas carpetas:

"Proyecto_sena/JEFT_J_R" dentro de la carpeta "htdocs" en caso de usar XAMMPP, ya que esa carpeta es donde se guardan los proyectos en XAMMPP y allí pegue
las carpetas "FRONTEND y BACKEND" del repositori de github,
así podrá pobrar rápidamente el proyecto sin cambiar nada
del codigo.
y la ruta inicial del proyecto quedaría así: 

"http://127.0.0.1/Proyecto_sena/JEFT_J_R/frontend1/dist/Home"

IMPORTANTE!!!

El proyecto funciona en el front sin necesidad de correr el servidor de NODE o NPM,
Ya que se genera un "build"similar al que se usa diretamente en produccion,
que se ejecuta directamente en APACHE, NO es necesario correr
dos servidores al tiempo y a causa de correr en el mismo servidor tampoco hay
la necesidad de usar CORS entre el front y el backend, al menos en la ejecución local
que en este caso se esta rezalizando.


GRACIAS!!!